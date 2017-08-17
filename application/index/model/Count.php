<?php

namespace app\index\model;

use think\Db;
use think\db\Query;
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

    //增加历史注册人数
    public function register()
    {
        Db::table('ml_count')->where('id',1)->setInc('register');
    }

    //增加历史交易量
    public function trade()
    {
        Db::table('ml_count')->where('id',1)->setInc('trade');
    }

    //查询历史交易金额
    public function getTotal()
    {
        $q = new Query();
        $res = $q->name('count')->field('total')->find();
        return $res;
    }

    //增加历史交易金额
    public function total($data = '')
    {
        Db::table('ml_count')->where('id',1)->update($data);
    }

    //增加活动交易量
    public function active()
    {
        Db::table('ml_count')->where('id',1)->setInc('active');
    }

    //增加酒店交易量
    public function hotel()
    {
        Db::table('ml_count')->where('id',1)->setInc('hotel');
    }

    //增加景区交易量
    public function scenery()
    {
        Db::table('ml_count')->where('id',1)->setInc('scenery');
    }

    //增加特产交易量
    public function food()
    {
        Db::table('ml_count')->where('id',1)->setInc('food');
    }

    //增加路线交易量
    public function route()
    {
        Db::table('ml_count')->where('id',1)->setInc('route');
    }
}
