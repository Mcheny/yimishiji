<?php
namespace app\admin\controller;
use think\Controller;

class Manager extends Controller {
    /**
     * 空操作
     *
     */
    public function _empty()
    {
        echo '网址输入错误';
        exit;
    }

    public function index(){
        $data = db('manager')
            ->alias('m')
            ->field('m.id,m.username,m.password,m.is_lock,r.rolename')
            ->join('role r', 'm.role_id=r.role_id')
            ->paginate(2);
        //echo db()->getLastSql();exit;
        $this->assign('data',$data);
        return $this->fetch("list");
    }


    public function add(){
        if(request()->isPost()){
            $data = [
                'username' => input('username') ,
                'password' => md5(input('password')) ,
                'role_id' => input('role_id'),
            ];
            //判断state状态
            if (input('is_lock') == 'on') {
                $data['is_lock'] = 1;
            } else {
                $data['is_lock'] = 0;
            }

            //验证
            $validate = validate('Manager');
            if(!$validate->scene('add')->check($data)){
                return $this->error($validate->getError());
            }

            //添加数据
            $res = db('manager')->insert($data);

            if($res){
                return $this->success('添加成功',url('Manager/index'));
            }else{
                return $this->error('添加失败');
            }

        }
        //查询所有管理员等级
        $role = db('role')->select();
        $this->assign('role', $role);
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        $data = db('manager')->find($id);
        $role = db('role')->select();
        $this->assign('role', $role);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function doEdit(){
        $username=input('username');
        $password=input('password');
        $role_id =input('role_id');
        $id =input('id');
        $data = [];
        $data['username'] = $username;
        $data['id'] = $id;
        if($password != ''){
            $data['password'] = md5($password);

        }
        //判断state状态
        if (input('is_lock') == 'on') {
            $data['is_lock'] = 1;
        } else {
            $data['is_lock'] = 0;
        }
        if($role_id == '1'){
            return $this->error('超级管理员不能冻结');
        }

        //验证
        $validate = validate('Manager');
        if(!$validate->scene('edit')->check($data)){
            return $this->error($validate->getError());
        }

        $res = db('manager')->update($data);
        if($res !== false){
            return $this->success('修改成功',url('Manager/index'));
        }else{
            return $this->error('修改失败');
        }
    }

    public function del(){
        $id = input('id');
        $role_id = input('role_id');
        if($role_id == '1'){
            return $this->error('超级管理员不能删除');
        }
        $res = db('manager')->delete($id);

        if($res){
            return $this->success('删除成功',url('Manager/index'));
        }else{
            return $this->error('删除失败');
        }
    }
}