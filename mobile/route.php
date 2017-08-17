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

Route::get('listshow','index/Index/listshow');
Route::get('detail','index/Index/detail');

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
//发送短信
Route::get('sendmsg/:phone','index/Sendmsg/send');
//执行注册
Route::post('doRegister', 'index/Register/doRegister');



//个人中心
Route::get('personal','index/Personal/index');
//优惠券
Route::get('coupon','index/Personal/coupon');
//删除已完成订单
Route::get('delete/:id','index/Order/delete');
//加入购物车
Route::get('docart/:gid/:cid','index/Cart/index');
//删除购物车中的商品

Route::get('delete/:id','index/Cart/delete');


//酒店确认支付
Route::post('playtrue','index/Order/playtrue');
//酒店预订
Route::get('hotelpay','index/Order/hotelpay');
//酒店订单确认
Route::post('hotelorder','index/Order/hotelorder');

Route::get('deletecart/:id','index/Cart/delete');
//添加评论
Route::get('create/:id','index/Comment/create');

return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
