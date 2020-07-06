<?php

namespace App\Model;

class Friendlink extends Base {
	
	protected $table = 'friendlink';
	
	public static function getList($page, $page_size) {
		
		$total = self::count();
		
		$page_count = page_count($total, $page_size);
		
		$start = ($page - 1) * $page_size;
		$list = self::orderBy("id", "desc")
			->skip($start)
			->take($page_size)
			->get();
		$list = $list->toArray();
		
		$r = [
			"page_size" => $page_size,
			"page_count" => $page_count,
			"total" => intval($total),
			"page" => $page,
			"list" => $list,
		];		
		return res_result($r, 0, "请求成功");
	}
	
	public static function saveData($data, $id = 0) {
		
		if(!$data["name"]) {
			return res_result(NULL, 1, "名称不能为空");
		}
		elseif(!$data["url"]) {
			return res_result(NULL, 1, "URL不能为空");
		}
		
		if($id) {
			self::where("id", $id)->update($data);
			return res_result(NULL, 0, "修改成功");
		}
		else {
			unset($data["id"]);
			self::create($data);
			return res_result(NULL, 0, "添加成功");
		}
	}
	
	public static function getById($id = 0) {
		$data = self::where("id", $id)->first();
		return res_result($data->toArray(), 0, "请求成功");
	}
	
	public static function delById($id = 0) {
		self::where("id", $id)->delete();
		return res_result(NULL, 0, "删除成功");
	}
	
}
