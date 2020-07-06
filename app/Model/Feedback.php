<?php

namespace App\Model;

class Feedback extends Base {
	
	protected $table = 'feedback';
	
	public static function getList($page, $page_size) {
		
		$total = self::count();
		
		$page_count = page_count($total, $page_size);
		
		$start = ($page - 1) * $page_size;
		$list = self::orderBy("id", "desc")
			->skip($start)
			->take($page_size)
			->get();
		$list = $list->toArray();
		
		foreach($list as &$v) {
			$v["add_time"] = date("Y-m-d H:i:s", $v["add_time"]);
		}
		
		$r = [
			"page_size" => $page_size,
			"page_count" => $page_count,
			"total" => intval($total),
			"page" => $page,
			"list" => $list,
		];
		return res_result($r, 0, "请求成功");
	}
	
	public static function delById($id = 0) {
		self::where("id", $id)->delete();
		return res_result(NULL, 0, "删除成功");
	}
	
}
