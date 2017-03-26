<?php

namespace App\Jobs;

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

    public function __construct($episode, $programme, $segment, $media)
    {
        $this->episode = $episode;
        $this->segment = $segment;
        $this->media = $media;
        $this->programme = $programme;
    }

    public function handle()
    {
        $segment = app('factory')->makeSegment(
            $this->episode,
            $this->programme,
            $this->segment,
            $this->media
        );

        $response = app('elastic')->request('PUT', 'media/segment/' . $segment['id'] . '/_create', [
            'body' => json_encode($segment),
        ]);
    }
}
