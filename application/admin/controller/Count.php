<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Count extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function chartjs()
    {
        $c = model('count');
        $view = $c->view()['view'];
        $todayView = $c->todayView()['today_view'];
        $tv = round($todayView/$view*100,2);
        //dump();die;
        return view('count/chartjs', [
            'tv'=>$tv,
            'todayView'=>$todayView,
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
