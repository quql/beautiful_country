<?php
namespace app\index\controller;
use lib\REST;
class Sendmsg 
{
  public function send()
  {
    $phone = input('phone');
    $arr = array(0,1,2,3,4,5,6,7,8,9);
    $newArr = array_rand($arr,4);
    $string = implode("",$newArr);
    $result = sendTemplateSMS("$phone",array("$string",'5'),"1");
    
    if($result['status']){
        $result['string']=$string;
        return json($result);
    }else{
        return json($result);
    }
  }
}