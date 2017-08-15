<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Order extends Controller
{
    //确认订单
    public function confirm()
    {
        $uid = input('session.u_id');
        $i = input('post.');
        //dump($i);

        //地址
        $aid = $i['aid'];
        $a = model('userAddress');
        $address = $a->oneAddress($aid);

        static $arr = array();
        foreach($i as $k =>$v){
            if($v === 'on'){
                //dump($v);
                $arr[] = $k;
            }
        }
        //dump($arr);
        $c = model('cart');
        $res = $c->getMsg($arr);
        //dump($res);

        //总价
        $s = 0;
        foreach($res as $k => $v){
            $s += $v['ca_price']*$v['ca_num'];
        }

        return view('index/confirm',[
            'data'=>$res,
            'address'=>$address[0],
            's'=>$s,
        ]);
    }

    public function index()
    {
        $i = input('post.');
        //dump($i);

        $uid = input('session.u_id');
        //生成订单时间
        $time = date('Y-m-d H:i:s',time());
        //生成订单号
        $orderNum = time().rand(10e8,90e8);

        //生成主订单表数据
        $data = [
          'uid'=>$uid,
            'aid'=>$i['aid'],
            'total'=>$i['total'],
            'time'=>$time,
        ];

        //添加进主表
        $o = model('morder');
        $order = $o->insert($data);
        //主订单编号
        $mid = Db::name('morder')->getLastInsID();

        //添加进详情表
        static $arr = array();
        foreach($i as $k =>$v){
            if($v === ''){
                $arr[] = $k;
            }
        }
        //查询购物车信息
        $c = model('cart');
        $res = $c->getMsg($arr);
        //dump($res);

        $a = array();
        foreach($res as $k=>$v){
           $a[$k]['o_gid']=$v['ca_gdid'];
           $a[$k]['o_uid']=$v['ca_uid'];
           $a[$k]['o_time']=$time;
           $a[$k]['o_status']=0;
           $a[$k]['o_num']=$v['ca_num'];
           $a[$k]['o_price']=$v['ca_price'];
           $a[$k]['o_order_num']=$orderNum;
           $a[$k]['o_total']=$v['ca_num']*$v['ca_price'];
           $a[$k]['o_gname']=$v['ca_gname'];
           $a[$k]['o_photo']=$v['ca_photo'];
           $a[$k]['moid']=$mid;
           $a[$k]['o_cid']=$v['cid'];
           $a[$k]['o_bid']=$v['bid'];
           $c->delete($v['ca_id']);
        }
        //dump($a);

        $o=  model('order');
        $order = $o->saveAll($a);

        //$clean = $c->delete($info['cid']);
        //exit;
        if($order){
            $this->success('支付成功~','index/index/index');
        }else{
            $this->error('支付失败,请重试~');
        }
        //dump($res);

    }
    /**
     * 处理购物车传递的信息
     *
     * @return \think\Response
     */
    public function index100()
    {

        $info = input('post.');

        //获取用户id
        $uid = input('session.u_id');
        if(empty($uid)){
            $this->error('请先登录哦~~~~','index/index/index');
        }

        $d = model('userDetail');
        //获取原积分
        $od = $d->getDetail($uid)[0]['ud_point'];
        //获取本次积分
        $nd = $info['point'];
        //得到最新积分
        $p = $od + $nd;
        //本次订单所获得的积分
        $point = [
            'ud_point'=>$p,
        ];
        //执行增加积分
        $p = $d->updateDetail($uid, $point);

        //商品id
        $gid = $info['gid'];

        //判断商品类型
        $type = $info['type'];

        if($type == 'scenery'){
            $s = model('scenery');
            $p = model('sceneryPic');
        }elseif($type == 'food'){
            $s = model('food');
            $p = model('foodPic');
        }elseif($type == 'route'){
            $s = model('route');
            $p = model('routePic');
        }

        //获取商家id
        $bid = $s->getDetail($gid)[0]['bus_id'];
        //dump($s->getDetail($gid));exit;
        //获取商品名称
        $gname = $s->getDetail($gid)['0']['gd_title'];
        //获取商品图片
        $photo = $p->getPhotos($gid, 1)[0]['pic'];
        //dump($photo);

        //生成订单时间
        $time = date('Y-m-d H:i:s',time());
        //生成订单号
        $orderNum = time().rand(10e8,90e8);
        //dump($orderNum);

        //准成order表字段
        $data = [
            'o_bid'=>$bid,
            'o_gid'=>$gid,
            'o_uid'=>$info['uid'],
            'o_aid'=>$info['aid'],
            'o_time'=>$time,
            'o_status'=>'0',
            'o_num'=>$info['num'],
            'o_price'=>$info['price'],
            'o_total'=>$info['total'],
            'o_order_num'=>$orderNum,
            'o_gname'=>$gname,
            'o_photo'=>$photo,
        ];

        $o = model('order');
        $order = $o->insert($data);
        //dump($order);

        $c = model('cart');
        $cart = $c->delete($info['cid']);

        $this->success('支付成功','index/index/index');


        //return view('')
    }


    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $good = db('order')->delete($id);

        if ($good){
            $info['status'] = true;
        }else{
            $info['status'] = false;
        }
        return json($info);
        //return json($good);
    }
}