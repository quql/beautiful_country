<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Admin
{
    public function index(Request $request)
    {

        return view('index/index');
    }

    public function loginexit(Request $request)
    {
        session('admin_id',null);
        $this->redirect('admin/login/index','已退出登录');
    }

}