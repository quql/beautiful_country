<?php

namespace app\admin\controller;


use think\Controller;
use think\Request;

class BusOrder extends Bus
{
    //显示未处理订单
    public function unOrder()
    {
        return view('order/unOrder');
    }

    //显示未发货订单
    public function unDiliver()
    {
        return view('order/unDiliver');
    }

    //显示发货中订单
    public function diliver()
    {
        return view('order/diliver');
    }

    //显示已完成订单
    public function done()
    {
        return view('order/done');
    }

    //显示被退货/取消订单
    public function cancel()
    {
        return view('order/cancel');
    }
}
