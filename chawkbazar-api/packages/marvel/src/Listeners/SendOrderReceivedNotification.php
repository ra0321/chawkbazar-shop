<?php

namespace Marvel\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Marvel\Events\OrderReceived;
use Marvel\Notifications\NewOrderReceived;

class SendOrderReceivedNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param OrderReceived $event
     * @return void
     */
    public function handle(OrderReceived $event)
    {
        $vendor = $event->order->shop->owner;
        $vendor->notify(new NewOrderReceived($event->order));
    }
}
