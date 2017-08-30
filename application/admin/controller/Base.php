<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller{
    public function _initialize()
    {
        parent::_initialize();
    }
    /**
     * 空操作
     *
     */
    public function _empty()
    {
        echo '网址输入错误';
        exit;
    }
}