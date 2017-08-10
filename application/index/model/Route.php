<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class Route extends Model
{
    //获取商品的详细信息
    public function getDetail($cid = '')
    {
        $query = new Query();
        $res = $query->table('ml_route')
            ->where("id",$cid)
            ->select();

        return $res;
    }
}