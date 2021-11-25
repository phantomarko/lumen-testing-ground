<?php

/** @var \Laravel\Lumen\Routing\Router $router */
$router->group(['prefix' => 'products'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return 'GET /products';
    });

    $router->post('/', function () use ($router) {
        return 'POST /products';
    });

    $router->get('{id}', ['uses' => 'GetProductController@execute', 'as' => 'GetProduct']);

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
