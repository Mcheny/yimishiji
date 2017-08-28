<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate{
    protected $rule=[
      'username'=>'require|max:6',
        //'password'=>''
    ];
    protected $message=[
        'username.require'=>'用户名不能为空',
        'username.max'=>'用户名长度不能超过16位'
    ];
    protected $scene=[
        'add'=>['username'],
    ];
}