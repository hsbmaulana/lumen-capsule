<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('auth.{id}', function ($auth, $id) { return $auth->id == $id; });
Broadcast::channel('user.{id}', function ($auth, $id) { return $auth->id != $id; });