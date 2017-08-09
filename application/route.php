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


Route::get('loginexit','admin/index/loginexit');
Route::get('admin','admin/index/index');
//后台管理员操作
Route::resource('adminuser', 'admin/User');
//节点操作

Route::get('exit','admin/index/loginexit');
Route::get('admin','admin/index/index');
Route::resource('adminuser', 'admin/User');


// 管理员密码修改
Route::post('password','admin/User/password');



Route::resource('adminnode', 'admin/Node');
Route::get('admin/login','admin/login/index');
//Route::get('power/[:id]','admin/user/power');
Route::resource('admincate','admin/Cate');
Route::post('admin/dologin','admin/login/dologin');


//住宿分类管理
Route::resource('Hotelcate', 'admin/Hotelcate');
//住宿管理
Route::resource('hotel', 'admin/Hotel');
//后台住宿管理
Route::resource('hotellist', 'admin/Hotellist');
//查看住宿图片
Route::get('hotelshow','admin/hotel/show');
//后台查看图片
Route::get('hotelshowpic','admin/hotellist/show');
//住宿图片管理
Route::resource('Hotelpic', 'admin/HotelPic');
//设置图片封面
Route::get('/hotelpicfirst/[:id]','admin/HotelPic/first');


//活动管理
//平台对活动类型的增删改查
Route::resource('ActivitiesAdminCate','admin/ActivitiesAdminCate');
//商家对活动的增删改查
Route::resource('Activities', 'admin/Activities');
//商家对活动图片的增删改查
Route::resource('ActivitiesBusPic', 'admin/ActivitiesBusPic');
//商家查看活动图片
Route::get('ActivitiesShow','admin/Activities/show');
//设置图片封面
Route::get('/ActivitiesBusPicfirst/[:id]','admin/ActivitiesBusPic/first');
//平台对活动的增删改查
Route::resource('ActivitiesAdminList', 'admin/ActivitiesAdminList');
//平台查看活动图片
Route::get('ActivitiesAdminShow','admin/ActivitiesAdminList/show');

//友情链接管理
Route::resource('link','admin/Link');



//前台住宿
Route::resource('hotelDetail', 'index/hotel');
//旅游线路分类管理
Route::resource('Routescate', 'admin/Routescate');
//旅游线路管理
Route::resource('Routes', 'admin/Routes');
//后台旅游线路管理
Route::resource('Routeslist', 'admin/Routeslist');
//旅游路线图片
Route::get('routesshow','admin/routes/show');
//后台查看图片
Route::get('routesshowpic','admin/routeslist/show');
//旅游路线图片管理
Route::resource('Routespic', 'admin/RoutesPic');
//设置旅游路线图片封面
Route::get('/routespicfirst/[:id]','admin/RoutesPic/first');


//个人中心
Route::resource('per', 'index/personal');
//验证密码
Route::get('money', 'index/personal/checkpass');
//普通商品详情页
Route::get('goodsDetail', 'index/goodsInfo/detail');
//普通商品详情页
Route::get('routeDetail', 'index/route/index');
//购物车页面,开启后无法从商品详情页跳转到购物车页


//所有商铺管理
Route::resource('buspower', 'admin/Buspower');


Route::post('cart', 'index/cart/index');
//回车触发搜素
Route::get('souover','index/Index/souover');
//点击触发搜索
Route::get('searchover/:search','index/Index/searchover');
//前台搜索框
Route::post('search','index/Index/search');
//前台搜索触发

//购物车页面
//Route::get('cart', 'index/cart/index');

//商户管理中心
Route::get('busInfo','admin/BusInfo/index');
//商家后台首页
Route::get('busIndex','admin/BusIndex/index');
//修改商家资料
Route::post('busEdit/:id','admin/BusInfo/update');
//在线咨询
Route::get('consultation','index/Consultation/index');
//修改商家密码
Route::post('busEditPass/:id','admin/BusInfo/pass');
//特产分类管理
Route::resource('foodcate', 'admin/Foodcate');
//特产管理
Route::resource('foodhandle', 'admin/Food');
//后台特产管理
Route::resource('foodlist', 'admin/Foodlist');
//查看特产图片
Route::get('foodshow','admin/Food/show');
//后台查看图片
Route::get('foodpicshow','admin/Foodlist/show');
//特产图片管理
Route::resource('foodpic', 'admin/FoodPic');
//设置图片封面
Route::get('/foodpicfirst/[:id]','admin/FoodPic/first');

//景区分类管理
Route::resource('scenerycate', 'admin/Scenerycate');
//景区管理
Route::resource('scenery', 'admin/Scenery');

//后台管理景区
Route::resource('scenerylist', 'admin/Scenerylist');
//查看景区图片
Route::get('sceneryshow','admin/scenery/show');
//后台查看图片
Route::get('sceneryshowpic','admin/scenerylist/show');
//景区图片管理
Route::resource('scenerypic', 'admin/SceneryPic');
//设置图片封面
Route::get('/Scenerypicfirst/[:id]','admin/SceneryPic/first');
//商家后台


//未处理订单
Route::get('unorder', 'admin/BusOrder/unorder');
//未发货订单
Route::get('unDiliver', 'admin/BusOrder/unDiliver');
//发货中订单
Route::get('diliver', 'admin/BusOrder/diliver');
//已完成订单
Route::get('done', 'admin/BusOrder/done');
//被取消订单
Route::get('cancel', 'admin/BusOrder/cancel');

//显示不同分类列表页
Route::get('/listshow/:id/:cid', 'index/Index/listshow');
//显示列表页
Route::get('/shoplist/[:id]', 'index/Index/read');



//评论列表
Route::get('commentlist','admin/Comment/index');
Route::get('/commentedit/:id','admin/Comment/edit');

//前台的商家首页展示
Route::get('busindexshow','index/Bus/index');


return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
