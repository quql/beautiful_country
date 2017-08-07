<?php

namespace app\admin\controller;

use app\admin\controller\Admin;
use think\Db;

class Comment extends Admin
{
    /**
     * 显示评论列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //加载评论页面视图
        $list=Db::name('comment')->select();
        //dump($list);
        return view('comment/list',['list'=>$list]);
    }


    /**
     * 禁用恶意评论及广告
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = ['is_ban'=>'1'];
        $result = Db::table('ml_comment')->where('c_id',$id)->update($data);
//        var_dump($result);
        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '已成功禁用此评论';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '禁用失败,请刷新重试!';
        }
        return json($info);
    }

}
