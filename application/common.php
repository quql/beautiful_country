<?php
use lib\REST;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

 function getTree($data,$id=0,$count=0)
{
    static $res=array();
    foreach($data as $val)
    {
        if($val['pid']==$id)
        {
            $val['count']=$count;
            $res[]=$val;
            getTree($data,$val['id'],$count+1);
        }
    }
    return $res;
}

function https_request($url,$data = null)
{
    // curl 初始化
    $curl = curl_init();


    // curl 设置
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    
    // 判断 $data get  or post
    if ( !empty($data) ) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // 执行
    $res = curl_exec($curl);
    curl_close($curl);
    return $res;

}

// function sendTemplateSMS($to,$datas,$tempId)
// {    //短信接口
//     $accountSid= '8aaf07085dbbd708015dbf86b09300fc';

//     //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
//     $accountToken= '45b2daf104dd49bda2c674369a344e80';

//     //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//     //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
//     $appId='8aaf07085dbbd708015dbf86b35f0103';

//     //请求地址
//     //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
//     //生产环境（用户应用上线使用）：app.cloopen.com
//     $serverIP='app.cloopen.com';
//     //请求端口，生产环境和沙盒环境一致
//     $serverPort='8883';

//     //REST版本号，在官网文档REST介绍中获得。
//     $softVersion='2013-12-26';
//      // 初始化REST SDK
//      // global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
//      $rest = new REST($serverIP,$serverPort,$softVersion);
//      $rest->setAccount($accountSid,$accountToken);
//      $rest->setAppId($appId);
    
//      // 发送模板短信
//      // echo "Sending TemplateSMS to $to <br/>";
//      $result = $rest->sendTemplateSMS($to,$datas,$tempId);
//      if($result == NULL ) {
//         $info['status']=false;
//         return $info;
//          // echo "result error!";
//          // break;
//      }
//      if($result->statusCode!=0) {
//          $info['status']=false;
//         return $info;
//          // echo "error code :" . $result->statusCode . "<br>";
//          // echo "error msg :" . $result->statusMsg . "<br>";
//      }else{
//          // echo "Sendind TemplateSMS success!<br/>";
//          // 获取返回信息
//          $smsmessage = $result->TemplateSMS;
//          // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
//          // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
//          $info['status']=true;
//          return $info;
//      }
    function send_msg($count,$mobile)
    {
        $post_data = array();
        $post_data['userid'] = '';
        $post_data['account'] = 'jksc176';
        $post_data['password'] = 'jksc17688';
        $post_data['content'] = $count.'【美丽乡村】';
        $post_data['mobile'] =  $mobile;
        $url='http://sh2.cshxsp.com/sms.aspx?action=send';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
        $task = curl_exec($ch);
        $ruslObj = simplexml_load_string($task, 'SimpleXMLElement', LIBXML_NOCDATA);
        $taskID = $ruslObj->taskID;
        $remainpoint =$ruslObj->remainpoint;
        $message =$ruslObj->message;
        if($message=='操作成功'){
            $res['status'] = true;
        }else{
            $res['status'] = false;
        }
        return $res;
    }
