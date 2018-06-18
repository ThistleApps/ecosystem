<?php

namespace App\Events\Getswift;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class JobAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $request;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order_id, $request = null)
    {
        $this->order = \App\Models\OrderHeader::findOrFail($order_id);
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
