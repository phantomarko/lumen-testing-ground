<?php

use App\Infrastructure\Product\Controller\Http\GetProductController;

/** @var \Laravel\Lumen\Routing\Router $router */
/** @var \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder */

$router->group(['prefix' => 'products'], function () use ($router, $containerBuilder) {
    $router->get('/', function () use ($router) {
        return 'GET /products';
    });

    $router->post('/', function () use ($router) {
        return 'POST /products';
    });

    $router->get('{uuid}',  function ($uuid) use ($containerBuilder) {
        /** @var GetProductController $controller */
        $controller = $containerBuilder->get('App\Infrastructure\Product\Controller\Http\GetProductController.random');
        return $controller->index($uuid);
    });

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

$router->group(['prefix' => 'pokemon'], function () use ($router, $containerBuilder) {
    $router->group(['prefix' => 'products'], function () use ($router, $containerBuilder) {
        $router->get('{uuid}',  function ($uuid) use ($containerBuilder) {
            /** @var GetProductController $controller */
            $controller = $containerBuilder->get('App\Infrastructure\Product\Controller\Http\GetProductController.random_pokemon');
            return $controller->index($uuid);
        });
    });
});
