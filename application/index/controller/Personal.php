<?php

namespace app\index\controller;

//Model::
use app\index\model\User;
use think\Controller;
use think\Model;
use think\Request;

class Personal extends Controller
{
    /**
     * 显示个人中心页面
     *
     * @return \think\Response
     */
    public function index()
    {
        $id = '1';
        //$user = new Ml_user;
        //$list = $user->getUser($id);
        //dump($list['u_id']);
        //dump($list[0]['ud_id']);

        $user = new User();
        $list = $user->with('user_detail')->find($id)->toArray();
        dump($list);
        //return view('index/personal', [
        //    'list'=>$list,
        //]);
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
        //
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
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
