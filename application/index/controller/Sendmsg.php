<?php
namespace app\index\controller;
use lib\REST;
class Sendmsg 
{
  public function send()
  {
    $phone = input('phone');
    $array = "0123456789";
    $code='';
    for ($i=0; $i <4 ; $i++) { 
        $code.=substr($array,rand(0,10),1);
    }
    $count = '您的手机验证码为('.$code.'),若不是本人操作请忽略.';
    $result = send_msg($count,$phone);

    if($result['status']){
        $result['string']=$code;
        return json($result);
    }else{
        return json($result);
    }
  }


}