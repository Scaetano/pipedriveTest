<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AuthenticateApi
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

        if(!$request->has('api_token')){
            return response()->json(['success' => false, 
                                'error' => 'You need to be authorized to make this request.']);
        }

        $user = User::where('api_token', $request['api_token']);

        if($user->count() <= 0){
            return response()->json(['success' => false, 
                                'error' => 'Your token is not valid, please register yourself to generate one.']);
        }

        return $next($request);
    }
}
