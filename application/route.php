<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//路由绑定参数还需要学习
use think\Route;

Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');

Route::get('api/:version/theme', 'api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id', 'api/:version.Theme/getComplexOne');


//路由是顺序匹配,recent如果放id下面就不行
//对id号进行限定,必须是正整数才能匹配这个接口
//Route::get('api/:version/product/by_category', 'api/:version.Product/getAllIncategory');
//Route::get('api/:version/product/:id', 'api/:version.Product/getOne',[],['id'=>'\d+']);
//Route::get('api/:version/product/recent', 'api/:version.Product/getRecent');


//闭包路由分组,效率会更高一点,不必每次都去遍历完整的路由规则
Route::group('api/:version/product',function(){
    Route::get(':id','api/:version.Product/getOne',[],['id'=>'\d+']);
    Route::get('by_category','api/:version.Product/getAllIncategory');
    Route::get('recent','api/:version.Product/getRecent');
});

Route::get('api/:version/category/all', 'api/:version.Category/getAllcategory');

Route::post('api/:version/token/user', 'api/:version.Token/getToken');

Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');
