<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Cart extends Base
{
    /**
     * 显示购物车页面
     *
     * @return \think\Response
     */
    public function index()
    {
        //用户id
        $uid = 1;

        //获取从商品详情页传送的数据
        $info = input('post.');
        //dump($info);exit;

        //商品id
        $id = $info['id'];
        //获取商品详细信息
        $good = model('goodsDetail');
        $res = $good->getDetail($id);
        //dump($res);
        //获取商品图片
        $p = model('goodsPhoto');
        $photos = $p->getPhotos($id);
        $photo = [[
            'p0'=>$photos[0]['gp_photo'],
        ]];
        //dump($photo);

        $data = [
            'ca_uid'=>$uid,
            'ca_gdid'=>$id,
            'ca_num'=>$info['num'],
            'ca_price'=>$info['price'],
        ];
        $data2 = [$data];
        //dump($data2);

        //添加信息到购物车表
        $cart =model('cart');
        $list = $cart->insert($data);

        $cid = db('cart')->getLastInsID();
        //dump($cid);

        if ($list){
            return view('index/shop-cart', [
                'photo'=>$photo,
                'res'=>$res,
                'data'=>$data2,
                'cid'=>$cid,
            ]);
        } else {
            return $this->error('添加购物车失败,请重试~');
            //echo User::getLastSql();
        }
    }

    //删除商品
    public function delete()
    {
        $id = input('get.')['id'];
        //dump($id);
        //$g = model('cart');
        //$good = $g->delete($id);

        $good = db('cart')->delete($id);

        if ($good){
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '商品ID为:'.$id.'的商品删除成功';
        }else{
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '商品ID为:'.$id.'的商品删除失败,请重试~';
        }
        return json($info);
        //return json($good);
    }

}
