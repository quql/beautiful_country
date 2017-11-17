<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\BusLogin;
use think\Db;


class BusInfo extends Bus

{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        //获取到缓存中的b_name 查询出对应商户
        $res = Db::name('business')->where('b_id',input('session.b_id'))->find();
        //dump($res);die;
        return view('bus/busInfo', ['res' => $res]);

    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        // 获取表单上传文件
        $file = request()->file('b_logo');

        if(empty($file)){
            $a = Db::name('business')->where('b_id',$id)->select();
            $data = $a['0'];
            $pic=$data['b_logo'];
        }else{
            // 把图片移动到框架应用根目录/public/uploads/ 目录下
            $infos = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($infos){
                // 成功上传后 获取上传信息
                $pic= $infos->getSaveName();
                $pic='/uploads/'.$pic;
                //dump($pic);
            }else{
                // 上传失败获取错误信息
                return $this->error('头像上传失败,请重新修改~~~');
            }
        }
        //获取提交的数据
        $info = $request->post();
        $x=Db::name('business')->where('b_name', $info['b_name'])->select();
        if (!empty($x)){
            if ($x['0']['b_id']!=$id){
                return $this->error('此店铺名已有人用啦,麻烦再取一个吧~~~');
            }
        }
        $y=Db::name('business')->where('b_phone', $info['b_phone'])->select();
        if (!empty($y)){
            if ($y['0']['b_id']!=$id){
                return $this->error('此手机号已经被注册过了~~~');
            }
        }
        $data = [
            'b_type' => $info['b_type'],
            'b_username' => $info['b_username'],
            'b_name' => $info['b_name'],
            'b_phone' => $info['b_phone'],
            'b_logo'=>$pic,
            'b_email'=> $info['b_email'],
            'b_desc'=>$info['b_desc']
        ];
        $result = Db::name('business')->where('b_id', $id)->update($data);
        if ($result) {
            return $this->success('O(∩_∩)O 资料修改成功', url('admin/BusInfo/index'));
        } else {
            return $this->error('%>_<% 修改失败');
        }
    }

    public function pass(Request $request, $id)
    {
        //获取提交的数据
        $info = $request->post();
        //dump($info);
        $x=Db::name('business')->find($id);
        if (md5($info['old_pass'])!=$x['b_password']){
            return $this->error('原密码输入有误,请刷新重试~~~');
        }

        $data = [
            'b_password' => md5($info['new_pass'])
        ];
        $result = Db::name('business')->where('b_id', $id)->update($data);
        if ($result) {
            return $this->success('O(∩_∩)O 密码重置成功', url('admin/BusInfo/index'));
        } else {
            return $this->error('%>_<% 修改失败,再来一次');
        }
    }

    /**
     * 显示用户评论的列表
     *
     * @return \think\Response
     */
    public function comment()
    {
        //获取到缓存中的b_id 查询出对应评论
        $id= input('session.b_id');
        $sql="select ml_comment.c_score,c_text,c_time,c_cid,c_gname,c_id,ml_bus_comment.c_content,ml_user.u_username FROM ml_comment LEFT JOIN ml_bus_comment ON ml_bus_comment.com_id=ml_comment.c_id LEFT JOIN ml_user ON ml_user.u_id=ml_comment.c_uid WHERE  ml_comment.c_bid=$id  AND ml_comment.is_ban='0'";
        $res=Db::query($sql);
        //dump($res);
        return view('bus/comment', ['res' => $res]);

    }
    public function create($id){
        if(!empty($id)){
            $res['id']=$id;
            $res['status']=true;
        }else{
            $res['status']=false;
        }
        return json($res);
    }
    /**
     * 保存商家回复的评论
     *
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //获取表单提交的数据
        $arr = $request->post();
        //dump($arr);die;
        $data = [
            'c_content' => $arr['content'],
            'bid' =>input('session.b_id'),
            'com_id' => $arr['com_id'],
            'c_atime' => date('Y-m-d H:i:s')
        ];
        //dump($data);
        $res = Db::name('bus_comment')->insert($data);
        if ($res) {
            $this->success('已回复此评论');
        } else {
            $this->error('啊偶~~失败了,不要气馁,再来一次');
        }

    }


}
