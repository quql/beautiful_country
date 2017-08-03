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
        //dump($list);

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
    
    //用户头像上传
    public function upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        $id = input('post.')['id'];
        //dump($id);
        //exit;
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/headPhoto');


        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            //echo $info->getExtension();
            //echo "<br>";
            //// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getSaveName();
            $old = $info->getSaveName();
            $new = str_replace("\\", "/", $old);
            //dump($new);exit;
            $data = [
                'ud_photo'=>$new,
            ];
            //echo "<br>";
            //// 输出 42a79759f284b767dfcb2a0197904287.jpg
            //echo $info->getFilename();
            //echo "<br>";
            //dump($data);exit;

            $img = model('userDetail');
            $res = $img->upPhoto($id, $data);
            if ($res){
                return $this->success('上传成功!', url('index/personal/index'));
            } else {
                return $this->error('上传失败,请重试~');
            }
        }else{
            // 上传失败获取错误信息
            //echo $file->getError();
            return $this->error('上传失败,请重试~');
        }
    }

    //用户个性照片上传
    public function upPic()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        $id = input('post.')['id'];

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/userPic');

        if($info){
            $old = $info->getSaveName();
            $new = str_replace("\\", "/", $old);
            $data = [
                'ud_picture'=>$new,
            ];

            $img = model('userDetail');
            $res = $img->upPhoto($id, $data);
            if ($res){
                return $this->success('上传成功!', url('index/personal/index'));
            } else {
                return $this->error('上传失败,请重试~');
            }
        }else{
            // 上传失败获取错误信息
            //echo $file->getError();
            return $this->error('上传失败,请重试~');
        }
    }
}
