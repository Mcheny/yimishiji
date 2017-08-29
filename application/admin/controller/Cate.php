<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/29
 * Time: 14:48
 */
namespace app\admin\controller;

use think\Controller;

class Cate extends Controller{
    public function index(){
        return $this->fetch();
    }
}