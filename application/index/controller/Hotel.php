<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Hotel extends Base
{
    /**
     * 显示酒店详情页
     *
     * @return \think\Response
     */
    public function index()
    {
        $i = input('get.');
        dump($i);die;
        //登录用户的id
        $uid = input('session.u_id');

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
        $uid = input('session.u_id');
        if(empty($uid)){
            $this->success('请先登录','index/index/index');
        }

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

        //订单生成时间
        $time = date('Y-m-d H:i:s',time());

        //生成订单号
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;
        for($i=0;$i<32;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        $orderNum =$str;
        $i = input('post.');
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

        cache('hotel_order',$data,3600);
        $res = Db::name('hotel_order')->insert($data);
        if($res>0){
            $this->assign('data',$data);
            return view('index/hotelorder');
        }else{
            $this->error('下单失败');
        }
            
    


    }

    // public function ordertrue()
    // {
    //     $uid = input('session.u_id');
    //     $data = cache('hotel_order');
    //     //dump($data);die;
    //     //增加积分
    //     $u = model('userDetail');
    //     $op = $u->getPoint($uid)['ud_point'];
    //     //dump($op);die;
    //     $point = [
    //         'ud_point'=>round($data['o_total']/20 + $op),
    //     ];
    //     $p = $u->updateDetail($uid, $point);

    //     $res = Db::name('hotel_order')->data($data)->insert();
    //     if($res>0){
    //         //添加交易量到统计表
    //         model('count')->trade();
    //         //添加酒店量到统计表
    //         model('count')->hotel();
    //         //添加数据到trade统计表
    //         model('trade')->insert();

    //         $this->success('支付成功','index/personal/index');
    //     }else{
    //         $this->error('支付失败');
    //     }
    //}


}