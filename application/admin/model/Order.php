<?php

namespace app\admin\model;

use think\Db;
use think\db\Query;
use think\Model;

class Order extends Model
{
    //获取未发货订单
    public function unOrder($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_bid' => $id, 'o_status' => 0])
            ->select();
        return $res;
    }

    //获取已发货订单
    public function diliver($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_bid' => $id, 'o_status' => 1])
            ->select();
        return $res;
    }

    //获取已完成订单
    public function done($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_bid' => $id, 'o_status' => 2])
            ->select();
        return $res;
    }

    //获取被取消订单
    public function cancel($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_bid' => $id, 'o_status' => 3])
            ->select();
        return $res;
    }

    //把未发货转为已发货
    public function todiliver($id = '', $data = '')
    {
        $db = db('order');
        $res = $db->where('o_id',$id)
            ->update($data);
        return $res;
    }

    //把未发货转为已完成
    public function todone($id = '', $data = '')
    {
        $db = db('order');
        $res = $db->where('o_id',$id)
            ->update($data);
        return $res;
    }

    //把未发货转为取消
    public function tocancel($id = '', $data = '')
    {
        $db = db('order');
        $res = $db->where('o_id',$id)
            ->update($data);
        return $res;
    }
}
