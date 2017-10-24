<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Cart extends Base
{

    public function index()
    {
        $gid=input('gid');
        $cid=input('cid');

        //用户id
      $uid = input('session.uid');
        if(empty($uid)){
            $this->error('请先登录哦~~~~','index/index/index');
        }
//        根据gid和cid获取商品详情
        if($cid==5){
            $type='旅游路线';
            $list = Db::query("select ml_route_detail.*,ml_route_pic.pic ,ml_route.gd_title,bus_id from ml_route_detail LEFT JOIN ml_route_pic ON ml_route_detail.c_gid=ml_route_pic.gid LEFT JOIN ml_route ON ml_route_detail.c_gid=ml_route.id where ml_route_detail.c_gid='$gid' ");
        }elseif($cid==1){
            $type='景区门票';
            $list = Db::query("select ml_scenery_detail.*,ml_scenery_pic.pic,ml_scenery.gd_title,bus_id from ml_scenery_detail LEFT JOIN ml_scenery_pic ON ml_scenery_detail.c_gid=ml_scenery_pic.gid LEFT JOIN ml_scenery ON ml_scenery_detail.c_gid=ml_scenery.id where ml_scenery_detail.c_gid='$gid'");
        }elseif($cid==6){
            $type='特产美食';
            $list = Db::query("select ml_food_detail.*, ml_food_pic.pic,ml_food.gd_title,bus_id from ml_food_detail LEFT JOIN ml_food_pic ON ml_food_detail.c_gid=ml_food_pic.gid LEFT JOIN ml_food ON ml_food_detail.c_gid=ml_food.id where ml_food_detail.c_gid='$gid' ");
        }elseif($cid==4){
            $type='住宿';
            $list = Db::query("select ml_hotel_detail.*, ml_hotel_pic.pic,ml_hotel.gd_title,bus_id from ml_hotel_detail LEFT JOIN ml_hotel_pic ON ml_hotel_detail.c_gid=ml_hotel_pic.gid LEFT JOIN ml_hotel ON ml_hotel_detail.c_gid=ml_hotel.id where ml_hotel_detail.c_gid='$gid' ");
        }else{
            $this->error('暂无数据');
        }
        $list=$list[0];

        //判断如果购物车表中已存在此用户加入的同一种商品,即更新购物车商品的数量
        $cart=Db::name('cart')->where(['ca_uid'=>$uid,'cid'=>$cid,'ca_gdid'=>$gid])->find();

        //dump($cart);
        //dump($cart['ca_num']);
        if(!empty($cart)){
            $data = [
                'ca_num'=>$cart['ca_num']+1,
                'ca_point'=>round($list['gd_price']/20)*2
            ];
            $update=Db::name('cart')->where('ca_id',$cart['ca_id'])->update($data);
            //dump($update);
            if($update){
                $info['status']=true;
            }else{
                $info['status']=false;
            }
            //return json($info);
        }else{
            $data = [
                'ca_uid'=>$uid,
                'ca_gdid'=>$gid,
                'ca_num'=>1,
                'ca_price'=>$list['gd_price'],
                'ca_photo'=>$list['pic'],
                'ca_gname'=>$list['gd_title'],
                'ca_gtype'=>$type,
                'ca_point'=>round($list['gd_price']/20),
                'bid'=>$list['bus_id'],
                'cid'=>$cid
            ];
            $c = model('cart');
            $res = $c->insert($data);
            //dump($res);die;
            if($res){
                $info['status']=true;
            }else{
                $info['status']=false;
            }
        }
        return json($info);
    }

    public function showindex()
    {
        //从缓存中获取用户id
        $uid = input('session.uid');
        if(empty($uid)){
            $this->success('请先登录','/showLogin');
        }
        $c = model('cart');
        $list = $c->getCart($uid);
        //加载用户收获的地址
        $add = model('userAddress');
        $address = $add->getAddress($uid);

        return view('buy/shopCart',[
            'list'=>$list,
            'address'=>$address,
        ]);
    }

    public function show()
    {
        //用户id
        $uid = input('session.uid');
        if(empty($uid)){
            $this->error('请先登录哦~~~~','index/index/index');
        }
        //加载用户收获的地址
        $add = model('userAddress');
        $address = $add->getAddress($uid);

        $c = model('cart');

        $list = $c->getCart($uid);
//        dump($list);
//        die;
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
        $uid = input('session.uid');

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

    //删除购物车中商品
    public function delete($id)
    {
        $good = db('cart')->delete($id);
        if ($good){
            $info['status'] = true;
        }else{
            $info['status'] = false;
        }
        return json($info);
    }

}
