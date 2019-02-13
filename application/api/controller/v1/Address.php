<?php
/**
 * Created by PhpStorm.
 * User: mask
 * Date: 2019/2/10
 * Time: 17:09
 */

namespace app\api\controller\v1;


use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\exception\successMessage;
use app\lib\exception\UserException;

class Address
{
    //新增和更改用同一套
    public function createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate->goCheck();



        //根据token来获取uid
        //根据uid来查找用户数据,判断用户是否存在,如果不存在抛出异常
        //获取用户从客户端传过来的信息
        //根据用户地址是否存在,判断添加或者是更新
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user) {
            throw new UserException();
        }

        //客户端传过来的数据,走规则验证
        $dataArray=$validate->getDataByRule(input('post.'));

        var_dump($dataArray);
        $userAddress = $user->address; //这里是因为模型关联了,所以这样写直接获取到user_address的数据


        //通过模型的关联模型来增加address
        if (!$userAddress) {
            //新增.通过关联的模型,来增加
            $user->address()->save($userAddress);
        } else {
            //更新.读取$user->address
            $user->address->save($userAddress);
        }
        //return $user; //标准做法是返回整个模型
        return new successMessage();  //自定义信息返回
    }

}