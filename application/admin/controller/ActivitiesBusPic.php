<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Activitiesbuspic extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

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

        // $acid = $request->post();
        // var_dump($file);
        // echo "<br>";
        // var_dump($acid);
        // die;
         // $acid = $request->post();
         // var_dump($acid);
         // die;

        if(empty($file)){

            $pic='1.jpg';
        }else{
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            // echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
               $pic= $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
                        }else{
            // 上传失败获取错误信息
                return $this->error('图片上传失败');
            }
        }

        $acid = $request->post();
        $acid =$acid['acid'];
        $data=[
            'acid'=>$acid,
            'pic'=>$pic,
            'is_first'=>'0'
        ];

        $result = Db::name('ac_pic')->data($data)->insert();
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

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        // var_dump($id);
        // die;

        //店铺后台展示
        if (cache('b_name') == null) {
            $this->redirect("admin/BusLogin/index");
        }
        $res = Db::name('business')->where('b_name', cache('b_name'))->find();
        $cate = Db::name('cate')->select();
        $this->assign('bus_res',$res);
        $this->assign('cate',$cate);


        $pic = Db::name('ac_pic')->field('id,pic')->where('id',$id)->select();
        $pic = $pic['0'];
        $this->assign('pic',$pic);
        return view('activities/ActivitiesBusPicEdit');
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

        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
        // echo $info->getExtension();
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        $pic= $info->getSaveName();
        // 输出 42a79759f284b767dfcb2a0197904287.jpg
        }else{
        // 上传失败获取错误信息
            return $this->error('图片上传失败');
        }

        $data=[
          'pic'=>$pic,
        ];

        $result = Db::name('ac_pic')->where('id', $id)->update($data);

        $b_id = cache('b_id');
        // var_dump($b_id);
        // die;

        $list = Db::table('ml_activities')->where('bus_id',$b_id)->select();
        // var_dump($list);die;

        $pid = $list['0']['id'];

        if ($result) {
            return $this->success('修改成功', url('admin/activities/show',['id'=>$pid]));
        } else {
            return $this->error('修改失败');
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
            $info['info'] = 'ID为:' . $id . '的图片删除成';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的图片删除失败,请重试!';
        }
        return json($info);
    }

     public function first($id)
    {
        $acid = Db::name('ac_pic')->field('acid')->where('id',$id)->select();
        $acid=$acid['0']['acid'];
        $arr = Db::name('ac_pic')->where('acid',$acid)->update(['is_first'=>'0']);
        $res=Db::name('ac_pic')->where('id',$id)->update(['is_first'=>'1']);
        $info['status'] = true;
        $info['id'] = $acid;
        $info['info'] = 'ID为:' . $id . '的图片设置封面成功';
        return json($info);
    }

}
