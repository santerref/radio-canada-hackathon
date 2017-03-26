<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SegmentIndexed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $extractAudio;

    public $segment;

    public function __construct($segment, $extractAudio = false)
    {
        $this->segment = $segment;
        $this->extractAudio = $extractAudio;
    }
}
