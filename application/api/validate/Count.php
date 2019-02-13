<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 10:33
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule=[
        'count'=>'isPositiveInteger|between:1,15'
    ];
}