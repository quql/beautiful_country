<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Cart extends Base
{

    public function index()
    {
        //用户id
        $uid = input('session.u_id');

        //加载用户收获的地址
        $add = model('userAddress');
        $address = $add->getAddress($uid);

        //详情表传递数据
        $i = input('post.');
        //dump($i);

        //每个商品可以得到的积分
        //$point = $i['point'];

        $data = [
          'ca_uid'=>$uid,
            'ca_gdid'=>$i['id'],
            'ca_num'=>$i['num'],
            'ca_price'=>$i['price'],
            'ca_photo'=>$i['photo'],
            'ca_gname'=>$i['gname'],
            'ca_gtype'=>$i['type'],
            'ca_point'=>$i['point'],
            'cid'=>6,
        ];

        $c = model('cart');
        $res = $c->insert($data);

        $list = $c->getCart($uid);
        //dump($list);

        return view('index/shopCart',[
           'list'=>$list,
            'address'=>$address,
        ]);
    }

    public function show()
    {
        //用户id
        $uid = input('session.u_id');

        //加载用户收获的地址
        $add = model('userAddress');
        $address = $add->getAddress($uid);

        $c = model('cart');

        $list = $c->getCart($uid);
        //dump($list);

        return view('index/shopCart',[
            'list'=>$list,
            'address'=>$address,
        ]);
    }

    /**
     * 显示购物车页面
     *
     * @return \think\Response
     */
    public function index1()
    {
        //用户id
        $uid = input('session.u_id');

        //加载用户收获的地址
        $add = model('userAddress');
        $address = $add->getAddress($uid);

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

        //购物车id
        $cid = db('cart')->getLastInsID();
        //dump($cid);

        //dump($photo);
        //dump($res);
        //dump($data2);
        //dump($cid);
        //dump($cate);exit;

        $result = [[
            'photo'=>$photo[0]['p0'],
            'title'=>$res[0]['gd_title'],
            'ca_price'=>$data2[0]['ca_price'],
            'type'=>$cate,
            'ca_num'=>$info['num'],
        ]];

        //dump($result);

        //if ($list){
        //    return view('index/shop-cart', [
        //        'photo'=>$photo,
        //        'res'=>$res,
        //        'data'=>$data2,
        //        'cid'=>$cid,
        //        'cate'=>$cate,
        //        'point'=>$point,
        //        'address'=>$address,
        //        'type'=>$type,
        //    ]);
        //} else {
        //    return $this->error('添加购物车失败,请重试~');
        //    //echo User::getLastSql();
        //}

        if ($list){
            return view('index/shop-cart', [
                'result'=>$result,
                'gid'=>$id,
                'point'=>$point,
                'uid'=>$uid,
                'cid'=>$cid,
                'address'=>$address,
            ]);
        } else {
            return $this->error('添加购物车失败,请重试~');
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
