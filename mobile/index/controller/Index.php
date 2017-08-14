<?php
namespace app\index\controller;

use think\Controller;
use think\Url;

class Index extends Controller
{
    public function index()
    {

        return view('index/index');
    }
    
    //显示登录页面
    public function showLogin()
    {
        return view('index/showLogin');
    }

    //显示注册页面
    public function showRegister()
    {
        return view('index/showRegister');
    }

}
