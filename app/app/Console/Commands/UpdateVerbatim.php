<?php

namespace App\Console\Commands;

use App\Jobs\ExtractTextFromVerbatim;
use App\MicrosoftAzureJob;
use Illuminate\Console\Command;
use WindowsAzure\Common\Internal\MediaServicesSettings;
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\MediaServices\Models\AccessPolicy;
use WindowsAzure\MediaServices\Models\Locator;

class UpdateVerbatim extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'radiocanada:update-verbatim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download extracted text and push it into ElasticSearch.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobs = MicrosoftAzureJob::whereStatus('Finished')->get();

        $restProxy = ServicesBuilder::getInstance()->createMediaServicesService(
            new MediaServicesSettings('lunfelhackathon', '8rPzGIYyFP3agGrLrfwDNLu7igKS3KMe5C8LLaKY/Zw=')
        );

        foreach ($jobs as $job) {
            $azureJob = $restProxy->getJob($job->job_id);
            $assets = $restProxy->getJobOutputMediaAssets($azureJob);

            foreach ($assets as $asset) {
                $files = $restProxy->getAssetAssetFileList($asset);

                $access = new AccessPolicy('Public File');
                $access->setDurationInMinutes(3600);
                $access->setPermissions(AccessPolicy::PERMISSIONS_WRITE | AccessPolicy::PERMISSIONS_LIST | AccessPolicy::PERMISSIONS_READ);
                $access = $restProxy->createAccessPolicy($access);

                $sasLocator = new Locator($asset, $access, Locator::TYPE_SAS);
                $sasLocator = $restProxy->createLocator($sasLocator);

                foreach ($files as $file) {
                    $restProxy->downloadAssetFile($file, $sasLocator, storage_path('app/verbatim'));
                    dispatch(new ExtractTextFromVerbatim($job->media_id,
                        storage_path('app/verbatim/' . $file->getName())));
                }

                $restProxy->deleteLocator($sasLocator);
                $restProxy->deleteAccessPolicy($access);
            }
        }
    }
}
