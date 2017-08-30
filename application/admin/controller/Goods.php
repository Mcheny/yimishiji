<?php

namespace app\admin\controller;
use app\admin\model\Goods as GoodsModel;
use app\admin\model\Img as ImageModel;
use Think\Db;

class Goods extends Base
{
    function goodsList()
    {
        $goods=db('goods')->select();
        $this->assign('data',$goods);
      return $this->fetch('list');
    }
    //添加
    function add(){
        if(request()->isPost()){
            $goods=[
                'good_name'=>input('goods_name'),
                'sell_price'=>input('sell_price'),
                'market_price'=>input('market_price'),
                'cate_id'=>input('id'),
                'store'=>input('store'),
                'desc'=>input('desc'),
                'content'=>input('content'),
                'last_modify_id'=>input('last_modify_id'),
                'last_modify_time'=>time(),
                'is_up'=>input('is_up'),

            ];

            if($_FILES['file']['tmp_name']==''||!$_FILES['file']['tmp_name']){
                return $this->error('\'必修上传封面图片\'');

            }
            //上传图片
            $file=ImageModel::upload('file');
            if($file['status']=='success'){
                $img_url=$file['img_url'];
            }else{
                return $this->error('上传失败');
            }

            //添加到goods
            $res=db('goods')->insertGetId($goods);
            //把商品在添加到分类表中
            $data=[
                'id'=>input('id'),
                'name'=>input('goods_name')
            ];
            //要拿到good_id所有返回了一个
            $goodId=GoodsModel::insertCate($data);

            //缩放图
            $img_b_url=ImageModel::thumb($img_url,650,650);
            $img_m_url=ImageModel::thumb($img_url,240,240);
            $img_s_url=ImageModel::thumb($img_url,120,120);
            //存放数据库中
            $imgData=[
                'goods_id'=>$res,
                'image_url'=>$file['img_url'],
                'image_b_url'=>$img_b_url,
                'image_m_url'=>$img_m_url,
                'image_s_url'=>$img_s_url
            ];
            $resimg=Db::name('image')->insert($imgData);
//三者都添加成功才算成功（商品，商品分类，图片）
            if($res&&$goodId&&$resimg){
                $this->success('添加成功','goodsList');
            }else{
                $this->error('添加失败');
            }
        }
        //将分类排序完后传给页面
        $arr=db('cate')->order('path')->select();
        foreach ($arr as $key=>$val){
            $arr[$key]['name']=str_repeat('--',$val['level']).$val['name'];
        }
        $this->assign('data',$arr);
        return $this->fetch('add');
    }

    //图片管理
    function editImg(){
        //查询商品
        $id=input('id');
        $data=db('goods')->field('good_id,good_name')->where(['good_id'=>$id])->find();
        $this->assign('data',$data);
       //查询商品下的图片
        $id=input('id');
        $imglist=db('image')->field('id,goods_id,image_url,is_face')->where(['goods_id'=>$id])->select();
        $this->assign('imglist',$imglist);
        return $this->fetch('menimg');
    }
//修改
    function edit(){

        return $this->fetch('edit');
    }
    //删除
    function del(){

    }
    //添加图片
    function addpic(){
        if(request()->isPost()){
            if (!$_FILES['file']['tmp_name']||$_FILES['file']['tmp_name']==""){
                return $this->error('请上传图片');

            }
            if($_FILES['file']['tmp_name']){
                $file=request()->file('file');
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');//DS反斜线
                if($info){
                    //生成图片路径
                    $fileload='/uploads/'.$info->getSaveName();
                    $fileload=str_replace('\\','/',$fileload);
                    $data['pic']=$fileload;
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
            //上传的新图搞成缩放图
            $img_b_url=ImageModel::thumb($fileload,650,650);
            $img_m_url=ImageModel::thumb($fileload,240,240);
            $img_s_url=ImageModel::thumb($fileload,120,120);

            $imgall=[
                'goods_id'=>input('goods_id'),
                'image_url'=>$fileload,
                'image_b_url'=>$img_b_url,
                'image_m_url'=>$img_m_url,
                'image_s_url'=>$img_s_url,
                'is_face'=>0
            ];
            $res=db('image')->insert($imgall);
            if($res){
                return $this->success('添加成功','goodsList');
            }else{
                return $this->error('添加失败');
            }
        }
        //传一个该商品id和名称的数组
        $data=db('goods')->field('good_id,good_name')->where(['good_id'=>input('id')])->find();
        $this->assign('data',$data);
        return $this->fetch('addimage');
    }
}