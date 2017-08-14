<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Url;
use think\Db;

class Activities extends Base
{
    /**
     * 显示酒店详情页
     *
     * @return \think\Response
     */
    public function index()
    {
        // $sql = "select ml_activities.id as activities_id,ml_activities.ac_title,ml_activities.ac_abstract,ml_activities.ac_opentime,ml_activities.ac_closetime,ml_activities.ac_spot,ml_activities.ac_spot,ml_activities.ac_host,ml_activities.ac_cate,ml_activities.ac_details,ml_activities.ac_price,ml_activities.ac_status,ml_activities.ac_contain,ml_activities.bus_id,ml_ac_cate.id as ac_cate_id,ml_ac_cate.ac_name,ml_ac_cate.p_id,ml_ac_pic.id as ac_pic_id,ml_ac_pic.acid,ml_ac_pic.pic from ml_activities LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid LEFT JOIN ml_ac_cate ON ml_activities.ac_cate=ml_ac_cate.id where ml_ac_pic.is_first='1'";

        $sql = "select ml_activities.id as activities_id,ml_activities.ac_title,ml_activities.ac_abstract,ml_activities.ac_opentime,ml_activities.ac_closetime,ml_activities.ac_spot,ml_activities.ac_spot,ml_activities.ac_host,ml_activities.ac_cate,ml_activities.ac_details,ml_activities.ac_price,ml_activities.ac_status,ml_activities.ac_contain,ml_activities.bus_id,ml_ac_cate.id as ac_cate_id,ml_ac_cate.ac_name,ml_ac_cate.p_id,ml_ac_pic.id as ac_pic_id,ml_ac_pic.acid,ml_ac_pic.pic from ml_activities LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid LEFT JOIN ml_ac_cate ON ml_activities.ac_cate=ml_ac_cate.id where ml_ac_pic.is_first='1' and  ml_activities.ac_status='1' ";

        $activities = Db::query($sql);

        // $result = $activities;
        // $i = 0;
        // foreach ($activities as $key => $value) {
        //     if(!empty($value['pic'])) {
        //         $activities[$key]['pic'] = '/public/static/app/index/images/3.jpg';
        //     }else{
        //         for ( $i=$key+1; $i<count($activities); $i++) {
        //             if ( $value['acid'] == $activities[$i]['acid'] && !empty($value['acid'])) {
        //                 unset($result[$key]);
        //             }
        //         }
        //     }
        // }

        // var_dump($activities);die;
        // return view('index/ActivitiesList', [
        //    "activitiesindex" =>$result
        // ]);

        return view('index/ActivitiesList', [
        "activitiesindex" =>$activities]);
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
        //
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
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }


    public function activitieslistshow ($id)
    {
        
        //根据传过来的分类id,查询所有活动数据
        $activitiessql = "select ml_activities.id as activities_id,
        ml_activities.ac_title,ml_activities.ac_abstract,ml_activities.ac_opentime,ml_activities.ac_closetime,ml_activities.ac_spot,ml_activities.ac_spot,ml_activities.ac_host,ml_activities.ac_cate,ml_activities.ac_details,ml_activities.ac_price,ml_activities.ac_status,ml_activities.ac_contain,ml_activities.bus_id,ml_activities.ac_contact,
        ml_ac_cate.id as ac_cate_id,
        ml_ac_cate.ac_name,ml_ac_cate.p_id,
        ml_ac_pic.id as ac_pic_id,
        ml_ac_pic.acid,ml_ac_pic.pic from ml_activities 
        LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid 
        LEFT JOIN ml_ac_cate ON ml_activities.ac_cate=ml_ac_cate.id 
        where ml_ac_cate.id = {$id} and ml_ac_pic.is_first='1' and  ml_activities.ac_status='1'";
        $activitieslist = Db::query($activitiessql);
        // var_dump($activitieslist);die;
        $this->assign('activitieslist',$activitieslist);
        return view ('index/ActivitiesCateList');
        // ok;
    }

    public function activitiesdetailsshow ($id)
    {   
        //根据传过来的活动id,查询所有活动数据
        $activitiessql = "select ml_activities.id as activities_id,
        ml_activities.ac_title,ml_activities.ac_abstract,ml_activities.ac_opentime,ml_activities.ac_closetime,ml_activities.ac_spot,ml_activities.ac_spot,ml_activities.ac_host,ml_activities.ac_cate,ml_activities.ac_details,ml_activities.ac_price,ml_activities.ac_status,ml_activities.ac_contain,ml_activities.bus_id,ml_activities.ac_contact,
        ml_ac_cate.id as ac_cate_id,
        ml_ac_cate.ac_name,ml_ac_cate.p_id,
        ml_ac_pic.id as ac_pic_id,
        ml_ac_pic.acid,ml_ac_pic.pic from ml_activities 
        LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid 
        LEFT JOIN ml_ac_cate ON ml_activities.ac_cate=ml_ac_cate.id 
        where ml_activities.id = {$id} and ml_ac_pic.is_first='1' and ml_activities.ac_status='1'";
        $activitiesdetails = Db::query($activitiessql);
        $yjf = "select * from ml_ac_pic where acid = {$id} limit 3";
        $yjf = Db::query($yjf);
        
        // var_dump($yjf);  die;
        // var_dump($activitiesdetails);die();
        $this->assign('activitiesdetails',$activitiesdetails);
        $this->assign('yjf',$yjf);
        return view ('index/ActivitiesDetails');
        // ok;
    }
}
