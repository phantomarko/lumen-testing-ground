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

$router->group(['prefix' => 'products'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return 'GET /products';
    });

    $router->post('/', function () use ($router) {
        return 'POST /products';
    });

    $router->get('{id}', function ($id) {
        return 'GET /products/'.$id;
    });

    $router->put('{id}', function ($id) {
        return 'PUT /products/'.$id;
    });

    $router->patch('{id}', function ($id) {
        return 'PATCH /products/'.$id;
    });

    $router->delete('{id}', function ($id) {
        return 'DELETE /products/'.$id;
    });
});
