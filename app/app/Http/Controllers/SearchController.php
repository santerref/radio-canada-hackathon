<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Carbon\Carbon;
use Faker\Factory;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        $response = app('elastic')->request('POST', 'media/segment/_search', [
            'query' => [
                'size' => 100,
            ],
            'body' => json_encode([
                'query' => [
                    'query_string' => [
                        'query' => $request->get('q'),
                    ],
                ],
            ]),
        ]);

        $results = \GuzzleHttp\json_decode($response->getBody()->getContents(), true)['hits']['hits'];

        // $results = $this->fakeResults();

        $results = array_map(function ($result) {
            $result['_source']['title'] = html_entity_decode($result['_source']['title']);

            $start = Carbon::parse($result['_source']['startAt']);
            $end = Carbon::parse($result['_source']['endAt']);

            $result['_source']['programme']['image'] = str_replace(
                '/v1/',
                '/w_250/v1/',
                $result['_source']['programme']['image']
            );

            $result['duration'] = $end->diffInSeconds($start);

            return $result;
        }, $results);

        return $results;
    }

    /**
     * @param $faker
     * @param $emissions
     * @return array
     */
    protected function fakeResults()
    {
        $faker = Factory::create();

        $emissions = [
            'La soirée est encore jeune',
            'Les années lumière',
            'Médium large',
            'Culture club',
            'Plus on est de fous, plus on lit',
            'Gravel le matin',
            'On est pas sorti de l\'auberge',
            'Les grands entretiens',
            'La croisée (Alberta)',
            'La sphère',
        ];

        $nbResults = $faker->numberBetween(1, 10);
        $results = [];
        for ($i = 0; $i < $nbResults; $i++) {
            $results[] = [
                'title' => $faker->sentence,
                'diffusion' => $faker->dateTime->format('Y-m-d H:i'),
                'emission' => $faker->randomElement($emissions),
                'duration' => $faker->numberBetween(1, 30 * 60),
                'description' => $faker->paragraph,
            ];
        }

        return $results;
    }
}
