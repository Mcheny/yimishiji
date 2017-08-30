<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/8/30
 * Time: 15:55
 */
namespace app\index\controller;

use think\Controller;

class Cart extends Controller{
    public function index(){
        return $this->fetch('cart');
    }
    public function checkout(){
        return $this->fetch('cart-checkout');
    }
}