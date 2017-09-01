<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 16:27
 */
namespace app\index\controller;

use think\Controller;

class Product extends Controller{
    public function index(){
        return $this->fetch('product');
    }
    public function products(){
        return $this->fetch('products');
    }
}