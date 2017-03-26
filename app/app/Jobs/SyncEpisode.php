<?php

namespace App\Jobs;

use App\Events\SegmentIndexed;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncEpisode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $episode;

    protected $segment;

    protected $media;

    protected $programme;

    protected $extractAudio;

    public function __construct($data, $extractAudio = false)
    {
        $this->episode = $data['episode'];
        $this->segment = $data['segment'];
        $this->media = $data['media'];
        $this->programme = $data['programme'];
        $this->extractAudio = $extractAudio;
    }

    public function handle()
    {
        $segment = app('factory')->makeSegment(
            $this->episode,
            $this->programme,
            $this->segment,
            $this->media
        );

        app('elastic')->request('POST', 'media/segment/' . $segment['doc']['id'] . '/_update', [
            'body' => json_encode($segment),
        ]);

        event(new SegmentIndexed($segment, $this->extractAudio));
    }
}
