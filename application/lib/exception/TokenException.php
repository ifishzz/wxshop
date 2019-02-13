<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/2/6
 * Time: 20:42
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已经过期或无效Token';
    public $eroorcode = 10001;
}