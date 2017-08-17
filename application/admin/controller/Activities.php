<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Activities extends Bus
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */

    public function index()
    {   
        //店铺后台展示
        $res = Db::name('business')->where('b_name', cache('b_name'))->find();
        $cate = Db::name('cate')->select();
        $this->assign('bus_res',$res);
        $this->assign('cate',$cate);

        //店铺活动首页 
        $list = Db::table('ml_activities')->where('bus_id', cache('b_id'))->select();
        $catelist = Db::table('ml_ac_cate')->select();
        $this->assign('list',$list);
        $this->assign('catelist',$catelist );
        return view('activities/ActivitiesBusList');
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
        //商家提交活动表单
        $p=$request->post();

        if (empty($p['ac_status'])) {
            $p['ac_status'] = '0';
        } else {
            $p['ac_status'] = '1';
        }

        $b_id = cache('b_id');
        // var_dump($p);
        // die;
        $ActivitiesData = [
            'ac_cate' => $p['ac_cate'],
            'ac_title' => $p['ac_title'],
            'ac_abstract' => $p['ac_abstract'],
            'ac_opentime' => $p['ac_opentime'],
            'ac_closetime' => $p['ac_closetime'],
            'ac_spot'=>$p['ac_spot'],
            'ac_host' => $p['ac_host'],
            'ac_price' => $p['ac_price'],
            'ac_contain' => $p['ac_contain'],
            'ac_status' => $p['ac_status'],
            'ac_details' => $p['ac_details'],
            'ac_contact' => $p['ac_contact'],
            'bus_id' => $b_id
        ];

        $result = Db::name('activities')->insertGetId($ActivitiesData);
        if ($result > 0) {

            return $this->success('添加成功', url('admin/Activities/index'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read ($id)
    {


        if (cache('b_name') == null) {
            $this->redirect("admin/BusLogin/index");
        }

        $res = Db::name('business')->where('b_name', cache('b_name'))->find();

        $cate = Db::name('cate')->select();
        // var_dump($cate);
        // die;
        $this->assign('bus_res',$res);
        $this->assign('cate',$cate);

        $data = Db::table('ml_activities')->where('id',$id)->select();
        // var_dump($data);die;
        $data = $data['0'];
        $this->assign('data',$data);
        return view('activities/ActivitiesBusListDatails');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {

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
        // var_dump($p);
        // die;
        if (empty($p['ac_status'])) {
            $p['ac_status'] = "0";
        } else {
            $p['ac_status'] = "1";
        }
        
        $ActivitiesData = [
            'ac_cate' => $p['ac_cate'],
            'ac_title' => $p['ac_title'],
            'ac_abstract' => $p['ac_abstract'],
            'ac_opentime' => $p['ac_opentime'],
            'ac_closetime' => $p['ac_closetime'],
            'ac_spot'=>$p['ac_spot'],
            'ac_host' => $p['ac_host'],
            'ac_price' => $p['ac_price'],
            'ac_contain' => $p['ac_contain'],
            'ac_status' => $p['ac_status'],
            'ac_details' => $p['ac_details'],
            'ac_contact' => $p['ac_contact']
        ];
        // var_dump($ActivitiesData);die;

        $result =Db::table('ml_activities')->where('id',$id)->update($ActivitiesData);
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', 'admin/activities/index');
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
        $res1 = Db::name('activities')->delete($id);
        $res2 =Db::name('ac_pic')->where('acid',$id)->delete();

        if ($res1 || $res2 ) {
            $info['status'] = true;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的活动删除成功';
        } else {
            $info['status'] = false;
            $info['id'] = $id;
            $info['info'] = 'ID为:' . $id . '的活动删除失败,请重试!';
        }
        return json($info);
    }


    public function show($id)
    {       

         //店铺后台展示
        if (cache('b_name') == null) {
            $this->redirect("admin/BusLogin/index");
        }
        $res = Db::name('business')->where('b_name', cache('b_name'))->find();
        $cate = Db::name('cate')->select();
        $this->assign('bus_res',$res);
        $this->assign('cate',$cate);


        $id = input();
        // var_dump($id);die;
        $id =$id['id'];
        $list=Db::table('ml_ac_pic')->where('acid',$id)->select();
        // var_dump($list);
        // die;

        $this->assign('piclist',$list);
        $this->assign('acid',$id);
        return view('activities/ActivitiesBusPic');
    }

    public function register($id)
    {   
        if (cache('b_name') == null) {
            $this->redirect("admin/BusLogin/index");
        }

        // $result = Db::name('activities_register')->where('ar_activities_id',$id)->select();
        
        $activities_register_sql = "select ml_activities.id as activities_id,
        ml_activities.ac_title,ml_activities.ac_abstract,ml_activities.ac_opentime,ml_activities.ac_closetime,ml_activities.ac_spot,ml_activities.ac_host,ml_activities.ac_cate,ml_activities.ac_details,ml_activities.ac_price,ml_activities.ac_status,ml_activities.ac_contain,ml_activities.bus_id,ml_activities.ac_contact,
        ml_activities_register.id as ar_id,ml_activities_register.ar_opentime,ml_activities_register.ar_closetime,ml_activities_register.ar_amount,ml_activities_register.ar_condinator,ml_activities_register.ar_contact,ml_activities_register.ar_comments,ml_activities_register.ar_bus_id,ml_activities_register.ar_submit_time,ml_activities_register.ar_activities_id,ml_activities_register.ar_user_id 
        from ml_activities
        LEFT JOIN ml_activities_register ON ml_activities.id=ml_activities_register.ar_activities_id where ml_activities_register.ar_activities_id = $id ";

        $activities_register = Db::query($activities_register_sql);
        // var_dump($activities_register);die;
        $this->assign('activities_register', $activities_register);
        return view('activities/ActivitiesBusRegisterDatails');

    }
}
