<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 10:59
 */

namespace app\lib\exception;


class ProducException extends BaseException
{
    public $code = 404;
    public $msg = '指定商品不存在,请检查id';
    public $eroorcode = 20000;
}