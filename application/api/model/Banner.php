<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/7
 * Time: 0:35
 */

namespace app\api\model;


use think\Model;

class Banner extends BaseModel
{
    /**
     * @param $id
     * @return \think\db\Query
     */
    protected $hidden=['id','delect_time','update_time'];

    //关联模型banneritem
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');

    }

    public static function getBannerById($id)
    {
        //静态类用self调用,嵌套关系查询
        $banner=self::with(['items','items.img'])->find($id);
        return $banner;
    }

}