<?php

namespace app\index\model;

use think\Db;
use think\db\Query;
use think\Model;

class User extends Model
{

    //获取user用户基本信息表数据
    public function getUser($id = '')
    {
        $query = new Query();
        $lsit = $query->table('ml_user user,ml_user_detail detail')
            ->where("user.u_id=detail.ud_uid and user.u_id=$id")
            ->field('user.u_id as id,user.u_username as username,user.u_phone as phone,detail.ud_photo as photo,detail.ud_sex as sex,detail.ud_type as type,detail.ud_point as point,detail.ud_picture as picture,detail.ud_email as email,detail.ud_text as text,detail.qqphoto')
            ->find();

        return $lsit;

    }

    public function updateUser($id = '',$data = '')
    {
        $user = model('user');
        $res = $user->allowField(true)->update($data,['u_id'=>$id]);
        return $res;
    }

    public function getPass($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_user')->where('u_id', $id)->field('u_password')->find();
        return $res;
    }

    public function updatePass($id = '', $data = '')
    {
        $user = model('user');
        $res = $user->allowField(true)->update($data,['u_id'=>$id]);

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
