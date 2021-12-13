<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
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

$containerBuilder = (new \App\Infrastructure\Core\Factory\SymfonyContainerBuilderFactory('config/services.yaml'))
    ->create();

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
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Ui\Rest\Core\Service\ExceptionHandler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Ui\Console\ConsoleKernel::class
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
*/

$app->configure('app');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
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
*/

// $app->register(\App\Infrastructure\Module\ModuleProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
*/

$app->router->group([
    'namespace' => 'App\Ui\Rest\Product\Controller',
], function ($router) {
    require __DIR__ . '/../app/Ui/Rest/Product/Resources/routes.php';
});

return $app;
