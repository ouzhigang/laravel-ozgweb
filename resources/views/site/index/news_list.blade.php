<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<title>{{ config('app.name') }}</title>
	@include('site.common.meta')
	@include('site.common.css')
	<link href="{{ config('app.url') }}/css/site/index/news_list.css" rel="stylesheet" />
</head>
<body>
	<div id="page_main">
		@include('site.common.header')
		<div id="page_body">
			<div class="page-body-content">
				<div class="page-body-currnav">当前位置: 首页 &gt; 新闻列表</div>
				@include('site.common.leftmenu')
				<div class="content-body">
					<div>
						<ul id="news_list">
						</ul>
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
	<script src="{{ config('app.url') }}/js/site/index/news_list.js"></script>
	<script src="{{ config('app.url') }}/js/site/common.js"></script>
</body>
</html>
