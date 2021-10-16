<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * @var array
     */
    protected $flags =
    [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'POST, PUT, PATCH, DELETE, GET, OPTIONS',
        'Access-Control-Allow-Headers' => 'Origin, Accept, Authorization, Accept-Charset, Accept-Language, Content-Type, X-Requested-With, X-Auth-Token, X-Socket-Id',

        'Access-Control-Allow-Credentials' => 'false',
        'Access-Control-Max-Age' => '65536',
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->isMethod('OPTIONS')) return response('OK', 200, $this->flags);

        foreach ($this->flags as $key => $value) {

            $response->header($key, $value);
        }

        return $response;
    }
}
