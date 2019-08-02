<?php

namespace Rluna\ChuckNorrisJokes\Tests;

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Rluna\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Rluna\ChuckNorrisJokes\Facades\ChuckNorris;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ChuckNorrisJokesServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ChuckNorris' => ChuckNorris::class,
        ];
    }

    /** @test */
    public function the_console_command_returns_a_joke()
    {
        $this->withoutMockingConsoleOutput();
        ChuckNorris::shouldReceive('getRandomJoke')
                    ->once()
                    ->andReturn('Chuck Norris can instantiate an abstract class.');
        $this->artisan('chuck-norris');
        $output = Artisan::output();
        $this->assertSame('Chuck Norris can instantiate an abstract class.'.PHP_EOL, $output);
    }

    /** @test */
    public function the_route_can_be_accessed()
    {
        $this->get('/chuck-norris')->assertStatus(200);
    }
}
