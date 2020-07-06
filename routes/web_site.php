<?php

Route::get('/index', [
	'middleware' => 'site',
	'uses' => 'Site\Index@index'
]);

Route::get('/art', [
	'middleware' => 'site',
	'uses' => 'Site\Index@art'
]);

Route::get('/news_list', [
	'middleware' => 'site',
	'uses' => 'Site\Index@newsList'
]);
Route::get('/get_news_list', [
	'middleware' => 'site',
	'uses' => 'Site\Index@getNewsList'
]);
Route::get('/news_view', [
	'middleware' => 'site',
	'uses' => 'Site\Index@newsView'
]);

Route::get('/product_list', [
	'middleware' => 'site',
	'uses' => 'Site\Index@productList'
]);
Route::get('/get_product_list', [
	'middleware' => 'site',
	'uses' => 'Site\Index@getProductList'
]);
Route::get('/product_view', [
	'middleware' => 'site',
	'uses' => 'Site\Index@productView'
]);

Route::get('/', [
	'middleware' => 'site',
	'uses' => 'Site\Index@index'
]);
