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
        $list=Db::name('comment')->paginate(5);
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

    /**
     * 显示单条数据.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function find($id)
    {
        //获取商品评论的内容及用户信息
        $sql="select ml_comment.c_score,c_text,c_time,c_gname,ml_user_detail.ud_photo,ml_user.u_username,ml_bus_comment.c_content,c_atime FROM ml_comment LEFT JOIN ml_user_detail ON ml_user_detail.ud_uid=ml_comment.c_uid LEFT JOIN ml_bus_comment ON ml_bus_comment.com_id=ml_comment.c_id LEFT JOIN ml_user ON ml_user.u_id=ml_comment.c_uid WHERE ml_comment.c_id=$id AND ml_comment.is_ban='0' ";

        $result=Db::query($sql);

//        $result = Db::table('ml_comment')->where('c_id',$id)->find();
        //var_dump($result);
        $result=$result[0];
        if ($result) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
        }

        return json($result);

    }
}
