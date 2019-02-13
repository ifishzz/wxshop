<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 21:08
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{

    //postman获取到token,微信小程序工具一直出错,不能发生post请求,get请求也带不上code码去微信端
    public function getToken($code = '')
    {
        //post,在body穿json的code,去找微信换取openid
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();

        //返回json到客户端,写成关联数组,框架自动处理为json
        return [
            'token' => $token
        ];
    }

}