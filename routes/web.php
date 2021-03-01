<?php

if (env('APP_KEY') && config('settings')) {
    Route::domain(sysConfig('subscribe_domain') ?: sysConfig('website_url'))
        ->get('s/{code}', 'User\SubscribeController@getSubscribeByCode')->name('sub'); // 节点订阅地址

    Route::domain(sysConfig('website_callback_url') ?: sysConfig('website_url'))
        ->match(['get', 'post'], 'callback/notify', 'PaymentController@notify')->name('payment.notify'); //支付回调
}

Route::get('callback/checkout', 'Gateway\PayPal@getCheckout')->name('paypal.checkout'); // 支付回调相关

// 登录相关
Route::middleware(['isForbidden', 'affiliate', 'isMaintenance'])->group(function () {
    Route::get('lang/{locale}', 'AuthController@switchLang')->name('lang'); // 语言切换
    Route::get('login', 'AuthController@showLoginForm')->middleware('isSecurity')->name('login'); // 登录页面
    Route::post('login', 'AuthController@login')->middleware('isSecurity'); // 登录
    Route::get('logout', 'AuthController@logout')->name('logout'); // 退出
    Route::get('register', 'AuthController@showRegistrationForm')->name('register'); // 注册
    Route::post('register', 'AuthController@register'); // 注册
    Route::match(['get', 'post'], 'reset', 'AuthController@resetPassword')->name('resetPasswd'); // 重设密码
    Route::match(['get', 'post'], 'reset/{token}', 'AuthController@reset')->name('resettingPasswd'); // 重设密码
    Route::match(['get', 'post'], 'activeUser', 'AuthController@activeUser')->name('active'); // 激活账号
    Route::get('active/{token}', 'AuthController@active')->name('activeAccount'); // 激活账号
    Route::post('send', 'AuthController@sendCode')->name('sendVerificationCode'); // 发送注册验证码
    Route::get('free', 'AuthController@free')->name('freeInvitationCode'); // 免费邀请码
    Route::get('create/string', '\Illuminate\Support\Str@random')->name('createStr'); // 生成随机密码
    Route::get('create/uuid', '\Illuminate\Support\Str@uuid')->name('createUUID'); // 生成UUID
    Route::get('getPort', '\App\Components\Helpers@getPort')->name('getPort'); // 获取端口
});
Route::get('admin/login', 'AuthController@showLoginForm')->name('admin.login')->middleware('isForbidden', 'isSecurity'); // 管理登录页面
Route::post('admin/login', 'AuthController@login')->middleware('isSecurity')->name('admin.login.post'); // 管理登录

//前端静态页面
Route::get('/', 'FrontPageController@home')->name("home");
//Route::get('/home', 'FrontPageController@home')->name("home");
Route::get('/price', 'FrontPageController@price')->name("price");
Route::get('/feature', 'FrontPageController@feature')->name("feature");
Route::get('/help-n', 'FrontPageController@help')->name("help-n");
Route::get('/help-subpage-n', 'FrontPageController@helpsubpage')->name("help-subpage-n");
//Route::get('/help-n/subpage', 'FrontPageController@helpsubpage')->name("help-subpage-n");
Route::get('/vpn-apps', 'FrontPageController@vpn')->name("vpn-apps");
Route::get('/account-n', 'FrontPageController@account')->name("account-n");
Route::get('/contact', 'FrontPageController@contact')->name("contact");
Route::get('/tutorial', 'FrontPageController@tutorial')->name("tutorial");
Route::get('/term', 'FrontPageController@term')->name("term");
Route::get('payment/payment-success', 'PaymentController@paymentSuccess')->name('payment-success');//支付成功跳转页面 
Route::get('payment/payment-failed', 'PaymentController@paymentFailed')->name('payment-failed');//支付失败跳转页面


