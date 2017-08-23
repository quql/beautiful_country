<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class business extends Model
{
    public function getArea($id = '')
    {
        $q = new Query();
        $res = $q->name('business')->where('b_id', $id)->field('b_area')->find();
        return $res;
    }
}
