<?php
namespace app\index\controller;
use think\Controller;
class Products extends Controller{
    function index(){
        //获取good_id
        $id=input('id');
        $data=db('goods')->where(['good_id'=>$id])->find();
        $this->assign('data',$data);
        return $this->fetch('product');
    }
    function showProduct(){
        $data=db('goods')->select();
        $this->assign('data',$data);
        return $this->fetch('products');
    }
}