<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class FoodPic extends Bus
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($id)
    {

        $list=Db::table('ml_food_pic')->where('gid',$id)->select();
//        var_dump($list);
//        die;
        $this->assign('piclist',$list);
        $this->assign('food_id',$id);

        return view('food/pic');
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
        $gid = $request->post();
        $gid =$gid['gid'];
        $num = Db::name('food_pic')->where('gid',$gid)->count();
        if($num>=4){
            return $this->error('此商品图片数量已达上限');
        }
        $file = request()->file('img');
        if(empty($file)){
            $pic='1.jpg';
        }else{
            // 移动到框架应用根目录/public/uploads/ 目录下
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
                return $this->error('图片上传失败');
            }
        }

        $data=[
            'gid'=>$gid,
            'pic'=>$pic,
            'is_first'=>'0'
        ];
        $result = Db::name('food_pic')->data($data)->insert();
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
        $pic = Db::name('food_pic')->field('id,pic')->where('id',$id)->select();
        $pic = $pic['0'];
        $this->assign('pic',$pic);
        return view('food/picEdit');
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
//            echo $info->getExtension();
// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $pic= $info->getSaveName();
// 输出 42a79759f284b767dfcb2a0197904287.jpg

        }else{
// 上传失败获取错误信息
            return $this->error('头像上传失败');
        }

        $data=[
          'pic'=>$pic,
        ];

        $result = Db::name('food_pic')->where('id', $id)->update($data);
        $b_id = input('session.b_id');
        $list = Db::table('ml_food')->where('bus_id',$b_id)->select();
        $pid = $list['0']['id'];
        if ($result) {
            return $this->success('修改成功', url('admin/food/show',['id'=>$pid]));
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
        $result = Db::name('food_pic')->delete($id);

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

    public function first($id)
    {
        $g_id = Db::name('food_pic')->field('gid')->where('id',$id)->select();

        $gid=$g_id['0']['gid'];
        $arr = Db::name('food_pic')->where('gid',$gid)->update(['is_first'=>'0']);
        $res=Db::name('food_pic')->where('id',$id)->update(['is_first'=>'1']);

        $info['status'] = true;
        $info['id'] = $gid;
        $info['info'] = '(^o^)设置封面成功';
        return json($info);
    }
}
