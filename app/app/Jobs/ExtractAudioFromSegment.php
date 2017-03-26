<?php

namespace App\Jobs;

use App\MicrosoftAzureJob;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use WindowsAzure\Common\Internal\MediaServicesSettings;
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\MediaServices\MediaServicesRestProxy;
use WindowsAzure\MediaServices\Models\AccessPolicy;
use WindowsAzure\MediaServices\Models\Asset;
use WindowsAzure\MediaServices\Models\Job;
use WindowsAzure\MediaServices\Models\Locator;
use WindowsAzure\MediaServices\Models\Task;
use WindowsAzure\MediaServices\Models\TaskOptions;

class ExtractAudioFromSegment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $segment;

    public function __construct($segment)
    {
        $this->segment = $segment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $microsoftAzureJob = MicrosoftAzureJob::whereMediaId($this->segment['doc']['mediaId'])->first();
        if ($microsoftAzureJob) {
            return;
        }

        $mediaServicesRestProxy = ServicesBuilder::getInstance()->createMediaServicesService(
            new MediaServicesSettings('lunfelhackathon', '8rPzGIYyFP3agGrLrfwDNLu7igKS3KMe5C8LLaKY/Zw=')
        );

        try {
            $url = sprintf(config('radiocanada.media_uri'), $this->segment['doc']['mediaId']);
            $response = app('guzzle')->request('GET', $url);
            $content = json_decode($response->getBody()->getContents(), true);

            $mediaFile = storage_path('app/media/' . $this->segment['doc']['mediaId']) . '.mp4';
            $fileName = $this->segment['doc']['mediaId'] . '.mp4';

            $command = sprintf(
                config('radiocanada.ffmpeg') . ' -y -i "%1$s" -acodec copy -vcodec copy %2$s 2>&1',
                $content['url'],
                $mediaFile
            );

            if ($handle = popen($command, 'r')) {
                pclose($handle);
                $asset = $this->createAsset($mediaServicesRestProxy, $mediaFile, $fileName);

                $processor = $mediaServicesRestProxy->getLatestMediaProcessor('Azure Media Indexer 2 Preview');

                $task = new Task('<?xml version="1.0" encoding="utf-8"?><taskBody><inputAsset>JobInputAsset(0)</inputAsset><outputAsset>JobOutputAsset(0)</outputAsset></taskBody>',
                    $processor->getId(), TaskOptions::NONE);
                $task->setConfiguration(file_get_contents(storage_path('app/azure') . '/Configuration.json'));

                $job = $mediaServicesRestProxy->createJob(new Job(), [$asset], [$task]);

                $result = $mediaServicesRestProxy->getJobStatus($job);

                $microsoftAzureJob = MicrosoftAzureJob::create([
                    'asset_id' => $asset->getId(),
                    'job_id' => $job->getId(),
                    'media_id' => $this->segment['doc']['mediaId'],
                    'status' => MicrosoftAzureJob::JOB_STATUS_MAP[$result],
                ]);

                echo "\tJob started for media " . $microsoftAzureJob->media_id . ".mp4\r\n";
            }

        } catch (\Exception $e) {
            echo "[" . get_class($e) . "] " . $e->getCode() . ": " . $e->getMessage() . "\r\n";
        }
    }

    protected function createAsset(MediaServicesRestProxy &$restProxy, $mediaFile, $fileName)
    {
        $asset = new Asset(Asset::OPTIONS_NONE);
        $asset = $restProxy->createAsset($asset);

        $access = new AccessPolicy('Public File');
        $access->setDurationInMinutes(3600);
        $access->setPermissions(AccessPolicy::PERMISSIONS_WRITE);
        $access = $restProxy->createAccessPolicy($access);

        $sasLocator = new Locator($asset, $access, Locator::TYPE_SAS);
        $sasLocator->setStartTime(new \DateTime('now -5 minutes'));
        $sasLocator = $restProxy->createLocator($sasLocator);

        $handle = fopen($mediaFile, 'r');
        $restProxy->uploadAssetFile($sasLocator, $fileName, $handle);
        $restProxy->createFileInfos($asset);
        fclose($handle);

        return $asset;
    }
}
