<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/7
 * Time: 21:43
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的banner不存在';
    public $eroorcode = 40000;
}