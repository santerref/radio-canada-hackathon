<?php

namespace App\Elastic;

use Carbon\Carbon;

class Factory
{

    public function makeSegment($episode, $programme, $segment, $media)
    {
        $elasticSegment = [
            'doc' => [
                'id' => sha1(
                    $media['id'] .
                    $segment['title'] .
                    Carbon::parse($segment['broadcastedFirstTimeAt'])->toIso8601String() .
                    Carbon::parse($segment['broadcastedFirstTimeAt'])->toIso8601String() .
                    Carbon::parse($segment['broadcastedFirstTimeAt'])->addSeconds($segment['durationInSeconds'])->toIso8601String()
                ),
                'title' => $segment['title'],
                'canonicalWebLink' => $segment['canonicalWebLink']['href'],
                'summary' => $segment['summary'],
                'broadcastedFirstTimeAt' => Carbon::parse($segment['broadcastedFirstTimeAt'])->toIso8601String(),
                'startAt' => Carbon::parse($segment['broadcastedFirstTimeAt'])->toIso8601String(),
                'endAt' => Carbon::parse($segment['broadcastedFirstTimeAt'])->addSeconds($segment['durationInSeconds'])->toIso8601String(),
                'mediaId' => $media['id'],
                'verbatim' => '',
                'programme' => [
                    'title' => $media['programme']['title'],
                    'summary' => $media['programme']['summary'],
                    'synopsis' => $programme['synopsis'],
                    'canonicalWebLink' => $programme['canonicalWebLink']['href'],
                ],
                'episode' => [
                    'id' => $episode['id'],
                    'title' => $episode['title'],
                    'summary' => $episode['summary'],
                    'canonicalWebLink' => $episode['canonicalWebLink'],
                    'publishedFirstTimeAt' => Carbon::parse($episode['publishedFirstTimeAt'])->toIso8601String(),
                    'publishedLastTimeAt' => Carbon::parse($episode['publishedLastTimeAt'])->toIso8601String(),
                ],
            ],
            'doc_as_upsert' => true,
        ];

        if (!empty($programme['summaryMultimediaItem'])) {
            if (isset($programme['summaryMultimediaItem']['concreteImages']) && !empty($programme['summaryMultimediaItem']['concreteImages'])) {
                $elasticSegment['doc']['programme']['image'] = $programme['summaryMultimediaItem']['concreteImages'][0]['mediaLink']['href'];
            }
        }

        if (!empty($episode['summaryMultimediaItem'])) {
            if (!empty($episode['summaryMultimediaItem']['summaryImage'])) {
                if ($episode['summaryMultimediaItem']['summaryImage']['contentType']['id'] != 21) {
                    if (!empty($episode['summaryMultimediaItem']['summaryImage']['concreteImages'])) {
                        $elasticSegment['doc']['episode']['image'] = $episode['summaryMultimediaItem']['summaryImage']['concreteImages'][0]['mediaLink']['href'];
                    }
                }
            }
        }

        return $elasticSegment;
    }

}
