<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/2/10
 * Time: 23:25
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = ['id', 'user_id', 'delete_time'];

}