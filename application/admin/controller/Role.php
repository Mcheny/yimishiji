<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/29
 * Time: 0:29
 */

namespace add\admin\controller;

use think\Controller;

class Role extends Controller{
    public function index(){
        return $this->fetch();
    }
}