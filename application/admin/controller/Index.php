<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Admin
{
    public function index(Request $request)
    {
        $c = model('count');
        //访问人数
        $view = $c->view()['view'];
        //$todayView = $c->todayView()['today_view'];
        //$tv = round($todayView/$view*100,2);

        //统计用户分布
        $sex = db('user_detail')->field('ud_sex')->count();
        //男
        $nmale = db('user_detail')->where('ud_sex',1)->count();
        $male = db('user_detail')->where('ud_sex',1)->count()/$sex*100;
        //女
        $nfemale = db('user_detail')->where('ud_sex',0)->count();
        $female = db('user_detail')->where('ud_sex',0)->count()/$sex*100;
        //保密
        $nsecrecy = db('user_detail')->where('ud_sex',2)->count();
        $secrecy = db('user_detail')->where('ud_sex',2)->count()/$sex*100;

        //注册人数
        $register = $c->register()['register'];

        //商家数量
        $bus = $c->bus();

        //交易量
        $trade = $c->trade()['trade'];

        //交易金额
        $total = $c->total()['total'];

        //活动次数
        $active = $c->active()['active'];

        //酒店次数
        $hotel = $c->hotel()['hotel'];

        //路线次数
        $route = $c->route()['route'];

        //特产次数
        $food = $c->food()['food'];

        //景区次数
        $scenery = $c->scenery()['scenery'];


        //统计时间单位交易量
        //今日
        $ttrade = $c->ttrade()[0]['count(time)'];
        //昨日
        $ytrade = $c->ytrade()[0]['count(time)'];
        //一周
        $wtrade = $c->wtrade()[0]['count(time)'];
        //一周
        $mtrade = $c->mtrade()[0]['count(time)'];

        $this->assign([
            'ttrade'=>$ttrade,
            'ytrade'=>$ytrade,
            'wtrade'=>$wtrade,
            'mtrade'=>$mtrade,
        ]);

        //统计交易金额
        //今日
        $ttotal = $c->ttotal();
        $n = 0;
        foreach($ttotal as $v){
            $n += (int)$v['total'];
        }
        //昨日
        $ytotal = $c->ytotal();
        $n1 = 0;
        foreach($ytotal as $v){
            $n1 += (int)$v['total'];
        }
        //一周
        $wtotal = $c->wtotal();
        $n2 = 0;
        foreach($wtotal as $v){
            $n2 += (int)$v['total'];
        }
        //本月
        $mtotal = $c->mtotal();
        $n3 = 0;
        foreach($mtotal as $v){
            $n3 += (int)$v['total'];
        }

        $this->assign([
            'ttotal'=>$n,
            'ytotal'=>$n1,
            'wtotal'=>$n2,
            'mtotal'=>$n3,
        ]);


        //统计访问量
        //今日
        $tview = $c->tview()[0]['count(time)'];
        //昨日
        $yview = $c->yview()[0]['count(time)'];
        //一周
        $wview = $c->wview()[0]['count(time)'];
        //一周
        $mview = $c->mview()[0]['count(time)'];

        $this->assign([
            'tview'=>$tview,
            'yview'=>$yview,
            'wview'=>$wview,
            'mview'=>$mview,
        ]);

        //统计注册量
        //今日
        $tregister = $c->tregister()[0]['count(time)'];
        //昨日
        $yregister = $c->yregister()[0]['count(time)'];
        //一周
        $wregister = $c->wregister()[0]['count(time)'];
        //一周
        $mregister = $c->mregister()[0]['count(time)'];

        $this->assign([
            'tregister'=>$tregister,
            'yregister'=>$yregister,
            'wregister'=>$wregister,
            'mregister'=>$mregister,
        ]);

        return view('index/index', [
            //'tv'=>$tv,
            //'todayView'=>$todayView,
            'view'=>$view,
            'register'=>$register,
            'bus'=>$bus,
            'male'=>$male,
            'nmale'=>$nmale,
            'female'=>$female,
            'nfemale'=>$nfemale,
            'secrecy'=>$secrecy,
            'nsecrecy'=>$nsecrecy,
            'trade'=>$trade,
            'total'=>$total,
            'active'=>$active,
            'hotel'=>$hotel,
            'route'=>$route,
            'food'=>$food,
            'scenery'=>$scenery,

        ]);
    }

    public function loginexit(Request $request)
    {
        session('admin_id',null);
        $this->redirect('admin/login/index','已退出登录');
    }

}