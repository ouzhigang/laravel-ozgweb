<?php

namespace App\Model;

use Cookie;
use DB;

class Data extends Base {
	
	protected $table = 'data';
	protected $fillable = [ 'name', 'sort', 'data_cat_id', 'type', 'content', 'add_time', 'hits', 'picture', 'is_index_show', 'recommend', 'is_index_top' ];
	
	public static function getList($page, $page_size, $type, $wq = "") {
		if($wq != "")
			$wq = " and " . $wq;
		
		$prefix = config("database.connections.sqlite.prefix");
		$total = Db::select('select count(d.id) as total from ' . $prefix . 'data as d left join ' . $prefix . 'data_cat as dc on d.data_cat_id = dc.id where d.type = ' . $type . ' ' . $wq);
		$total = intval($total[0]->total);
		$page_count = page_count($total, $page_size);
		
		$start = ($page - 1) * $page_size;
		$list = Db::select('select d.*, dc.name as dc_name from ' . $prefix . 'data as d left join ' . $prefix . 'data_cat as dc on d.data_cat_id = dc.id where d.type = ' . $type . ' ' . $wq . ' order by d.sort desc, d.id desc limit ' . $start . ', ' . $page_size);		
		//var_dump($list);exit();
		foreach($list as &$v) {
			$v = (array)$v;
			$v["add_time_s"] = date("Y-m-d H:i:s", $v["add_time"]);
			$v["dc_name"] = $v["dc_name"] ? $v["dc_name"] : "[暂无]";
			$v["picture"] = json_decode($v["picture"], true);
			$v["picture_0"] = count($v["picture"]) > 0 ? $v["picture"][0] : "";
			$v["content"] = html_entity_decode($v["content"]);
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
	
	public static function getById($id) {
		$data = self::where("id", $id)->first();
		if($data) {
			$data = $data->toArray();
			$data["picture"] = json_decode($data["picture"], true);
			$data["content"] = html_entity_decode($data["content"]);
			return res_result($data, 0, "请求成功");
		}
		return res_result(NULL, 1, "查询不到数据");
	}
	
	public static function saveData($data, $id = 0) {
		
		if(!$data["name"]) {
			return res_result(NULL, 1, "名称不能为空");
			
		}
		elseif(!$data["content"]) {
			return res_result(NULL, 1, "内容不能为空");
		}
		
		if($id) {
			self::where("id", $id)->update($data);
			return res_result(NULL, 0, "修改成功");
		}
		else {
			unset($data["id"]);
			$data["add_time"] = time();
			self::create($data);
			
			return res_result(NULL, 0, "添加成功");
		}
	}
	
	public static function delByIds($ids = 0) {
		if(strpos($ids, ",") !== false) {
			//删除多条数据
			$ids = explode(",", $ids);
			foreach($ids as $id) {
				$id = intval($id);
				self::where("id", $id)->delete();
			}
			return res_result(NULL, 0, "删除成功");
		}
		else {
			//删除一条数据
			$ids = intval($ids);
			self::where("id", $ids)->delete();
			return res_result(NULL, 0, "删除成功");
		}
	}
	
	public static function upHits($id = 0) {
		
		$history = [];
		if(Cookie::get('history')) {
			$history = Cookie::get('history');
			$history = explode(",", $history);
		}
		
		if(!in_array($id, $history)) {
		
			$data = self::getById($id);
			if($data["data"]) {
				unset($data["data"]["id"]);
				unset($data["data"]["picture"]);
				$data["data"]["hits"]++;
				self::saveData($data["data"], $id);
			}
			
			$history[] = $id;
			
			Cookie::make('history', implode(",", $history), 86400 * 30);
		}
		
		return res_result(NULL, 0, "请求成功");
	}
	
}
