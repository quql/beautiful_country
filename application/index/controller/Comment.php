<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Comment extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create($id)
    {
        //参数为订单的id
        //根据订单id 获取对应产品的名称 用户的id 分类id 商品的id
        $good = Db::name('order')->where('o_id', $id)->find();
        dump($good);
        if (!empty($good)) {
            $data = [
                'oid' => $id,
                'bid' => $good['o_bid'],
                'gid' => $good['o_gid'],
                'cid' => $good['o_cid'],
                'uid' => $good['o_uid'],
                'gname' => $good['o_gname'],
                'status' => true
            ];
        } else {
            $data['status'] = false;
        }
        return json($id);

    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //获取表单提交的数据
        $arr = $request->post();
        //dump($arr);
        $data = [
            'c_gid' => $arr['gid'],
            'c_uid' => $arr['uid'],
            'c_cid' => $arr['cid'],
            'c_bid' => $arr['bid'],
            'c_oid' => $arr['oid'],
            'c_gname' => $arr['gname'],
            'c_text' => $arr['content'],
            'c_score' => $arr['score'],
            'c_time' => date('Y-m-d H:i:s')
        ];
        //dump($data);
        $res = Db::name('comment')->insert($data);
        if ($res) {
            $this->success('评论已提交O(∩_∩)O');
        } else {
            $this->error('啊偶~~失败了,不要气馁,再来一次');
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //用户的id
        //$uid = input('session.u_id');
        //加载已完成订单的评论
        $comment = Db::name('comment')->where(['c_oid' => $id])->find();
        return json($comment);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
