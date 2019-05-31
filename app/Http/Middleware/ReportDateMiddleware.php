<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class ReportDateMiddleware
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
        $today = Carbon::now();
        if(!$request->year)
        {
            $request->year = $today->year;
        }
        if(!$request->month)
        {
            $request->month = $today->month;
        }
        if(!$request->date)
        {
            $request->date = $today->format('d');
        }
        foreach (['year', 'month', 'date'] as $key) {
            $request->$key = (int)$request->$key;
        }
        return $next($request);
    }
}
