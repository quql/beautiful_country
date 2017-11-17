<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Motive extends Base
{
    /**
     * 显示热门景区
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_is_sale='1' AND ml_scenery.gd_hot='1'");
//        var_dump($list);
        $this->assign('list',$list);
        $this->assign('motive','热门景区');
        return view('index/motivelist');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function motive()
    {

        $date = date('m');
        $month = (int)$date;
        if($month>=3 && $month<=5){
         $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_is_sale='1' AND ml_scenery.h_cate='18'");
            $this->assign('motive','春季景区');
            $this->assign('list',$list);
            return view('index/motivelist');
        }
        if($month>=6 && $month<=8){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_is_sale='1' AND ml_scenery.h_cate='19'");
            $this->assign('motive','夏季景区');
            $this->assign('list',$list);
            return view('index/motivelist');
        }
        if($month>=9 && $month<=11){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_is_sale='1' AND ml_scenery.h_cate='20'");
            $this->assign('motive','秋季景区');
            $this->assign('list',$list);
            return view('index/motivelist');
        }
        if($month==12 && $month<=2 && $month>=1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_is_sale='1' AND ml_scenery.h_cate='21'");
            $this->assign('motive','冬季景区');
            $this->assign('list',$list);
            return view('index/motivelist');
        }
    }

    public function price()
    {
        $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_is_sale='1' AND ml_scenery.price <'299'");
//        var_dump($list);
        $this->assign('list',$list);
        $this->assign('motive','特价景区');
        return view('index/motivelist');
    }
}
