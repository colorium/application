<?php

/**
 * Database setup
 */

use Colorium\Orm;
use App\Model\User;

$sqlite = new Orm\SQLite(__DIR__ . '/database.db', [
    'user' => User::class
]);

Orm\Hub::source($sqlite);



/**
 * Authentication setup
 * Define user factory when login in
 */

use Colorium\Stateful\Auth;

Auth::factory(function($ref) {
    return User::one(['id' => $ref]);
});



/**
 * Template setup
 */

use Colorium\Templating\Templater;

$templater = new Templater(__DIR__ . '/views/');



/**
 * Router setup
 */

use Colorium\Routing\Router;

$router = new Router([
    'GET  /login'                   => 'App\Logic\Users::login',
    'POST /authenticate'            => 'App\Logic\Users::authenticate',
    'GET  /logout'                  => 'App\Logic\Users::logout',
    'GET  /'                        => 'App\Logic\Home::page',
]);



/**
 * App instance
 */

$app = new Colorium\App\Front($router, $templater);



/**
 * Http event
 */

$app->events([
    401 => 'App\Logic\Errors::unauthorized',
    404 => 'App\Logic\Errors::notfound',
    Exception::class => 'App\Logic\Errors::fatal'
]);



/**
 * Dev mode
 */

$trusted = ['127.0.0.1', '::1'];
if(in_array($app->context->request->ip, $trusted)) {
    require 'development.php';
}



/**
 * Finally, run app
 */

$app->run()->end();