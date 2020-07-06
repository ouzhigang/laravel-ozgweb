<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<title>{{ config('app.name') }}</title>
	@include('site.common.meta')
	@include('site.common.css')
	<link href="{{ config('app.url') }}/css/site/index/product_view.css" rel="stylesheet" />
</head>
<body>
	<div id="page_main">
		@include('site.common.header')
		<div id="page_body">
			<div class="page-body-content">
				<div class="page-body-currnav">当前位置: 首页 &gt; 产品中心 &gt; {{ $data['name'] }}</div>
				@include('site.common.leftmenu')
				<div class="content-body">
					<div class="title-div">
						<div class="title">
							<h5>{{ $data['name'] }}</h5>
						</div>
						<div>
							<span>发布人：admin</span>
							<span class="release-time">发布时间：{{ $data['add_time'] }}</span>
						</div>
					</div>
					<div class="content-body-view">
						{!! $data['content'] !!}
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
	<script src="{{ config('app.url') }}/js/site/index/product_view.js"></script>
	<script src="{{ config('app.url') }}/js/site/common.js"></script>
</body>
</html>
