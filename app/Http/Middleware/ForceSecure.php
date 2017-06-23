<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

class ForceSecure
{
    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        if (!app()->environment('local')) {
            // for Proxies
            Request::setTrustedProxies([$request->getClientIp()]);

            if (!$request->isSecure()) {
                return redirect()->secure($request->getRequestUri());
            }
        }

        return $next($request);
    }
}