<?php

namespace Rluna\ChuckNorrisJokes;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\TransferStats;
use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

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
