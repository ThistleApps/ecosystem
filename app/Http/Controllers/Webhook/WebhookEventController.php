<?php

namespace App\Http\Controllers\Webhook;

use App\Events\Getswift\JobAcceptedEvent;
use App\Events\Getswift\JobAddedEvent;
use App\Events\Getswift\JobCancelledEvent;
use App\Events\Getswift\JobDriverAtDropoffEvent;
use App\Events\Getswift\JobDriverAtPickupEvent;
use App\Events\Getswift\JobFinishedEvent;
use App\Events\Getswift\JobOnwayEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookEventController extends Controller
{
    public function jobAdded(Request $request, $order_id)
    {
        event(new JobAddedEvent($order_id, $request));
    }

    public function jobAccepted(Request $request, $order_id)
    {
        event(new JobAcceptedEvent($order_id, $request));
    }

    public function jobDriverAtPickup(Request $request, $order_id)
    {
        event(new JobDriverAtPickupEvent($order_id, $request));
    }

    public function jobOnway(Request $request, $order_id)
    {
        event( new JobOnwayEvent($order_id, $request));
    }

    public function jobDriverAtDropOff(Request $request, $order_id)
    {
        event(new JobDriverAtDropoffEvent($order_id, $request));
    }

    public function jobFinished(Request $request, $order_id)
    {
        event(new JobFinishedEvent($order_id, $request));
    }

    public function jobCancelled(Request $request, $order_id)
    {
        event(new JobCancelledEvent($order_id, $request));
    }


}
