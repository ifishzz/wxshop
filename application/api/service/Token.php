<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/2/6
 * Time: 19:36
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken()
    {
        //32位随机字符串
        $randChars = getRandChar(32);
        //用三组字符串,进行MD5加密
        $timeNow = strtotime('now');
        //salt
        $salt = config('security.token_salt');
        return md5($randChars . $timeNow . $salt);
        //此处出现bug连接符写成,
    }

    //获取缓存中的key
    //先获得用户的token
    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()->header('token'); //约定从header获得token
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        } else {
            //存进来的是字符串,要转化成数组
            //判断一下
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            //判断vars里面有没有key
            if (array_key_exists($key,$vars)){
                return $vars[$key];
            }else{
                throw new Exception('尝试获取的token变量不存在');
            }
        }
    }

    public static function getCurrentUid()
    {
        $uid=self::getCurrentTokenVar('uid');
        return $uid;
    }

}