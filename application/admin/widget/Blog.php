<?php
namespace app\admin\widget;
use think\Controller;

class Blog extends Controller{
    function header(){
        return $this->fetch('common/header');
    }
    function left(){
        return $this->fetch('common/left');
    }
}