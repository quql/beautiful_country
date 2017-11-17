<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
//节点操作
class Node extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = Db::table('ml_node')->paginate(5);
        $this->assign('list',$data);
        return view('node/index');
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
        $p=$request->post();

        $data = [
            'name' => $p['name'],
            'controller' => ucfirst(strtolower($p['controller'])),
            'action' => strtolower($p['action']),
            'status'=>'1'
        ];

        $result = Db::name('node')->data($data)->insert();
        if ($result > 0) {
            return $this->success('添加成功', url('admin/node/index'));
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
        $data = Db::table('ml_node')->where('id',$id)->select();
        $data=$data['0'];
//        var_dump($data);
        $this->assign('data',$data);
        return view('node/edit');
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
        $p = $request->put();
        $data = [
            'name' => $p['name'],
            'controller'=>$p['controller'],
            'action'=>$p['action'],
            'status'=>'1'
        ];
        $result = Db::name('node')->where('id', $id)->update($data);
        if ($result) {
            return $this->success('编辑成功', url('admin/node/index'));
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
        $result = Db::name('node')->delete($id);

        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的节点删除成';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的节点删除失败,请重试!';
        }
        return json($info);
    }
}
