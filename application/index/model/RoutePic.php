<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class RoutePic extends Model
{
    //获取商品的图片
    public function getPhotos($cid = '')
    {
        $query = new Query();
        $res = $query->table('ml_route_pic')
            ->where("gid=$cid")
            ->select();
        return $res;
    }
}
