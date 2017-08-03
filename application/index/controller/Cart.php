<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Cart extends Controller
{
    /**
     * 显示购物车页面
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取从商品详情页传送的数据
        $info = input('post.');
        //dump($info);exit;
        //商品id
        $id = $info['id'];
        exit;
        $good = model('goodsDetail');
        $res = $good->insert($info);
        exit;

        $cart =model('cart');
        $list = $cart->getDetail($id);

        return view('index/shop-cart', [
            'info'=>$info,
            'list'=>$list,
        ]);
        //return view('index/shop-cart');
    }


}
