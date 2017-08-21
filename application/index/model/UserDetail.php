<?php

namespace app\index\model;

use think\Db;
use think\db\Query;
use think\Model;

class UserDetail extends Model
{
    //获取个人详细信息
    public function getDetail($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_user_detail')
            ->where("ud_uid",$id)
            ->select();
        return $res;
    }

    //获取个人积分
    public function getPoint($id = '')
    {
        $query = new Query();
        $point = $query->name('user_detail')->where('ud_uid',$id)->field('ud_point')->find();
        return $point;
    }

    //修改个人基本信息
    public function updateDetail($id = '', $data = '')
    {
        $detail = model('user_detail');
        $res = $detail->allowField(true)->update($data,['ud_uid'=>$id]);
        return $res;
    }

    //修改个人头像
    public function upPhoto($id = '', $data = '')
    {
        $img = model('user_detail');
        $res = $img->allowField(true)->update($data,['ud_uid'=>$id]);
        return $res;
    }




}
