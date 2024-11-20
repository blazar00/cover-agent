<?php

require __DIR__ . '/../../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

// Include route definitions
require __DIR__ . '/routes.php';

$app->run();
