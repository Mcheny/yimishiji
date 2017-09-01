<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 15:35
 */
namespace app\index\controller;

use think\Controller;

class Regist extends Controller{
    public function index(){
        return $this->fetch('regist');
    }
    public function regist(){
        $data = [
            'username' => input('username'),
            'password' => input('password'),
            'repassword' =>input('repassword'),
        ];
            $code = input('code');
        //验证用户名,密码和验证码
        if($data['username']==''|| !$data['username']){
            return $this->error('用户名不能为空,请输入用户名...');
        }
        if($data['password']==''|| !$data['password']){
            return $this->error('密码不能为空，请输入密码...');
        }
        if($data['repassword']!==$data['password']){
            return $this->error('您两次输入的密码不一致...');
        }
        if($code==''|| !$code){
            return $this->error('验证码不能为空，请输入验证码...');
        }
//        判断验证码是否错误
        if(!captcha_check($code)){
            return $this->error('验证码错误，请重新输入...');
        }
        //判断用户名是否已经注册过
        $arr = db('member')->where(['username'=>$data['username']])->find();
        if($arr){
            return $this->error('注册失败，该用户已注册...');
        }
        db('member')->insert($data);
        return $this->success('恭喜你注册成功，马上进入用户页面，请稍等...',url('Login/index'));

    }
}