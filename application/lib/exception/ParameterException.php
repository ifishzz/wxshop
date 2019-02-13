<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/8
 * Time: 14:32
 */

namespace app\lib\exception;


use think\Exception;

class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $eroorcode = 10000;
}