<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JobExist
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
        if (!$request->job) {
            return redirect(route('anggota.index'));
        }
        return $next($request);
    }
}
