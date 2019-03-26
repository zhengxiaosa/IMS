<?php
/**
 * Created by PhpStorm.
 * User: 36934
 * Date: 2019/3/26
 * Time: 21:42
 */

namespace app\admin\model;


use think\Model;

class Grade extends Model
{
    protected $table = 'ims.grade';
    protected $update = ['update_time'];
    protected $insert = ['create_time'];

    /**
     * @param $value
     * @return int
     */
    protected function setUpdateTimeAttr($value)
   {
      return time();
   }

    /**
     * @param $value
     * @return int
     */
   protected function setCreateTimeAttr($value){
        return time();
   }

    /**
     * @param $value
     * @return false|string
     */
   protected function getCreateTimeAttr($value)
   {
       return date('Y-m-d H:i:s',$value);
   }

    /**
     * @param $value
     * @return false|string
     */
   protected function getUpdateTimeAttr($value)
   {
       return date('Y-m-d H:i:s',$value);
   }
}