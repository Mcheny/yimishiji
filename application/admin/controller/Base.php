<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller{
    public function _initialize()
    {
        parent::_initialize();
        $this->isLogin();

    }
    public function isLogin(){
        $admin=session('admin');
       // dump($admin);exit;
        if(!isset($admin)){
            return $this->error('请先登录','Login/login');
        }
    }
}