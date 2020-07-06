<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;
use Session;
use Gregwar\Captcha\CaptchaBuilder;

class Index extends Base {
	
	public function getvcode(Request $request) {
		$vcode = $request->input("vcode", NULL);
		
		if(is_null($vcode)) {
			$vcode = "user_captcha";
		}
		
		$builder = new CaptchaBuilder();
		$builder->build($width = 130, $height = 28, $font = null);
		
		$phrase = $builder->getPhrase();

		Session::flash($vcode, $phrase);
		
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-Type: ');
		$builder->output();
		
		return response(NULL, 200)->header('Content-Type', "image/jpeg");	
	}

	public function login(Request $request) {
		
		$name = $request->input("name", NULL);
		$pwd = $request->input("pwd", NULL);
		$remember = $request->input("remember", 0);
		$vcode = $request->input("vcode", NULL);
		
		$res = \App\Model\User::adminLogin($name, $pwd, $vcode);
		
		$cookie = NULL;
		if($res["code"] == 0 && $remember == 1) {
			$curr_user_name = \utility\Encrypt::encode($name);
			$cookie = \Cookie('curr_user_name', $curr_user_name, 60 * 24 * 7); //保存7天
			return response()->json($res)->cookie($cookie);
		}
		return response()->json($res);
	}
	
}
