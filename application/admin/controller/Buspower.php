<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
//平台对店铺的操作

class Buspower extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data1 = Db::name('business')->field('b_id,b_username,b_name,b_create_time,is_approve')->where('is_approve','N')->paginate(5);
        $data2 = Db::name('business')->field('b_id,b_username,b_name,b_create_time,is_approve')->where('is_approve','Y')->paginate(5);
        $this->assign('list1',$data1);
        $this->assign('list2',$data2);
        return view('buspower/buspowerList');
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
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $data = Db::name('business')->where('b_id',$id)->select();
        $res = $data['0'];
        $this->assign('res',$res);
        return view('buspower/busdetail');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //执行重置密码

        $pass = md5(123456);
        $data=[
          'b_password'=>$pass,
        ];
        $res = Db::name('business')->where('b_id',$id)->update($data);
        if ($res) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '密码成功重置为:123456';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '密码重置失败';
        }
        return json($info);


    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    //更改审核状态
    public function update(Request $request, $id)
    {
        $data=[
            'is_approve'=>'Y',
        ];
        $res = Db::name('business')->where('b_id',$id)->update($data);
        if ($res) {
            $info['status'] = true;
        } else {
            $info['status'] = false;
        }
        return json($info);

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result = Db::name('business')->delete($id);

        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的商铺删除成';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的商铺删除失败,请重试!';
        }
        return json($info);
    }
}
