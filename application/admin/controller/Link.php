<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Link extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */

    public function index()
    {   
        $res = Db::table('ml_link')->select();
        $this->assign('list',$res);
        return view('link/LinkList');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

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
          // var_dump($p);
          // die;
          $file = $request->file('l_logo');

          // var_dump($file);
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

       $data = [
        'l_name' => $p['l_name'],
        'l_url' => $p['l_url'],
        'l_logo'=>$pic
        ];

        $result = Db::name('link')->data($data)->insert();
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
        $res = Db::table('ml_link')->select();
        $this->assign('list',$res);
        return view('link/linklist');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        // var_dump($id);die;
        $link = Db::name('link')->where('id',$id)->select();
        // var_dump($link);die;
        $link = $link['0'];
        $this->assign('link',$link);
        return view('link/LinkEdit');
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
        // var_dump($p);die;
        // $data = [
        //     'l_name' => $p['l_name'],
        //     'l_url' => $p['l_url'],
        // ];

        $file = request()->file('img');

        if(!empty($file)){

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
                return $this->error('logo上传失败');
            }

            $data = [
                'l_name' => $p['l_name'],
                'l_url' => $p['l_url'],
                'l_logo'=>$pic
            ];
        }else{
            
            $data = [
                'l_name' => $p['l_name'],
                'l_url' => $p['l_url'],
            ];
        }



        $result = Db::name('link')->where('id', $id)->update($data);

        
        // $b_id = cache('b_id');
        // $list = Db::table('ml_hotel')->where('bus_id',$b_id)->select();
        // $pid = $list['0']['id'];

        if ($result) {
            return $this->success('修改成功', url('admin/link/index'));
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
      
        $result = Db::name('link')->delete($id);

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
