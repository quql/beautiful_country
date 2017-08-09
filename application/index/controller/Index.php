<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Url;
use think\Db;

class Index extends Base
{
    public function index()
    {
        return view('index/index');
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


    public function search(Request $request)
    {
        $data=$request->post('search');
        if(empty($data)){
            $data = 'sadaddadadadada536746 gewafd';
        }

        static $arr=array();
        $arr1 = Db::name('hotel')
                 ->field('id,gd_title,c_id')
                 ->where("gd_title",'like',"%$data%")
                 ->select();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr2 = Db::name('food')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr3 = Db::name('route')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr4 = Db::name('scenery')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $arr[]=$v;
            }
        }
        //var_dump($arr);
        return json($arr);
    }//

    //显示不同分类的商品列表
    //显示列表页
    public function listshow()
    {
        $data =input();
        $id = $data['id'];
        $cateid = $data['cid'];

       // 判断用户查看的类型
        if($id==4){
            //查询主表字段和封面图片
            $list = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.h_cate={$cateid}");
        }elseif($id==5){
            $list = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.h_cate={$cateid}");
        }elseif($id==1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.h_cate={$cateid}");
        }elseif($id==6){
            $list = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.h_cate={$cateid}");
        }else{
            return '暂无数据';
        }
//        var_dump($list);
//        die;
        $this->assign('list',$list);
        return view ('index/list');
    }

//搜索触发
    public function souover()
    {

        $data=input('search');

        if(empty($data)){
           $this->redirect('index/index/index');
        }

            //查询主表字段和封面图片
            $arr1 = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.gd_title like '%$data%' ");

            $arr2 = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.gd_title like '%$data%' ");

            $arr3 = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_title like '%$data%' ");

            $arr4 = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.gd_title like '%$data%' ");

        static $list=array();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $list[]=$v;
            }
        }

        $this->assign('list',$list);
        return view ('index/list');
    }//

    public function searchover()
    {

        $data=input('search');

        if(empty($data)){
            $data = 'sadaddadadadada536746 gewafd';
        }

        //查询主表字段和封面图片
        $arr1 = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.gd_title like '%$data%' ");

        $arr2 = Db::query("select ml_route.id,gd_title,gd_abstract,price,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.gd_title like '%$data%' ");

        $arr3 = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_title like '%$data%' ");

        $arr4 = Db::query("select ml_food.id,gd_title,gd_abstract,price,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.gd_title like '%$data%' ");

        static $list=array();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $list[]=$v;
            }
        }

        $this->assign('list',$list);
        return view ('index/list');
    }//

}
