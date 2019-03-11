<?php

namespace Rluna\ChuckNorrisJokes;

class JokeFactory
{
    protected $jokes = [
        'Chuck Norris counted to infinity... Twice.',
        'Chuck Norris\' tears cure cancer. Too bad he has never cried.',
        'The Great Wall of China was originally created to keep Chuck Norris out. It failed miserably.',
    ];

    public function __construct(array $jokes = null)
    {
        if ($jokes) {
            $this->jokes = $jokes;
        }
    }

    public function getRandomJoke()
    {
        return $this->jokes[array_rand($this->jokes)];
    }
}
