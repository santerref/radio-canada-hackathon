<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExtractTextFromVerbatim implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mediaId;

    protected $filePath;

    public function __construct($mediaId, $filePath)
    {
        $this->mediaId = $mediaId;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $query = [
            'query' => [
                'constant_score' => [
                    'filter' => [
                        'term' => [
                            'mediaId' => $this->mediaId,
                        ],
                    ],
                ],
            ],
        ];

        $response = app('elastic')->request('POST', 'media/segment/_search', [
            'body' => json_encode($query),
        ]);

        $results = json_decode($response->getBody()->getContents(), true);

        if (isset($results['hits']) && isset($results['hits']['hits'])) {
            foreach ($results['hits']['hits'] as $hit) {
                $hit['_source']['verbatim'] = $this->getSegmentText($hit);
                app('elastic')->request('PUT', 'media/segment/' . $hit['_id'], [
                    'body' => json_encode($hit['_source']),
                ]);
            }
        }
    }

    protected function getSegmentText($hit)
    {
        return file_get_contents($this->filePath);
    }
}
