<?php

namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;

class Activitiesadminpic extends Admin
{
    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $p=$request->post();
        // var_dump($p);
        // die;

        $p_id=$p['p_id'];

        $ac_name=$p['ac_name'];

        $data=[
            'p_id'=>$p_id,
            'ac_name'=>$ac_name,

        ];

        $result = Db::table('ml_ac_pic')->data($data)->insert();
        if ($result > 0) {
            return $this->success('添加成功');
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

        $res = Db::table('ml_ac_pic')->select();
        $this->assign('list',$res);
        return view('activities/ActivitiesAdminCate');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $one = Db::table('ml_ac_cate')->where('id',$id)->select();
        // var_dump($one);
        // die;
        $data = $one['0'];
        // var_dump($data);
        $this->assign('data',$data);

        return view('activities/ActivitiesAdminCateEdit');
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
        // echo $id;
        // die;
        $p = $request->put();
        $data = [
            'p_id' => $p['p_id'],
            'ac_name' => $p['ac_name'],
        ];
        $result = Db::name('ac_cate')->where('id', $id)->update($data);
        if ($result) {
            return $this->success('编辑成功', url('admin/ActivitiesAdminCate/read',['id'=>$p['p_id']]));
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
        $result = Db::name('ac_pic')->delete($id);

        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的分类删除成功';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的分类删除失败,请重试!';
        }
        return json($info);
    }
}
