<?php

/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'products'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return 'GET /products';
    });

    $router->post('/', function () use ($router) {
        return 'POST /products';
    });

    $router->get('{uuid}','GetProductController@index');

    $router->put('{uuid}', function ($uuid) {
        return 'PUT /products/'.$uuid;
    });

    $router->patch('{uuid}', function ($uuid) {
        return 'PATCH /products/'.$uuid;
    });

    $router->delete('{uuid}', function ($uuid) {
        return 'DELETE /products/'.$uuid;
    });
});
