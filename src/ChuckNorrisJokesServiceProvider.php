<?php

namespace Rluna\ChuckNorrisJokes;

use Illuminate\Support\ServiceProvider;
use Rluna\ChuckNorrisJokes\Console\ChuckNorrisJoke;
use Rluna\ChuckNorrisJokes\JokeFactory;

class ChuckNorrisJokesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ChuckNorrisJoke::class
            ]);
        }
    }

    public function register()
    {
        $this->app->bind('ChuckNorris', function () {
            return new JokeFactory();
        });
    }
}
