<?php

namespace app\index\model;

use think\Db;
use think\db\Query;
use think\Model;

class SceneryDetail extends Model
{
    //获取商品的详细信息
    public function getDetail($cid = '')
    {
        $query = new Query();
        $res = $query->table('ml_scenery_detail')
            ->where("c_gid",$cid)
            ->select();
        return $res;
    }
}
