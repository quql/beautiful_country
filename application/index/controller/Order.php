<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Order extends Controller
{
    /**
     * 处理购物车传递的信息
     *
     * @return \think\Response
     */
    public function index()
    {

        $info = input('post.');
        //dump($info);exit;

        //获取用户id
        $uid = $info['uid'];

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
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
