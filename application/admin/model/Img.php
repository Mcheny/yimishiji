<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Img extends Model{
    static public function upload($file){
        $reponse=[
            'status'=>'error',
            'msg'=>''
        ];
        $file=request()->file('file');
        $info=$file->move(ROOT_PATH.'public'.DS.'uploads');
        if($info){
            $fileload='/uploads/'.$info->getSaveName();
            $fileload=str_replace('\\','/',$fileload);
            $reponse['status']='success';
            $reponse['msg']='上传成功';
            $reponse['img_url']=$fileload;
            return $reponse;

        }else{
            // 上传失败获取错误信息
            return  $file->getError();
        }
    }
    //缩放图
    static public function thumb($url,$width=120,$height=120){
        $image = \think\Image::open('./'.$url);
        $dir_name=dirname($url);//目录名
        $fir_name=basename($url);//文件名
        $save_name=$dir_name.'/'.$width.'_'.$fir_name;
        //保存
        $res=$image->thumb($width,$height)->save('./'.$save_name);
        if(!$res){
            return false;
        }
        //返回缩放图名

        return $save_name;
    }
}