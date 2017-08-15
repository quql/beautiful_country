<?php

namespace app\index\model;

use think\db\Query;
use think\Model;

class Cart extends Model
{
    public function getMsg($arr = [])
    {
        $query = new Query();
        static $n = array();
        foreach($arr as $v){
            $num = $query->table('ml_cart')->where('ca_id', $v)->select();
            $n[] = $num[0];
            //dump($n);
        }
        return $n;
    }

    public function insert($data = '')
    {
        //添加信息到购物车表
        $cart = db('cart');
        $list = $cart->insert($data);
        return $list;
    }
    //查询购物车信息
    public function getCart($id = '')
    {
        $query = new Query();
        $res = $query->table('ml_cart')->where('ca_uid', $id)->select();
        return $res;
    }
    //删除商品
    public function delete($id = '')
    {
        $db = db('cart');
        $res = $db->delete($id);
        return $res;
    }

    public function getAll()
    {
        $query = new Query();
        $res = $query->table('ml_food f,ml_food_pic fp,ml_route r,ml_route_pic rp,ml_scenery s,ml_scenery_pic sp')
            ->field('f.gd_title,f.c_id,fp.pic,r.gd_title,r.c_id,rp.pic,s.gd_title,s.c_id,sp.pic')
            ->select();
        return $res;
    }
}
