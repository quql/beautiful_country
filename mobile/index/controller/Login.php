<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
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
            session('uid', $res[0]['u_id']);
            $this->success('登录成功', 'index/index/index');
        }else{
            $this->error('用户不存在,请检查用户名密码是否正确');
        }
    }

    //退出登录
    public function outLogin()
    {
        //dump(input('session.u_id'));
        session('uid',null);
        $this->success('退出成功', 'index/index/index');
    }

    //qq登录
    public function login()
    {
        //获取code
        $code = input('code');
         //var_dump($code);die;
        //获取access_token
        $token_url='https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=101416221&client_secret=57f281ad0fe49e7abf77011dccc1373c&code='.$code.'&state=qql&redirect_uri=http://qqlong.top/qqlogin';

        $token_res = https_request($token_url);
        //获取access_token
        $data = explode('&', $token_res);
        $token = explode('=',$data[0]);
        $token =$token[1];
        // var_dump($token);
        // var_dump($token_res);die;

        //获取openID
        $openid_url = 'https://graph.qq.com/oauth2.0/me?access_token='.$token;
        $openid_res = https_request($openid_url);

        //dump($openid_res);die;
        //处理str
        if (strpos($openid_res, "callback") !== false)
        {
            $lpos = strpos($openid_res, "(");
            $rpos = strrpos($openid_res, ")");
            $openid_res  = substr($openid_res, $lpos + 1, $rpos - $lpos -1);
        }

        // var_dump($openid_res);
        $openid_data = json_decode($openid_res,true);
        $openid = $openid_data['openid'];
        $user_url = 'https://graph.qq.com/user/get_user_info?access_token='.$token.'&oauth_consumer_key=101416221&openid='.$openid;

        $user = https_request($user_url);
        $user_data = json_decode($user,true);
        //获取QQ昵称
        $username=$user_data['nickname'];
        //获取QQ头像
        $userphoto=$user_data['figureurl_2'];
        //dump($user);die;

        $user_id=Db::name('user')->field('u_id')->where('u_username',$username)->select();
        if(empty($user_id)){
            $this->assign('photo',$userphoto);
            $this->assign('username',$username);
            return view('index/qqlogin');
        }else{
            $uid = $user_id[0]['u_id'];
            session('uid',"$uid");
            $this->success('登录成功','index/index/index');
        }

    }

    public function doqqlogin(Request $request)
    {
        $p = $request->post();
        $data1 = [
            'u_username'=>$p['username'],
            'u_phone'=>$p['phone']
        ];
        $res1 = Db::name('user')->insertGetId($data1);
        $data2=[
            'qqphoto'=>$p['photo'],
            'ud_picture'=>'tou2.jpg',
            'ud_uid'=>$res1
        ];
        $res2 = Db::name('user_detail')->insert($data2);
        if($res2){
            session('uid',$res1);
            $this->success('登录成功','index/index/index');
        }

    }

}
