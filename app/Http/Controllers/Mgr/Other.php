<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;

class Other extends Base {
	
	public function logout(Request $request) {		
		$res = \App\Model\User::logout();
		
		if($request->cookie('curr_user_name')) {
			$cookie = \Cookie::forget('curr_user_name');
			return response()->json($res)->cookie($cookie);
		}		
		return response()->json($res);
	}
	
}
