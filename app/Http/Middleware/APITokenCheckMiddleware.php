<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Models\Token;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class APITokenCheckMiddleware
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
        //check token is valid
        $validToken = Token::where('isvalid', 1)->orderBy('id', 'DESC')->first();
        if ($validToken && (Carbon::parse($validToken->expired_at) < Carbon::now())) {
            return $next($request);
        }else{
            if((new AuthController)->refreshAPIToken()==true){
                return $next($request);
            }else{
                return abort(503);
            }
        }
    }
}
