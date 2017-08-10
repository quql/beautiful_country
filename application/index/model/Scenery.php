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
}