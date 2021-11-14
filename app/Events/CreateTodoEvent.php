<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast as SB;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateTodoEvent implements SB
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * my variables
     */
    public $text;
    public $num;
    public $action;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($text = '', $num = '', $action)
    {
        $this->text = $text;
        $this->num = $num;
        $this->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('todoapp');
    }

    public function broadcastAs()
    {
        return 'todo';
    }
}
