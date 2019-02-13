<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/1/12
 * Time: 22:09
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ThemeException;

class Theme
{
    /**
     * @url /theme?ids=id1,id2....
     * @return 一组theme模型
     */
    public function getSimpleList($ids = '')
    { //先验证传入id,去写个验证器
        (new IDCollection())->goCheck(); //经过验证器往下走
//        $ids = explode(',', $ids);  //这里没有必要写这个处理字符的,如果不是就过不了验证器

        $result = ThemeModel::with('topicImg,headImg')->select($ids); //with(关联的方法名),selec([1,2,3])格式,所以要切割字符为1,2
        if ($result->isEmpty()) {  //写一个抛出错误的模版
            throw new ThemeException();  //抛出错误
        }
        return $result;
    }

    //1.定义一个新的接口,之后要干嘛?写路由
    public function getComplexOne($id)
    {
            //2.return 'sss'; //return条消息来判断接口成不成功,但是这里,id没有走到这里,,错误信息ids不能为空,路由完整匹配
        //在rest服务里面,保证一个url对应一个接口
        //3.参数校验,id正整型
        (new  IDMustBePostiveInt())->goCheck();
        //4.封装查询代码
        $theme = ThemeModel::getThemeWithProducts($id);
        //5.如果出错抛出异常信息
        if (!$theme) {
            throw new ThemeException();
        }
        return $theme;
    }
}