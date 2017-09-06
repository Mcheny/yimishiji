<?php
namespace app\index\controller;
use think\Controller;
class Pay extends Controller{
 function index(){
     //生成订单号
     $orderId=date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
     $this->assign('orderId',$orderId);
     return $this->fetch('paycenter');
 }
}