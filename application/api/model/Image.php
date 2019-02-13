<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/10
 * Time: 19:29
 */

namespace app\api\model;


use think\Model;

class Image extends BaseModel
{
    protected $hidden = ['id', 'from', 'delete_time', 'update_time'];

}