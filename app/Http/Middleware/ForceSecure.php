<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Redirect;

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
        if (! $request->secure() && App::environment() !== 'local') {
            $request->setTrustedProxies([$request->getClientIp()]);

            return Redirect::secure($request->getRequestUri());
        }

        return $next($request);
    }
}