<?php
namespace app\index\controller;
use think\Controller;
class Index  extends Controller
{
    public function index()
    {
        //顶级分类信息
        $data=db('cate')->query('SELECT g.good_id,g.good_name,g.sell_price,i.image_url  FROM yimi_goods as g LEFT JOIN yimi_image as i ON g.good_id=i.goods_id WHERE cate_id=1 ');
        //dump($data);
        $this->assign('data',$data);
       return $this->fetch('index');
    }
    //登陆后 跳到购物车页面
    public  function enter(){
        session('customer',1);
        $cookie=cookie('cart');
        if($cookie){
            $data=unserialize(cookie('cart'));
            //将购物车cookie里的信息添加到数据库
            foreach ($data as  $val){
                $val['member_id']=session('customer');
                $res=db('cart')->insert($val);
            }
            //清空cookie
            cookie('cart',null);
            if ($res){
                return $this->success('正在跳转...','Cart/index');
            }
        }
    }
}
