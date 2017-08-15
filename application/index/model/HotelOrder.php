<?php

namespace app\index\model;

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
            ->where(['o_uid' => $id])
            ->select();
        return $res;
    }


}
