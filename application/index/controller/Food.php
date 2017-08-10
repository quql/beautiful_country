<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Food extends Base
{
    public function detail()
    {
        //登录用户的id
        $uid = 1;

        //浏览店铺商家的id
        $bid = 1;

        //商品的id
        $cid = 10;

        //获取用户会员类型
        $u = model('userDetail');
        $type = $u->getDetail($uid)[0];
        //dump($type);exit;

        //获取商品基本信息
        $f = model('Food');
        $food = $f->getDetail($cid);

        //获取商品详细信息
        $d = model('FoodDetail');
        $detail = $d->getDetail($cid);


        //获取商品图片
        $p = model('foodPic');
        $photos = $p->getPhotos($cid);

        return view('index/foodDetail', [
            'foods'=>$food[0],
            'detail'=>$detail[0],
            'photo'=>$photos,
            'type'=>$type,
        ]);
    }
}
