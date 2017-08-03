<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//动态注册
use think\Route;
//节点操作
Route::post('nodeedit','admin/cate/nodeedit');
Route::get('/','index/index/index');

//商户注册
Route::post('busDoRegister','index/BusRegister/doregister');
//商户登陆的页面
Route::get('busLogin','admin/BusLogin/index');
//商户登陆的操作
Route::post('busDoLogin','admin/BusLogin/doLogin');
//商户注销的操作
Route::get('busLoginOut','admin/BusLogin/loginOut');

Route::get('loginexit','admin/index/loginexit');
Route::get('admin','admin/index/index');
//后台管理员操作
Route::resource('adminuser', 'admin/User');
//节点操作
Route::resource('adminnode', 'admin/Node');
Route::get('admin/login','admin/login/index');
//Route::get('power/[:id]','admin/user/power');
Route::resource('admincate','admin/Cate');
Route::post('admin/dologin','admin/login/dologin');



//个人中心
Route::resource('per', 'index/personal');
//商品详情页
Route::get('goodsDetail', 'index/goodsInfo/detail');
//购物车页面,开启后无法从商品详情页跳转到购物车页
Route::any('cart', 'index/cart/index', ['method'=>'get|post']);



//购物车页面
Route::get('cart', 'index/cart/index');

//住宿管理
Route::resource('hotel', 'admin/Hotel');
//查看住宿图片
Route::get('hotelshow','admin/hotel/show');
//住宿图片管理
Route::resource('Hotelpic', 'admin/HotelPic');
//住宿分类管理
Route::resource('HotelCate', 'admin/HotelCate');
//设置图片封面
Route::get('/hotelpicfirst/[:id]','admin/HotelPic/first');

Route::get('BusIndex','admin/BusIndex/index');

//商户管理中心
Route::get('busInfo','admin/BusInfo/index');
//商家后台首页
Route::get('BusIndex','admin/BusIndex/index');
//修改商家资料
Route::post('busEdit/:id','admin/BusInfo/update');
//在线咨询
Route::get('consultation','index/Consultation/index');

return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
