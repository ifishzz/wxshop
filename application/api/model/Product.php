<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/12
 * Time: 22:11
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = ['category_id', 'create_time', 'main_img_id', 'pivot', 'from', 'delete_time', 'update_time'];


    public function getMainImgUrlAttr($value, $data)
    {
        return $this->getUrlAttr($value, $data); //这里不懂要在测试
    }

//    //商品详情
//    public function imgs(){
//        //一对多用hasmany
//        //product和productimage关联,靠product_id
//       return $this->hasMany('ProductImage','product_id','id');
//    }
//
//    //商品属性也是一对多
//    public function properties(){
//        //一对多用hasmany
//        return $this->hasMany('ProductProperty','product_id','id');
//    }

    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }
    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;

    }

    public static function getProductByCategoryId($categoryId)
    {
        $products = self::where('category_id', '=', $categoryId)
            ->select();
        return $products;
    }

    public static function getProductDetail($id){
        //草,这里出现bug,没有写find()
        //查询imgs,没有imgUrl,需要嵌套模型查询,加imags.imgUrl
        //self::with(['imgs.imgUrl','properties'])->find($id); 是关联预载入
        //self::with('imgs.imgUrl,properties')->find($id); 两种写法


        //模型排序写法
        $product=self::with([
            'imgs'=>function($query){
            $query->with(['imgUrl'])
                ->order('order asc');
            }])
            ->with(['properties'])
            ->find($id);
        return $product;


    }
}