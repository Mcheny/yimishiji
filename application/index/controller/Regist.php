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
}