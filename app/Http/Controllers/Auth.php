<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Auth extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function socket(Request $request)
    {
        return app(\Illuminate\Contracts\Broadcasting\Factory::class)->auth($request);
    }
}