<?php

namespace App\Events\Auth;

use App\Events\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;

class Activated extends Event
{
    /**
     * @var \App\Models\User
     */
    public $data;

    /**
     * @param \App\Models\User $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'user.activated';
    }

    /**
     * @return mixed
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user' . '.' . $this->data->getKey());
    }
}