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
    protected $signature = 'radiocanada:sync {programmeId?} {--all}';

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
        $programmeId = $this->argument('programmeId');
        $syncAll = $this->option('all');

        if (!$programmeId && !$syncAll) {
            $this->error('You must specify an ID or use the option --all to sync all medias.');

            return;
        }

        if ($syncAll) {

        } else {
            $sitesearchResult = app('sitesearch')->call(
                'internal/rcgraph/indexable-content-summaries',
                [
                    'ContentTypeIds' => '18',
                    'programmeIds' => $programmeId,
                    'pageSize' => 200,
                ]
            );

            foreach ($sitesearchResult['items'] as $key => $episode) {
                echo ($key + 1) . "/" . count($sitesearchResult['items']) . "\r\n";
                $neuroResult = app('neuro')->call('episodes/' . $episode['id'] . '/clips');
                echo "\t " . count($neuroResult) . " segments.\r\n";
                foreach ($neuroResult as $segment) {
                    if (isset($segment['summaryMultimediaItem']) && isset($segment['summaryMultimediaItem']['futureId'])) {
                        $media = app('neuro')->call('media/' . $segment['summaryMultimediaItem']['futureId']);
                    } elseif (isset($segment['summaryMultimediaItem']) && isset($segment['summaryMultimediaItem']['items'])) {
                        $media = app('neuro')->call('media/' . $segment['summaryMultimediaItem']['items'][0]['media']['futureId']);
                    } else {
                        $media = false;
                    }
                    $programme = app('neuro')->call('programmes/' . $programmeId);
                    dispatch(new SyncEpisode($episode, $programme, $segment, $media));
                }
            }
        }
    }
}
