<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/12
 * Time: 23:44
 */

namespace app\api\validate;


use app\api\model\BaseModel;

class IDCollection extends BaseValidate
{
    protected $rule=[
      'ids'=>'require|checkIDs'
    ];
    protected $msg=[
        'ids'=>'这个ids必须以逗号分隔的正整数'
    ];
    //ids=id1,id2...
    protected function checkIDs($value){
        $value=explode(',',$value);
        if(empty($value)){
            return false;
        }
        foreach ($value as $id){
            if (!$this->isPositiveInteger($id))
            return false;
        }
        return true;
    }
}