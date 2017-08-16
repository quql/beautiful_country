<?php

namespace app\admin\model;

use think\db\Query;
use think\Model;

class Count extends Model
{
    //查询网站总访问量
    public function view()
    {
        $q = new Query();
        $res = $q->name('count')->field('view')->find();
        return $res;
    }

    //查询网站今日访问量
    public function todayView()
    {
        $q = new Query();
        $res = $q->name('count')->field('today_view')->find();
        return $res;
    }
}
