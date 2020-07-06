
$(function() {
	
	function show_data() {
		
		var data = {
			"page": page
		};
		
		var search = getUrlParam("search");
		if(search) data.search = search;
		
		var data_cat_id = getUrlParam("data_cat_id");
		if(data_cat_id) data.data_cat_id = data_cat_id;
		
		do_show_data = false;
		var url = $("#cfg_url").val() + "/get_product_list";
		$.getJSON(
			url,
			data,
			function(data) {
				if(data.code == 0) {
					
					var html = '';
					for(var i in data.data.list) {
						html += '<li>';
						html += '<a href="' + $("#cfg_url").val() + '/product_view?id=' + data.data.list[i].id + '" target="_blank">';
						html += '<img class="product-img" src="' + $("#cfg_url").val() + "/upload/" + data.data.list[i].picture + '" />';
						html += '<div class="product-name">' + data.data.list[i].name + '</div>';
						html += '</a>';
						html += '</li>';
					}							
					$("#product_list").append(html);
					
					$("#product_list > li").unbind("mouseover").mouseover(function() {
						$(this).css("border", "1px #ddd dotted");
					});
					$("#product_list > li").unbind("mouseout").mouseout(function() {
						$(this).css("border", "1px #fff solid");
					});
					
					page = parseInt(data.data.page);
					page_count = parseInt(data.data.page_count);
					
					if(page < page_count) {
						page++;
						
						setTimeout(function() {
							do_show_data = true;
						}, 500);
					}					
				}
			}
		);
	}
	
	var page = 1;
	var page_count = 1;
	var do_show_data = true;	
	
	$(window).scroll(function() {
		if($(document).scrollTop() + $(window).height() >= $(document).height()) {
			
			if(do_show_data) {
				show_data();
			}
			
		}
	});
	
	show_data();
});