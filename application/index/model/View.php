<?php

namespace app\index\model;

use think\Db;
use think\Model;

class View extends Model
{
    //添加数据到trade表
    public function insert()
    {
        $t = [
            'time'=>date('Y-m-d H:i:s',time())
        ];
        Db::table('ml_view')->insert($t);
    }

}
