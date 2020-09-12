<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;

class RedirectMovedPages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->getStatusCode() == 404) {
            $uri = substr($request->getRequestUri(),1);
            $redirect = Redirect::where('from', $uri)->first();
            if ($redirect) {
                return redirect($redirect->to, $redirect->status);
            }
        }

        return $response;
    }
}
