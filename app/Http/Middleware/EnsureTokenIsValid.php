<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // you have to get token from database below line is just an example
        $tokenInDatabase = "12222";

     
        if ($request->input('token') !== $tokenInDatabase) {
            $response = ['status' => 0, 'message' => 'Unauthorized'];

            return response()->json($response, 413);

        }
 
        return $next($request);
    }
}
