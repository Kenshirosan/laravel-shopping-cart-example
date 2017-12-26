<?php

namespace App\Events;

use App\Order;
use App\Mail\SendThankYouEmail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class UserOrdered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        return $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        new SendThankYouEmail();

        return new PrivateChannel('customer-channel.' . $this->order->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $extra = [
            'status_name' => $this->order->status->name,
            'status_percent' => $this->order->status->percent,
        ];

        return array_merge($this->order->toArray(), $extra);
    }
}
