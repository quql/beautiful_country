<?php

namespace app\index\model;

use think\Db;
use think\Model;

class UserDetail extends Model
{
    public function updateDetail($id = '', $data = '')
    {
        $detail = model('user_detail');
        $res = $detail->allowField(true)->update($data,['ud_uid'=>$id]);
        return $res;
    }


}
