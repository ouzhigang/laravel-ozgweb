<?php

namespace App\Model;

class ArtSingle extends Base {
	
	protected $table = 'art_single';
	
	public static function getById($id) {
		$data = self::where("id", $id)->first();
		if($data) {
			$data = $data->toArray();
			$data["content"] = html_entity_decode($data["content"]);
			return res_result($data, 0, "请求成功");
		}
		return res_result(NULL, 1, "查询不到数据");
	}
	
	public static function saveData($data, $id = 0) {
		
		self::where("id", $id)->update($data);
		
		return res_result(NULL, 0, "修改成功");
	}
	
}
