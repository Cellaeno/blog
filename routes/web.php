<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// 后台
Route::get('admins','Admin\IndexController@index');
Route::post('admin/index/dologin','Admin\IndexController@dologin');

Route::group(['prefix'=>'admin','middleware'=>'login'],function(){

// 用户管理
    Route::get('user/index','Admin\UserController@index');
    Route::get('user/create','Admin\UserController@create');
    Route::post('user/store','Admin\UserController@store');
    Route::get('user/destory','Admin\UserController@destory');
    // Route::get('user/delete','Admin\UserController@delete');
    Route::get('user/edit/{uid}/{token}','Admin\UserController@edit');
    Route::post('user/update','Admin\UserController@update');
    Route::post('user/face','Admin\UserController@face');

// 栏目管理
    Route::get('cate/index','Admin\CateController@index');
    Route::get('cate/create','Admin\CateController@create');
    Route::post('cate/store','Admin\CateController@store');
    Route::get('cate/edit/{cid}','Admin\CateController@edit');

// 轮播图管理
    Route::get('banner/index','Admin\BannerController@index');
    Route::get('banner/create','Admin\BannerController@create');
    Route::post('banner/store','Admin\BannerController@store');
    Route::get('banner/schange','Admin\BannerController@schange');
    Route::get('banner/destory','Admin\BannerController@destory');
    Route::get('banner/edit/{bid}','Admin\BannerController@edit');
    Route::post('banner/update','Admin\BannerController@update');

// 标签云管理
    Route::get('tag/index','Admin\TagController@index');
    Route::get('tag/create','Admin\TagController@create');
    Route::post('tag/store','Admin\TagController@store');
    Route::get('tag/edit/{tid}','Admin\TagController@edit');
    Route::post('tag/update','Admin\TagController@update');
    Route::get('tag/destory','Admin\TagController@destory');

// 文章管理
    Route::get('art/index','Admin\ArtController@index');
    Route::get('art/create','Admin\ArtController@create');
    Route::post('art/store','Admin\ArtController@store');
    Route::get('art/edit/{aid}','Admin\ArtController@edit');
    Route::post('art/update','Admin\ArtController@update');
    Route::get('art/destory','Admin\ArtController@destory');

// 登录设置
    Route::get('index/logout','Admin\IndexController@logout');
    Route::get('index/edit/{uid}/{token}','Admin\IndexController@edit');
    Route::post('index/update','Admin\IndexController@update');
// 留言管理
    Route::get('discuss/index','Admin\DiscussController@index');
    Route::get('discuss/destory','Admin\DiscussController@destory');

});


// 前台
Route::get('/', 'Home\IndexController@index');

// 登录注册
Route::get('home/login/index','Home\LoginController@index');
Route::post('home/login/dologin','Home\LoginController@dologin');
Route::get('home/login/logout','Home\LoginController@logout');
Route::post('home/login/store','Home\LoginController@store');


Route::group(['prefix'=>'home'],function () {
// 首页
    Route::get('index/index','Home\IndexController@index');

// 文章列表
    Route::get('list/index','Home\ListController@index');

// 文章详情
    Route::get('detail/index','Home\DetailController@index');
    Route::get('detail/like','Home\DetailController@like');
    Route::get('detail/discuss','Home\DetailController@discuss');

// 个人信息
    Route::get('index/edit/{uid}/{token}','Home\IndexController@edit');
    Route::post('index/update','Home\IndexController@update');


});





