<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        //加载,模板
        return view('index/index');
    }

}