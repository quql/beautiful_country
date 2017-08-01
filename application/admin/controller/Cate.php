<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Cate extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $data = Db::table('ml_role')->select();
        $this->assign('data',$data);
        return view('user/cate');
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
//        var_dump($p);
//        exit;
        $data = [
            'name' => $p['name'],
            'remark' => $p['remark'],
            'status'=>'1'

        ];

        $result = Db::name('role')->data($data)->insert();
        if ($result > 0) {
            return $this->success('添加成功', url('admin/cate/index'));
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
        //显示所有权限列表

        $arr=array();
        $node = Db::table('ml_node')->select();
        $role = Db::table('ml_role_node')->where('rid',$id)->select();
//        var_dump($role);
//        die;
        foreach($role as $key=>$v){
            $rolenode=Db::table('ml_node')->where('id',$v['nid'])->select();
            $arr[]=$rolenode[0];
        }
//        var_dump($arr);
//        die;
        $role_id=array();
        foreach($arr as $key=>$v){
            $role_id[]= $v['id'];
        }
//        var_dump($role_id);
//        var_dump($node);

        foreach($node as $key=>$v){
            if(in_array($v['id'],$role_id)){
                $node[$key]['is']='1';
            }else{
                $node[$key]['is']='0';
            }
        }
//        var_dump($node);
//        die;
        $this->assign('rid',$id);
        $this->assign('node',$node);
        return view('user/catepower');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $role = Db::name('role')->where('id',$id)->select();
        $role=$role['0'];
        $this->assign('role',$role);
        return view('user/cateedit');
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
            'remark' => $p['remark'],
            'status'=>'1'
        ];
        $result = Db::name('role')->where('id', $id)->update($data);
        if ($result) {
            return $this->success('编辑成功', url('admin/cate/index'));
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
        $result = Db::name('role')->delete($id);

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

    public function nodeedit(Request $request)
    {
        $data=$request->post();
//        $rid=$request->get();
        $rid=$data['rid'];
//        var_dump($data,$rid);
//       exit;
        $result=array();
        Db::table('ml_role_node')->where('rid',$rid)->delete();
        foreach($data as $key=>$val){
            if($key!=='rid'){
                $add=[
                    'rid'=>$rid,
                    'nid'=>$key
                ];
               $res=Db::table('ml_role_node')->data($add)->insert();
               $result[]=$res;
            }
        }
//        var_dump($arr);
        if(in_array('0',$result)){
           $this->error('修改失败');
        }else{
           $this->success('修改成功','admin/cate/index');
        }
    }
}
