<?php

namespace app\index\controller;


use app\index\model\User;
use think\Controller;
use think\Request;

class Personal extends Controller
{
    /**
     * 显示个人中心页面
     *$id,用户id
     * @return \think\Response
     */
    public function index()
    {
        $id = '1';
        //获取用户基本信息
        $user = model('user');
        $list = $user->getUser($id);

        //加载用户收获的地址
        $add = model('userAddress');
        $data = $add->getAddress($id);
        //dump($data);

        return view('index/personal',[
           'list'=>$list,
           'data'=>$data,
        ]);



    }

    /*
     * 修改个人信息
     * */
    public function updateUser()
    {
        $info = input('put.');
        $id = $info['id'];
        //dump($info
        //exit;);
        $d1 = [
          'u_username'=>$info['u_username'],
          'u_phone'=>$info['u_phone'],
        ];
        $d2 = [
            'ud_sex'=>$info['ud_sex'],
            'ud_email'=>$info['ud_email'],
        ];

        $user = model('user');
        $r1 = $user->updateUser($id, $d1);

        $detail = model('userDetail');
        $r2 = $detail->updateDetail($id, $d2);

        if ($r1 && $r2){
            return $this->success('修改成功!', url('index/personal/index'));
        } else {
            return $this->error('修改失败,请重试~');
            //echo User::getLastSql();
        }
    }

    //修改用户密码
    public function updatePass()
    {
        $info = input('put.');
        $id = $info['id'];
        //dump($info);

        //后期加上md5
        $oldpass = $info['oldpass'];
        //更新的数据必须是数组!
        $secondpass = ['u_password'=>$info['secondpass']];
        //查询原密码
        $user = model('user');
        $pass = $user->getPass($id)['u_password'];
        //dump($pass);
        //dump($oldpass);

        //匹配
        if ($oldpass === $pass){
            //修改
            $res = $user->updatePass($id, $secondpass);

            if ($res){
                return $this->success('密码修改成功!', url('index/personal/index'));
            }else{
                return $this->error('密码修改失败,请重试~');
            }
        }else{
            return $this->error('原密码不正确,请重试~');
        }
    }


    //添加收货地址
    public function address()
    {
        $info = input('post.');
        //dump($info);

        $id = $info['id'];

        $data = [
          'ua_uid'=>$id,
          'ua_name'=>$info['addname'],
          'ua_address'=>$info['address'],
          'ua_street'=>$info['street'],
          'ua_phone'=>$info['addphone'],
        ];

        $user = model('userAddress');
        $res = $user->add($data);
        //
        //dump($id);
        //dump($data);

        if ($res){
            return $this->success('添加地址成功!', url('index/personal/index'));
        } else {
            return $this->error('修改失败,请重试~');
            //echo User::getLastSql();
        }
    }
    
    //删除用户收获的地址
    public function delAddress()
    {
        $id = input('param.');
        //dump($id);

        $user = model('userAddress');
        $res = $user->del($id);

        if ($res){
            return $this->success('删除成功!', url('index/personal/index'));
        } else {
            echo User::getLastSql();
            //return $this->error('删除失败,请重试~');
        }
    }
}
