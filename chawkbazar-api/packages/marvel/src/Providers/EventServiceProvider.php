<?php

namespace Marvel\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Marvel\Events\OrderCreated;
use Marvel\Events\OrderReceived;
use Marvel\Listeners\ManageProductInventory;
use Marvel\Listeners\SendOrderCreationNotification;
use Marvel\Listeners\SendOrderReceivedNotification;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        OrderCreated::class => [
            SendOrderCreationNotification::class,
            ManageProductInventory::class,
        ],
        OrderReceived::class => [
            SendOrderReceivedNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
