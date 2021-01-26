<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->api_password != env('API_PASSWORD', 't2vlnnf0HoFxdceju3WoICP7VXbDpkeP9r89SNfeoZullA6nrOluaVnpCcvbXhLG')){
            return response()->json(['message' => 'Unauthenticated']);
        }
        return $next($request);
    }
}
