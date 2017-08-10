<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Hotel extends Base
{
    /**
     * 显示酒店详情页
     *
     * @return \think\Response
     */
    public function index()
    {
        //登录用户的id
        $uid = 1;

        //浏览店铺商家的id
        $bid = 15;

        //商品的id
        $cid = 4;

        //获取用户会员类型
        $u = model('userDetail');
        $type = $u->getDetail($uid)[0];
        //dump($type);exit;

        //获取商品基本信息
        $h = model('hotel');
        $hotels = $h->getDetail($cid);

        //获取商品详细信息
        $d = model('hotelDetail');
        $detail = $d->getDetail($cid);

        //获取商品图片
        $p = model('hotelPic');
        $photos = $p->getPhotos($cid);

        //dump($hotels[0]);
        //dump($detail[0]);
        //dump($photos);


        return view('index/hotelDetail', [
            'hotels' => $hotels[0],
            'detail' => $detail[0],
            'photos' => $photos,
            'type' => $type,
            //'cid'=>$cid
        ]);
    }

    public function save()
    {
        $info = input('post.');
        dump($info);
        $uid = input('session.u_id');
        $u = model('userDetail');
        $res = $u->getDetail($uid);
        $utype = $res[0]['ud_type'];
        //dump($res);


        return view('index/hotelBook', [
            'data' => $info,
            'utype'=>$utype,
        ]);
    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update()
    {
        $i = input('post.');
        //dump($i);exit;

        //订单生成时间
        $time = date('Y-m-d H:i:s',time());

        //生成订单号
        $orderNum = time().rand(10e8,90e8);

        $data = [
            'o_bid'=>$i['bid'],
            'o_gid'=>$i['cid'],
            'o_uid'=>input('session.u_id'),
            'o_time'=>$time,
            'o_status'=>0,
            'o_num'=>$i['num'],
            'o_order_num'=>$orderNum,
            'o_price'=>$i['dan'],
            'o_total'=>$i['total'],
            'o_gname'=>$i['roomtype'],
            'o_photo'=>$i['photo'],
            'intime'=>$i['time'],
            'inname'=>$i['name'],
            'inphone'=>$i['phone'],
        ];
        $o = model('order');
        $res = $o->insert($data);
        if($res){
            $this->success('支付成功','index/index/index');
        }else{
            $this->error('支付失败,请重试');
        }
    }


}