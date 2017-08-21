<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Register extends Base
{
    public function register ()
    { 
      return view('index/login-register');
    }
    
    public function doRegister(Request $request)
    { 
      $info = $request->post();

      //判断用户名是否注册
      $res = Db::table('ml_user')->where('u_username', $info["u_username"])->find();
        //dump($res);
        if ($res !== null) {
            $this->error('该名字太热了，换一个吧？');
        }
      //判断手机号码是否注册
      $a = Db::table('ml_user')->where('u_phone', $info["u_phone"])->find();
        if ($a !== null) {
            $this->error('手机号码重复啦,请修改，嘿嘿~~~~');
        }

      //整理添加的数组信息
      $time = date('Y-m-d H:i:s',time());
      // var_dump($time);die;

      $data = [
          'u_username' => $info['u_username'],
          'u_phone' => $info['u_phone'],
          'u_password' => md5($info['u_password']),
          'u_create_time' => $time,
      ];

        //添加进数据库
        $result = Db::table('ml_user')->insertGetId($data);
        $data1 = [
          'ud_uid'=>$result,
          'ud_type'=>'0',
          'ud_photo'=>'tou1.jpg',
          'ud_picture'=>'tou2.jpg'
        ];
        $res = Db::table('ml_user_detail')->data($data1)->insert();
        //dump($result);

        //新增money表数据
        Db::table('ml_money')->data('m_uid',$result)->insert();
        if ($result > 0 && $res>0) {
            //添加数据到统计表
            model('count')->register();
            //添加数据到register表
            model('register')->insert();

            //如果添加成功 重定向到首页
            $this->success('恭喜你注册成功，请点击登录', 'index/Register/register');
        } else {
            //失败则回到注册页 自动触发一次注册按钮
            $this->error('(⊙o⊙)网络异常,提交失败,请重新提交,谢谢!');
        }
      }

}
