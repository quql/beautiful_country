<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Route extends Base
{
    /**
     * 显示路线详情
     *
     * @return \think\Response
     */
    public function index()
    {
        //登录用户的id
        $uid = 1;

        //浏览店铺商家的id
        $bid = 1;

        //商品的id
        $cid = 8;

        //获取用户会员类型
        $u = model('userDetail');
        $type = $u->getDetail($uid)[0];
        //dump($type);exit;

        //获取路线的基本信息
        $r = model('Route');
        $route = $r->getDetail($cid);

        //获取路线的详细信息
        $d = model('RouteDetail');
        $detail = $d->getDetail($cid);

        //获取路线的图片
        $p = model('RoutePic');
        $photos = $p->getPhotos($cid);

        //dump($route[0]);
        //dump($detail[0]);
        //dump($photos);

        return view('index/routeDetail', [
            'route'=>$route[0],
            'detail'=>$detail[0],
            'photos'=>$photos,
            'type'=>$type,
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
