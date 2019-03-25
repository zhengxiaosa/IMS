<?php

/**
 * Created by PhpStorm.
 * User: 36934
 * Date: 2019/3/17
 * Time: 21:28
 */
namespace app\admin\model;
use think\Model;

/**
 * Class User
 * @package app\admin\model
 */
class User extends Model
{
   protected  $table = 'ims.user';
   protected $update = ['role','create_time','status','update_time'];
   protected $insert = ['update_time','create_time'];

    /**
     * @param $value
     * @return string
     */
   protected function getRoleAttr($value)
   {
        $value == 0 ? $value = '管理员' :$value = '超级管理员';
        return $value;
   }

   protected function getStatusAttr($value)
   {
        $value == 0 ? $value ='已停用' :$value = '正常';
        return $value;
   }

   protected function setUpdateTimeAttr($value)
   {
       return time();
   }

   protected function setCreateTimeAttr($value)
   {
     return time();
   }

   protected function getCreateTimeAttr($value)
   {
       return date('Y-m-d H:i:s',$value);
   }

   protected function getUpdateTimeAttr($value)
   {
       return date('Y-m-d H:i:s',$value);
   }
}