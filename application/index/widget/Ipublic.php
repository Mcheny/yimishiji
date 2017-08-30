<?php
namespace app\index\widget;
use think\Controller;

class Ipublic extends Controller{
    function header(){
        return $this->fetch('common/header');
    }
    function head(){
        return $this->fetch('common/head');
    }
    function footer(){
        return $this->fetch('common/footer');
    }
}