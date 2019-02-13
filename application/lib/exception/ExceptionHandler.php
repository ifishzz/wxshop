<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/7
 * Time: 21:32
 * 重写的全局异常类
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;
use Exception;

class ExceptionHandler extends Handle
{
    //http状态码
    private $code;
    //具体错误信息
    private $msg;
    //自定义的错误码
    private $errorcode;


    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            //如果是用户自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorcode = $e->eroorcode;
        } else {
            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorcode = 999;
                $this->recordErrorLog($e);
            }
        }
        $url = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorcode,
            'url' => $url->url()
        ];
        return json($result, $this->code);

    }

    //自定义保存错误日志
    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}