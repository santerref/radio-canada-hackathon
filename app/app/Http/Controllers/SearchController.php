<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Faker\Factory;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        $response = app('elastic')->request('GET', 'media/segment/_search?size=5');

        $results = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);

        // $results = $this->fakeResults();

        return $results['hits']['hits'];
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
                'description' => $faker->paragraph
            ];
        }
        return $results;
    }
}
