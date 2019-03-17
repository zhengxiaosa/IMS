<?php
/**
 * Created by PhpStorm.
 * User: 36934
 * Date: 2019/3/17
 * Time: 19:30
 */

namespace app\admin\controller;
use think\Controller;
use think\Session;

class Base extends Controller
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $user = Session::get('user_info');
        if($user ==null){
            $this->error('用户未登录，请先登录','admin/user/login');
        }
    }

    protected function checkLogin(){
        $user = Session::get('user_info');
        if($user !==null){
            $this->error('该用户已经登录','admin/index/index');
        }
    }
}