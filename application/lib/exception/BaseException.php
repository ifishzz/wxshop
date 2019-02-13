<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/7
 * Time: 21:34
 */

namespace app\lib\exception;


use think\Exception;
/**
 * Class BaseException
 * 自定义异常类的基类
 */
class BaseException extends Exception
{
    public $code = 400;
    public $msg = '参数错误';
    public $eroorcode = 10000;
    /**
     * 构造函数，接收一个关联数组
     * @param array $params 关联数组只应包含code、msg和errorCode，且不应该是空值
     * 注意了就是在这里翻车车,2019.1.9
     */
    public function __construct($params=[])
    {
        if (!is_array($params)){
            return;
        }
        if (array_key_exists('code',$params)){
            $this->code=$params['code'];
        }

        if (array_key_exists('msg',$params)){
            $this->msg=$params['msg'];
        }

        if (array_key_exists('errorcode',$params)){
            $this->eroorcode=$params['errorcode'];
        }
    }

}