<?php

namespace App\Http\Middleware;

use Closure;

use Validator;

class JsonApiMiddleware
{

    const PARSED_METHODS = [
        'POST'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!$request->isJson()){
            return response()->json(['success' => false, 'error' => 'This request must be a JSON!']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'daughters.*.name' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, $validator->errors()->all()]);
        }

        if(in_array($request->getMethod(), self::PARSED_METHODS)) {
            $request->merge(json_decode($request->getContent(), true));
        }

        return $next($request);
    }
}
