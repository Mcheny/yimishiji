<?php
namespace app\index\controller;
use think\Controller;
class Login extends Controller{
    function index(){
        return $this->fetch('login');
    }
}