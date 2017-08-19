<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Comment extends Controller
{
    /**
     * 添加评论前传递id.
     *
     * @return \think\Response
     */
    public function create($id)
    {
        //参数为订单的id
        //根据订单id 获取对应产品的名称 用户的id 分类id 商品的id
        $good = Db::name('order')->where('o_id', $id)->find();

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
        //dump($data);die;
        return json($data);

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
        //加载此条评论
        $comment = Db::name('comment')->where('c_id', $id)->find();
        if($comment){
            $data['status']=true;
            $data['text']=$comment['c_text'];
            $data['score']=$comment['c_score'];
            $data['gname']=$comment['c_gname'];
            $data['c_id']=$id;
        }else{
            $data['status']=false;
        }
        return json($data);
    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $info = $request->post();
        $id=$info['c_id'];
        $data=[
            'c_score'=>$info['score'],
            'c_text'=>$info['text']
        ];
        $result = Db::table('ml_comment')->where('c_id',$id)->update($data);
        //var_dump($result);
        if ($result) {
            $this->success('修改成功');
        } else {
            $this->success('修改失败,请刷新重试!');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result = Db::name('comment')->delete($id);
        if ($result) {
            $info['status'] = true;
            $info['info'] = '此条评论已删除';
        } else {
            $info['status'] = false;
            $info['info'] = '删除失败,请重试!';
        }
        return json($info);
    }
}
