<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;

class User extends Base {
    
	public function show(Request $request) {
		
		$page = $request->input("page", 1);
		$page_size = $request->input("page_size", config('app.custom.web_page_size'));
		
		$res_data = \App\Model\User::getList($page, $page_size);
		$data = $res_data["data"];
		
		return response()->json(res_result($data, 0, "请求成功"));
	}
	
	public function add(Request $request) {
		$name = $request->input("name", "");
		$pwd = $request->input("pwd", "");
			
		$user = [
			"name" => $name,
			"pwd" => $pwd,
		];
		$res = \App\Model\User::saveData($user);
		return response()->json($res);
	}
	
	public function del(Request $request) {
		$ids = $request->input("ids", 0);
		$res = \App\Model\User::delByIds($ids);
		
		return response()->json($res);
	}
	
	public function updatepwd(Request $request) {
		
		$old_pwd = $request->input("old_pwd", "");
		$pwd = $request->input("pwd", "");
		$pwd2 = $request->input("pwd2", "");
		
		$res = \App\Model\User::updatePwd($old_pwd, $pwd, $pwd2);
		return response()->json($res);
	}
	
}
