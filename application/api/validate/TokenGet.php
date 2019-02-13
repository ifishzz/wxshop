<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 21:09
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule=[
      'code'=>'require|isNotEmpty'
    ];

    protected $message=[
        'code'=>'没有code还想获取token'
    ];
}