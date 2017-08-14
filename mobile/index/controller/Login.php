<?php
namespace app\index\controller;

use think\Controller;
use think\Url;

class Login extends Controller
{
    //执行登录
    public function doLogin()
    {
        $i = input('post.');
        //dump($i);
        $data = [
            'username'=>$i['username'],
            'pass'=>md5($i['pass']),
        ];
        $u = model('User');
        $res = $u->getUser($data);
        //dump($res);die;
        if($res){
            session('u_id', $res[0]['u_id']);
            $this->success('登录成功', 'index/index/index');
        }else{
            $this->error('用户不存在,请检查用户名密码是否正确');
        }
    }

    //退出登录
    public function outLogin()
    {
        //dump(input('session.u_id'));
        session('u_id',null);
        $this->success('退出成功', 'index/index/index');
    }

}
