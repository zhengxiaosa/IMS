<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;
class Welcome extends Base {

    public function index(){

        return $this->fetch();

    }

}