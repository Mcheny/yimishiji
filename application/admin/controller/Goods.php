<?php

namespace app\admin\controller;
class Goods extends Base
{
    function goodsList()
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