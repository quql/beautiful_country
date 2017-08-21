<?php

namespace app\index\controller;

use think\Controller;
use think\db\Query;
use think\Request;
use think\Db;

class GoodsDetail extends Base
{
    /**
     * 显示资源列表G
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取get传递的数据
        $data = input();
        //商品ID
        $id = $data['id'];
        //分类ID
        $cid = $data['cid'];
        //商家ID
        $bid = $data['bus_id'];

        //获取商品评论的内容及用户
        $sql="select ml_comment.c_score,c_text,c_time,c_gname,ml_user_detail.ud_photo,ml_user.u_username,ml_bus_comment.c_content,c_atime FROM ml_comment LEFT JOIN ml_user_detail ON ml_user_detail.ud_uid=ml_comment.c_uid LEFT JOIN ml_bus_comment ON ml_bus_comment.com_id=ml_comment.c_id LEFT JOIN ml_user ON ml_user.u_id=ml_comment.c_uid WHERE ml_comment.c_cid=$cid AND ml_comment.c_gid=$id AND ml_comment.is_ban='0' ";
        $comment=Db::query($sql);
        //dump(count($comment));die;

        //判断用户是否登录
        if(!empty(input('session.u_id'))){
            $uid = input('session.u_id');
            $u = model('userDetail');
            $type = $u->getDetail($uid)[0];
        }else{
            $type['ud_type'] = '0';
        }

        if($cid==6){
            //获取商品基本信息
            $f = model('Food');
            $food = $f->getDetail($id);

            //获取商品详细信息
            $d = model('FoodDetail');
            $detail = $d->getDetail($id);

            //获取商品图片
            $p = model('foodPic');
            $photos = $p->getPhotos($id);

            //获取其他商品
            $all = $f->getAll($bid);
            static $pics = array();
            foreach($all as $k=>$v){
                $q = new Query();
                $pics= $q->name('food_pic')->field('pic')->where('gid',$v['id'])->find();
                $all[$k]['pic']=$pics['pic'];
            };

            //dump($all);die;

            return view('index/foodDetail', [
                'foods'=>$food[0],
                'detail'=>$detail[0],
                'photo'=>$photos,
                'type'=>$type,
                'bid'=>$bid,
                'cid'=>6,
                'comment'=>$comment,
                'all'=>$all,


            ]);

        }elseif($cid==1){
            //获取景区的基本信息
            $s = model('Scenery');
            $scenery = $s->getDetail($id);

            //获取景区的详细信息
            $d = model('SceneryDetail');
            $detail = $d->getDetail($id);

            //获取景区的图片
            $p = model('sceneryPic');
            $photos = $p->getPhotos($id);

            //获取其他商品
            $all = $s->getAll($bid);
            static $pics = array();
            foreach($all as $k=>$v){
                $q = new Query();
                $pics= $q->name('scenery_pic')->field('pic')->where('gid',$v['id'])->find();
                $all[$k]['pic']=$pics['pic'];
            };

            //获取景区所在区域
            $b = model('business');
            $area = $b->getArea($bid)['b_area'];

            //dump($scenery[0]);
            //dump($detail[0]);
            //dump($all);die;

            return view('index/sceneryDetail', [
                'scenerys'=>$scenery[0],
                'detail'=>$detail[0],
                'photos'=>$photos,
                'type'=>$type,
                'bid'=>$bid,
                'cid'=>1,
                'comment'=>$comment,
                'all'=>$all,
                'area'=>$area,
            ]);
        }elseif($cid==5){
            //获取路线的基本信息
            $r = model('Route');
            $route = $r->getDetail($id);

            //获取路线的详细信息
            $d = model('RouteDetail');
            $detail = $d->getDetail($id);

            //获取路线的图片
            $p = model('RoutePic');
            $photos = $p->getPhotos($id);

            //dump($route[0]);
            //dump($detail[0]);
            //dump($photos);

            //获取其他商品
            $all = $r->getAll($bid);
            static $pics = array();
            foreach($all as $k=>$v){
                $q = new Query();
                $pics= $q->name('route_pic')->field('pic')->where('gid',$v['id'])->find();
                $all[$k]['pic']=$pics['pic'];
            };

            return view('index/routeDetail', [
                'route'=>$route[0],
                'detail'=>$detail[0],
                'photos'=>$photos,
                'type'=>$type,
                'bid'=>$bid,
                'cid'=>5,
                'comment'=>$comment,
                'all'=>$all,

            ]);
        }elseif($cid==4){
            //获取住宿基本信息
            $h = model('hotel');
            $hotels = $h->getDetail($id);

            //获取住宿详细信息
            $d = model('hotelDetail');
            $detail = $d->getDetail($id);

            //获取住宿图片
            $p = model('hotelPic');
            $photos = $p->getPhotos($id);

            //dump($hotels[0]);
            //dump($detail[0]);
            //dump($photos);


            return view('index/hotelDetail', [
                'hotels'=>$hotels[0],
                'detail'=>$detail[0],
                'photos'=>$photos,
                'type'=>$type,
                'bid'=>$bid,
                'cid'=>6,
                'comment'=>$comment
            ]);
        }

    }


}
