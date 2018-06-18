<?php

namespace App\Listeners\GetSwift;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliveryDriverAtPickup
{
    private $status = \App\Models\OrderHeader::DELIVERY_DRIVER_PICKUP;
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
     */
    public function handle($event)
    {
        $order = $event->order;
        $request = $event->request;

        $order->getswift_status = $this->status;
        $order->save();


        \App\Models\GetswiftOrderLog::create([
            'order_id' => $order->id,
            'status' => $this->status,
            'request_data' => json_encode($request->all())
        ]);
    }
}
