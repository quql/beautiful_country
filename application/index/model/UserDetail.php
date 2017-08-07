<?php

namespace app\index\model;

use think\Db;
use think\Model;

class UserDetail extends Model
{
    //获取个人基本信息
    public function getPoint($id = '')
    {
        $d = model('user_detail');
        $point = $d->field('ud_point')->find($id);
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
