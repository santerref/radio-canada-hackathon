<?php

namespace App\Console\Commands;

use App\Jobs\SyncEpisode;
use Illuminate\Console\Command;

class SyncRadioCanada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'radiocanada:sync {programmeId?*} {--all} {--extract-audio}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync media from Radio-Canada APIs to ElasticSearch.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $programmeIds = $this->argument('programmeId');
        $syncAll = $this->option('all');

        if (!$programmeIds && !$syncAll) {
            $this->error('You must specify an ID or use the option --all to sync all medias.');

            return;
        }

        if ($syncAll) {

        } else {
            foreach ($programmeIds as $programmeId) {

                try {
                    $sitesearchResult = app('sitesearch')->call(
                        'internal/rcgraph/indexable-content-summaries',
                        [
                            'ContentTypeIds' => '18',
                            'programmeIds' => $programmeId,
                            'pageSize' => config('radiocanada.page_size'),
                        ]
                    );

                    $programme = app('neuro')->call('programmes/' . $programmeId);

                    foreach ($sitesearchResult['items'] as $key => $episode) {
                        echo ($key + 1) . "/" . count($sitesearchResult['items']) . " (" . $programmeId . ")\r\n";
                        $neuroResult = app('neuro')->call('episodes/' . $episode['id'] . '/clips');
                        echo "\t" . count($neuroResult) . " segments.\r\n";
                        foreach ($neuroResult as $segment) {
                            $media = $this->getMediaFromSegment($segment);

                            if ($media) {
                                dispatch(new SyncEpisode([
                                    'episode' => $episode,
                                    'programme' => $programme,
                                    'segment' => $segment,
                                    'media' => $media,
                                ], $this->option('extract-audio')));
                            }
                        }
                    }
                } catch (\Exception $e) {
                    echo $e->getCode() . ": " . $e->getMessage() . "\r\n";
                }
            }
        }
    }

    protected function getMediaFromSegment($segment)
    {
        if (isset($segment['summaryMultimediaItem']) && isset($segment['summaryMultimediaItem']['futureId'])) {
            $media = app('neuro')->call('media/' . $segment['summaryMultimediaItem']['futureId']);
        } elseif (isset($segment['summaryMultimediaItem']) && isset($segment['summaryMultimediaItem']['items'])) {
            $media = app('neuro')->call('media/' . $segment['summaryMultimediaItem']['items'][0]['media']['futureId']);
        } else {
            $media = false;
        }

        return $media;
    }
}
