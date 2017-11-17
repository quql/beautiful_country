<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class cate extends Model
{
    public function getCate($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_cate')
            ->where("id",$id)
            ->select();

        return $res;
    }

}
