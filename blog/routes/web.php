<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前台首页
Route::get('/', 'Home\IndexController@index');


//登录，注册页面
Route::get('/login', 'Home\LoginController@login');
//处理登录，注册
// Route::post('doLogin','Api\LoginController@signIn');

//后台路由组
Route::prefix('/admin')->group(function () {

    //后台中间键，判断是否登录
    Route::middleware(['admin_user'])->group(function () {
        //商城主页管理的路由组
        Route::prefix('/index')->group(function () {
            Route::get('/rob', 'Admin\IndexController@rob');
        });

        Route::get('/', function () {
            return view('Admin/index');
        });

        //会员管理路由组
        Route::prefix('/homeusers')->group(function () {
            //显示会员列表路由
            Route::get('/list', 'Admin\HomeUsersController@homeUsersList');
            //停用会员路由
            Route::post('/stopandstart', 'Admin\HomeUsersController@stopAndStart');
            //会员积分管理路由
            Route::get('/level', 'Admin\HomeUsersController@level');
        });

        Route::get('/', function () {
            return view('Admin/index');
        });



        //显示我的桌面路由
        Route::get('/welcome', 'Admin\IndexController@welCome');

        //角色管理
        // Route::resource('/role', 'Admin\Administrator\Role');
        Route::get('/role', 'Admin\Administrator\RoleController@index');
        Route::get('/role/create', 'Admin\Administrator\RoleController@create');
        Route::post('/role/create', 'Admin\Administrator\RoleController@store');
        Route::get('/role/{id}', 'Admin\Administrator\RoleController@show');
        Route::patch('/role/{id}', 'Admin\Administrator\RoleController@update');
        Route::get('/role/details/{id}', 'Admin\Administrator\RoleController@details');

        //权限管理
        // Route::resource('/permission', 'Admin\Administrator\Permission');
        Route::get('/permission', 'Admin\Administrator\PermissionController@index');
        Route::get('/permission/create', 'Admin\Administrator\PermissionController@create');
        Route::post('/permission/create', 'Admin\Administrator\PermissionController@store');
        Route::get('/permission/{id}', 'Admin\Administrator\PermissionController@show');
        Route::patch('/permission/{id}', 'Admin\Administrator\PermissionController@update');


        //管理员列表
        // Route::resource('/adminlist', 'Admin\Administrator\AdminList');
        // Route::post('/update/{id}', 'Admin\Administrator\AdminList@update')->where('id','\d+');
        Route::get('/user', 'Admin\Administrator\UserController@index');
        Route::get('/user/create', 'Admin\Administrator\UserController@create');
        Route::post('/user/create', 'Admin\Administrator\UserController@store');
        Route::get('/user/{id}', 'Admin\Administrator\UserController@show');
        Route::patch('/user/{id}', 'Admin\Administrator\UserController@update');

        //后台系统管理->友情链接
        Route::resource('/url', 'Admin\Systron\Url');
        Route::get('/disable', 'Admin\Systron\Url@disable');

        //网站logo的路由
        Route::get('logo', 'Admin\Systron\Logo@index');
        Route::get('editlogo/{id}', 'Admin\Systron\Logo@edit');
        Route::post('update', 'Admin\Systron\Logo@update');

        //后台意见反馈路由
        Route::get('feedback','Admin\Systron\Feedback@index');

        //后台退出路由组
        route::get('/out','Admin\Api\CommonController@Out');

    });


    //后台登录路由
    Route::get('login','Admin\IndexController@doLogin');
    Route::get('/makecode', 'Admin\Api\CommonController@buildCode');
    //提交用户登陆信息
    Route::post('dologin','Admin\Api\LoginController@dologin');







   	// Route::get('product/delete/{gayquan}', 'Admin\ProductController@destroy')
    //     ->where(['gayquan' => '\d+']);
    //秒杀商品列表路由
    Route::resource('/seckill', 'Admin\SeckillController');

});

//前台用户中心路由
Route::prefix('/user')->group(function () {
    //验证是否有登录
    Route::middleware(['home.auth'])->group(function () {
        //个人中心首页
        Route::get('/myaccount', 'Home\IndexUserController@myAccount');
        //个人资料
        Route::get('/information', 'Home\IndexUserController@information');
        //收货地址
        Route::get('/address', 'Home\IndexUserController@address');
        //添加地址
        Route::get('/address/add', 'Home\IndexUserController@add');
        //编辑
        Route::get('/address/edit/{id}', 'Home\IndexUserController@edit');
        //执行添加地址
        Route::post('/address/exadd', 'Home\Api\AddressApi@exAdd');
        //获取省市区地址
        Route::get('/select', 'Home\Api\AddressApi@select');
        //执行修改
        Route::post('/address/exedit/{id}', 'Home\Api\AddressApi@exEdit');
        //执行删除地址
        Route::get('/address/delete/{id}', 'Home\Api\AddressApi@delete');
        //修改用户信息
        Route::post('/userinfo/update', 'Home\IndexUserController@infoUpdate');
    });
});

//前台意见反馈路由
Route::get('feedback','Home\Feedback@index');
Route::post('in-feedback', 'Home\Feedback@insert');


//产品管理路由组
Route::prefix('admin/product')->group(function () {
    //产品分类资源控制器
    Route::resource('/category', 'Admin\Product\ProdectController');
    //品牌管理资源控制器
    Route::resource('/brand', 'Admin\Product\BrandController');
    //删除品牌路由
    Route::post('/delbrand', 'Admin\Product\BrandController@destroy');
    //商品管理资源控制器
    Route::resource('/goods', 'Admin\Product\GoodsController');
    //添加商品的加载品牌路由
    Route::post('/goodsbrand', 'Admin\Product\GoodsController@goodsBrand');
    //添加商品的上传图片路由
    Route::post('/goodsimg/{id}', 'Admin\Product\GoodsController@goodsImg');
    //商品的上架和下架路由
    Route::post('/goods/status', 'Admin\Product\GoodsController@stopAndStart');
    //商品图片列表路由
    Route::get('/goods/imglist/{id}', 'Admin\Product\GoodsController@goodsImgShow');
    //删除商品图片路由
    Route::get('/goods/imgdel/{id}', 'Admin\Product\GoodsController@goodsImgdel');

});

//获取验证码
Route::get('/makecode', 'Api\CommonApi@buildCode');

//获取手机验证码
Route::post('/phonecode', 'Api\CommonApi@phoneCode');

//判断用户名是否存在
Route::post('/existence', 'Home\RegisterController@isExistence');

//处理登录
Route::post('/dologin', 'Home\LoginController@doLogin');
Route::get('/outlogin', 'Home\LoginController@outLogin');

//处理注册
Route::post('/doregister', 'Home\RegisterController@doregister');



//搜索
Route::get('/search', 'Home\SearchController@search');


//购物车资源路由
Route::prefix('/cart')->group(function () {
    //购物车首页
    Route::get('/', 'Home\CartController@cart');
    //查看购物车商品
    Route::get('/show', 'Home\CartController@showCart');

    //添加商品到购物车
    Route::get('/add', 'Home\CartController@addCart');

    //移除商品
    Route::post('/del', 'Home\CartController@delCart');

    //修改商品数量
    Route::post('/change', 'Home\CartController@changeCart');

});


//订单资源路由
Route::prefix('/order')->group(function () {
    //结算页面
    Route::get('/', 'Home\OrderController@check');

    //提交订单
    Route::post('/add', 'Home\OrderController@add');

    //成功提交订单
    Route::get('/success', 'Home\OrderController@success');

    Route::get('/show', 'Home\OrderController@show');

});

//地址资源路由
Route::prefix('/address')->group(function () {
    //三级联动
    Route::post('/select', 'Home\AddressController@select');

    //添加地址
    Route::post('/add', 'Home\AddressController@add');

    //显示地址
    Route::post('/show', 'Home\AddressController@show');

    //删除地址
    Route::post('/del', 'Home\AddressController@del');

    //默认地址添加
    Route::post('/tacit', 'Home\AddressController@tacit');

});

//加载秒杀商品路由
Route::get('/seckill', 'Home\IndexController@seckill');
//加载新品推介路由
Route::get('/newgoods/{id}', 'Home\IndexController@newGoods');
//商品列表路由
Route::get('/goods/list/{type}/{id}', 'Home\GoodsListController@list');
//商品详情页路由
Route::get('/goods/detail/{id}', 'Home\GoodsListController@goodsDetail');
//home用户退出
Route::get('/queit', 'Home\LoginController@queit');

