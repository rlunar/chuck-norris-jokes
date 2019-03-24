# Chuck Norris Jokes

Create Chuck Norris Jokes in your next PHP project.

[![Build Status](https://travis-ci.org/rlunar/chuck-norris-jokes.svg?branch=master)](https://travis-ci.org/rlunar/chuck-norris-jokes)
[![coverage report](https://gitlab.elephpant.rocks/school/beyondcode/chuck-norris-jokes/badges/master/coverage.svg)](https://gitlab.elephpant.rocks/school/beyondcode/chuck-norris-jokes/commits/master)
[![StyleCI](https://github.styleci.io/repos/175336033/shield)](https://github.styleci.io/repos/175336033/shield)


## Installation

Require the package using composer.

```bash
composer require rluna/chuck-norris-jokes
```

## Usage

```php
use Rluna\ChuckNorrisJokes\JokeFactory;

$jokes = new JokeFactory();
$joke = $jokes->getRandomJoke();
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[LGPL-3.0](./LICENSE.md)
