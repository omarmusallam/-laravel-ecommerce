<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */public function handle(OrderCreated $event)
    {
        $order = $event->order;

        foreach ($order->items as $item) {
            $store = $item->product->store;

            // Find the admins associated with the store
            $admins = Admin::where('store_id', $store->id)->get();

            foreach ($admins as $admin) {
                // Send notifications for each admin
                $admin->notify(new OrderCreatedNotification($order));
            }
        }
    }
}