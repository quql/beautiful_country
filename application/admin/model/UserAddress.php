<?php

namespace app\admin\model;

use think\db\Query;
use think\Model;

class UserAddress extends Model
{
    //查询收货地址
    public function getAddress($id = '')
    {
        $query = new Query();
        $res = $query->name('user_address')->where('ua_id', $id)->select();
        return $res;
    }
}
