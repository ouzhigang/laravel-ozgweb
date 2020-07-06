<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;

class Friendlink extends Base {
    
	public function show(Request $request) {
		
		$page = $request->input("page", 1);
		$page_size = $request->input("page_size", config('app.custom.web_page_size'));
		
		$data = \App\Model\Friendlink::getList($page, $page_size);
		$data = $res_data["data"];
		
		//分页导航
		$page_first = config("app.url") . "/mgr/friendlink/show?page=1";
		$page_prev = config("app.url") . "/mgr/friendlink/show?page=" . ($page <= 1 ? 1 : $page - 1);
		$page_next = config("app.url") . "/mgr/friendlink/show?page=" . ($page >= $data["page_count"] ? $data["page_count"] : $page + 1);
		$page_last = config("app.url") . "/mgr/friendlink/show?page=" . $data["page_count"];
		
		//分页导航 end
		
		$view_data = [
			"data" => $data,
			"page_first" => $page_first,
			"page_prev" => $page_prev,
			"page_next" => $page_next,
			"page_last" => $page_last
		];
		return view("mgr.friendlink.show", $view_data);
	}
	
	public function get(Request $request) {
		$id = $request->input("id", 0);
		$res_data = \App\Model\Friendlink::getById($id);
		
		return response()->json($res_data);
	}
	
	public function add(Request $request) {
		
		return view("mgr.friendlink.add");
	}
	
	public function doAdd(Request $request) {
		$id = $request->input("id", 0);
		
		$row = [];
		$row["name"] = $request->input("name", "");
		$row["url"] = $request->input("url", "");	
		$row["picture"] = $request->input("picture", "");
		$row["sort"] = $request->input("sort", 0);
		$row["is_picture"] = $request->input("is_picture", 0);
		
		$res_data = NULL;
		if($id != 0) {
			$res_data = \App\Model\Friendlink::saveData($row, $id);
		}
		else {
			$res_data = \App\Model\Friendlink::saveData($row);			
		}
		return response()->json($res_data);
	}
	
	public function del(Request $request) {
		$id = $request->input("id", 0);
		$res_data = \App\Model\Friendlink::delById($id);
		return response()->json($res_data);
	}
	
}
