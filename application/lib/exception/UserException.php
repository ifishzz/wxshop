<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/2/10
 * Time: 22:35
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $eroorcode = 60000;
}