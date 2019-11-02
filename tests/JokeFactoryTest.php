<?php

namespace Rluna\ChuckNorrisJokes\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Rluna\ChuckNorrisJokes\JokeFactory;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_random_joke()
    {
        $mock = new MockHandler([
            new Response(200, [], '{ "type": "success", "value": { "id": 501, "joke": "Chuck Norris\' programs never exit, they terminate.", "categories": ["nerdy"] } }
'),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $jokes = new JokeFactory($client);
        $joke = $jokes->getRandomJoke();
        $this->assertSame('Chuck Norris\' programs never exit, they terminate.', $joke);
    }
}
