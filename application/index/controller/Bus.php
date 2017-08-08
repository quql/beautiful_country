<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Bus extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //根据接收到的id显示不同的商家页面
        //$b_id = input('get.b_id');
        $b_id =15;
        //查询店铺信息，用于首页展示
        $data=Db::name('business')->where('b_id',$b_id)->select();
        $data=$data['0'];

        //查看景区下的分类
        $cate=Db::name('scenery_cate')->where(['c_id'=>1])->select();
        if (!empty($cate)) {
            //二级分类的id
            foreach ($cate as $v) {
                $x[] = $v['id'];
                $cate_name[]=$v['h_name'];

            }
            //dump($x);
            for ( $i=0;$i<count($x);$i++){
                //dump($i);
                $sql="select * from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' and ml_scenery.h_cate={$x[$i]} and ml_scenery.bus_id={$b_id} and ml_scenery.gd_is_sale='1'";
                $ticket[]=Db::query($sql);
            }
//            dump(count($x));
//            dump($cate_name);
//
//            dump($ticket);
            //分类对应的商品
            $sql="select * from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' and ml_scenery.h_cate={$x[0]} and ml_scenery.bus_id={$b_id} and ml_scenery.gd_is_sale='1'";
            $ticket1=Db::query($sql);
            $sql="select * from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' and ml_scenery.h_cate={$x[1]} and ml_scenery.bus_id={$b_id} and ml_scenery.gd_is_sale='1'";
            $ticket2=Db::query($sql);
            //dump($ticket1);
            //dump($ticket2);
        }

        //查看特产美食下的分类
        $cate_f=Db::name('food_cate')->where(['c_id'=>6])->select();
        if (!empty($cate_f)) {
            //二级分类的id
            foreach ($cate_f as $v) {
                $y[] = $v['id'];
            }
            //dump($y);
            //分类对应的商品
            $sql="select * from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' and ml_food.h_cate={$y[0]} and ml_food.bus_id={$b_id} and ml_food.gd_is_sale='1'";
            $food1=Db::query($sql);
            $sql="select * from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' and ml_food.h_cate={$y[1]} and ml_food.bus_id={$b_id} and ml_food.gd_is_sale='1'";
            $food2=Db::query($sql);
            //dump($food1);
            //dump($food2);
        }

        //查看旅游路线下的分类
        $cate_f=Db::name('route_cate')->where(['c_id'=>5])->select();
        if (!empty($cate_f)) {
            //二级分类的id
            foreach ($cate_f as $v) {
                $r[] = $v['id'];
            }
            //dump($r);
            //分类对应的商品
            $sql="select * from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' and ml_route.h_cate={$r[0]} and ml_route.bus_id={$b_id} and ml_route.gd_is_sale='1'";
            $route1=Db::query($sql);
            $sql="select * from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' and ml_route.h_cate={$r[1]} and ml_route.bus_id={$b_id} and ml_route.gd_is_sale='1'";
            $route2=Db::query($sql);
            //dump($route1);
            //dump($route2);
        }

        //查看住宿下的分类
        $cate_h=Db::name('h_cate')->where(['c_id'=>4])->select();
        if (!empty($cate_h)) {
            //二级分类的id
            foreach ($cate_h as $v) {
                $h[] = $v['id'];
            }
            //dump($h);
            //分类对应的商品
            $sql="select * from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' and ml_hotel.h_cate={$h[0]} and ml_hotel.bus_id={$b_id} and ml_hotel.gd_is_sale='1'";
            $hotel1=Db::query($sql);
            $sql="select * from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' and ml_hotel.h_cate={$h[1]} and ml_hotel.bus_id={$b_id} and ml_hotel.gd_is_sale='1'";
            $hotel2=Db::query($sql);
            $sql="select * from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' and ml_hotel.h_cate={$h[2]} and ml_hotel.bus_id={$b_id} and ml_hotel.gd_is_sale='1'";
            $hotel3=Db::query($sql);
            //dump($hotel1);
            //dump($hotel2);
        }





        return view('bus/index',[
            'list'=>$data,
            'cate'=>$cate_name,
            'num'=>count($cate_name),
            'ticket'=>$ticket,
            'ticket1'=>$ticket1,
            'ticket2'=>$ticket2,
            'food1'=>$food1,
            'food2'=>$food2,
            'route1'=>$route1,
            'route2'=>$route2,
            'hotel1'=>$hotel1,
            'hotel2'=>$hotel2,
            'hotel3'=>$hotel3
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read()
    {

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
