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
Route::get('/','index/index/index');
Route::get('admin','admin/index/index');

//显示登录页面
Route::get('showLogin', 'index/Index/showLogin');
//执行登录
Route::post('dologin', 'index/login/doLogin');
//退出登录
Route::get('outLogin', 'index/login/outLogin');


Route::get('qqlogin', 'index/login/login');
//QQ资料完善
Route::post('qqlogin','index/Login/doqqlogin');



//显示注册页面
Route::get('showRegister', 'index/Index/showRegister');
//执行注册
Route::post('doRegister', 'index/Register/doRegister');


return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
