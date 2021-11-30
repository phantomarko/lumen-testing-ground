<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// $app->withFacades();

// $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Instance symfony container builder
|--------------------------------------------------------------------------
*/

$containerBuilder = new Symfony\Component\DependencyInjection\ContainerBuilder();
$loader = new Symfony\Component\DependencyInjection\Loader\YamlFileLoader(
    $containerBuilder,
    new Symfony\Component\Config\FileLocator(__DIR__)
);
$loader->load('../config/services.yaml');

/*
|--------------------------------------------------------------------------
| Instance tactician command bus
|--------------------------------------------------------------------------
*/

$mappings = require '../config/cqrs_mapping.php';
$containerLocator = new \League\Tactician\Bundle\Handler\ContainerBasedHandlerLocator(
    $containerBuilder,
    $mappings
);

$commandHandlerMiddleware = new League\Tactician\Handler\CommandHandlerMiddleware(
    new League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor(),
    $containerLocator,
    new League\Tactician\Handler\MethodNameInflector\HandleInflector()
);

$commandBus = new League\Tactician\CommandBus(
    [
        $commandHandlerMiddleware,
        // add other middlewares...
    ]
);

/*
|--------------------------------------------------------------------------
| Register singletons in service container
|--------------------------------------------------------------------------
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Infrastructure\Core\Controller\Http\ExceptionHandler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Infrastructure\Core\Controller\Console\ConsoleKernel::class
);

$app->singleton(
    Symfony\Component\DependencyInjection\ContainerBuilder::class,
    function () use ($containerBuilder) {
        return $containerBuilder;
    }
);

$app->singleton(
    League\Tactician\CommandBus::class,
    function () use ($commandBus) {
        return $commandBus;
    }
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('app');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(\App\Infrastructure\Module\ModuleProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Infrastructure\Product\Controller\Http',
], function ($router) {
    require __DIR__.'/../app/Infrastructure/Product/Resources/routes.php';
});

return $app;
