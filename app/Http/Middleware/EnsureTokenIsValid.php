<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
      $bearerToken        = $request->bearerToken();
      $currentipAddress   = str_replace("::ffff:","",$_SERVER['REMOTE_ADDR']);

      $access_allowed     = DB::table("api_access")
        ->where("token", $bearerToken)
        ->where("ipaddress", $currentipAddress)
        ->where("customer_id", $request->customer_id);



        if($access_allowed->count()){
          return $next($request);
        }else{
          $response = [
            'status'    => 0,
            'message'   => 'Unauthorized',
            'status'    => '403',
            'ipaddress' => $currentipAddress
          ];
          }


       return response()->json($response, 403);
    }
}
