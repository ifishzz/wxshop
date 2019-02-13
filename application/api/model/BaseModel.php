<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/11
 * Time: 15:59
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{

    //获取数据库表里Url这个字段,要用驼峰写法,get xx Attr是固定格式
    public function getUrlAttr($value, $data)
    {
        $finalUrl = $value;
        if ($data['from'] == 1) {
            $finalUrl = config('setting.img_prefix') . $value;
        }
        return $finalUrl;
    }
}