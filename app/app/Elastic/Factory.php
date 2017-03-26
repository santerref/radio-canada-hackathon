<?php

namespace App\Elastic;

use Carbon\Carbon;

class Factory
{

    public function makeSegment($episode, $programme, $segment, $media)
    {
        $elasticSegment = [
            'id' => sha1($media['id'] . $segment['title'] . Carbon::parse($segment['broadcastedFirstTimeAt'])->toIso8601String()),
            'title' => $segment['title'],
            'canonicalWebLink' => $segment['canonicalWebLink']['href'],
            'summary' => $segment['summary'],
            'broadcastedFirstTimeAt' => Carbon::parse($segment['broadcastedFirstTimeAt'])->toIso8601String(),
            'startAt' => Carbon::parse($segment['broadcastedFirstTimeAt'])->toIso8601String(),
            'endAt' => Carbon::parse($segment['broadcastedFirstTimeAt'])->addSeconds($segment['durationInSeconds'])->toIso8601String(),
            'mediaId' => $media['id'],
            'programme' => [
                'title' => $media['programme']['title'],
                'summary' => $media['programme']['summary'],
                'synopsis' => $programme['synopsis'],
            ],
            'episode' => [
                'title' => $episode['title'],
                'summary' => $episode['summary'],
                'canonicalWebLink' => $episode['canonicalWebLink'],
                'publishedFirstTimeAt' => Carbon::parse($episode['publishedFirstTimeAt'])->toIso8601String(),
                'publishedLastTimeAt' => Carbon::parse($episode['publishedLastTimeAt'])->toIso8601String(),
            ],
        ];

        return $elasticSegment;
    }

}
