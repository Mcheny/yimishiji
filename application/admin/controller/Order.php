<?php
namespace app\admin\controller;
class Order extends Base{
    function index()
    {
        return $this->fetch('list');
    }
    function add(){
        return $this->fetch('add');
    }
    function edit(){
        return $this->fetch('edit');
    }
    function del(){

    }
}