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
//            'code' => input('code'),
        ];
        db('member')->insert($data);
        return $this->success('注册成功，极速加载中...',url('Login/index'));
        exit;
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
        if($data['code']==''|| !$data['code']){
            return $this->error('验证码不能为空，请输入验证码...');
        }
//        判断验证码是否错误
        if(!captcha_check($data['code'])){
            return $this->error('验证码错误，请重新输入...');
        }
        //判断用户名密码是否存在
        $arr = db('member')->where(['username'=>$data['username']])->find();

        if(!$arr){
            return $this->error('用户名或密码错误，请重新输入...');
        }
        if($arr['password'] != md5($data['password'])){
            return $this->error('用户名或密码错误，请重新输入...');
        }
        //成功之后跳转到登录“提示信息注册成功”
        session('member',$arr);
        return $this->success('账号注册成功，极速加载中...',url('Login/index'));
    }
    //修改密码
        public function modify(){
            return $this->fetch('modify');
        }
        public function edit(){
            //成功之后跳转到登录“提示信息修改成功”
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'repassword' =>input('repassword'),
//            'code' => input('code'),
            ];
            db('member')->update($data);
            return $this->success('注册成功，极速加载中...',url('Login/index'));
        }
}