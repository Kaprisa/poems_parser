<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class LoadData
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
        if ((getdate()[0] - strtotime(DB::select('SELECT Max(updated_at) as date FROM poems')[0]->date)/60) >= 10) {
            Artisan::call('data:load');
        }
        return $next($request);
    }
}
