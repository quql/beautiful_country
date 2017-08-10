<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

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


            return view('index/foodDetail', [
                'foods'=>$food[0],
                'detail'=>$detail[0],
                'photo'=>$photos,
                'type'=>$type,
            ]);

        }elseif($cid==1){
            //获取路线的基本信息
            $s = model('Scenery');
            $scenery = $s->getDetail($id);

            //获取路线的详细信息
            $d = model('SceneryDetail');
            $detail = $d->getDetail($id);

            //获取路线的图片
            $p = model('sceneryPic');
            $photos = $p->getPhotos($id);

            //dump($scenery[0]);
            //dump($detail[0]);
            //dump($photos);

            return view('index/sceneryDetail', [
                'scenerys'=>$scenery[0],
                'detail'=>$detail[0],
                'photos'=>$photos,
                'type'=>$type,
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

            return view('index/routeDetail', [
                'route'=>$route[0],
                'detail'=>$detail[0],
                'photos'=>$photos,
                'type'=>$type,
            ]);
        }elseif($cid==4){
            //获取商品基本信息
            $h = model('hotel');
            $hotels = $h->getDetail($id);

            //获取商品详细信息
            $d = model('hotelDetail');
            $detail = $d->getDetail($id);

            //获取商品图片
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
            ]);
        }

    }


}