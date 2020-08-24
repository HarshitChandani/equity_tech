<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class UserAuth
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
        $this->validateRequest($request)->validate();
        return $next($request);
    }
    protected function validateRequest($request){
        return Validator::make($request->all(),[
            "name"=>"required|max:255",
            "email"=>"required|unique:users|max:255|email",
            "password"=>"required|string"
        ]);
    }
}
