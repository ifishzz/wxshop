<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 21:25
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {

        $this->code = $code;
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppId, $this->wxAppSecret, $this->code);
    }

    public function get()
    {
        $result = curl_get($this->wxLoginUrl);

        //true是数组,不加是对象
        $wxResult = json_decode($result, true);

        if (empty($wxResult)) {
            throw new Exception('获取session内部异常,微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }

    private function grantToken($wxResult)
    {
        //拿到openid
        //如果存在opentid就不处理,不存在就新增一条user
        //生成令牌,准备缓存数据写入缓存
        //把令牌还回客户端

        //key:令牌
        //value:wxResult,uid,scope

        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenId($openid);
        if ($user) {
            $uid = $user->id;
        } else {
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCacheValue($wxResult, $uid);
        $token=$this->saveToCache($cachedValue);
        return $token;
    }

    private function saveToCache($cachedValue)
    {
        //键值对缓存
        $key = self::generateToken();
        //json_encode数组转化为字符串
        $value = json_encode($cachedValue);
        //令牌的过期时间,这里写入缓存,相当于如果缓存过期,令牌也过期
        $expire=config('setting.token_expire');

        //使用tp5自带的缓存,默认是文件,可以选择redis(支持存取对象),memcache
        $request=cache($key,$value,$expire);
        if (!$request){
            throw new TokenException(
                [
                    'msg'=>'服务器缓存异常',
                    'errorCode'=>10005
                ]
            );
        }
        return $key;
    }

    private function prepareCacheValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }

    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;
    }

    private function processLoginError($wxResult)
    {
        //抛出异常这里是有bug的
        throw new WeChatException(
            [
                'msg' => $wxResult['errmsg'],
                'errorCode' => $wxResult['errcode']
            ]
        );
    }


}