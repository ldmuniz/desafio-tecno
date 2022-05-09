<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['middleware' => App\Http\Middleware\BearerMiddleware::class], function () use ($router) {
    $router->get('movements', 'APIController@getMovements');
    $router->get('users', 'APIController@getUsers');
    $router->get('records', 'APIController@getRecords');
    $router->get('movements_records/{id}', 'APIController@movementStatistics');
});