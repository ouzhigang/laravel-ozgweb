<?php

namespace App\Model;

class DataCat extends Base {
	
	protected $table = 'data_cat';
	protected $fillable = [ 'name', 'sort', 'parent_id', 'type' ];
	
	protected static function deleteById($id) {
		$list = self::where("parent_id", $id)->get();
		$list = $list->toArray();
		foreach($list as $v) {
			$child_count = self::where("parent_id", $v["id"])->count();
			if($child_count > 0) {
				self::deleteById($v["id"]);
			}
			//删除该分类下面的对应数据
			Data::where("data_class_id", $v["id"])->delete();
			self::where("id", $v["id"])->delete();
		}
		
		//不需要返回res_result
	}
	
	public static function getById($id) {
		$dataclass = self::where("id", $id)->first();
		$dataclass = $dataclass->toArray();
		if($dataclass["parent_id"] != 0) {
			$dataclass["parent"] = self::getById($dataclass["parent_id"]);
		}
		
		//不需要返回res_result
		return $dataclass;
	}
	
	public static function listById($id) {
		
		$list = self::where("parent_id", $id)
			->orderBy("sort", "desc")
			->orderBy("id", "desc")
			->get();
		$list = $list->toArray();
		
		foreach($list as &$v) {
			$v["children"] = [];
			
			$child_count = self::where("parent_id", $v["id"])->count();
			if($child_count > 0) {
				$v["children"] = self::listById($v["id"]);
			}
			
		}
		
		//不需要返回res_result
		return $list;
	}
	
	public static function getTreeSelector($type) {
		
		$list = self::where([ "parent_id" => 0, "type" => $type ])
			->orderBy("sort", "desc")
			->orderBy("id", "desc")
			->get();
		$list = $list->toArray();
		
		foreach($list as &$v) {
			$data[] = [
				"id" => intval($v["id"]),
				"parent_id" => 0,
				"name" => $v["name"]
			];
			$res = self::where("parent_id", $v["id"])->count();
			if($res) {
				self::treeSelector($data, $v["id"]);
			}
		}
		
		return res_result($data, 0, "请求成功");
	}
	
	protected static function treeSelector(&$data, $parent_id) {		
		$list = self::where("parent_id", $parent_id)
			->orderBy("sort", "desc")
			->orderBy("id", "desc")
			->get();
		$list = $list->toArray();
		
		foreach($list as &$v) {
			$data[] = [
				"id" => intval($v["id"]),
				"parent_id" => intval($v["parent_id"]),
				"name" => $v["name"]
			];
			self::treeSelector($data, $v["id"]);
		}
		
		//不需要返回res_result
	}
	
	public static function saveData($data, $id = 0) {
		if($id) {
			if($id == $data["parent_id"]) {
				return res_result(NULL, 1, "父级分类不能为当前选中分类");
			}
			
			self::where("id", $id)->update($data);
			
			return res_result(NULL, 0, "更新成功");
		}
		else {
			unset($data["id"]);
			self::create($data);
			
			return res_result(NULL, 0, "添加成功");
		}
	}
	
	public static function delById($id = 0) {
		
		$dataclass = self::where("id", $id)->first();
		$dataclass = $dataclass->toArray();
		$child_count = self::where("parent_id", $dataclass["id"])->count();
		
		if($child_count > 0) {
			self::deleteById($dataclass["id"]);
		}
		
		//删除该分类下面的对应数据
		Data::where("data_cat_id", $dataclass["id"])->delete();
		self::where("id", $dataclass["id"])->delete();
		
		return res_result(NULL, 0, "删除成功");
	}
	
	public static function getList($type = 0) {
		
		$list = self::where([ "type" => $type, "parent_id" => 0 ])
			->orderBy("sort", "desc")
			->orderBy("id", "desc")
			->get();
		$list = $list->toArray();
		
		foreach($list as &$v) {
			$v["children"] = [];
			
			$child_count = self::where("parent_id", $v["id"])->count();
			if($child_count > 0)
				$v["children"] = self::listById($v["id"]);
			
		}
		return res_result($list, 0, "请求成功");
	}
	
}
