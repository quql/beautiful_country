<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Bus extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //根据接收到的id显示不同的商家页面
        $b_id = input('id');
        //dump($b_id);
        //查询店铺信息，用于首页展示
        $data = Db::name('business')->where('b_id', $b_id)->select();
        //dump($data);
        $data = $data['0'];

        //查看景区下的分类
        $cate = Db::name('scenery_cate')->where(['c_id' => 1])->select();
        if (!empty($cate)) {
            //二级分类的id
            foreach ($cate as $v) {
                $x[] = $v['id'];
                $cate_name[] = $v['h_name'];

            }
            for ($i = 0; $i < count($x); $i++) {
                $sql = "select * from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' and ml_scenery.h_cate={$x[$i]} and ml_scenery.bus_id={$b_id} and ml_scenery.gd_is_sale='1'";
                $ticket[] = Db::query($sql);
            }
//            dump(count($x));
//            dump($cate_name);
            //dump($ticket);
        }

        //查看特产美食下的分类
        $cate_f = Db::name('food_cate')->where(['c_id' => 6])->select();
        if (!empty($cate_f)) {
            //二级分类的id
            foreach ($cate_f as $v) {
                $y[] = $v['id'];
                $cate_food[] = $v['h_name'];
            }
            for ($i = 0; $i < count($y); $i++) {
                //分类对应的商品
                $sql = "select * from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' and ml_food.h_cate={$y[$i]} and ml_food.bus_id={$b_id} and ml_food.gd_is_sale='1'";
                $food[] = Db::query($sql);
            }
            //dump($y);
            //dump($food);
        }

        //查看旅游路线下的分类
        $cate_f = Db::name('route_cate')->where(['c_id' => 5])->select();
        if (!empty($cate_f)) {
            //二级分类的id
            foreach ($cate_f as $v) {
                $r[] = $v['id'];
                $cate_route[] = $v['h_name'];
            }
            for ($i = 0; $i < count($r); $i++) {
                //分类对应的商品
                $sql = "select * from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' and ml_route.h_cate={$r[$i]} and ml_route.bus_id={$b_id} and ml_route.gd_is_sale='1'";
                $route[] = Db::query($sql);
            }
            //dump($route);
        }

        //查看住宿下的分类
        $cate_h = Db::name('h_cate')->where(['c_id' => 4])->select();
        if (!empty($cate_h)) {
            //二级分类的id
            foreach ($cate_h as $v) {
                $h[] = $v['id'];
                $cate_hotel[] = $v['h_name'];
            }
            for ($i = 0; $i < count($h); $i++) {
                //分类对应的商品
                $sql = "select * from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' and ml_hotel.h_cate={$h[$i]} and ml_hotel.bus_id={$b_id} and ml_hotel.gd_is_sale='1'";
                $hotel[] = Db::query($sql);
            }
            //dump($hotel);
        }

        //查看活动下的数据
        $cate_a = Db::name('ac_cate')->select();
        //dump($cate_a);
        if (!empty($cate_a)) {
            //二级分类的id
            foreach ($cate_a as $v) {
                $a[] = $v['id'];
                $cate_ac[] = $v['ac_name'];
            }
            for ($i = 0; $i < count($a); $i++) {
                //分类对应的商品
                $sql = "select * from ml_activities LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid where ml_ac_pic.is_first='1' and ml_activities.ac_cate={$a[$i]} and ml_activities.bus_id={$b_id} and ml_activities.ac_status='1'";
                $activities[] = Db::query($sql);
            }
//            dump($a);
//            dump($cate_ac);
           // dump($activities);
        }



        //加载页面
        return view('bus/index', [
            'b_id'=>$b_id,
            'list' => $data,
            'cate' => $cate_name,
            'ticket' => $ticket,
            'cate_f' => $cate_food,
            'food' => $food,
            'cate_r' => $cate_route,
            'route' => $route,
            'cate_h' => $cate_hotel,
            'hotel' => $hotel,
            'cate_a' => $cate_ac,
            'activities' => $activities

        ]);
    }
}
