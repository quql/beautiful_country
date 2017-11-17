<?php

namespace app\admin\model;

use think\Db;
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
    //public function todayView()
    //{
    //    $q = new Query();
    //    $res = $q->name('count')->field('today_view')->find();
    //    return $res;
    //}

    //查询历史注册量
    public function register()
    {
        $q = new Query();
        $res = $q->name('count')->field('register')->find();
        return $res;
    }

    //查询历史注册量
    public function trade()
    {
        $q = new Query();
        $res = $q->name('count')->field('trade')->find();
        return $res;
    }

    //查询商家注册量
    public function bus()
    {
        $q = new Query();
        $res = $q->name('business')->count('b_id');
        return $res;
    }

    //查询历史交易金额
    public function total()
    {
        $q = new Query();
        $res = $q->name('count')->field('total')->find();
        return $res;
    }

    //查询活动次数
    public function active()
    {
        $q = new Query();
        $res = $q->name('count')->field('active')->find();
        return $res;
    }

    //查询酒店交易次数
    public function hotel()
    {
        $q = new Query();
        $res = $q->name('count')->field('hotel')->find();
        return $res;
    }

    //查询路线交易次数
    public function route()
    {
        $q = new Query();
        $res = $q->name('count')->field('route')->find();
        return $res;
    }

    //查询特产交易次数
    public function food()
    {
        $q = new Query();
        $res = $q->name('count')->field('food')->find();
        return $res;
    }

    //查询景区交易次数
    public function scenery()
    {
        $q = new Query();
        $res = $q->name('count')->field('scenery')->find();
        return $res;
    }
    
    //统计时间交易量
    //今日
    public function ttrade()
    {
        $res = Db::query("select count(time) from ml_trade where to_days(time) = to_days(now())");
        return $res;
    }

    //昨日
    public function ytrade()
    {
        $res = Db::query("select count(time) from ml_trade where to_days(now()) - to_days(time) <= 1");

        return $res;
    }

    //一周
    public function wtrade()
    {
        $res = Db::query("select count(time) from ml_trade where date_sub(curdate(),interval 7 day) <=date(time)");

        return $res;
    }

    //本月
    public function mtrade()
    {
        $res = Db::query("select count(time) from ml_trade where date_format(time,'%Y%m') = date_format(curdate(),'%Y%m')");
        return $res;
    }

    //统计访问量
    //今日
    public function tview()
    {
        $res = Db::query("select count(time) from ml_view where to_days(time) = to_days(now())");
        return $res;
    }

    //昨日
    public function yview()
    {
        $res = Db::query("select count(time) from ml_view where to_days(now()) - to_days(time) <= 1");

        return $res;
    }

    //一周
    public function wview()
    {
        $res = Db::query("select count(time) from ml_view where date_sub(curdate(),interval 7 day) <=date(time)");

        return $res;
    }

    //本月
    public function mview()
    {
        $res = Db::query("select count(time) from ml_view where date_format(time,'%Y%m') = date_format(curdate(),'%Y%m')");
        return $res;
    }

    //统计注册量
    //今日
    public function tregister()
    {
        $res = Db::query("select count(time) from ml_register where to_days(time) = to_days(now())");
        return $res;
    }

    //昨日
    public function yregister()
    {
        $res = Db::query("select count(time) from ml_register where to_days(now()) - to_days(time) <= 1");

        return $res;
    }

    //一周
    public function wregister()
    {
        $res = Db::query("select count(time) from ml_register where date_sub(curdate(),interval 7 day) <=date(time)");

        return $res;
    }

    //本月
    public function mregister()
    {
        $res = Db::query("select count(time) from ml_register where date_format(time,'%Y%m') = date_format(curdate(),'%Y%m')");
        return $res;
    }

    //统计交易金额
    //今日
    public function ttotal()
    {
        $res = Db::query("select total from ml_morder where to_days(time) = to_days(now())");
        return $res;
    }

    //昨日
    public function ytotal()
    {
        $res = Db::query("select total from ml_morder where to_days(now()) - to_days(time) <= 1");
        return $res;
    }

    //一周
    public function wtotal()
    {
        $res = Db::query("select total from ml_morder where date_sub(curdate(),interval 7 day) <=date(time)");

        return $res;
    }

    //本月
    public function mtotal()
    {
        $res = Db::query("select total from ml_morder where date_format(time,'%Y%m') = date_format(curdate(),'%Y%m')");
        return $res;
    }





}
