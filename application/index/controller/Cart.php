<?php
namespace app\index\controller;
class Cart extends Base{
    function index(){
        $login=$this->doLogin();
        if ($login){
            $arr=db('cart')->field('good_id,good_num,spPrice')->where(['member_id'=>session('customer')])->select();
            $this->assign('data',$arr);
            return $this->fetch('cart');
        }
    }


    function add()
    {

        $good_id = input('good_id');
        $good_num = input('good_num');
        $spPrice = input('spPrice');
        $login = $this->doLogin();
        if ($login) {
            //如果登录了就直接添加到数据库中
            $addate=[
                'member_id'=>session('customer'),
                'good_id'=>$good_id,
                'good_num'=>$good_num,
                'spPrice' => $spPrice
            ];
            //判断添加的是否是同一商品
            $r=db('cart')->where(['good_id'=>$good_id])->find();
            if($r){
                $r['good_num']+=$good_num;
                $result=db('cart')->update($r);
                if ($result){
                    $response = [
                        'status' => 'success',
                        'msg' => '添加成功'
                    ];
                    return json($response);
                }
            }else{
                $res=db('cart')->insert($addate);
                if ($res){
                    $response = [
                        'status' => 'success',
                        'msg' => '添加成功'
                    ];
                    return json($response);
                }
            }




        } else {
            //先判断cookie是否有商品
            $cookie = cookie('cart');
            $data = [
                'good_id' => $good_id,
                'good_num' => $good_num,
                'spPrice' => $spPrice,
                'selected' => 1
            ];

//如果有商品的话，要加商品合并，一样的累加
            if ($cookie) {
                $cart = unserialize($cookie);
                //判断是否重复good_id键
                if (array_key_exists($good_id, $cart)) {
                    $cart[$good_id]['good_num'] += $data['good_num'];
                    $cart = serialize($cart);
                    cookie('cart', $cart);
                } else {
                    //cookie里不存在该商品
                    $cart[$good_id] = $data;
                    $cart = serialize($cart);
                    cookie('cart', $cart);
                }
            } else {
                //cookie里不存在该商品
                $cart[$good_id] = $data;
                $cart = serialize($cart);
                cookie('cart', $cart);
            }
            $response = [
                'status' => 'success',
                'msg' => '添加成功'
            ];
            return json($response);
        }
    }
    // }
    //跳订单填写信息
    function check()
    {

        return $this->fetch('cart-checkout');
    }

    function address()
    {
        $data = [
            'member_id' => 1,
            'area' => input('city'),
            'addr' => input('local'),
            'name' => input('name'),
            'mobile' => input('phone'),

        ];

        $res = db('address')->insert('$data');
        if ($res) {
            $addr = db('address')->field('area')->where(['member_id' => '1'])->select();
            if ($addr) {
                return json($addr);
            }
        }
    }

}