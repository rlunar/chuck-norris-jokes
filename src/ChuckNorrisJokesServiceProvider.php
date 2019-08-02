<?php

namespace Rluna\ChuckNorrisJokes;

use Illuminate\Support\ServiceProvider;
use App\ChuckNorrisJokes\JokeFactory;

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
