<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MapFields extends Command
{
    protected $signature = 'elastic:map-fields';

    protected $description = 'Map segment fields.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        app('elastic')->request('DELETE', 'media');

        try {
            app('elastic')->request('PUT', 'media', [
                'body' => json_encode([
                    'settings' => [
                        'analysis' => [
                            'filter' => [
                                'french_stop' => [
                                    'type' => 'stop',
                                    'stopwords' => '_french_',
                                ],
                            ],
                            'analyzer' => [
                                'french' => [
                                    'tokenizer' => 'standard',
                                    'filter' => [
                                        'lowercase',
                                        'french_stop',
                                    ],
                                ],
                            ],
                        ],

                    ],
                    'mappings' => [
                        'segment' => [
                            'properties' => [
                                'title' => [
                                    'type' => 'text',
                                    'analyzer' => 'french',
                                ],
                                'canonicalWebLink' => [
                                    'type' => 'text',
                                ],
                                'summary' => [
                                    'type' => 'text',
                                    'analyzer' => 'french',
                                ],
                                'broadcastedFirstTimeAt' => [
                                    'type' => 'date',
                                ],
                                'startAt' => [
                                    'type' => 'date',
                                ],
                                'endAt' => [
                                    'type' => 'date',
                                ],
                                'mediaId' => [
                                    'type' => 'integer',
                                ],
                                'verbatim' => [
                                    'type' => 'text',
                                    'analyzer' => 'french',
                                ],
                                'programme' => [
                                    'type' => 'nested',
                                    'properties' => [
                                        'title' => [
                                            'type' => 'text',
                                            'analyzer' => 'french',
                                        ],
                                        'summary' => [
                                            'type' => 'text',
                                            'analyzer' => 'french',
                                        ],
                                        'synopsis' => [
                                            'type' => 'text',
                                            'analyzer' => 'french',
                                        ],
                                        'image' => [
                                            'type' => 'text',
                                        ],
                                    ],
                                ],
                                'episode' => [
                                    'type' => 'nested',
                                    'properties' => [
                                        'id' => [
                                            'type' => 'integer',
                                        ],
                                        'title' => [
                                            'type' => 'text',
                                            'analyzer' => 'french',
                                        ],
                                        'summary' => [
                                            'type' => 'text',
                                            'analyzer' => 'french',
                                        ],
                                        'canonicalWebLink' => [
                                            'type' => 'text',
                                        ],
                                        'publishedFirstTimeAt' => [
                                            'type' => 'date',
                                        ],
                                        'publishedLastTimeAt' => [
                                            'type' => 'date',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]),
            ]);
        } catch (\Exception $e) {
            $this->error($e->getCode() . ': ' . $e->getMessage());
        }
    }
}
