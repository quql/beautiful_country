<?php

namespace app\index\model;

use think\Db;
use think\Model;

class Count extends Model
{
    //增加历史浏览人数
    public function view()
    {
        Db::table('ml_count')->where('id',1)->setInc('view');
    }

    //增加今日浏览人数
    public function todayView()
    {
        Db::table('ml_count')->where('id',1)->setInc('today_view');
    }
}
