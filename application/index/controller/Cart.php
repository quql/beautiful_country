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

        //每个商品可以得到的积分
        $point = $info['point'];
        //dump($point);exit;

        //判断商品类型
        $type = $info['type'];
        //景区类型
        if($type == 'scenery'){
           $dm = 'scenery';
           $pm = 'sceneryPic';
        }elseif($type == 'hotel'){
            $dm = 'hotel';
            $pm = 'hotelPic';
        }elseif($type == 'route'){
            $dm = 'route';
            $pm = 'routePic';
        }elseif($type == 'food'){
            $dm = 'food';
            $pm = 'foodPic';
        }

        //获取商品详细信息
        $d = model($dm);
        $res = $d->getDetail($id);
        //dump($id);exit;

        //查询商品类型
        $cid = $res[0]['c_id'];
        $c = model('cate');
        $cate = $c->getCate($cid);
        $cate = $cate[0]['c_name'];
        //dump($cate);

        //获取商品图片
        $p = model($pm);
        $photos = $p->getPhotos($id);
        $photo = [[
            'p0'=>$photos[0]['pic'],
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
        $cart = model('cart');
        $list = $cart->insert($data);

        $cid = db('cart')->getLastInsID();
        //dump($cid);

        //dump($photo);
        //dump($res);
        //dump($data2);
        //dump($cid);
        //dump($cate);
        dump($point);

        if ($list){
            return view('index/shop-cart', [
                'photo'=>$photo,
                'res'=>$res,
                'data'=>$data2,
                'cid'=>$cid,
                'cate'=>$cate,
                'point'=>$point,
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
