<?php
namespace app\admin\validate;

use think\Validate;

/**
 * Created by PhpStorm.
 * User: 36934
 * Date: 2019/3/21
 * Time: 22:35
 */
class User extends Validate
{
    protected  $rule = [
        'id' => 'require|number',
        'name'=>'require',
        'password'=>'require',
        'captcha'=>'require|captcha'
    ];

    protected $message = [
        'name.require'=>'用户名不能为空',
        'password.require'=>'密码不能为空',
        'captcha.require'=>'验证码不能为空',
        'captcha.captcha'=>'验证码错误'
    ];

    protected $scene = [
       'login' =>['name','password','captcha']
    ];
}