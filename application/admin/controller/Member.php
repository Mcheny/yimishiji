<?php
namespace app\admin\controller;
use think\Controller;

class Member extends Controller {
    public function index(){
        return $this->fetch('list');
    }

}