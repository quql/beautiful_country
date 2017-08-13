<?php

namespace app\admin\controller;

use think\Request;
use think\Db;

class Carousel extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //加载模板
        $list=Db::name('pic')->paginate(5);
        //dump($list);
        return view('carousel/index',['list'=>$list]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $file = request()->file('pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        //dump($info);
        if($info){
            $pic= $info->getSaveName();
        }else{
            return $this->error('图片上传失败');
        }
        $res = $request->post();
        if(!isset($res['is_show'])){
            $res['is_show']='0';
        }else{
            $res['is_show']='1';
        }
        //dump($res);
        $data=[
            'desc'=>$res['desc'],
            'pic'=>$pic,
            'is_show'=>$res['is_show']
        ];
        $result = Db::name('pic')->data($data)->insert();
        if ($result > 0) {
            return $this->success('添加成功');
        } else {
            return $this->error('添加失败');
        }
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = ['is_show'=>'0'];
        $result = Db::table('ml_pic')->where('id',$id)->update($data);
//        var_dump($result);
        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '已成功禁用此图片';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '禁用失败,请刷新重试!';
        }
        return json($info);

    }
    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function show($id)
    {
        $data = ['is_show'=>'1'];
        $result = Db::table('ml_pic')->where('id',$id)->update($data);
//        var_dump($result);
        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '已成功展示此图片';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '展示失败,请刷新重试!';
        }
        return json($info);

    }
    /**
     * 显示单条数据.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function find($id)
    {
        $result = Db::table('ml_pic')->where('id',$id)->find();
        //var_dump($result);
        if ($result) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
        }

        return json($result);

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
        $file = request()->file('pic');
        if ($file!==null){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $pic= $info->getSaveName();
            }else{
                return $this->error('图片修改失败');
            }
            $res = $request->post();
            if(!isset($res['is_show'])){
                $res['is_show']='0';
            }else{
                $res['is_show']='1';
            }
            //dump($res);
            $data=[
                'desc'=>$res['desc'],
                'pic'=>$pic,
                'is_show'=>$res['is_show']
            ];
        }else{
            $res = $request->post();
            if(!isset($res['is_show'])){
                $res['is_show']='0';
            }else{
                $res['is_show']='1';
            }
            //dump($res);
            $data=[
                'desc'=>$res['desc'],
                'is_show'=>$res['is_show']
            ];
        }

        $result = Db::name('pic')->where('id', $id)->update($data);
        if ($result) {
            return $this->success('修改成功');
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
        $result = Db::name('pic')->delete($id);

        if ($result) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '(^o^)图片删除成功';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '╮(╯▽╰)╭图片删除失败,请重试!';
        }
        return json($info);
    }
}
