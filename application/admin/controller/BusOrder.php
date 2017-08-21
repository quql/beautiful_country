<?php

namespace app\admin\controller;


use think\Controller;
use think\Request;

class BusOrder extends Bus
{
    //显示订单用户详情
    public function showDetail()
    {
        $info = input();
        $aid = $info['aid'];
        //dump($aid);exit;
        $u = model('user');
        $data = $u->getMsg($aid);
        //dump($data);exit;
        return view('order/showDetail',[
            'data'=>$data[0],
        ]);
    }

    //显示酒店订单
    public function hotelOrder()
    {
        //获取当前登录商家id
        $bid = cache('b_id');

        //处理订单信息
        $o = model('hotelOrder');
        //加载未发货订单
        $data = $o->getOrder($bid);
        //dump($data);die;

        return view('order/hotelOrder', [
            'data'=>$data,
        ]);
    }

    //改变酒店订单状态
    public function changeStatus()
    {
        $info = input();
        $id = $info['id'];

        $data = [
            'o_status'=>1,
        ];

        $o = model('hotelOrder');
        $status = $o->change($id, $data);

        if($status){
            $this->success('订单状态修改成功');
        }else{
            $this->success('订单状态修改失败');
        }


    }

    //显示未发货详情订单
    public function unDiliver()
    {
        //获取当前登录商家id
        $bid = cache('b_id');

        //处理订单信息
        $o = model('order');
        //加载未发货订单
        $un = $o->unOrder($bid);

        //dump($un);exit;
        return view('order/unDiliver',[
            'un'=>$un,
            //'data'=>$data,

        ]);
    }

    //显示发货中订单
    public function diliver()
    {
        //获取当前登录商家id
        $bid = cache('b_id');

        //处理订单信息
        $o = model('order');
        //加载未发货订单
        $un = $o->diliver($bid);

        return view('order/diliver',[
            'un'=>$un,
        ]);
    }

    //显示已完成订单
    public function done()
    {
        //获取当前登录商家id
        $bid = cache('b_id');

        //处理订单信息
        $o = model('order');
        //加载未发货订单
        $un = $o->done($bid);

        return view('order/done',[
            'un'=>$un,
        ]);
    }

    //显示被退货/取消订单
    public function cancel()
    {
        //获取当前登录商家id
        $bid = cache('b_id');

        //处理订单信息
        $o = model('order');
        //加载未发货订单
        $un = $o->cancel($bid);

        return view('order/cancel',[
            'un'=>$un,
        ]);
    }

    //修改未发货订单为已发货
    public function todiliver(){
        $oid = input('post.')['oid'];
        //dump($oid);die;

        $data = [
            'o_status'=>1,
        ];

        $o = model('order');
        $res = $o->todiliver($oid, $data);

        if ($res){
            $info['status'] = true;
        } else{
            $info['status'] = false;
        }

        return json($info);
    }

    //修改未发货订单为已完成
    public function todone(){
        $oid = input('post.')['oid'];

        $data = [
            'o_status'=>2,
        ];

        $o = model('order');
        $res = $o->todone($oid, $data);

        if ($res){
            $info['status'] = true;
        } else{
            $info['status'] = false;
        }

        return json($info);
    }

    //修改未发货订单为取消
    public function tocancel(){
        $oid = input('post.')['oid'];

        $data = [
            'o_status'=>3,
        ];

        $o = model('order');
        $res = $o->tocancel($oid, $data);

        if ($res){
            $info['status'] = true;
        } else{
            $info['status'] = false;
        }

        return json($info);
    }

}
