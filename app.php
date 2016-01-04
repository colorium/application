<?php

/**
 * Orm setup
 */

use Colorium\Orm;

$sqlite = new Orm\SQlite(__DIR__ . '/files/app.db');
$sqlite->map('user', App\Model\User::class);

$sqlite->builder('user')->create();

Orm\Mapper::source($sqlite);


/**
 * App setup
 */

use Colorium\Kernel;

$app = new Kernel\App;

// routes definition
$app->router->add('get /', 'App\Logic\Home::page');

// events definition
$app->events->on(404, 'App\Logic\Home::notfound');

$app->run();