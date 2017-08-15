<?php

namespace app\admin\model;

use think\Db;
use think\db\Query;
use think\Model;

class HotelOrder extends Model
{
    //获取订单
    public function getOrder($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_hotel_order')
            ->where(['o_bid' => $id])
            ->select();
        return $res;
    }

    //改变订单状态
    public function change($id = '', $data = '')
    {
        $db = db('hotel_order');
        $res = $db->where('o_uid',$id)
            ->update($data);
        return $res;
    }
}
