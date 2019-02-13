<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/13
 * Time: 20:07
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在,请检查主题id';
    public $eroorcode = 30000;
}