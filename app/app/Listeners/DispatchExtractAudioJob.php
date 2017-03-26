<?php

namespace App\Listeners;

use App\Events\SegmentIndexed;
use App\Jobs\ExtractAudioFromSegment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DispatchExtractAudioJob
{
    public function __construct()
    {
        //
    }

    public function handle(SegmentIndexed $event)
    {
        if ($event->extractAudio) {
            dispatch(new ExtractAudioFromSegment($event->segment));
        }
    }
}
