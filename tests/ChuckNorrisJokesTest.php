<?php

use Orchestra\Testbench\TestCase;

class TestCase extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        // Your code here
    }

    protected function getPackageProviders($app)
    {
        return ['Rluna\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ChuckNorris' => 'Rluna\ChuckNorrisJokes\Facades\ChuckNorris'
        ];
    }
}
