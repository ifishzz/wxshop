<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/29
 * Time: 19:47
 */

return [
    'app_id' => 'wx526c9d29c9698deb',
    'app_secret' => '67817ccc6dc8c254a37fff74e63e9865',
    'login_url' => 'https://api.weixin.qq.com/sns/jscode2session?' .
        'appid=%s&secret=%s&js_code=%s&grant_type=authorization_code'
];

//此处出现bug,日,操他妈的login_url拼接错误,导致一直出现无效的appid