<?php

namespace App\Events\Auth;

use Illuminate\Queue\SerializesModels as SerializationTrait;

class Deactivated
{
    use SerializationTrait;

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
}