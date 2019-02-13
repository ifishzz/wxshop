<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/28
 * Time: 14:17
 */

namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllcategory(){

        $Category= CategoryModel::all([],'img');
        if ($Category->isEmpty()){
            throw new CategoryException();
        }
        return $Category;
    }
}