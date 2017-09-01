<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/9/1
 * Time: 10:34
 */
namespace app\index\controller;

use think\Controller;

class Modify extends Controller{

    public function index(){
        return $this->fetch('modify');
    }
    //修改密码
    public function modify()
    {
        //遍历数据库，查询所有栏目
        if (request()->isPost()) {
            $data = [
                'username' => input('username'),
                'password' => input('password'),
            ];
            if ('password' != '') {
                $data['password'] = input('password');
            }

            $res = db('member')->where('password')->update($data);

            if ($res !== false) {
                return $this->success('修改成功', url('Login/index'));

            } else {
                return $this->error('修改失败');
            }

        }

    }
}