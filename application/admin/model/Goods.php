<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Goods extends Model
{
//子分类添加
    static public function insertCate($data)
    {
        $arr = self::getCateById($data['id']);
        $cate = [
            'name' => $data['name'],
            'pid' => $arr['id'],
            'level' => $arr['level'] + 1,
        ];
        $id = Db::name('cate')->insertGetId($cate);
        Db::name('cate')->update([
            'id' => $id,
            'path' => $arr['path'] . "," . $id
        ]);
        return $id ;
    }
    //子分类添加
    static public function getCateById($id){
        if(!$id){
            return false;

        }
        $data=Db::name('cate')->find($id);
        return $data;
    }

}