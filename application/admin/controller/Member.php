<?php
namespace app\admin\controller;
use think\Controller;

class Member extends Base {

    public function index(){
        $data = db('member')->paginate(2);
        $this->assign('data',$data);
        return $this->fetch('list');
    }
    public function edit(){
        if (request()->isPost()) {
            $data = [
                'username' => input('username') ,
                'member_id' => input('member_id'),
            ];
            //判断state状态
            if (input('is_lock') == 'on') {
                $data['is_lock'] = 1;
            } else {
                $data['is_lock'] = 0;
            }
            $res = db('member')->update($data);
            if ($res !== false) {
                return $this->success('修改成功', url('Member/index'));

            } else {
                return $this->error('修改失败');
            }
        }
        $data = db('member')->find(input('member_id'));
       // dump($data);exit;
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function del(){
        $member_id = input('member_id');
        $res = db('member')->delete($member_id);
        if($res){
            return $this->success('删除成功',url('Member/index'));
        }else{
            return $this->error('删除失败');
        }
    }


}