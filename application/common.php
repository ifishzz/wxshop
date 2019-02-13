<?php
//// +----------------------------------------------------------------------
//// | ThinkPHP [ WE CAN DO IT JUST THINK ]
//// +----------------------------------------------------------------------
//// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
//// +----------------------------------------------------------------------
//// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
//// +----------------------------------------------------------------------
//// | Author: 流年 <liu21st@gmail.com>
//// +----------------------------------------------------------------------
//
//// 应用公共文件
//function curl_get($url,&$httpCode=0){
//    // 1. 初始化
//    $ch = curl_init();
//    // 2. 设置选项，包括URL
//    curl_setopt($ch,CURLOPT_URL,$url);
//    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//    curl_setopt($ch,CURLOPT_HEADER,0);
//
//    //不做证书校验
////    curl_setopt($ch,CURL_SSLVERSION_DEFAULT,false);
//    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
//
//    // 3. 执行并获取HTML文档内容
//    $output = curl_exec($ch);
//    $httpCode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
//    // 4. 释放curl句柄
//    curl_close($ch);
//    return $output;
//}



// 应用公共文件
/**
 * @param $url get请求地址
 * @param int $httpCode 返回状态码
 */
function curl_get($url,&$httpCode = 0 ){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//    不做证书校验，部署在linux环境下请改为true
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
    $file_contents = curl_exec($ch);
    $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $file_contents;
}


/**
 ** $length : the length of the result String
 **/
function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol)-1;

    for($i=0;$i<$length;$i++){
        $str.=$strPol[mt_rand(0,$max)];
    }
    return $str;
}