<?php

namespace App\Infrastructure\Product\Event;

use App\Application\Product\Listener\SaveProductOnAlternativeStorageListener;
use App\Domain\Product\Event\ProductCreatedEvent;
use Illuminate\Support\Facades\Event;
use Laravel\Lumen\Providers\EventServiceProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ProductEventsProvider extends EventServiceProvider
{
    public function boot()
    {
        $containerBuilder = app(ContainerBuilder::class);

        /** @var SaveProductOnAlternativeStorageListener $saveProductOnAlternativeStorageListener */
        $saveProductOnAlternativeStorageListener = $containerBuilder->get(
            'App\Application\Product\Listener\SaveProductOnAlternativeStorageListener'
        );

        Event::listen(
            ProductCreatedEvent::class,
            [$saveProductOnAlternativeStorageListener, 'onProductCreated']
        );
    }
}
