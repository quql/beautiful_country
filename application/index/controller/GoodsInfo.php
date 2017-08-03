<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class GoodsInfo extends Controller
{
    public function detail()
    {
        //登录用户的id
        $uid = 1;

        //浏览店铺商家的id
        $bid = 1;

        //商品的id
        $cid = 1;

        //获取商品详细信息
        $good = model('goodsDetail');
        $list = $good->getDetail($cid);
        //dump($list);exit;

        //获取商品图片
        $p = model('goodsPhoto');
        $photos = $p->getPhotos($cid);
        //把二维数组转为一维数组
        $photo = [[
          'p0'=>$photos[0]['gp_photo'],
          'p1'=>$photos[1]['gp_photo'],
          'p2'=>$photos[2]['gp_photo'],
          'p3'=>$photos[3]['gp_photo'],
        ]];

        //dump($photo);exit;

        return view('index/goodsDetail', [
            'list'=>$list,
            'photo'=>$photo,
        ]);
    }
}
