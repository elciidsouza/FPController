<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ImportsAnimesController extends Controller
{
    public function index(){

        $queryPages = '
        query ($page: Int) {
          Page(page: $page, perPage: 50) {
            pageInfo {
              total
              perPage
              currentPage
              lastPage
              hasNextPage
            }
            media(seasonYear: 2019) {
              id
            }
          }
        }
        ';

        $queryAnimes = '
        query ($page: Int) {
            Page(page: $page, perPage: 50) {
                media(seasonYear: 2019) {
                    id  
                    title {
                        romaji
                    }
                    startDate {
                        year
                        month
                        day
                    }
                    endDate {
                      year
                      month
                      day
                    }
                    coverImage {
                      extraLarge
                    }
                    season
                    status
                    nextAiringEpisode {
                          episode
                          timeUntilAiring
                    }
                    episodes
                    genres
                    isAdult
                }
            }
        }
        ';

        $variablesPages = [
            "page" => 1
        ];

        $http = new \GuzzleHttp\Client();
        //$http = new GuzzleHttp\Client;
        $response = $http->post('https://graphql.anilist.co', [
            'json' => [
                'query' => $queryPages,
                'variables' => $variablesPages,
            ]
        ]);

        $jsonPages = json_decode($response->getBody()->getContents());

        $lastPage = $jsonPages->data->Page->pageInfo->lastPage;

        echo 'Qtd Páginas: ' . $lastPage . '<br>';

        $pageAtual = 1;

        for($i = 1; $i <= $lastPage; $i++){
            $variablesAnimes = [
                "page" => $pageAtual
            ];

            echo "<br>Página atual: " . $pageAtual . "<br>";

            $responseAnimes = $http->post('https://graphql.anilist.co', [
                'json' => [
                    'query' => $queryAnimes,
                    'variables' => $variablesAnimes,
                ]
            ]);

            $jsonAnimes = json_decode($responseAnimes->getBody()->getContents(), true);

            $pageAtual = $pageAtual+1;

            foreach($jsonAnimes['data']['Page']['media'] as $pos => $dados){
                echo $dados['title']['romaji'] . '<br>';
            }

            echo "<br>";

        }

        echo 'Última página: ' . $pageAtual . '<br>';

    }
}
