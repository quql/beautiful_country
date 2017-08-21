<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Base extends Controller
{
    /**
     *基类
     *
     *
     */
    public function _initialize()
    {
        session_start();
        $cate = Db::name('cate')->select();
        $this->assign('cate',$cate);

        $activities = Db::name('ac_cate')->select();
        // var_dump($activities);die;
        $this->assign('activities',$activities);
    }


}
