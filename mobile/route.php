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
return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
