<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use View;

class Index extends Base {
	
    public function index(Request $request) {
		
		$view_data = [];
		
		//新闻资讯
		$news_list_top = \App\Model\Data::getList(1, 1, 2, "d.is_index_top = 1");
		if(count($news_list_top) <= 0)
			$news_list_top = \App\Model\Data::getList(1, 1, 2);
		if(count($news_list_top) <= 0) {
			$news_list_top = [
				"list" => [
					[
						"id" => 0, 
						"name" => "", 
						"content" => ""
					]
				]
			];
		}
		$news_list_top["data"]["list"][0]["content"] = strip_tags(html_entity_decode($news_list_top["data"]["list"][0]["content"]));
		$news_list_top["data"]["list"][0]["content"] = get_string($news_list_top["data"]["list"][0]["content"], 50);
		$view_data["news_list_top"] = $news_list_top["data"]["list"][0];
		
		$news_list = \App\Model\Data::getList(1, 4, 2, "d.is_index_show = 1 and d.id <> " . $news_list_top["data"]["list"][0]["id"]);
		foreach($news_list["data"]["list"] as &$v) {
			$v["add_time"] = strtotime($v["add_time"]);
			$v["add_time"] = date("Y-m-d", $v["add_time"]);
		}
		$view_data["news_list"] = $news_list["data"]["list"];
		//新闻资讯 end
		
		//滚动产品
		$product_list = \App\Model\Data::getList(1, 10, 1, "d.is_index_show = 1");
		$view_data["product_list"] = $product_list["data"]["list"];
		//滚动产品 end
		
		//公司简介
		$art_2 = \App\Model\ArtSingle::getById(2);
		$view_data["art_2"] = $art_2["data"]["content"];
		
		//联系我们(首页)
		$art_6 = \App\Model\ArtSingle::getById(6);
		$view_data["art_6"] = $art_6["data"]["content"];
		
		$view_data["page_header_nav_selected1"] = 'class="selected"';
		$view_data["title"] = "首页";
		
		return view("site.index.index", $view_data);
    }
	
	public function art(Request $request) {
		$id = $request->input("id", 0);
		
		$view_data = [];
		
		$art = \App\Model\ArtSingle::getById($id);
		$view_data["content"] = $art["data"]["content"];
		
		if($id == 1) {
			$view_data["page_header_nav_selected2"] = 'class="selected"';
		}
		elseif($id == 3) {
			$view_data["page_header_nav_selected5"] = 'class="selected"';
		}
		elseif($id == 4) {
			$view_data["page_header_nav_selected6"] = 'class="selected"';
		}
		elseif($id == 5) {
			$view_data["page_header_nav_selected7"] = 'class="selected"';
		}
		
		$view_data["title"] = $art["data"]["name"];
		
		return view("site.index.art", $view_data);
    }
	
	public function productView(Request $request) {		
		$id = $request->input("id", 0);
		
		$view_data = [];
		
		$data = \App\Model\Data::getById($id);
		$data["data"]["add_time"] = date("Y-m-d H:i:s", $data["data"]["add_time"]);
		
		$view_data["data"] = $data["data"];
		
		\App\Model\Data::upHits($id);
		
		$view_data["page_header_nav_selected4"] = 'class="selected"';
		
		return view("site.index.product_view", $view_data);
    }
	
	public function productList(Request $request) {
		
		$view_data = [
			"page_header_nav_selected4" => 'class="selected"',
			"title" => '产品中心'
		];
		
		return view("site.index.product_list", $view_data);
    }
	
	public function newsView(Request $request) {
		$id = $request->input("id", 0);
		
		$view_data = [];
		
		$data = \App\Model\Data::getById($id);
		$data["data"]["add_time"] = date("Y-m-d H:i:s", $data["data"]["add_time"]);
		$view_data["data"] =  $data["data"];
		
		\App\Model\Data::upHits($id);
		
		$view_data["page_header_nav_selected3"] = 'class="selected"';
		return view("site.index.news_view", $view_data);
    }
	
	public function newsList(Request $request) {
		$view_data = [
			"page_header_nav_selected3" => 'class="selected"',
			"title" => "新闻中心"
		];
		return view("site.index.news_list", $view_data);
    }
	
	public function getNewsList(Request $request) {
		$page = $request->input("page", 1);
		$page_size = 40;
		
		$res_data = \App\Model\Data::getList($page, $page_size, 2);
		return response()->json($res_data);
	}
		
	public function getProductList(Request $request) {
		$page = $request->input("page", 1);
		$search = $request->input("search", NULL);
		$data_cat_id = $request->input("data_cat_id", 0);
		
		$page_size = 40;
		
		$wq = " 1 = 1 ";
		if($search)
			$wq .= " and d.name like '%" . $search . "%' ";
		if($data_cat_id)
			$wq .= " and d.data_cat_id = " . $data_cat_id;
		
		$res_data = \App\Model\Data::getList($page, $page_size, 1, $wq);
		return response()->json($res_data);	
	}
	
}
