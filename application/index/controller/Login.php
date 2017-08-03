<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Login extends Controller
{
    public function dologin(Request $request)
    {
        $data = $request->post();
        // var_dump($request->post());
        // die;
        $has = Db::table('ml_user')->where('u_username',$data['u_username'])->select();
        // var_dump($has);die;

        if(empty($has)){
            $this->error('账号或密码错误');
        }

        $pass = $has['0']['u_password'];

        $id = $has['0']['u_id'];

        if( $data['u_password']==$pass){
            session_start();
            session('u_id',"$id");
            $this->success('登录成功','/');
        }else{
            $this->error('账号或密码错误');
        }
    }
}
