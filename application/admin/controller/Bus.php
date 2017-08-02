<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Bus extends Controller
{
    public function _initialize(){
        if (cache('b_name') == null) {
            $this->redirect("admin/BusLogin/index");
        }

        $res = Db::name('business')->where('b_name', cache('b_name'))->find();
        $this->assign('bus_res',$res);
    }
}
