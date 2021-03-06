<?php

namespace App\Model;

use Session;

class User extends Base {
	
	protected $table = 'user';
	protected $fillable = [ 'name', 'pwd', 'is_admin', 'add_time' ];
	
	public static function getList($page, $page_size) {
		
		$total = self::where("is_admin", 1)->count();
		
		$page_count = page_count($total, $page_size);
		
		$start = ($page - 1) * $page_size;
		$list = self::where("is_admin", 1)
			->skip($start)
			->take($page_size)
			->orderBy("id", "desc")
			->get();
		$list = $list->toArray();
		foreach($list as &$v){
			$v["add_time_s"] = date("Y-m-d H:i:s", $v["add_time"]);
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
	
	public static function adminLogin($name, $pwd, $vcode) {
		
		$user = self::where([
			"name" => $name
		])->first();
		
		if($user) {
			$user = $user->toArray();
			
			if($user["err_login"] >= 3) {
				if(is_null($vcode)) {
					return res_result(NULL, 2, "输入错误密码次数过多，需要输入验证码");
				}
				elseif($vcode == "") {
					return res_result(NULL, 2, "验证码不能为空");
				}
				else {
					$user_captcha = Session::get("user_captcha");
					if(strtolower($user_captcha) != strtolower($vcode)) {
						//验证失败
						return res_result(NULL, 3, "验证码错误");
					};
				}
			}
			
			$arr = NULL;
			if($user["pwd"] == self::buildPassword($pwd)) {
				$user["err_login"] = 0;
				unset($user["pwd"]);
				Session::put("user", $user);
				
				$id = $user["id"];
				unset($user["id"]);
				self::where("id", $id)->update($user);
				
				$arr = res_result($user, 0, "登录成功");
			}
			else {				
				$user["err_login"] += 1;
				$id = $user["id"];
				unset($user["id"]);
				self::where("id", $id)->update($user);
				
				$code = $user["err_login"] >= 3 ? 2 : 1;
				$arr = res_result(NULL, $code, "密码错误");
			}			
			return $arr;
		}
		else {
			$arr = res_result(NULL, 1, "没有此用户");
			return $arr;
		}
	}
	
	public static function delByIds($ids = 0) {
		$user = Session::get("user");
		
		if(strpos($ids, ",") !== false) {
			//删除多条数据
			$ids = explode(",", $ids);
			foreach($ids as $id) {
				$id = intval($id);
				if($user["id"] == $id) {
					return res_result(NULL, 1, "不能删除自己");
				}
				self::where("id", $id)->delete();
			}
			return res_result(NULL, 0, "删除成功");
		}
		else {
			//删除一条数据
			$ids = intval($ids);
			
			if($user["id"] == $ids) {
				return res_result(NULL, 1, "不能删除自己");
			}
			
			$result = self::where("id", $ids)->delete();
			if($result) {
				return res_result(NULL, 0, "删除成功");
			}
			
			return res_result(NULL, 1, "删除失败");
		}
	}
	
	//退出登录
	public static function logout() {
	
		Session::forget("user");		
		
		return res_result(NULL, 0, "退出成功");
	}
	
	public static function getByName($name, $other = []) {
		$where = [
			"name" => $name
		];		
		$where = array_merge($where, $other);
		$data = self::where($where)->first();
		return res_result($data->toArray(), 0, "请求成功");
	}
	
	public static function saveData($data, $id = 0) {
	
		if(!$data["name"]) {
			return res_result(NULL, 1, "用户名不能为空");
		}
		if(!$data["pwd"]) {
			return res_result(NULL, 1, "密码不能为空");
		}
		
		$data["pwd"] = self::buildPassword($data["pwd"]);
		if($id) {
			self::where("id", $id)->update($data);
			return res_result(NULL, 0, "修改成功");
		}
		else {
			$total = self::where("name", $data["name"])->count();
			if($total > 0) {
				return res_result(NULL, 1, "该用户已存在");
			}
			
			$data["add_time"] = time();
			$data["is_admin"] = 1;
			
			self::create($data);
			return res_result(NULL, 0, "添加成功");
		}
	}
	
	public static function updatePwd($old_pwd, $pwd, $pwd2) {
		if(!$old_pwd) {
			return res_result(NULL, 1, "旧密码不能为空");
		}
		if(!$pwd) {
			return res_result(NULL, 1, "新密码不能为空");
		}
		if($pwd != $pwd2) {
			return res_result(NULL, 1, "确认密码不正确");
		}
	
		$curr_user = Session::get("user");
		
		$user = self::where([ "name" => $curr_user["name"], "pwd" => self::buildPassword($old_pwd) ])->first();		
		if($user) {
			$user = $user->toArray();
			$user["pwd"] = self::buildPassword($pwd);
			$id = $user["id"];
			unset($user["id"]);
			self::where("id", $id)->update($user);
			return res_result(NULL, 0, "修改密码成功");
		}
		else {
			return res_result(NULL, 1, "旧密码不正确");
		}
		
	}
	
	protected static function buildPassword($password) {
		$password = md5($password);
		return $password;
	}
	
}
