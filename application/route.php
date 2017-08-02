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
Route::post('nodeedit','admin/cate/nodeedit');
Route::get('/','index/index/index');
//分类管理
Route::resource('category','admin/Category');
//定义主页
Route::get('index/login/index','index/login/index');

//用户注册
Route::post('UserRegister','index/Register/doregister');


//商户注册
Route::post('busDoRegister','index/BusRegister/doregister');
//商户登陆的页面
Route::get('busLogin','admin/BusLogin/index');
//商户登陆的操作
Route::post('busDoLogin','admin/BusLogin/doLogin');
//商户注销的操作
Route::get('busLoginOut','admin/BusLogin/loginOut');

Route::get('exit','admin/index/loginexit');
Route::get('admin','admin/index/index');
Route::resource('adminuser', 'admin/User');
Route::resource('adminnode', 'admin/Node');
Route::get('admin/login','admin/login/index');
//Route::get('power/[:id]','admin/user/power');
Route::resource('admincate','admin/Cate');
Route::post('admin/dologin','admin/login/dologin');


//个人中心
Route::resource('per', 'index/personal');

//购物车页面
Route::get('cart', 'index/cart/index');
return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
