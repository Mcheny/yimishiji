<?php

namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use think\Controller;
use Think\Db;
use think\Request;
class  Cate extends Controller {
    public $request;
    function _initialize(){
        parent::_initialize();
        $this->request=Request::instance();
    }
    function index(){
        $data=CateModel::getAllCate();
        $this->assign('data',$data);

        return $this->fetch('list');
    }
    /**
     * 添加顶级分类
     */
    function topCate(){
        if($this->request->isPost()){
            //原生写法
            $name=$this->request->param('name');
            $data=[
                'name'=>$name,
                'pid'=>0,
                'level'=>0,
            ];
            $res=CateModel::topCate($data);
            if($res){
                return $this->success('添加成功！','index');
            }
        }
        return $this->fetch('add');
    }
//添加子分类
    function addCate(){
        $id=input('id');
        $data=CateModel::getCateById($id);
        $this->assign('data',$data);
        return   $this->fetch('addCate');

    }
//执行添加子分类
    function doAddCate(){
        $data=[
            'id'=>input('id'),
            'name'=>input('catename')
        ];

        $res=CateModel::addCate($data);
        if($res){
            return $this->success('添加成功','index');
        }else{
            return $this->error('添加失败');
        }
    }
    /*
     * 显示分类
     *
     * */



    function raddCate(){

        $arr=array();
        //获取表长度
        $l=count(db('cate')->select());
        //制作分类
        for($i=1;$i<=$l;$i++){
            $catePid=db('cate')->where(['id'=>$i])->select();
            if($catePid[0]['pid']==0){
                $catePid[0]['name']=str_repeat('>',$catePid[0]['level']).$catePid[0]['name'];
                array_push($arr,$catePid);
            }
            for($j=1;$j<=$l;$j++){
                $pid=db('cate')->where(['id'=>$j])->select();
                //dump($pid[0]['pid']);exit;
                if($pid[0]['pid']==$i){
                    $pid[0]['name']=str_repeat('>',$pid[0]['level']).$pid[0]['name'];
                    array_push($arr,$pid);
                }
            }

        }

        //dump($arr[0][0]['name']);exit;
        $this->assign('data',$arr);
        return $this->fetch('add');
    }
    function insertCate(){
        $data=[
            'id'=>input('id'),
            'name'=>input('catename')
        ];
        $res=CateModel::insertCate($data);
        if($res){
            $this->success('添加成功','index');
        }else{
            $this->error('添加失败');
        }
    }
}

