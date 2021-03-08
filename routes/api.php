<?php

 Route::post( 'callback/notify/{paymethod}', 'PaymentController@notify')->name('payment.notify'); //支付回调
 


// 后端WEBAPI
Route::group(['namespace' => 'Api\WebApi', 'middleware' => 'webApi'], function () {
    // VNet后端WEBAPI V1版
    Route::group(['prefix' => 'web/v1'], function () {
        Route::get('node/{node}', 'VNetController@getNodeInfo'); // 获取节点信息
        Route::post('nodeStatus/{node}', 'BaseController@setNodeStatus'); // 上报节点心跳信息
        Route::post('nodeOnline/{node}', 'BaseController@setNodeOnline'); // 上报节点在线人数
        Route::get('userList/{node}', 'VNetController@getUserList'); // 获取节点可用的用户列表
        Route::post('userTraffic/{node}', 'BaseController@setUserTraffic'); // 上报用户流量日志
        Route::get('nodeRule/{node}', 'BaseController@getNodeRule'); // 获取节点的审计规则
        Route::post('trigger/{node}', 'BaseController@addRuleLog'); // 上报用户触发的审计规则记录
    });

    // VNet后端WEBAPI V2版
    Route::group(['prefix' => 'vnet/v2'], function () {
        Route::get('node/{node}', 'VNetController@getNodeInfo'); // 获取节点信息
        Route::post('nodeStatus/{node}', 'BaseController@setNodeStatus'); // 上报节点心跳信息
        Route::post('nodeOnline/{node}', 'BaseController@setNodeOnline'); // 上报节点在线人数
        Route::get('userList/{node}', 'VNetController@getUserList'); // 获取节点可用的用户列表
        Route::post('userTraffic/{node}', 'BaseController@setUserTraffic'); // 上报用户流量日志
        Route::get('nodeRule/{node}', 'BaseController@getNodeRule'); // 获取节点的审计规则
        Route::post('trigger/{node}', 'BaseController@addRuleLog'); // 上报用户触发的审计规则记录
    });

    // V2Ray后端WEBAPI V1版
    Route::group(['prefix' => 'v2ray/v1'], function () {
        Route::get('node/{node}', 'V2RayController@getNodeInfo'); // 获取节点信息
        Route::post('nodeStatus/{node}', 'BaseController@setNodeStatus'); // 上报节点心跳信息
        Route::post('nodeOnline/{node}', 'BaseController@setNodeOnline'); // 上报节点在线人数
        Route::get('userList/{node}', 'V2RayController@getUserList'); // 获取节点可用的用户列表
        Route::post('userTraffic/{node}', 'BaseController@setUserTraffic'); // 上报用户流量日志
        Route::get('nodeRule/{node}', 'BaseController@getNodeRule'); // 获取节点的审计规则
        Route::post('trigger/{node}', 'BaseController@addRuleLog'); // 上报用户触发的审计规则记录
        Route::post('certificate/{node}', 'V2RayController@addCertificate'); // 上报节点伪装域名证书信息
    });

    // Trojan后端WEBAPI V1版
    Route::group(['prefix' => 'trojan/v1'], function () {
        Route::get('node/{node}', 'TrojanController@getNodeInfo'); // 获取节点信息
        Route::post('nodeStatus/{node}', 'BaseController@setNodeStatus'); // 上报节点心跳信息
        Route::post('nodeOnline/{node}', 'BaseController@setNodeOnline'); // 上报节点在线人数
        Route::get('userList/{node}', 'TrojanController@getUserList'); // 获取节点可用的用户列表
        Route::post('userTraffic/{node}', 'BaseController@setUserTraffic'); // 上报用户流量日志
        Route::get('nodeRule/{node}', 'BaseController@getNodeRule'); // 获取节点的审计规则
        Route::post('trigger/{node}', 'BaseController@addRuleLog'); // 上报用户触发的审计规则记录
    });
});

// 客户端API
Route::group(['namespace' => 'Api\Client', 'middleware' => 'api', 'prefix' => 'client/v1'], function () {
    Route::post('login', 'V1Controller@login'); // 登录
    Route::get('logout', 'V1Controller@logout'); // 退出
    Route::get('refresh', 'V1Controller@refresh'); // 刷新令牌
    Route::get('profile', 'V1Controller@userProfile'); // 获取账户信息
    Route::get('nodes', 'V1Controller@nodeList'); // 获取账户全部节点
    Route::get('node/{id}', 'V1Controller@nodeList'); // 获取账户个别节点

    Route::post('register', 'V1Controller@register'); // 注册
    Route::get('shop', 'V1Controller@shop'); // 获取商品信息
});


Route::group(['middleware' => ['auth:api','checkPostPara']], function() {
    Route::get('test','Api\Client\UsersController@test');
    Route::post('user/ver1/logupload','Api\Client\UsersController@logUpload');
    Route::get('user/ver1/refreshstatus','Api\Client\UsersController@refreshStatus');
    Route::post('user/ver1/updateuser','Api\Client\AuthsController@updateUser');
    Route::post('user/ver1/buy','Api\Client\Buycontroller@create');
    Route::get('user/ver1/serverlist','Api\Client\Client\UsersController@serverList');
    Route::get('user/ver1/userstatus','Api\Client\UsersController@userStatus');
    Route::get('user/ver1/goodslist','Api\Client\UsersController@goodslist');
    Route::get('user/ver1/puerchased','Api\Client\UsersController@puerchased');
    Route::get('user/ver1/latestVersion/{device_type}','Api\Client\UsersController@latestVersion');
    Route::get('user/ver1/contract','Api\Client\UsersController@contract');
    Route::post('user/ver1/getdomain','Api\Client\UsersController@getDmain');
    Route::get('user/ver1/getseting','Api\Client\UsersController@getSeting');
    Route::post('user/ver1/checkin','Api\Client\UsersController@checkIn');
    Route::get('user/ver1/getpaymethod','Api\Client\UsersController@getPayMethod');
    Route::get('user/ver1/help/{type}','Api\Client\UsersController@help');
    Route::get('user/ver1/affrecord','Api\Client\UsersController@getAffRecord');
    Route::post('user/ver1/edpawdcode/update-password-with-auth-token','Api\Client\AuthsController@updatePasswordWithAuth');

});

Route::group(['middleware' => ['api','checkPostPara']], function() {

    Route::post('user/ver1/vregister','Api\Client\AuthsController@autoRegister');
    Route::post('user/ver1/login','Api\Client\AuthsController@login');
    Route::post('user/ver1/get_edpawdcode','Api\Client\AuthsController@sendCodeAPI');
    Route::post('user/ver1/updatepassword','Api\Client\AuthsController@updatePasswordWithCode');
  });
