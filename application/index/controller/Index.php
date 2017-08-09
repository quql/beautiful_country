<?php
namespace app\index\controller;

use think\Controller;
use think\Url;
use think\Db;

class Index extends Base
{
    public function index()
    {
        //查询特产美食数据
        $sql="select ml_food.*,ml_food_pic.pic,ml_business.b_name from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid LEFT JOIN ml_business ON ml_food.bus_id=ml_business.b_id  where ml_food_pic.is_first='1' and  ml_food.gd_is_sale='1'";
        $food=Db::query($sql);
        //dump($food);
        //exit;

        return view('index/index',[
            'foods'=>$food
        ]);
    }

    public function loginout()
    {
       session('u_id',null);
       $this->success('退出成功','index/index/index');
    }

    //显示列表页
    public function read($id)
    {
        //判断用户查看的类型
        if($id==4){
            //查询主表字段和封面图片
           $list = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1'");
        }elseif($id==5){
            $list = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1'");
        }elseif($id==1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1'");
        }elseif($id==6){
            $list = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1'");
        }else{
            return '暂无数据';
        }
//        var_dump($list);
//        die;
        $this->assign('list',$list);
        return view ('index/list');
    }


}
