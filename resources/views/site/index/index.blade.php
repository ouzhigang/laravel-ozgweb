<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<title>{{ config('app.name') }}</title>
	@include('site.common.meta')
	@include('site.common.css')
	<link href="{{ config('app.url') }}/css/site/index/index.css" rel="stylesheet" />
</head>
<body>
	<div id="page_main">
		@include('site.common.header')
		<div id="page_body">
			<div id="banner_slider">
				<ul class="bxslider">
					<li><a href="#" target="_blank"><img src="http://img13.360buyimg.com/da/jfs/t3766/257/1617667028/113747/ed374209/582d0572N17db6fec.jpg" /></a></li>
					<li><a href="#" target="_blank"><img src="http://img1.360buyimg.com/da/jfs/t3484/18/1601695659/118343/ee9969d1/582c2295N8f13622c.jpg" /></a></li>
					<li><a href="#" target="_blank"><img src="http://img13.360buyimg.com/da/jfs/t3766/257/1617667028/113747/ed374209/582d0572N17db6fec.jpg" /></a></li>
					<li><a href="#" target="_blank"><img src="http://img1.360buyimg.com/da/jfs/t3484/18/1601695659/118343/ee9969d1/582c2295N8f13622c.jpg" /></a></li>
					<li><a href="#" target="_blank"><img src="http://img13.360buyimg.com/da/jfs/t3766/257/1617667028/113747/ed374209/582d0572N17db6fec.jpg" /></a></li>
					<li><a href="#" target="_blank"><img src="http://img1.360buyimg.com/da/jfs/t3484/18/1601695659/118343/ee9969d1/582c2295N8f13622c.jpg" /></a></li>										
				</ul>
			</div>			
			<div class="page-body-content">
				<div>
					<div class="content-body">
						<div class="title-div">
							<span class="title">公司简介</span>
							<span class="title-en">COMPANY</span>
							<a href="{{ config('app.url') }}/art?id=1" class="more">More</a>
						</div>
						<div class="company-div">
							<img src="{{ config('app.url') }}/images/company_1.png" class="company-img" />
							<div class="company-content">
								{{ $art_2 }}
								[<a href="{{ config('app.url') }}/art?id=1">查看详情</a>]
							</div>
						</div>
					</div>
					<div class="content-body">
						<div class="title-div">
							<span class="title">新闻资讯</span>
							<span class="title-en">NEWS</span>
							<a href="{{ config('app.url') }}/news_list" class="more">More</a>
						</div>
						<div class="news-div">
							<table>
								<tbody>
									<tr>
										<td>
											<img src="{{ config('app.url') }}/images/news_1.png" class="news-img" />
										</td>
										<td class="news-top-td">
											<div class="news-top"><a href="{{ config('app.url') }}/news_view?id={{ $news_list_top['id'] }}" target="_blank"><b>{{ $news_list_top['name'] }}</b></a></div>
											<div class="news-top">
												{{ $news_list_top['content'] }}[<a href="{{ config('app.url') }}/news_view?id={{ $news_list_top['id'] }}" target="_blank">详细</a>]
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<ul class="news-list">
								@forelse ($news_list as $k => $v)
								<li @if ($v == end($news_list)) class="last" @endif>
									<span>{{ $k + 1 }}.</span>
									<a href="{{ config('app.url') }}/news_view?id={{ $v['id'] }}" target="_blank">{{ $v['name'] }}</a>
									<span class="date">{{ $v['add_time'] }}</span>
								</li>
								@empty
								<li class="last">暂时没有数据</li>
								@endforelse
							</ul>
						</div>						
					</div>
					<div class="content-body content-body-last">
						<div class="title-div">
							<span class="title">联系我们</span>
							<span class="title-en">CONTACT US</span>
							<a href="{{ config('app.url') }}/art?id=5" class="more">More</a>
						</div>
						{!! $art_6 !!}
					</div>
				</div>
				<div class="product-list-div">
					<div class="product-list-title">
						<span class="title">产品展示</span>
						<span class="title-en">PRODUCT</span>
						<a href="product_list" class="more">More</a>
					</div>

					<div id="product_list">
						<table border="0" align="center" cellpadding="1" cellspacing="1" cellspace="0">
							<tr>
								<td id="product_list1" valign="top" bgcolor="ffffff">
									<table border="0" cellspacing="0" cellpadding="0">
										<tr align="center">
											@foreach ($product_list as $v)
											<td>
												<div class="product-list-item">
													<a href="{{ config('app.url') }}/product_view?id={{ $v['id'] }}" target="_blank">
														<img class="product-img" src="{{ config('app.url') }}/upload/{{ $v['picture_0'] }}" />
														<div class="product-name">{{ $v['name'] }}</div>
													</a>
												</div>
											</td>
											@endforeach
										</tr>
									</table>
								</td>
								<td id="product_list2" valign="top">
								</td>
							</tr>
						</table>
					</div>
	
				</div>
			</div>
		</div>
		@include('site.common.footer')
	</div>
	<div class="hidden-data">
		<input id="cfg_url" type="hidden" value="{{ config("app.url") }}" />
	</div>
	@include('site.common.js')
	<script src="{{ config('app.url') }}/js/site/index/index.js"></script>
	<script src="{{ config('app.url') }}/js/site/common.js"></script>
</body>
</html>
