<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db; // 导入Db类


class Category extends Controller
{

    public function index()
    {
        // 使用Db模型类
        $list = Db::table('ml_category')->select();
        return view('category/cateList',['title'=>'分类列表','list'=>$list]);
    }

    public function create()
    {
        // 加载,模板
        // $this->assign('title', '后台首页');
        // return $this->fetch('category/category');
        // return view('category/cateList');
        $list = Db::table('ml_category')->select();
        return view('category/cateAdd',['title'=>'分类列表','list'=>$list]);
         // 助手函数
    }

     public function save(Request $request)
    {
        
        $post = $request->post();
        $list = Db::table('ml_category')->insert($post);
        if($list){
        //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
        $this->success('新增成功', 'admin/category/index');
        } else {
        //错误页面的默认跳转页面是返回前一页，通常不需要设置
        $this->error('新增失败','admin/category/create');
                // var_dump($list);
        }
    }

     public function read($id)
    {
        $list = Db::table('ml_category')->where('pid',$id)->select();
        // var_dump($list);die;
        return view('category/cateList',['title'=>'分类列表','list'=>$list]);
    }

    public function edit($id)
    {
        $node = Db::table('ml_category')->find();
        $result = $node['pid'];
        // return view(['result=>$result']);
        // var_dump($node);
        // die;
        $row = Db::table('ml_category')->field('c_id,pid,c_name')->where('c_id',$id)->select();
        // var_dump($row);
        // die;
        if(($row['0']['pid']==0)){
            $data['c_name']='顶级分类';
            $a = $row['0']['c_name'];
            $id=$row['0']['c_id'];
            return view('category/cateEdit', [
            'data' => $data,
            'name'=>$a,
            'id'=>$id,
            ]);
        }
        // var_dump($row);
        // die;
        $pid=$row['0']['pid'];
        $a = $row['0']['c_name'];
        $id=$row['0']['c_id'];
        // var_dump($pid,$a,$id);die;

        $c_name = Db::table('ml_category')->where('c_id',$pid)->select();
        // var_dump($c_name);die;

        $name=$c_name['0'];
        // var_dump($name);
        return view('category/cateEdit', [
            'data' => $name,
            'name'=>$a,
            'id'=>$id,
            // 'result'=>$result
        ]);
    }

    public function update(Request $request, $id)
    {
        // var_dump($request);
        // die;
        $info = $request->put();
        // var_dump($info);
        // die;
        $newInfo = [
            'c_id'=>$info['id'],
            'c_name'=>$info['c_name']
        ];

        $result =Db::table('ml_category')->update($newInfo);

        if($result){
        //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
        $this->success('添加成功', 'admin/category/index');
        } else {
        //错误页面的默认跳转页面是返回前一页，通常不需要设置
        $this->error('添加失败');
        }
    }

    public function delete($id)
    {
        $info['status'] = true;
        $info['id'] = $id;
        $info['info']= "hahaha";
        return json($info);
        // $result = Db::table('ml_category')->delete($id);

        // if ($result) {
        //     $info['status'] = true;
        //     $info['id'] = $id;
        //     $info['info'] = 'ID为:' . $id . '的用户删除成';
        // } else {
        //     $info['status'] = false;
        //     $info['id'] = $id;
        //     $info['info'] = 'ID为:' . $id . '的用户删除失败,请重试!';
        // }
        // return json($info);


        // echo 123;die;
        // $result = Db::table('ml_category')->delete($id);
        //     if ($result) {
        //         $info['status'] = true;
        //         $info['id'] = $id;
        //         $info['info'] = 'ID为:' . $id . '的分类删除成功';
        //     } else {
        //         $info['status'] = false;
        //         $info['id'] = $id;
        //         $info['info'] = 'ID为:' . $id . '的分类删除失败,请重试!';
        //     }
        //     return json($info);

        // $delete = Db::table('ml_category')->where('pid',$id)-select();
        // if($delete){
        //     alert('有子类，不能删除');
        // }else{
        //     $result = Db::table('ml_category')->delete($id);
        //     if ($result) {
        //         $info['status'] = true;
        //         $info['id'] = $id;
        //         $info['info'] = 'ID为:' . $id . '的分类删除成功';
        //     } else {
        //         $info['status'] = false;
        //         $info['id'] = $id;
        //         $info['info'] = 'ID为:' . $id . '的分类删除失败,请重试!';
        //     }
        //     return json($info);
        // }
    }

}