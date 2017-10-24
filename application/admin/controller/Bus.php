<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Bus extends Controller
{
    public function _initialize(){
        if (input('session.b_name') == null) {
            $this->redirect("admin/BusLogin/index");
        }

        $res = Db::name('business')->where('b_name', input('b_name'))->find();

        $cate = Db::name('cate')->select();
        // var_dump($cate);
        // die;
        $this->assign('bus_res',$res);
        $this->assign('cate',$cate);

    }
}
