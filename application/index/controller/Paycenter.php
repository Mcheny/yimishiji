<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 16:25
 */
namespace app\index\controller;

use think\Controller;

class Paycenter extends Controller{
    public function index(){
        return $this->fetch('paycenter');
    }
}