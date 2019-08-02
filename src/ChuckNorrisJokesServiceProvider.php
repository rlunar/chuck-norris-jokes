<?php

namespace Rluna\ChuckNorrisJokes;

use Illuminate\Support\ServiceProvider;

class ChuckNorrisJokesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind('ChuckNorris', function () {
            return new JokeFactory();
        });
    }
}
