				<div class="leftmenu">
					<div class="list-div">
						<div class="menu-title">产品类别</div>
						<ul class="product-class-list">
							@forelse ($product_class_list as $k => $v)
							<li @if ($v == end($product_class_list)) class="last" @endif>								
								<a href="{{ config('app.url') }}/product_list?data_cat_id={{ $v['id'] }}">{{ $v['name'] }}</a>
							</li>
							@empty
							<li class="last">暂时没有数据</li>
							@endforelse
						</ul>
					</div>
					<div class="list-div">
						<div class="menu-title">推荐产品</div>
						<ul class="product-list">
							@forelse ($product_list_recommend as $k => $v)
							<li @if ($v == end($product_list_recommend)) class="last" @endif>
								<a href="{{ config('app.url') }}/product_view?id={{ $v['id'] }}" target="_blank">								
									<img src="{{ config('app.url') }}/upload/{{ $v['picture_0'] }}" />
									<span>{{ $v['name'] }}</span>
								</a>
							</li>
							@empty
							<li class="last">暂时没有数据</li>
							@endforelse
						</ul>
					</div>					
					<div class="list-div">
						<div class="menu-title">行业新闻</div>
						<ul class="new-list">
							@forelse ($news_list_recommend as $k => $v)
							<li @if ($v == end($news_list_recommend)) class="last" @endif>
								<a href="{{ config('app.url') }}/news_view?id={{ $v['id'] }}" target="_blank">{{ $k + 1 }}.{{ $v['name'] }}</a>							
							</li>
							@empty
							<li class="last">暂时没有数据</li>
							@endforelse
						</ul>
					</div>
					<div class="list-div">
						<div class="menu-title">联系我们</div>
						<div class="leftmenu-contact-div">
							{!! $art_7 !!}
						</div>
					</div>
				</div>