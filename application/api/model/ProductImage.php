<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/2/8
 * Time: 23:42
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
 protected $hidden=['img_id','delete_time','product_id'];

 //在跟img表关联
 public function imgUrl(){
     //一对一
     return $this->belongsTo('Image','img_id','id');

 }
}