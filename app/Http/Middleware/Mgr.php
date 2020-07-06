<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Mgr {
	
    public function handle($request, Closure $next) {
		
		if(!Session::has("user")) {
			return response()->json(res_result(NULL, 1, "请先登录后台"));
		}
		
		$response = $next($request);		
        return $response;
    }
	
}
