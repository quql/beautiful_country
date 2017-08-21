<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Url;

class Register extends Controller
{
    public function doRegister()
    {
        $i = input('post.');
        //dump($i);die;

        $data1 = [
            'u_username'=>$i['username'],
        ];
        $data2 = [
            'u_phone'=>$i['phone'],
        ];

        $u = model('user');
        $old1 = $u->checkUser($data1);
        $old2 = $u->checkPhone($data2);
        if($old1){
            $this->error('用户名已被注册,换个名字吧~');
        }elseif($old2){
            $this->error('手机号已被注册,换个手机吧~');
        }


        //注册时间
        $time = date('Y-m-d H:i:s', time());
        //dump($time);die;

        $new = [
            'u_username'=>$i['username'],
            'u_password'=>md5($i['pass']),
            'u_phone'=>$i['phone'],
            'u_create_time'=>$time,

        ];

        //添加主表数据
        $res = $u->insert($new);
        $uid = $u->getLastInsID();
        //dump($uid);die;
        //添加详情表数据
        $d = [
            'ud_uid'=>$uid,
            'ud_photo'=>'tou1.jpg',
            'ud_picture'=>'tou2.jpg',
        ];
        $res2 = db('user_detail')->insert($d);

        if($res && $res2){
            //添加数据到统计表
            model('count')->register();
            //添加数据到register表
            model('register')->insert();


            $this->success('注册成功!', 'index/Index/showLogin');
        }else{
            $this->error('注册失败,请重试');
        }

        //return view('index/showRegister');
    }


}
