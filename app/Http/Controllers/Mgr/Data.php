<?php

namespace App\Http\Controllers\Mgr;

use Illuminate\Http\Request;

class Data extends Base {
    
	public function show(Request $request) {
		
		$page = $request->input("page", 1);
		$page_size = $request->input("page_size", config("app.custom.web_page_size"));
		$type = $request->input("type", 1);
		$res_data = \App\Model\Data::getList($page, $page_size, $type);
		return response()->json($res_data);
	}
	
	public function get(Request $request) {
		$id = $request->input("id", 0);
		$res_data = \App\Model\Data::getById($id);
		
		return response()->json($res_data);
	}
	
	public function add(Request $request) {
		$id = $request->input("id", 0);
			
		$row = [];
		$row["name"] = $request->input("name", "", "str_filter");
		$row["content"] = $request->input("content", "", "str_filter");	
		$row["data_cat_id"] = $request->input("data_cat_id", 0, "intval");
		$row["sort"] = $request->input("sort", 0, "intval");
		$row["type"] = $request->input("type", 0, "intval");		
		$row["picture"] = $request->has("picture") ? $request->input("picture") : [];
		
		if(count($row["picture"]) > 0)
			$row["picture"] = json_encode($row["picture"]);
		else 
			$row["picture"] = "[]";
		
		$row["is_index_show"] = $request->input("is_index_show", 0, "intval");		
		$row["is_index_top"] = $request->input("is_index_top", 0, "intval");		
		$row["recommend"] = $request->input("recommend", 0, "intval");
		
		$res_data = NULL;
		if($id != 0) {
			$res_data = \App\Model\Data::saveData($row, $id);			
		}
		else {				
			$res_data = \App\Model\Data::saveData($row);
		}
		return response()->json($res_data);
	}
	
	public function del(Request $request) {
		$ids = $request->input("ids", 0);
		$res_data = \App\Model\Data::delByIds($ids);
		return response()->json($res_data);
	}
	
	public function upload(Request $request) {
		
		$file = NULL;
		foreach($request->file() as $f) {
			$file = $f;
			break;
		}
		
		if($file && $file->getSize() > 0) {
			$max_size = config("app.custom.max_upload");
			$allow_ext_name = [
				"jpg",
				"jpeg",
				"png",
				"gif",
			];			
			
			if($file->getSize() <= $max_size) {
				$ext_name = $file->getClientOriginalExtension();
				
				if(in_array($ext_name, $allow_ext_name)) {
					$fileName = md5_file($file->getPathName()) . "." . $ext_name;
					$info = $file->move(public_path() . "/upload/", $fileName);
					
					if($info) {
						$tmp = explode("/", $info->getPathName());
						return response()->json(res_result([ "filepath" => $tmp[count($tmp) - 1] ], 0, "上传完成"));
					}
					return response()->json(res_result(NULL, 1, $file->getError()));
				}
				else {
					return response()->json(res_result(NULL, 1, "不允许上传此类文件"));
				}
			}
			else {
				return response()->json(res_result(NULL, 1, "不能上传超过" . intval($max_size / 1024 / 1024) . "M的文件"));
			}			
		}
		else {
			return response()->json(res_result(NULL, 1, "没有选择上传文件"));
		}
		
	}
	
}
