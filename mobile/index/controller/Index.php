<?php
namespace app\index\controller;

use think\Controller;
use think\Url;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        //查询特产美食数据
        $sql1="select ml_food.*,ml_food_pic.pic,ml_business.b_name from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid LEFT JOIN ml_business ON ml_food.bus_id=ml_business.b_id  where ml_food_pic.is_first='1' and  ml_food.gd_is_sale='1' limit 3";
        $food=Db::query($sql1);
        //dump($food);
//die;
        //热推线路TOP10
        $sql2="select ml_route.*,ml_route_pic.pic,ml_route.c_id,gd_title,gd_abstract,bus_id,ml_business.b_name from ml_route_detail LEFT JOIN ml_route ON ml_route_detail.c_gid=ml_route.id LEFT JOIN ml_business ON ml_route.bus_id=ml_business.b_id LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid WHERE ml_route.gd_is_sale='1' and ml_route_pic.is_first='1' ORDER BY gd_view desc limit 3";
        $routes = Db::query($sql2);
        //dump($routes);

        //热门景点
        $sql3="select ml_scenery.*,ml_scenery_pic.pic,ml_scenery.c_id,gd_title,gd_abstract,bus_id,ml_business.b_name,b_province,b_city,b_area from ml_scenery_detail LEFT JOIN ml_scenery ON ml_scenery_detail.c_gid=ml_scenery.id LEFT JOIN ml_business ON ml_scenery.bus_id=ml_business.b_id LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid WHERE ml_scenery.gd_is_sale='1' and ml_scenery_pic.is_first='1' ORDER BY gd_view desc limit 3";
        $scenery = Db::query($sql3);
        //dump($scenery);
        //exit;

        //查询友情链接数据
        $link = Db::name('link')->select();

        //查询精彩活动的数据
        $activitiessql = "select ml_activities.id as activities_id,ml_activities.ac_title,ml_activities.ac_abstract,ml_activities.ac_opentime,ml_activities.ac_closetime,ml_activities.ac_spot,ml_activities.ac_spot,ml_activities.ac_host,ml_activities.ac_cate,ml_activities.ac_details,ml_activities.ac_price,ml_activities.ac_status,ml_activities.ac_contain,ml_activities.bus_id,ml_ac_cate.id as ac_cate_id,ml_ac_cate.ac_name,ml_ac_cate.p_id,ml_ac_pic.id as ac_pic_id,ml_ac_pic.acid,ml_ac_pic.pic from ml_activities LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid LEFT JOIN ml_ac_cate ON ml_activities.ac_cate=ml_ac_cate.id where ml_ac_pic.is_first='1' and  ml_activities.ac_status='1'";
        // where ml_ac_pic.is_first='1'

        $activitiesindex = Db::query($activitiessql);
        // var_dump($activitiesindex);
//        dump($routes);
//        exit;

        return view('index/index',[
            'foods'=>$food,
            'link' =>$link,
            'hotroute'=>$routes,
            'hotscenery'=>$scenery,
            'activitiesindex'=>$activitiesindex
        ]);
    }

    public function listshow()
    {
        $data =input();
        $cid = $data['cid'];

        // 判断用户查看的类型
        if($cid==4){
            //查询主表字段和封面图片
            $list = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,bus_id,c_id,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' ");
        }elseif($cid==5){
            $list = Db::query("select ml_route.id,gd_title,gd_abstract,price,bus_id,c_id,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' ");
        }elseif($cid==1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1'");
        }elseif($cid==6){
            $list = Db::query("select ml_food.id,gd_title,gd_abstract,price,bus_id,c_id, ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' ");
        }else{
            return '暂无数据';
        }
//
//         var_dump($list);
//         die;

        $this->assign('list',$list);
        return view ('index/list');
    }

    public function detail()
    {
        $data =input();
        $cid = $data['cid'];
        $gid = $data['gid'];
        //var_dump($data);

        if($cid==5){
            $list = Db::query("select ml_route_detail.*,ml_route_pic.pic from ml_route_detail LEFT JOIN ml_route_pic ON ml_route_detail.c_gid=ml_route_pic.gid where ml_route_detail.c_gid='$gid' ");
            $this->assign('list',$list);
            $this->assign('data',$data);
//            var_dump($list);
//            die;
            return view ('index/detail');
        }elseif($cid==1){
            $list = Db::query("select ml_scenery_detail.*,ml_scenery_pic.pic from ml_scenery_detail LEFT JOIN ml_scenery_pic ON ml_scenery_detail.c_gid=ml_scenery_pic.gid where ml_scenery_detail.c_gid='$gid'");
            $this->assign('list',$list);
            $this->assign('data',$data);
            return view ('index/detail');
        }elseif($cid==6){
            $list = Db::query("select ml_food_detail.*, ml_food_pic.pic from ml_food_detail LEFT JOIN ml_food_pic ON ml_food_detail.c_gid=ml_food_pic.gid where ml_food_detail.c_gid='$gid' ");
            $this->assign('list',$list);
            $this->assign('data',$data);
            return view ('index/detail');
        }elseif($cid==4){
            $list = Db::query("select ml_hotel_detail.*, ml_hotel_pic.pic from ml_hotel_detail LEFT JOIN ml_hotel_pic ON ml_hotel_detail.c_gid=ml_hotel_pic.gid where ml_hotel_detail.c_gid='$gid' ");
//            var_dump($list);
//            die;
            $this->assign('list',$list);
            return view ('index/hoteldetail');
        }else{
            $this->error('暂无数据');
        }
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
