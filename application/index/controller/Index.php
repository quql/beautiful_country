<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Url;
use think\Db;
use phpmailer\phpmailer;
use think\Session;

class Index extends Base
{
    public function index()
    {
        //查询轮播图
        $pic=Db::name('pic')->where('is_show','1')->select();
        //查询特产美食数据
        $sql1="select ml_food.*,ml_food_pic.pic,ml_business.b_name from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid LEFT JOIN ml_business ON ml_food.bus_id=ml_business.b_id  where ml_food_pic.is_first='1' and  ml_food.gd_is_sale='1'";
        $food=Db::query($sql1);
        //dump($food);
//die;
        //热推线路TOP10
        $sql2="select ml_route_detail.*,ml_route_pic.pic,ml_route.c_id,gd_title,gd_abstract,bus_id,ml_business.b_name from ml_route_detail LEFT JOIN ml_route ON ml_route_detail.c_gid=ml_route.id LEFT JOIN ml_business ON ml_route.bus_id=ml_business.b_id LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid WHERE ml_route.gd_is_sale='1' and ml_route_pic.is_first='1' ORDER BY gd_view desc limit 5";
        $routes = Db::query($sql2);
        //dump($routes);

        //热门景点
        $sql3="select ml_scenery_detail.*,ml_scenery_pic.pic,ml_scenery.c_id,gd_title,gd_abstract,bus_id,ml_business.b_name,b_province,b_city,b_area from ml_scenery_detail LEFT JOIN ml_scenery ON ml_scenery_detail.c_gid=ml_scenery.id LEFT JOIN ml_business ON ml_scenery.bus_id=ml_business.b_id LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid WHERE ml_scenery.gd_is_sale='1' and ml_scenery_pic.is_first='1' ORDER BY gd_view desc limit 6";
        $scenery = Db::query($sql3);
        //dump($scenery);
        //exit;

        //查询友情链接数据
        $link = Db::name('link')->select();

        //查询精彩活动的数据
        $activitiessql = "select ml_activities.id as activities_id,ml_activities.ac_title,ml_activities.ac_abstract,ml_activities.ac_opentime,ml_activities.ac_closetime,ml_activities.ac_spot,ml_activities.ac_spot,ml_activities.ac_host,ml_activities.ac_cate,ml_activities.ac_details,ml_activities.ac_price,ml_activities.ac_status,ml_activities.ac_contain,ml_activities.bus_id,ml_ac_cate.id as ac_cate_id,ml_ac_cate.ac_name,ml_ac_cate.p_id,ml_ac_pic.id as ac_pic_id,ml_ac_pic.acid,ml_ac_pic.pic from ml_activities LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid LEFT JOIN ml_ac_cate ON ml_activities.ac_cate=ml_ac_cate.id where ml_ac_pic.is_first='1' and  ml_activities.ac_status='1'";
        // where ml_ac_pic.is_first='1'
             //查询精彩活动的数据
       $linksql = "select * from ml_activities
         LEFT JOIN ml_ac_pic ON ml_activities.id=ml_ac_pic.acid
         LEFT JOIN ml_ac_cate ON ml_activities.ac_cate=ml_ac_cate.id";

        $activities = Db::query($linksql);
        // var_dump($activities);die;

        $activitiesindex = Db::query($activitiessql);
        // var_dump($activitiesindex);
        // die;
//        dump($scenery);
//        exit;
        return view('index/index',[
            'foods'=>$food,
            'pics'=>$pic,
            'link' =>$link,
            'activities' =>$activities,
            'hotroute'=>$routes,
            'hotscenery'=>$scenery,
            'activitiesindex'=>$activitiesindex
        ]);
    }

    public function loginout()
    {
       session('u_id',null);
       $this->success('退出成功','index/index/index');
    }

    //显示列表页
    public function read($id)
    {
        //判断用户查看的类型
        if($id==4){
            //查询主表字段和封面图片
           $list = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,c_id,bus_id,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1'");
        }elseif($id==5){
            $list = Db::query("select ml_route.id,gd_title,gd_abstract,price,c_id,bus_id,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1'");
        }elseif($id==1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,c_id,bus_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1'");
        }elseif($id==6){
            $list = Db::query("select ml_food.id,gd_title,gd_abstract,price,c_id,bus_id,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1'");
        }else{
            return '暂无数据';
        }
//        var_dump($list);
//        die;
        $this->assign('list',$list);
        return view ('index/list');
    }


    public function search(Request $request)
    {
        $data=$request->post('search');
        if(empty($data)){
            $data = 'sadaddadadadada536746 gewafd';
        }

        static $arr=array();
        $arr1 = Db::name('hotel')
                 ->field('id,gd_title,c_id')
                 ->where("gd_title",'like',"%$data%")
                 ->select();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr2 = Db::name('food')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr3 = Db::name('route')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $arr[]=$v;
            }
        }

        $arr4 = Db::name('scenery')
            ->field('id,gd_title,c_id')
            ->where("gd_title",'like',"%$data%")
            ->select();
        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $arr[]=$v;
            }
        }
        //var_dump($arr);
        return json($arr);
    }//

    //显示不同分类的商品列表
    //显示列表页
    public function listshow()
    {
        $data =input();
        $id = $data['id'];
        $cateid = $data['cid'];

       // 判断用户查看的类型
        if($id==4){
            //查询主表字段和封面图片
            $list = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,bus_id,c_id,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.h_cate={$cateid}");
        }elseif($id==5){
            $list = Db::query("select ml_route.id,gd_title,gd_abstract,price,bus_id,c_id,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.h_cate={$cateid}");
        }elseif($id==1){
            $list = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.h_cate={$cateid}");
        }elseif($id==6){
            $list = Db::query("select ml_food.id,gd_title,gd_abstract,price,bus_id,c_id, ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.h_cate={$cateid}");
        }else{
            return '暂无数据';
        }

       // var_dump($list);
       // die;

        $this->assign('list',$list);
        return view ('index/list');
    }

//搜索触发
    public function souover()
    {

        $data=input('search');

        if(empty($data)){
            $this->error('请输入关键字~~','index/index/index');
        }

            //查询主表字段和封面图片
            $arr1 = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,bus_id,c_id,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.gd_title like '%$data%' ");

            $arr2 = Db::query("select ml_route.id,gd_title,gd_abstract,price,bus_id,c_id,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.gd_title like '%$data%' ");

            $arr3 = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_title like '%$data%' ");

            $arr4 = Db::query("select ml_food.id,gd_title,gd_abstract,price,bus_id,c_id,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.gd_title like '%$data%' ");

        static $list=array();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $list[]=$v;
            }
        }
        if(empty($list)){
            $this->error('没有找到哦~~~','index/index/index');
        }
        $this->assign('list',$list);
        return view ('index/list');
    }//

    public function searchover()
    {

        $data=input('search');

        if(empty($data)){
            $data = 'sadaddadadadada536746 gewafd';
        }

        //查询主表字段和封面图片
        $arr1 = Db::query("select ml_hotel.id,gd_title,gd_abstract,price,bus_id,c_id,ml_hotel_pic.pic from ml_hotel LEFT JOIN ml_hotel_pic ON ml_hotel.id=ml_hotel_pic.gid where ml_hotel_pic.is_first='1' AND ml_hotel.gd_title like '%$data%' ");

        $arr2 = Db::query("select ml_route.id,gd_title,gd_abstract,price,bus_id,c_id,ml_route_pic.pic from ml_route LEFT JOIN ml_route_pic ON ml_route.id=ml_route_pic.gid where ml_route_pic.is_first='1' AND ml_route.gd_title like '%$data%' ");

        $arr3 = Db::query("select ml_scenery.id,gd_title,gd_abstract,price,bus_id,c_id,ml_scenery_pic.pic from ml_scenery LEFT JOIN ml_scenery_pic ON ml_scenery.id=ml_scenery_pic.gid where ml_scenery_pic.is_first='1' AND ml_scenery.gd_title like '%$data%' ");

        $arr4 = Db::query("select ml_food.id,gd_title,gd_abstract,price,bus_id,c_id,ml_food_pic.pic from ml_food LEFT JOIN ml_food_pic ON ml_food.id=ml_food_pic.gid where ml_food_pic.is_first='1' AND ml_food.gd_title like '%$data%' ");

        static $list=array();

        if(!empty($arr1)){
            foreach($arr1 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr2)){
            foreach($arr2 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr3)){
            foreach($arr3 as $key=>$v){
                $list[]=$v;
            }
        }

        if(!empty($arr4)){
            foreach($arr4 as $key=>$v){
                $list[]=$v;
            }
        }

        $this->assign('list',$list);
        return view ('index/list');
    }//

    public function email($toemail='695260422@qq.com')
    {
       $toemail = input('email');//定义收件人的邮箱
        //生成一个随机四位数 保存在session中
        $vcode=rand(1000,9999);
//        Session::set('vcode',$vcode,'think');
        $options = [
            // 缓存类型为redis
            'type' => 'redis',
            'host' => '127.0.0.1',
            // 默认缓存有效期为永久有效
            'expire' => 0,
            // 指定缓存目录
            'path' => APP_PATH . 'runtime/cache/',
        ];
        //初始化缓存
        cache($options);
        //设置缓存
        cache('vcode', $vcode, 180);

        $mail = new PHPMailer(); //建立邮件发送类
        $mail->CharSet = "UTF-8";
        $address ="13127573831@163.com";
        $mail->IsSMTP(); // 使用SMTP方式发送
        $mail->Host = "smtp.163.com";
        $mail->SMTPAuth = true; // 启用SMTP验证功能
        $mail->Username = "13127573831@163.com";
        $mail->Password = "shanshan123";
        $mail->Port=25;
        $mail->From = "13127573831@163.com"; //邮件发送者email地址
        $mail->FromName = "在线Q聊";
        $mail->AddAddress($toemail, "邮箱测试");
        //$mail->AddReplyTo("", "");//设置回复人信息
        $mail->IsHTML(true); //是否使用HTML格式

        $mail->Subject = "邮箱测试"; //邮件标题
        $mail->Body = "您的验证码是:".$vcode. ",三分钟内验证有效"; //邮件内容，上面设置HTML，则可以是HTML
        if(!empty(cache('vcode'))){
            if(!$mail->Send())
            {
                $result['status']=false;
                $result['info']='验证码获取失败,请重新点击获取';
                //echo "错误原因: " . $mail->ErrorInfo;
                //exit;
            }else{
                $result['status']=true;
                $result['info']='验证码已发送到您的邮箱,请在有效期内输入';
            }
        }else{
            $result['status']=false;
            $result['info']='验证码获取失败,请重新点击获取';
        }

        return json($result);
    }
}
