<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class BusIndex extends Bus
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
       $bid = input('session.b_id');;
        $o = model('order');
        //加载未发货订单
        $un = $o->unOrder($bid);
        $unum=count($un);
        //已发货
        $on = $o->diliver($bid);
        $onum=count($on);
        //已完成
        $dn = $o->done($bid);
        $dnum=count($dn);

        //酒店
        $hotel = model('hotelOrder');
        //加载未发货订单
        $data = $hotel->getOrder($bid);
        $hnum=count($data);

        return view('index/busIndex',[
            'unum'=>$unum,
            'onum'=>$onum,
            'dnum'=>$dnum,
            'hnum'=>$hnum

            ]);
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
