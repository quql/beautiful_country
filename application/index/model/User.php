<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    protected $model = new Model('user');

    //获取user用户基本信息表数据
    //public function getUser($id = '')
    //{
    //    $a = db('user')->find($id);
    //    //$uid =
    //    $b = db('user_detail')->select(['ud_uid'=>$id]);
    //
    //    $list = array_merge($a, $b);
    //    return $list;


    //}

    public function user_detail()
    {
        return $this->hasOne('User_detail', 'ud_uid');
    }

}
