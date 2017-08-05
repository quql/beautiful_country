<?php

namespace app\index\model;

use think\Model;

class Cart extends Model
{
    //删除商品
    public function delete($id = '')
    {
        $db = db('cart');
        $res = $db->delele($id);
        return $res;
    }
}
