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
    public function handle($request, Closure $next, $accuracy = 'date')
    {
        $today = Carbon::now();
        $field_arr = ['date', 'month', 'year'];
        $accuracy_index = array_search($accuracy, $field_arr); 
        if($accuracy_index !== false) {
            if(!$request->year && $accuracy_index <= 2)
            {
                $request->year = $today->year;
            }
            if(!$request->month && $accuracy_index <= 1)
            {
                $request->month = $today->month;
            }
            if(!$request->date && $accuracy_index == 0)
            {
                $request->date = $today->format('d');
            }
            foreach ($field_arr as $i => $field) {
                if($accuracy_index <= $i) {
                    $request->$field = (int)$request->$field;
                }
            }
        }
        return $next($request);
    }
}
