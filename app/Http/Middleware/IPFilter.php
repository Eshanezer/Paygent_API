<?php

namespace App\Http\Middleware;

use App\Http\Controllers\IPFilterController;
use App\Models\ResponseModel;
use Closure;
use Illuminate\Http\Request;

class IPFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ((new IPFilterController)->block($request->ip())) {
            return (new ResponseModel)->sendJSON(403, 'Please check your ip address before access the API');
        }
        return $next($request);
    }
}
