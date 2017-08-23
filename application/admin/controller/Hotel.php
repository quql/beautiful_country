<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Hotel extends Bus
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $b_id =input('session.b_id');
        $list = Db::table('ml_hotel')->where('bus_id',$b_id)->select();
        $catelist = Db::table('ml_h_cate')->select();
//        var_dump($list);
//        die;
//       var_dump($catelist);
//       die;
        $this->assign('list',$list);
        $this->assign('catelist',$catelist );
        return view('hotel/hotelList');

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
                return $this->error('图片上传失败');
            }
        }

        $bus_id=input('session.b_id');
        $p=$request->post();

//        var_dump($p);
//        die;
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

        if(empty($p['is_wifi'])){
            $wifi=0;
        }else{
            $wifi=1;
        }

        if(empty($p['is_park'])){
            $park=0;
        }else{
            $park=1;
        }


        $data1 = [
            'c_id' =>'4',
            'gd_title' => $p['gd_title'],
            'gd_abstract' => $p['gd_abstract'],
            'gd_hot'=>$hot,
            'gd_is_sale'=>$sale,
            'bus_id'=>$bus_id,
            'h_cate'=>$p['h_cate'],
            'price' => $p['gd_price']

        ];





        $result = Db::name('hotel')->insertGetId($data1);
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
            'is_wifi'=>$wifi,
            'is_park'=>$park,
            'gd_view'=>'0',
            'gd_phone'=>$p['gd_phone'],
            'gd_address'=>$p['gd_address']
        ];
        $data3 = [
            'gid'=>$result,
            'pic'=>$pic,
            'is_first'=>'1'
        ];
        $res = Db::name('hotel_detail')->data($data2)->insert();
        $res = Db::name('hotel_pic')->data($data3)->insert();
        if ($res > 0) {
            return $this->success('添加成功', url('admin/hotel/index'));
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
        $data1 = Db::table('ml_hotel')->where('id',$id)->select();
        $data2 = Db::table('ml_hotel_detail')->where('c_gid',$id)->select();
        $data1 = $data1['0'];
        $data2 = $data2['0'];
        $this->assign('data1',$data1);
        $this->assign('data2',$data2);
        return view('hotel/hotelListdetail');

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $one = Db::table('ml_hotel')->where('id',$id)->select();
        $data = $one['0'];
//        var_dump($data);
//        die;
        $this->assign('data',$data);
        return view('goods/goodsEdit');
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
        $p=$request->post();
        // var_dump($id);
        // die;
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

        if(empty($info['is_wifi'])){
            $wifi=0;
        }else{
            $wifi=1;
        }

        if(empty($info['is_park'])){
            $park=0;
        }else{
            $park=1;
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
            'is_wifi'=>$wifi,
            'is_park'=>$park,
            'gd_phone'=>$p['gd_phone'],
            'gd_address'=>$p['gd_address']
        ];

        $result1 =Db::table('ml_hotel')->where('id',$id)->update($newInfo1);
        $result2 =Db::table('ml_hotel_detail')->where('c_gid',$id)->update($newInfo2);

        // dump($newInfo1);
        // dump($result1);
        // dump($result2);
        // die;

        if($result1 || $result2){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', 'admin/hotel/index');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
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
        $res = Db::name('hotel')->delete($id);
        $res = Db::name('hotel_detail')->where('c_gid',$id)->delete();
        $res =Db::name('hotel_pic')->where('gid',$id)->delete();

        if ($res) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的商品删除成功';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的商品删除失败,请重试!';
        }
        return json($info);
    }

    public function show($id)
    {
        $list=Db::table('ml_hotel_pic')->where('gid',$id)->select();
//        var_dump($list);
//        die;
        $this->assign('piclist',$list);
        $this->assign('goods_id',$id);

        return view('hotel/hotelpic');
    }
}
