<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use View;

class Site {
	
    public function handle($request, Closure $next) {
		
		//内页左边 产品类别
		$product_class_list = \App\Model\DataCat::getList(1);
		View::share("product_class_list", $product_class_list["data"]);
		
		//内页左边 推荐产品
		$product_list_recommend = \App\Model\Data::getList(1, 5, 1, "d.recommend = 1");
		View::share("product_list_recommend", $product_list_recommend["data"]["list"]);
		
		//内页左边 行业新闻
		$news_list_recommend = \App\Model\Data::getList(1, 5, 2, "d.recommend = 1");
		View::share("news_list_recommend", $news_list_recommend["data"]["list"]);
		
		//内页左边 联系我们(内页)
		$art_7 = \App\Model\ArtSingle::getById(7);
		View::share("art_7", $art_7["data"]["content"]);
		
		//页脚
		$art_8 = \App\Model\ArtSingle::getById(8);
		View::share("art_8", $art_8["data"]["content"]);
		
		View::share("page_header_nav_selected1", "");
		View::share("page_header_nav_selected2", "");
		View::share("page_header_nav_selected3", "");
		View::share("page_header_nav_selected4", "");
		View::share("page_header_nav_selected5", "");
		View::share("page_header_nav_selected6", "");
		View::share("page_header_nav_selected7", "");
		
		$response = $next($request);
        return $response;
    }
	
}
