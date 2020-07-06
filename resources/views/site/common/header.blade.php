		<div id="page_header">
			<div class="page-header-top">
				<table>
					<tbody>
						<tr>
							<td class="logo-td">
								<!-- <a href="{{ config('app.url') }}/index"><img src="{{ config('app.url') }}/images/logo.png" class="logo" /></a> -->
							</td>
							<td class="pull-right">
								<div class="pull-right-nav">
									<a href="{{ config('app.url') }}/index">官网首页</a> | 
									<a href="#" id="btn_set_home">设为首页</a> | 
									<a href="#" id="add_favorite">收藏本站</a>
								</div>
								<div class="pull-right-search-div">
									<input type="text" id="text_search" name="text_search" class="" value="{{ Request::input('search') }}" />
									<button class="btn-search" id="btn_search">搜索</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="page-header-nav-div">
				<ul class="page-header-nav">
					<li {{ $page_header_nav_selected1 }}><a href="{{ config('app.url') }}/index">首页</a></li>
					<li {{ $page_header_nav_selected2 }}><a href="{{ config('app.url') }}/art?id=1">关于我们</a></li>
					<li {{ $page_header_nav_selected3 }}><a href="{{ config('app.url') }}/news_list">新闻中心</a></li>
					<li {{ $page_header_nav_selected4 }}><a href="{{ config('app.url') }}/product_list">产品中心</a></li>
					<li {{ $page_header_nav_selected5 }}><a href="{{ config('app.url') }}/art?id=3">人才招聘</a></li>
					<li {{ $page_header_nav_selected6 }}><a href="{{ config('app.url') }}/art?id=4">解决方案</a></li>
					<li {{ $page_header_nav_selected7 }}><a href="{{ config('app.url') }}/art?id=5">联系我们</a></li>
				</ul>
			</div>			
		</div>