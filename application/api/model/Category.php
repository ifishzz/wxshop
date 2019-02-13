<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 14:17
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden=['delete_time','update_time'];
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }

    public static function getAllcategory(){
        $category=self::with('img')->select();
        return $category;
    }

}