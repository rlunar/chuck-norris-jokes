<?php

namespace Rluna\ChuckNorrisJokes;

use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Log;

class JokeFactory
{
    const API_BASE = 'http://api.icndb.com/';
    const API_ENDPOINT = 'jokes/random/';

    protected $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client;
    }

    public function getRandomJoke()
    {
        $response = $this->client->get(self::API_BASE.self::API_ENDPOINT, [
            'on_stats'  => function (TransferStats $stats) {
                Log::debug(
                    'Request => '.$stats->getRequest()->getBody().
                    ' | Response => '.$stats->getResponse()->getBody().
                    ' | Tx Time => '.$stats->getTransferTime()
                );
            },
        ]);

        $joke = json_decode((string) $response->getBody());

        return $joke->value->joke;
    }
}
