<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
//管理员操作
class User extends Admin
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //显示管理员列表
        $userlist = db('admin_user as user,ml_role as role')->where('user.role = role.id')->field('user.*,role.name as rolename')->select();
        // var_dump($userlist);die;
        $rolelist = Db::name('role')->field('id,name')->select();
        // var_dump($rolelist);die;
        $this->assign('title','管理员列表');
        $this->assign('list',$userlist);
        $this->assign('rolelist',$rolelist);
        return view('user/index');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {

        $file = request()->file('img');
        if(empty($file)){
            $pic='1.jpg';
        }else{
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
// 成功上传后 获取上传信息
// 输出 jpg
//            echo $info->getExtension();
// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $pic= $info->getSaveName();
// 输出 42a79759f284b767dfcb2a0197904287.jpg

            }else{
// 上传失败获取错误信息
                return $this->error('头像上传失败');
            }
        }


        $p=$request->post();
        $data = [
            'username' => $p['username'],
            'pass' => $p['pass'],
            'sex' => $p['sex'],
            'age' => $p['age'],
            'role' => $p['role'],
            'status'=>'1',
            'photo'=>$pic
        ];

        $result = Db::name('admin_user')->data($data)->insert();
        if ($result > 0) {
            return $this->success('添加成功', url('admin/user/index'));
        } else {
            return $this->error('添加失败');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $rolelist = Db::name('role')->field('id,name')->select();
        $a = Db::name('admin_user')->where('id',$id)->select();
        $data = $a['0'];
        $role = Db::name('role')->field('name')->where('id',$data['role'])->select();
        $rolename=$role['0']['name'];
        $this->assign('data',$data);
        $this->assign('rolelist',$rolelist);
        $this->assign('rolename',$rolename);
        return view('user/edit');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {

        $file = request()->file('img');
        if(empty($file)){
            $a = Db::name('admin_user')->where('id',$id)->select();
            $data = $a['0'];
            $pic=$data['photo'];
        }else{
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
// 成功上传后 获取上传信息
// 输出 jpg
//            echo $info->getExtension();
// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $pic= $info->getSaveName();
// 输出 42a79759f284b767dfcb2a0197904287.jpg

            }else{
// 上传失败获取错误信息
                return $this->error('头像上传失败');
            }
        }
        // $info = input('put.');
        $p = $request->put();
        $data = [
            'username' => $p['username'],
            'sex' => $p['sex'],
            'age' => $p['age'],
            'role' => $p['role'],
            'status'=>'1',
            'photo'=>$pic
        ];
        $result = Db::name('admin_user')->where('id', $id)->update($data);
        if ($result) {
            return $this->success('编辑成功');
        } else {
            return $this->error('编辑失败');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        
        $user = Db::name('admin_user')->find($id);
        $role = $user['role'];
        if($role==1){
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '超级管理员无法删除';
            return json($info);
        }
        $result = Db::name('admin_user')->delete($id);

        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的用户删除成';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的用户删除失败,请重试!';
        }
        return json($info);
    }

    public function power()
    {
        //显示所有权限列表
        $node = Db::table('ml_node')->select();
//        var_dump($node);
//        die;
        $this->assign('node',$node);
        return view('user/power');
    }

    public function password(Request $request, $id)
    {
        // echo $id;
         $userlist = db('admin_user as user,ml_role as role')->where('user.role = role.id')->field('user.*,role.name as rolename')->select();
        // var_dump($userlist);die;
        $rolelist = Db::name('role')->field('id,name')->select();
        // var_dump($rolelist);die;
        $this->assign('title','管理员列表');
        $this->assign('list',$userlist);
        $this->assign('rolelist',$rolelist);

        $post = $request->post();
        $data = Db::table('ml_admin_user')->find($id);
        // var_dump($post);
        // echo"<hr>";
        // var_dump($data);
        // die;
        if ($post['pass']!== $post['repass']) {

            return $this->error('两次密码输入不一致，请重新输入','admin/user/index');

            // header('location:/index/user/password');
        } 

        if($post['oldpass']!==$data['pass']){
            //密码匹配成功
            return $this->error('原始密码不正确，请重新输入','admin/user/index');
        }

        $password = ['pass' => $post['pass']];

        $result = Db::table('ml_admin_user')->where('id',$id)->update($password);
        
        if ($result) {
            return $this->success('恭喜你，密码修改成功!','admin/user/index');
        } else {
            return $this->error('两次密码输入不一致，请重新输入','admin/user/index');
        }
    }
}
