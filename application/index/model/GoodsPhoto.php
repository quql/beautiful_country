<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class GoodsPhoto extends Model
{
    //获取商品的图片
    public function getPhotos($cid = '')
    {
        $query = new Query();
        $res = $query->table('ml_goods_photo')
            ->where("gp_gid=$cid")
            ->select();
        return $res;
    }
}
