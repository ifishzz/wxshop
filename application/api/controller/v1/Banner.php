<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/4/17
 * Time: 2:05
 */

namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerMissException;


class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     *
     */
    public function getBanner($id)
    {
//        验证器和独立验证
        //为什么这里new要括号包起来
        (new  IDMustBePostiveInt())->goCheck();
        $banner = BannerModel::getBannerById($id);
        if (!$banner) {
            throw new BannerMissException();
        }
        config('setting.img_prefix');
        return $banner;
    }


}