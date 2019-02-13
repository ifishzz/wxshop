<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/2/3
 * Time: 22:33
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = '微信接口调用失败';
    public $eroorcode = 999;
}