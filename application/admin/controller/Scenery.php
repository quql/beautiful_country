<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Scenery extends Bus
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $b_id = cache('b_id');
        $list = Db::table('ml_scenery')->where('bus_id',$b_id)->select();
        $catelist = Db::table('ml_scenery_cate')->select();
//        var_dump($list);
//        die;
//       var_dump($catelist);
//       die;
        $this->assign('list',$list);
        $this->assign('catelist',$catelist );
        return view('scenery/list');

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

        $file = request()->file('img');
        if(empty($file)){
            $pic='2.jpg';
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
                return $this->error('头像上传失败');
            }
        }

        $bus_id=cache('b_id');
        $p=$request->post();

        //var_dump($p);
        if(empty($p['is_hot'])){
           $hot=0;
        }else{
            $hot=1;
        }

        if(empty($p['is_sale'])){
            $sale=0;
        }else{
            $sale=1;
        }


        $data1 = [
            'c_id' =>'1',
            'gd_title' => $p['gd_title'],
            'gd_abstract' => $p['gd_abstract'],
            'gd_hot'=>$hot,
            'gd_is_sale'=>$sale,
            'bus_id'=>$bus_id,
            'h_cate'=>$p['h_cate'],
            'price' => $p['gd_price']

        ];





        $result = Db::name('scenery')->insertGetId($data1);
        if ($result <= 0) {
            return $this->error('添加失败');
        }

        $data2 = [
            'c_gid'=>$result,
            'gd_details' => $p['gd_details'],
            'gd_price' => $p['gd_price'],
            'gd_store' => $p['gd_store'],
            'gd_discount' => $p['gd_discount'],
            'gd_num'=>'0',
            'gd_view'=>'0',
            'gd_phone'=>$p['gd_phone']
        ];
        $data3 = [
            'gid'=>$result,
            'pic'=>$pic,
            'is_first'=>'1'
        ];
        $res = Db::name('scenery_detail')->data($data2)->insert();
        $res = Db::name('scenery_pic')->data($data3)->insert();
        if ($res > 0) {
            return $this->success('添加成功', url('admin/scenery/index'));
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
        var_dump($id);
        $data1 = Db::table('ml_scenery')->where('id',$id)->select();
        $data2 = Db::table('ml_scenery_detail')->where('c_gid',$id)->select();
        $data1 = $data1['0'];
        $data2 = $data2['0'];
        $this->assign('data1',$data1);
        $this->assign('data2',$data2);
        return view('scenery/listDetail');

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $one = Db::table('ml_scenery')->where('id',$id)->select();
        $data = $one['0'];
//        var_dump($data);
//        die;
        $this->assign('data',$data);
        return view('scenery/edit');
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
        $info = $request->put();
//         var_dump($info);
//         die;
        if(empty($info['is_hot'])){
            $hot=0;
        }else{
            $hot=1;
        }

        if(empty($info['is_sale'])){
            $sale=0;
        }else{
            $sale=1;
        }


        $newInfo1 = [
            'gd_title' => $info['gd_title'],
            'gd_abstract' => $info['gd_abstract'],
            'gd_hot'=>$hot,
            'gd_is_sale'=>$sale,
            'price' => $info['gd_price']
        ];

        $newInfo2 = [
            'gd_details' => $info['gd_details'],
            'gd_price' => $info['gd_price'],
            'gd_store' => $info['gd_store'],
            'gd_discount' => $info['gd_discount'],
            'gd_phone'=>$info['gd_phone']
        ];

        $result1 =Db::table('ml_scenery')->where('id',$id)->update($newInfo1);
        $result2 =Db::table('ml_scenery_detail')->where('c_gid',$id)->update($newInfo2);
//        dump($id);
//        dump($result1);
//        dump($result2);
//        die();
        if($result1 || $result2){
            $this->success('修改成功', 'admin/scenery/index');
        } else {
            $this->error('修改失败');
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
        $res = Db::name('scenery')->delete($id);
        $res = Db::name('scenery_detail')->where('c_gid',$id)->delete();
        $res =Db::name('scenery_pic')->where('gid',$id)->delete();
        //dump($res);
        //die();
        if ($res) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = '\(^o^)/产品删除成功';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = '╮(╯▽╰)╭产品删除失败,请重试!';
        }
        return json($info);
    }

    public function show($id)
    {
        $list=Db::table('ml_scenery_pic')->where('gid',$id)->select();
        //var_dump($list);
        $this->assign('piclist',$list);
        $this->assign('goods_id',$id);

        return view('scenery/pic');
    }
}
