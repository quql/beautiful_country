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

// Route::get('category_show','admin/category/show');
Route::resource('category','admin/Category');
// Route::Resource('update','admin/category/update');
// Route::post('category/:id', 'admin/category/delete');
// Route::get('category_list','admin/category/list');
// Route::get('category_add','admin/category/add');
// Route::get('category','admin/category/read');
// Route::get('cateshow', 'admin/category/show');
// Route::get('admin','admin/index/index');
// Route::get('ad','admin/category/index');



return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
