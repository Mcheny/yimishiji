<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Cate extends Model{
    /**
     * 查询所有分类
     */
    static  public function getAllCate(){
        $data=Db::name('cate')->order('path')->paginate(5);
        $page=$data->render();
        $arr=$data->all();
        foreach ($data as $key=>$val){
            $arr[$key]['name']=str_repeat('--',$val['level']).$val['name'];
        }
       return[
           'data'=>$arr,
            'page'=>$page
       ];

    }
    /**
     * 添加顶级分类
     */
    static public function topCate($data){
        $id= Db::name('cate')->insertGetId($data);
        if(!$id){
  return false;
        }
        //再修改path为id
        $res=Db::name('cate')->update([
            'id'=>$id,
            'path'=>$id
        ]);
        return $res?true:false;
    }
    //子分类
    static public function getCateById($id){
        if(!$id){
            return false;

        }
$data=Db::name('cate')->find($id);
        return $data;
    }
    //子分类添加
    static public function addCate($data)
    {
        //查询这条分类的信息
        $arr = self::getCateById($data['id']);
        if (!$arr || empty($arr)) {
            return false;
        }

            $pid = $data['id'];//自己的pid
            $name = $data['name'];
            $level = $arr['level'] + 1;
            $par=[
                'pid'=>$pid,
                'name'=>$name,
                'level'=>$level
            ];
            $id=Db::name('cate')->insertGetId($par);
            if(!$id){
                return false;
            }
            $path=$arr['path'].','.$id;
            $res=Db::name('cate')->update([
                'id'=>$id,
                'path'=>$path
            ]);
            return $res?true:false;

    }



    //子分类添加
    static public function insertCate($data){
        $arr=self::getCateById($data['id']);
        $cate=[
            'name'=>$data['name'],
            'pid'=>$arr['id'],
            'level'=>$arr['level']+1,
        ];
            $id=Db::name('cate')->insertGetId($cate);
            $res=Db::name('cate')->update([
                'id'=>$id,
                'path'=>$arr['path'].",".$id
            ]);
            return $res?true:false;
    }
}