<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogActionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $tablename;
    public string $object_id;
    public string $object;
    public string $action;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        string $action,
        string $table,
        string $object = '',
        string $object_id = '',
    )
    {
        $this->tablename = $table;
        $this->object_id = $object_id;
        $this->object = $object;
        $this->action = $action;
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
