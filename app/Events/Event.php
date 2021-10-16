<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels as SerializationTrait;
use Illuminate\Broadcasting\InteractsWithSockets as InteractionTrait;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow as SyncableContract;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast as AsyncableContract;

abstract class Event implements SyncableContract { use InteractionTrait, SerializationTrait; }