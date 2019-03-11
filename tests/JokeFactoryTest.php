<?php

namespace Rluna\ChuckNorrisJokes\Tests;

use PHPUnit\Framework\TestCase;
use Rluna\ChuckNorrisJokes\JokeFactory;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_returns_a_sample_joke()
    {
        $sample = 'This is a joke';
        $jokes = new JokeFactory([$sample]);
        $joke = $jokes->getRandomJoke();
        $this->assertSame($sample, $joke);
    }

    /** @test */
    public function it_returns_a_random_joke()
    {
        $chuckNorrisJokes = [
            'Chuck Norris counted to infinity... Twice.',
            'Chuck Norris\' tears cure cancer. Too bad he has never cried.',
            'The Great Wall of China was originally created to keep Chuck Norris out. It failed miserably.',
        ];
        $jokes = new JokeFactory();
        $joke = $jokes->getRandomJoke();
        $this->assertContains($joke, $chuckNorrisJokes);
    }
}
