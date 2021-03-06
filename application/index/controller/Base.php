<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Base extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function _initialize()
    {
        session_start();
        $hotel = Db::name('h_cate')->select();
        $routes = Db::name('route_cate')->select();
        $scenery = Db::name('scenery_cate')->select();
        $food = Db::name('food_cate')->select();

        //查询友情链接数据
        $link = Db::name('link')->select();
        $activities = Db::name('ac_cate')->select();

        $this->assign('link',$link);
        $this->assign('activities',$activities);
        $this->assign('hotel',$hotel);
        $this->assign('routes',$routes);
        $this->assign('scenery',$scenery);
        $this->assign('food',$food);

        if(!empty(input('session.u_id'))){
            $id = input('session.u_id');
            $user = Db::name('user')->where('u_id',$id)->field('u_id,u_username')->select();
            $shopcart = Db::name('cart')->field('ca_price,ca_gname,ca_photo')->where('ca_uid',$id)->select();
            //var_dump($shopcart);
            $user = $user['0'];
            $this->assign('user',$user);
            $this->assign('shopcart',$shopcart);
        }
    }


}
