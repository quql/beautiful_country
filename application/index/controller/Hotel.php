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
            'hotels'=>$hotels[0],
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
        //dump($request);
        //dump(input('post.'));
        return view('index/hotelBook');
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
