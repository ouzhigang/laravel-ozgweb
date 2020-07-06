<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;

class DataCat extends Base {
	
	public function show(Request $request) {
		$type = $request->input("type", 0);
		
		$res_data = \App\Model\DataCat::getList($type);
		return response()->json($res_data);
	}
	
	public function get(Request $request) {
		$id = $request->input("id", 0);
		$data = \App\Model\DataCat::getById($id);
		return response()->json(res_result($data, 0, "请求成功"));
	}
	
	public function add(Request $request) {
		$id = $request->input("id", 0);
			
		$row = [];
		$row["name"] = $request->input("name", "");
		$row["parent_id"] = $request->input("parent_id", 0);
		$row["sort"] = $request->input("sort", 0);
		$row["type"] = $request->input("type", 0);
		
		$res_data = NULL;
		if($id != 0) {				
			$res_data = \App\Model\DataCat::saveData($row, $id);
		}
		else {
			$res_data = \App\Model\DataCat::saveData($row);
		}
		return response()->json($res_data);
	}
	
	public function gettree(Request $request) {
		$type = $request->input("type", 0);
		$res_data = \App\Model\DataCat::getTreeSelector($type);
		
		return response()->json($res_data);
	}
	
	public function del(Request $request) {
		
		$id = $request->input("id", 0);
		$res_data = \App\Model\DataCat::delById($id);
		return response()->json($res_data);
	}
	
}
