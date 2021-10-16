<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthableContract;

class Authentication
{
    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * @param \Illuminate\Contracts\Auth\Factory $auth
     * @return void
     */
    public function __construct(AuthableContract $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) { return response('Unauthorized.', 401); }

        return $next($request);
    }
}