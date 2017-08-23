<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class SceneryPic extends Model
{
    //获取商品的图片
    public function getPhotos($cid = '', $num = '')
    {
        $query = new Query();
        $res = $query->table('ml_scenery_pic')
            ->where(['gid'=>$cid])
            ->limit($num)
            ->select();
        return $res;
    }
}
