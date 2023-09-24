<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
{
    $response = $next($request);

    if (!session()->has('visits')) {
        session(['visits' => 1]);
    } else {
        session(['visits' => session('visits') + 1]);
    }

    return $response;
}

}
