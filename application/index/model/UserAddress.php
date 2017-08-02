<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class UserAddress extends Model
{
    //查询收货地址
    public function getAddress($id = '')
    {
        $query = new Query();
        $res = $query->name('user_address')->where('ua_uid', $id)->select();
        return $res;
    }
    //添加收货地址
    public function add($data = '')
    {
        $add = db('user_address');
        $res = $add->insert($data);
        return $res;
    }
    
    //修改收货地址
    public function editAddress()
    {
        
    }
    
    //删除收货地址
    public function del($id = '')
    {
        //dump($id);
        $del = db('user_address');
        $res = $del->delete('ua_id',$id);
        return $res;
    }
}
