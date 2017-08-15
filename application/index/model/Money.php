<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class Money extends Model
{
    //获取用户区的优惠券信息
    public function getNum($id = '',$field = true)
    {
        $query = new Query();
        $res = $query->table('ml_money')->where('m_uid', $id)->field($field)->select();
        return $res;
    }

    //修改用户的优惠券信息
    public function updateNum($id = '', $data = '')
    {
        $detail = model('money');
        $res = $detail->allowField(true)->update($data,['m_uid'=>$id]);
        return $res;
    }
}
