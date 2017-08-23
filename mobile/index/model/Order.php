<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class Order extends Model
{
    //添加订单
    public function insert($data = '')
    {
        $add = db('order');
        $res = $add->insert($data);
        return $res;
    }

    //获取未发货订单
    public function unOrder($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_uid'=>$id,'o_status'=>1])
            ->select();
        return $res;
    }

    //获取已发货订单
    public function diliver($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_uid'=>$id,'o_status'=>2])
            ->select();
        return $res;
    }

    //获取已完成订单
    public function done($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_uid'=>$id,'o_status'=>3])
            ->select();
        return $res;
    }
}
