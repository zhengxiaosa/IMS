<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use think\Session;
class Index extends Base {

    public function index(){
//        $this->checkLogin();
        return $this->fetch();

    }

    public function welcome(){

    }
}