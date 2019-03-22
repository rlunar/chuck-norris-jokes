<?php

require __DIR__.'/vendor/autoload.php';

use Rluna\ChuckNorrisJokes\JokeFactory;

$factory = new JokeFactory();
$factory->hello();
