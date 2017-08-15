<?php
namespace app\index\controller;
use lib\REST;
class Sendmsg 
{
  public function send()
  {
    $arr = array(0,1,2,3,4,5,6,7,8,9);
    $newArr = array_rand($arr,4);
    $string = implode("",$newArr);
    $result = sendTemplateSMS("18121280312",array("$string",'5'),"1");//手机号码，替换内容数组，模板ID
    return json($result);
  }
}