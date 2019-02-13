<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/12
 * Time: 22:11
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden=['update_time','topic_img_id','head_img_id','delete_time'];
    //一对一的关联关系
    public function topicImg(){
        //绑定模型关联关系,模型,外键,另一张表的主键
        return $this->belongsTo('Image','topic_img_id','id');
    }
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }


    public function products(){
        //多对多关联用belongtomany
    return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    public static function getThemeWithProducts($id){
        $theme=self::with('products,topicImg,headImg')->find(); //rest基于资源,把所有的图都返回去
        return $theme;
    }
}   