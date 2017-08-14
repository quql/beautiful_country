<?php

namespace app\index\model;

use think\Db;
use think\db\Query;
use think\Model;

class User extends Model
{
    //登录判断用户是否存在
    public function getUser($data = '')
    {
        $query = new Query();
        $res = $query->name('user')
                    ->where(['u_username'=>$data['username'], 'u_password'=>$data['pass']])
                    ->select();
        return $res;
    }

    //注册判断用户名是否存在
    public function checkUser($data = '')
    {
        $query = new Query();
        $res = $query->name('user')
            ->where(['u_username'=>$data['u_username']])
            ->select();
        return $res;
    }

    //注册判断手机号是否存在
    public function checkPhone($data = '')
    {
        $query = new Query();
        $res = $query->name('user')
            ->where(['u_phone'=>$data['u_phone']])
            ->select();
        return $res;
    }

    //新增用户
    public function insert($data = '')
    {
        $db = db('user');
        $res = $db->insert($data);
        return $res;
    }

}
