<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/8/21
 * Time: 16:23
 */
namespace app\admin\controller;
class Index extends Base {
    public function index(){
        return $this->fetch('index');
    }
}