<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use lib\page;
//use app\admin\controller\Page;

class Users extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //加载模板
        $sql='select * from ml_user LEFT JOIN ml_user_detail ON ml_user.u_id=ml_user_detail.ud_uid';
        $list=Db::query($sql);
       // dump($list);

        //分页
        //$data = count($list);
       $p = new Page($list,5);
        //exit();
       // dump($p);
       //die;
        return view('users/index',['p'=>$p]);
    }

    /**
     * 保存更新的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function update($id)
    {
        $data = ['is_comment'=>'1'];
        $result = Db::name('user')->where('u_id',$id)->update($data);
        //dump($result);
       //exit;
       if ($result) {
           $info['status'] = true;
           $info['id'] = $id;
           $info['info'] = '已限制此用户的评论功能';
       } else {
            $info['status'] = false;
            $info['id'] = $id;
           $info['info'] = '禁言失败,请刷新重试!';
       }
       return json($info);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result = Db::name('user')->delete($id);

        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '此用户已被删除';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '用户删除失败,请重试!';
        }
        return json($info);
    }
}
