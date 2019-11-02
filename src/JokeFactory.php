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

        return;

        $handlerStack = HandlerStack::create();
        $handlerStack->push(
            Middleware::log(
                app(LogManager::class)->channel(),
                new MessageFormatter('[{ts}] {req_body} - {res_body} - {transfer_time}')
            )
        );

        $this->client = $client ?? new Client(
            [
                'handler' => $handlerStack,
            ]
        );
    }

    public function getRandomJoke()
    {
        $logger = app(LogManager::class)->channel();
        $response = $this->client->get(self::API_BASE.self::API_ENDPOINT, [
            'on_stats'  => function (TransferStats $stats) use ($logger) {
                // do something inside the callable.
//                echo $stats->getTransferTime() . "\n";
                Log::debug(
                    'Request => '.$stats->getRequest()->getBody().
                    ' | Response => '.$stats->getResponse()->getBody().
                    ' | Tx Time => '.$stats->getTransferTime()
                );
//                $logger->debug(
//                    'Request' . $stats->getRequest()->getBody() .
//                    'Response' . $stats->getResponse()->getBody() .
//                    'Tx Time' . $stats->getTransferTime()
//                );
            },
        ]);

        $joke = json_decode((string) $response->getBody());

        return $joke->value->joke;

        $response = $this->client->get(self::API_BASE.self::API_ENDPOINT, [
            'on_stats' => function (TransferStats $stats) {
                $stats->getTransferTime();
//                Log::info($stats->getTransferTime());
                // echo $stats->getEffectiveUri() . "\n";
                // echo $stats->getTransferTime() . "\n";
                // var_dump($stats->getHandlerStats());

                // You must check if a response was received before using the
                // response object.
                if ($stats->hasResponse()) {
                    // echo $stats->getResponse()->getStatusCode();
                } else {
                    // Error data is handler specific. You will need to know what
                    // type of error data your handler uses before using this
                    // value.
                    // var_dump($stats->getHandlerErrorData());
                }
            },
        ]);

        $joke = json_decode((string) $response->getBody());
        // $joke = json_decode($response->getBody()->getContents());

        return $joke->value->joke;
    }
}
