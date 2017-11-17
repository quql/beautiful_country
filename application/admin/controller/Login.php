<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Login extends Controller
{
   public function index()
   {
       return view('login/login');
   }

    public function dologin(Request $request)
    {
        $data = $request->post();
        //var_dump($request->post());
        $has = Db::table('ml_admin_user')->where('username',$data['username'])->select();
        if(empty($has)){
            $this->error('账号或密码错误');
        }
        $pass = $has['0']['pass'];
        $id = $has['0']['id'];
        if( $data['pass']==$pass){
            session_start();
           session('admin_id',"$id");
            $this->success('登录成功','admin');
        }else{
            $this->error('账号或密码错误');
        }
    }

}
