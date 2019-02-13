<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 21:23
 */

namespace app\api\model;


class User extends BaseModel
{

    //在带有外键的一方,才用belongto,
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenId($openid)
    {
        $user = self::where('openid', '=', $openid)->find();
        return $user;
    }
}