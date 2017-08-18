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
    public function save(Request $request,$id)
    {

        $info = $request->post();
        //获取活动id
        $id=$id;
        // var_dump($id);die;
        //获取商家id
        $sql="select ml_activities.bus_id from ml_activities where id = {$id}";
        $bus_id=Db::query($sql);
        $bus_id = $bus_id['0']['bus_id'];
        // var_dump($bus_id);die;
        //获取用户id
        $uid = input('session.u_id');

        if(empty($uid)){
            $this->error('请先登录哦~~~~','index/index/index');
        }
        //获取当前时间
        $time = date('Y-m-d H:i:s',time());

        //获取活动开始与结束时间
        $sqltime="select ml_activities.ac_opentime,ml_activities.ac_closetime from ml_activities where id = {$id}";
        // var_dump($sqltime);die;
        $activitiestime = Db::query($sqltime);
        //获取活动开始时间
        $ac_opentime = $activitiestime['0']['ac_opentime'];
        //获取活动结束时间
        $ac_closetime =  $activitiestime['0']['ac_closetime'];
        //获取报名起始与活动起始的时间戳
        $ac_opentime_stamp = strtotime($ac_opentime);
        $ac_closetime_stamp = strtotime($ac_closetime);
        // var_dump($ac_closetime_stamp);die;
        $ar_opentime_stamp = strtotime($info['opentime']);
        $ar_closetime_stamp = strtotime($info['closetime']);

        // var_dump($ar_opentime_stamp);die;

        if ($info['opentime'] == null || $info['closetime'] == null || $info['amount']== null || $info['condinator'] == null || $info['contact'] == null) {

            $this->error('请填写完成所有带星标的信息,谢谢!');
            # code...
        }

        if ($ar_opentime_stamp>=$ac_opentime_stamp && $ar_opentime_stamp<=$ac_closetime_stamp && $ar_closetime_stamp>=$ac_opentime_stamp && $ar_closetime_stamp<=$ac_closetime_stamp) {

             $data = [
            'ar_opentime' => $info['opentime'],
            'ar_closetime' => $info['closetime'],
            'ar_amount' => $info['amount'],
            'ar_condinator' => $info['condinator'],
            'ar_contact' => $info['contact'],
            'ar_comments' => $info['comments'],
            'ar_submit_time' => $time,
            'ar_bus_id' => $bus_id,
            'ar_activities_id' => $id,
            'ar_user_id'=> $uid
            ];

            // var_dump($data);die;

        //添加进数据库
        $result = Db::table('ml_activities_register')->insert($data);

            if ($result > 0 ) {
                //添加数据到活动统计
                // model('count')->active();

                //如果添加提交成功
                $this->success('报名信息提交成功,商家会尽快给您联系');
            } else {
                //失败则回到注册页 自动触发一次注册按钮
                $this->error('(⊙o⊙)网络异常,您的报名信息提交失败,烦请重新提交,谢谢!');
            }
        }else{
            $this->error('报名时间区间需要在活动时间区间内');
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
        return view ('activities/ActivitiesCateList');
        // ok;
    }

    public function activitiesdetailsshow ()
    {   
        $data = input();
        //var_dump($data);
        $id = $data['id'];
        //var_dump($id);
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
        // var_dump($activitiesdetails);  die;
        // var_dump($activitiesdetails);die();
        $this->assign('activitiesdetails',$activitiesdetails);
        $this->assign('yjf',$yjf);
        return view ('activities/ActivitiesDetails');
        // ok;
    }
}
