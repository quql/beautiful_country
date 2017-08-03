<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Register extends Controller
{
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
      $time = time();
        $data = [
            'u_username' => $info['u_username'],
            'u_phone' => $info['u_phone'],
            'u_password' => ($info['u_password']),
            'u_create_time' => $time,
        ];

        //添加进数据库
        $result = Db::table('ml_user')->data($data)->insert();
        //dump($result);
        if ($result > 0) {
            //如果添加成功 重定向到首页
            $this->success('恭喜你注册成功，请点击登录', '/');
        } else {
            //失败则回到注册页 自动触发一次注册按钮
            $this->error('(⊙o⊙)网络异常,提交失败,请重新提交,谢谢!');
        }
      }

}
