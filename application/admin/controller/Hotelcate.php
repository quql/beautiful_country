<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Hotelcate extends Admin
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
        $c_id=$p['c_id'];
        $h_name=$p['h_name'];

        $data=[
            'c_id'=>$c_id,
            'h_name'=>$h_name,

        ];
        $result = Db::name('h_cate')->data($data)->insert();
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


        $res = Db::table('ml_h_cate')->select();
        $this->assign('list',$res);
        return view ('hotel/hotelcateList');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $one = Db::table('ml_h_cate')->where('id',$id)->select();
        $data = $one['0'];
        $this->assign('data',$data);
        return view('hotel/hotelcateEdit');
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
            'c_id' => $p['c_id'],
            'h_name' => $p['h_name'],
        ];
        $result = Db::name('h_cate')->where('id', $id)->update($data);
        if ($result) {
            return $this->success('编辑成功', url('admin/HotelCate/read',['id'=>$p['c_id']]));
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
        $result = Db::name('h_cate')->delete($id);

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
