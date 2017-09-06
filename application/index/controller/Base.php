<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller{
    public function _initialize()
    {
        parent::_initialize();

    }
      public function isLogin(){
        $admin=session('coustomer');
        //dump($admin);exit;
        if(empty($admin) || !$admin){
            return false;
        }else{
            return $admin;
        }
    }
    public function doLogin(){
        $customer=session('customer');
        if($customer==null){
            return $this->error('请先登录',url('Login/index'));
        }else{
            return true;
        }
    }
}