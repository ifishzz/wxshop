<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 10:28
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ProducException;

class Product
{
    public function getRecent($count=15){
        (new Count())->goCheck();
        $products=ProductModel::getMostRecent($count);
        if ($products->isEmpty()){
            throw new ProducException();
        }
        $products=$products->hidden(['summary']);
        return $products;
    }



    public function getAllIncategory($id){
        (new IDMustBePostiveInt())->goCheck();
        $products=ProductModel::getProductByCategoryId($id);
        if ($products->isEmpty()){
            throw new ProducException();
        }
        $products=$products->hidden(['summary']);
        return $products;
    }

    public function getOne($id){
        (new IDMustBePostiveInt())->goCheck();
        $products=ProductModel::getProductDetail($id);
        if (!$products){

            throw new ProducException();
        }
        return $products;
    }
}