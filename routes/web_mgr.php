<?php

Route::get('/server/mgr/index/getvcode', 'Mgr\Index@getvcode');
Route::post('/server/mgr/index/login', 'Mgr\Index@login');

//需要登录才能打开的部分
Route::group(['prefix' => '/server/mgr', 'middleware' => 'mgr'], function()
{
    Route::get('other/logout', 'Mgr\Other@logout');
	
	Route::get('art_single/get', 'Mgr\ArtSingle@get');
	Route::post('art_single/update', 'Mgr\ArtSingle@update');
	
	Route::get('user/show', 'Mgr\User@show');
	Route::post('user/add', 'Mgr\User@add');
	Route::get('user/del', 'Mgr\User@del');
	Route::post('user/updatepwd', 'Mgr\User@updatepwd');
	
	Route::get('data_cat/show', 'Mgr\DataCat@show');
	Route::get('data_cat/get', 'Mgr\DataCat@get');
	Route::get('data_cat/gettree', 'Mgr\DataCat@gettree');
	Route::post('data_cat/add', 'Mgr\DataCat@add');
	Route::get('data_cat/del', 'Mgr\DataCat@del');
	
	Route::get('data/show', 'Mgr\Data@show');
	Route::post('data/add', 'Mgr\Data@add');
	Route::get('data/get', 'Mgr\Data@get');
	Route::get('data/del', 'Mgr\Data@del');
	Route::post('data/upload', 'Mgr\Data@upload');

});
