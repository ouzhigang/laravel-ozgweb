<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;

class Feedback extends Base {
    
	public function show(Request $request) {
		
		$page = $request->input("page", 1);
		$page_size = $request->input("page_size", config('app.custom.web_page_size'));
		$res_data = \App\Model\Feedback::getList($page, $page_size);
		$data = $res_data["data"];
		
		//分页导航
		$page_first = config("app.url") . "/mgr/feedback/show?page=1";
		$page_prev = config("app.url") . "/mgr/feedback/show?page=" . ($page <= 1 ? 1 : $page - 1);
		$page_next = config("app.url") . "/mgr/feedback/show?page=" . ($page >= $data["page_count"] ? $data["page_count"] : $page + 1);
		$page_last = config("app.url") . "/mgr/feedback/show?page=" . $data["page_count"];
		
		//分页导航 end
		
		$view_data = [
			"data" => $data,
			"page_first" => $page_first,
			"page_prev" => $page_prev,
			"page_next" => $page_next,
			"page_last" => $page_last
		];
		return view("mgr.feedback.show", $view_data);
	}
	
	public function del(Request $request) {
		$id = $request->input("id", 0);
		$res_data = \App\Model\Feedback::delById($id);
		
		return response()->json($res_data);
	}
	
}
