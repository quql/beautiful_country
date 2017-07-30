<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        //测试数据库连接
        //dump(db('user')->find(1));

        //加载,模板
        return view('index/index');
    }

}