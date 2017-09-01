<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 16:36
 */
namespace app\admin\controller;

/**
 * Class Error
 * @package app\admin\controller
 * 空控制器
 */
class Error{

    public function _empty(){
        echo '网址输入错误';
        exit;
    }
}