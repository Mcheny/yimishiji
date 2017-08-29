<?php
namespace app\admin\validate;
use think\Validate;
class Manager extends Validate{
    /**
     * @var array
     * 验证规则
     */

    protected $rule = [
        'username'  =>  'require|max:25|unique:manager',
        'password' =>  'require',
        'role_id' =>  'require',

    ];

    /**
     * @var array
     * 验证提示文字
     */
    protected $message  =   [
        'username.require' => '管理员名不能为空',
        'username.max'     => '管理员名最多不能超过25个字符',
        'username.unique'     => '管理员名不能重复',
        'password.require'     => '密码不能为空',
        'role_id.require'     => '角色不能为空',
    ];

    /**
     * @var array
     * 验证提示文字
     */

    protected $scene = [
        'add' => ['username','password','role_id'],
        'edit' => ['username'],
    ];
}