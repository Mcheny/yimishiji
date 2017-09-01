<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 15:33
 */
namespace app\index\controller;

use think\Controller;

class Login extends Controller{
    public function index(){
        return $this->fetch('login');
    }
    public function login(){
        $data = [
            'username' => input('username'),
            'password' => input('password'),
        ];
        $code = input('code');
        //验证用户名,密码和验证码
        if($data['username']==''|| !$data['username']){
            return $this->error('用户名不能为空,请输入用户名...');
        }
        if($data['password']==''|| !$data['password']){
            return $this->error('密码不能为空，请输入密码...');
        }
        if($code==''|| !$code){
            return $this->error('验证码不能为空，请输入验证码...');
        }
        //        判断验证码是否错误
        if(!captcha_check($code)){
           return $this->error('验证码错误，请重新输入...');
        }
//        判断用户名格式是否错误[手机号码格式]
        //判断用户名密码是否存在
        $res=[
            'username'=>$data['username'],
            'password'=>$data['password']
        ];
        $arr = db('member')->where($res)->find();

        if(!$arr){
            return $this->error('用户名或密码错误，请重新输入...');
        }
        session('member',$arr);
        return $this->success('登录成功，极速加载中...',url('Index/index'));
    }
}