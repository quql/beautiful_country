<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class Morder extends Model
{
    //添加订单
    public function insert($data = '')
    {
        $add = db('morder');
        $res = $add->insert($data);
        return $res;
    }

    //获取未发货订单
    public function unOrder($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_uid'=>$id,'o_status'=>0])
            ->paginate(3);
        return $res;
    }

    //获取已发货订单
    public function diliver($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_uid'=>$id,'o_status'=>1])
            ->paginate(3);
        return $res;
    }

    //获取已完成订单
    public function done($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_order')
            ->where(['o_uid'=>$id,'o_status'=>2])
            ->paginate(3);
        return $res;
    }
}
