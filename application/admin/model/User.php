<?php

namespace app\admin\model;

use think\Db;
use think\db\Query;
use think\Model;

class User extends Model
{
    public function getUser($id = '')
    {
        $query = new Query();
        $lsit = $query->table('ml_user')
            ->where('u_id',$id)
            ->select();

        return $lsit;
    }

    public function getMsg($id = '')
    {
        //dump($id);exit;
        $list = Db::query("select ml_user.u_id,u_username,ml_user_address.ua_name,ua_phone,ua_address,ua_street from ml_user LEFT JOIN ml_user_address ON ml_user.u_id=ml_user_address.ua_uid where ml_user_address.ua_uid=$id");
        return $list;
    }
}
