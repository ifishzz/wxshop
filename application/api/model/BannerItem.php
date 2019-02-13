<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/10
 * Time: 17:15
 */

namespace app\api\model;


use think\Model;

class BannerItem extends BaseModel
{
    protected $visible=['key_word','type','img'];
    //banneritem查询image,所以这个方法就写在这
    public function img(){
      return $this->belongsTo('Image','img_id','id');

    }
}