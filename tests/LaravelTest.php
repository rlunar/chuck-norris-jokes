<?php

namespace Rluna\ChuckNorrisJokes\Tests;

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Rluna\ChuckNorrisJokes\ChuckNorrisJokesServiceProvider;
use Rluna\ChuckNorrisJokes\Facades\ChuckNorris;
use Rluna\ChuckNorrisJokes\Models\Joke;

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

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        // $app['config']->set('database.default', 'testbench');
        // $app['config']->set('database.connections.testbench', [
        //     'driver'   => 'sqlite',
        //     'database' => ':memory:',
        //     'prefix'   => '',
        // ]);

        include_once __DIR__.'/../database/migrations/create_jokes_table.php.stub';
        (new \CreateJokesTable)->up();
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
        $joke = 'Chuck Norris knows Victoria\'s secret.';
        ChuckNorris::shouldReceive('getRandomJoke')
                    ->once()
                    ->andReturn($joke);
        $this->get('/chuck-norris')
                ->assertViewIs('chuck-norris::joke')
                ->assertViewHas('joke', $joke)
                ->assertStatus(200);
    }

    /** @test */
    public function it_can_access_the_database()
    {
        $testJoke = 'this is funny';

        $joke = new Joke();
        $joke->joke = $testJoke;
        $joke->save();

        $newJoke = Joke::find($joke->id);

        $this->assertSame($newJoke->joke, $testJoke);
    }

    /** @test */
    public function it_calls_the_api()
    {
        $joke = ChuckNorris::getRandomJoke();
        $this->assertContains('Chuck', $joke);
    }
}
