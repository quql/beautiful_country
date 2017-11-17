<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class Scenery extends Model
{
    //获取商品的详细信息
    public function getDetail($cid = '')
    {
        $query = new Query();
        $res = $query->table('ml_scenery')
            ->where("id",$cid)
            ->select();

        return $res;
    }

    //获取店铺的其他商品
    public function getAll($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_scenery')
            ->where("bus_id",$id)
            ->limit(4)
            ->select();
        //var_dump($res);
        return $res;
    }
}
