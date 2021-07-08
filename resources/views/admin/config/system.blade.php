@extends('admin.layouts')
@section('css')
    <link href="/assets/global/vendor/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="/assets/global/vendor/switchery/switchery.min.css" rel="stylesheet">
    <link href="/assets/global/vendor/dropify/dropify.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="page-content container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title"><i class="icon wb-settings"></i>通用配置</h1>
            </div>
            <div class="panel-body">
                <div class="nav-tabs-horizontal" data-plugin="tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="tab" href="#webSetting" aria-controls="webSetting" role="tab">网站常规</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#account" aria-controls="account" role="tab">账号设置</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#node" aria-controls="node" role="tab">节点设置</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#extend" aria-controls="extend" role="tab">拓展功能</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#checkIn" aria-controls="checkIn" role="tab">签到系统</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#promo" aria-controls="promo" role="tab">推广系统</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#notify" aria-controls="notify" role="tab">通知系统</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#auto" aria-controls="auto" role="tab">自动任务</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#other" aria-controls="other" role="tab">LOGO|客服|统计</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#payment" aria-controls="payment" role="tab">支付系统</a>
                        </li>
                        <li class="dropdown nav-item" role="presentation">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">菜单</a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item active" data-toggle="tab" href="#webSetting" aria-controls="webSetting" role="tab">网站常规</a>
                                <a class="dropdown-item" data-toggle="tab" href="#account" aria-controls="account" role="tab">账号设置</a>
                                <a class="dropdown-item" data-toggle="tab" href="#node" aria-controls="node" role="tab">节点设置</a>
                                <a class="dropdown-item" data-toggle="tab" href="#extend" aria-controls="extend" role="tab">拓展功能</a>
                                <a class="dropdown-item" data-toggle="tab" href="#checkIn" aria-controls="checkIn" role="tab">签到系统</a>
                                <a class="dropdown-item" data-toggle="tab" href="#promo" aria-controls="promo" role="tab">推广系统</a>
                                <a class="dropdown-item" data-toggle="tab" href="#notify" aria-controls="notify" role="tab">通知系统</a>
                                <a class="dropdown-item" data-toggle="tab" href="#auto" aria-controls="auto" role="tab">自动任务</a>
                                <a class="dropdown-item" data-toggle="tab" href="#other" aria-controls="other" role="tab">LOGO|客服|统计</a>
                                <a class="dropdown-item" data-toggle="tab" href="#payment" aria-controls="payment" role="tab">支付系统</a>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content py-35 px-35">
                        <div class="tab-pane active" id="webSetting" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal" autocomplete="off">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3" for="website_name">网站名称</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="website_name" value="{{$website_name}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('website_name')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 发邮件时展示 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="website_url">网站地址</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="url" class="form-control" id="website_url" value="{{$website_url}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('website_url')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">生成重置密码、在线支付必备 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="AppStore_id">苹果账号</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="email" class="form-control" id="AppStore_id" value="{{$AppStore_id}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('AppStore_id')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> iOS软件设置教程中使用的苹果账号 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="AppStore_password">苹果密码</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="AppStore_password" value="{{$AppStore_password}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('AppStore_password')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> iOS软件设置教程中使用的苹果密码 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="webmaster_email">管理员邮箱</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="email" class="form-control" id="webmaster_email" value="{{$webmaster_email}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('webmaster_email')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 错误提示时会提供管理员邮箱作为联系方式 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="website_security_code">网站安全码</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="website_security_code" value="{{$website_security_code}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-info" type="button" onclick="makeWebsiteSecurityCode()">生成</button>
                                                        <button class="btn btn-primary" type="button" onclick="update('website_security_code')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">非空时必须通过<a href="{{route('login')}}?securityCode=" target="_blank">安全入口</a>加上安全码才可访问</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="forbid_mode">禁止访问模式</label>
                                            <div class="col-md-9">
                                                <select id="forbid_mode" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','forbid_mode')">
                                                    <option value="">关闭</option>
                                                    <option value="ban_mainland">阻拦大陆</option>
                                                    <option value="ban_china">阻拦中国</option>
                                                    <option value="ban_oversea">阻拦海外</option>
                                                </select>
                                                <span class="text-help"> 依据IP对对应地区进行阻拦，非阻拦地区可正常访问 </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_forbid_robot">阻止机器人访问</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_forbid_robot" data-plugin="switchery" @if($is_forbid_robot) checked
                                                       @endif onchange="updateFromOther('switch','is_forbid_robot')">
                                                <span class="text-help"> 如果是机器人、爬虫、代理访问网站则会抛出404错误 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="maintenance_mode">维护模式</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="maintenance_mode" data-plugin="switchery" @if($maintenance_mode) checked
                                                       @endif onchange="updateFromOther('switch','maintenance_mode')">
                                                <span class="text-help"> 启用后，用户访问转移至维护界面 | 管理员使用 <a href="javascript:(0)">{{route('admin.login')}}</a> 登录</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3" for="maintenance_time">维护结束时间</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="datetime-local" class="form-control" id="maintenance_time" value="{{$maintenance_time}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('maintenance_time')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 用于维护界面倒计时 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3" for="maintenance_content">维护介绍内容</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <textarea class="form-control" rows="3" id="maintenance_content">{{$maintenance_content}}</textarea>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('maintenance_content')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 自定义维护内容信息 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3" for="redirect_url">重定向地址</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="redirect_url" value="{{$redirect_url}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('redirect_url')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 触发审计规则时访问请求被阻断并重定向至该地址 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="account" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_register">用户注册</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_register" data-plugin="switchery" @if($is_register) checked
                                                       @endif onchange="updateFromOther('switch','is_register')">
                                                <span class="text-help"> 关闭后无法注册 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_invite_register">邀请注册</label>
                                            <div class="col-md-9">
                                                <select id="is_invite_register" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','is_invite_register')">
                                                    <option value="">关闭</option>
                                                    <option value="1">可选</option>
                                                    <option value="2">必须</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_activate_account">激活账号</label>
                                            <div class="col-md-9">
                                                <select id="is_activate_account" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','is_activate_account')">
                                                    <option value="">关闭</option>
                                                    <option value="1">注册前激活</option>
                                                    <option value="2">注册后激活</option>
                                                </select>
                                                <span class="text-help"> 启用后用户需要通过邮件来激活账号 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="password_reset_notification">重置密码</label>
                                            <div class="col-md-9">
                                                <select id="password_reset_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','password_reset_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                </select>
                                                <span class="text-help"> 启用后用户可以重置密码 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_free_code">免费邀请码</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_free_code" data-plugin="switchery" @if($is_free_code) checked
                                                       @endif onchange="updateFromOther('switch','is_free_code')">
                                                <span class="text-help"> 关闭后免费邀请码不可见 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_rand_port">随机端口</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_rand_port" data-plugin="switchery" @if($is_rand_port) checked
                                                       @endif onchange="updateFromOther('switch','is_rand_port')">
                                                <span class="text-help"> 注册、添加用户时随机生成端口 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">端口范围</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <label for="min_port"></label>
                                                    <input type="number" class="form-control" id="min_port" value="{{$min_port}}"
                                                           onchange="updateFromInput('min_port','1000',$('#max_port').val())"/>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> ~ </span>
                                                    </div>
                                                    <label for="max_port"></label>
                                                    <input type="number" class="form-control" id="max_port" value="{{$max_port}}"
                                                           onchange="updateFromInput('max_port',$('#min_port').val(),'65535')"/>
                                                </div>
                                                <span class="text-help"> 端口范围：1000 - 65535 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="default_days">初始有效期</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="default_days" value="{{$default_days}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">小时</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('default_days','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 用户注册时默认账户有效期，为0即当天到期 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="default_traffic">初始流量</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="default_traffic" value="{{$default_traffic}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">MB</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('default_traffic','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 用户注册时默认可用流量 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="invite_num">可生成邀请码数</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="invite_num" value="{{$invite_num}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('invite_num','0')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 用户可以生成的邀请码数 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="reset_password_times">重置密码次数</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="reset_password_times" value="{{$reset_password_times}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('reset_password_times','0')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 24小时内可以通过邮件重置密码次数 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_email_filtering">邮箱过滤机制</label>
                                            <div class="col-md-9">
                                                <select id="is_email_filtering" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','is_email_filtering')">
                                                    <option value="">关闭</option>
                                                    <option value="1">黑名单</option>
                                                    <option value="2">白名单</option>
                                                </select>
                                                <span class="text-help">黑名单: 用户可使用任意黑名单外的邮箱注册；白名单:用户只能选择使用白名单中的邮箱后缀注册 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="active_times">激活账号次数</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="active_times" value="{{$active_times}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('active_times','0')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 24小时内可以通过邮件激活账号次数 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="register_ip_limit">同IP注册限制</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="register_ip_limit" value="{{$register_ip_limit}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('register_ip_limit','0')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 同IP在24小时内允许注册数量，为0时不限制 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="user_invite_days">用户-邀请码有效期</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="user_invite_days" value="{{$user_invite_days}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">天</span>
                                                    </div>
                                                    <button class="btn btn-primary" type="button"
                                                            onclick="updateFromInput('user_invite_days','1',false)">{{trans('common.update')}}</button>
                                                </div>
                                                <span class="text-help"> 用户自行生成邀请的有效期 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="admin_invite_days">管理员-邀请码有效期</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="admin_invite_days" value="{{$admin_invite_days}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">天</span>
                                                    </div>
                                                    <button class="btn btn-primary" type="button"
                                                            onclick="updateFromInput('admin_invite_days','1',false)">{{trans('common.update')}}</button>
                                                </div>
                                                <span class="text-help"> 管理员生成邀请码的有效期 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="node" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="subscribe_domain">节点订阅地址</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="url" class="form-control" id="subscribe_domain" value="{{$subscribe_domain}}" placeholder="默认为 {{$website_url}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('subscribe_domain')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">（推荐）防止面板域名被DNS投毒后无法正常订阅，需带http://或https:// </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="subscribe_max">订阅节点数</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="subscribe_max" value="{{$subscribe_max}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('subscribe_max','0')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 客户端订阅时取得几个节点，为0时返回全部节点 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="rand_subscribe">随机订阅</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="rand_subscribe" data-plugin="switchery" @if($rand_subscribe) checked
                                                       @endif onchange="updateFromOther('switch','rand_subscribe')">
                                                <span class="text-help"> 启用后，订阅时将随机返回节点信息，否则按节点排序返回 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_custom_subscribe">高级订阅</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_custom_subscribe" data-plugin="switchery" @if($is_custom_subscribe) checked
                                                       @endif onchange="updateFromOther('switch','is_custom_subscribe')">
                                                <span class="text-help">启用后，订阅信息顶部将显示过期时间、剩余流量（只支持个别客户端） </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="web_api_url">授权/后端访问域名</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="web_api_url" value="{{$web_api_url}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('web_api_url')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">例：https://demo.proxypanel.ml</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="v2ray_license">V2Ray授权</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="v2ray_license" value="{{$v2ray_license}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('v2ray_license')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="trojan_license">Trojan授权</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="trojan_license" value="{{$trojan_license}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('trojan_license')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="v2ray_tls_provider">V2Ray TLS配置</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="v2ray_tls_provider" value="{{$v2ray_tls_provider}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('v2ray_tls_provider')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">后端自动签发/载入TLS证书时用（节点的设置值优先级高于此处）</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="extend" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="ddns_mode">DDNS模式</label>
                                            <div class="col-md-9">
                                                <select id="ddns_mode" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','ddns_mode')">
                                                    <option value="">关闭</option>
                                                    <option value="namesilo">Namesilo</option>
                                                    <option value="aliyun">阿里云(国际&国内)</option>
                                                    <option value="dnspod">DNSPod</option>
                                                    <option value="cloudflare">CloudFlare</option>
                                                </select>
                                                <span class="text-help"> 添加/编辑/删除节点的【域名、ipv4、ipv6】时，自动更新对应内容至DNS服务商 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="ddns_key">DNS服务商Key</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="ddns_key" value="{{$ddns_key}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('ddns_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">浏览<a href="https://proxypanel.gitbook.io/wiki/ddns" target="_blank">设置指南</a>来设置</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="ddns_secret">DNS服务商Secret</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="ddns_secret" value="{{$ddns_secret}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('ddns_secret')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="col-lg-12">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_captcha">验证码模式</label>
                                            <div class="col-md-9">
                                                <select id="is_captcha" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','is_captcha')">
                                                    <option value="">关闭</option>
                                                    <option value="1">普通验证码</option>
                                                    <option value="2">极验Geetest</option>
                                                    <option value="3">Google reCaptcha</option>
                                                    <option value="4">hCaptcha</option>
                                                </select>
                                                <span class="text-help"> 启用后 登录/注册 需要进行验证码认证 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="captcha_key">验证码 Key</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="captcha_key" value="{{$captcha_key}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('captcha_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">浏览<a href="https://proxypanel.gitbook.io/wiki/captcha" target="_blank">设置指南</a>来设置</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="captcha_secret">验证码 Secret/ID</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="captcha_secret" value="{{$captcha_secret}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('captcha_secret')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="checkIn" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_checkin">签到加流量</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_checkin" data-plugin="switchery" @if($is_checkin) checked
                                                       @endif onchange="updateFromOther('switch','is_checkin')">
                                                <span class="text-help"> 登录时将根据流量范围随机得到流量 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="traffic_limit_time">时间间隔</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="traffic_limit_time" value="{{$traffic_limit_time}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">分钟</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('traffic_limit_time','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 间隔多久才可以再次签到</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label">流量范围</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <label for="min_rand_traffic"></label>
                                                    <input type="number" class="form-control" id="min_rand_traffic" value="{{$min_rand_traffic}}"
                                                           onchange="updateFromInput('min_rand_traffic','0','{{$max_rand_traffic}}')"/>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> ~ </span>
                                                    </div>
                                                    <label for="max_rand_traffic"></label>
                                                    <input type="number" class="form-control" id="max_rand_traffic" value="{{$max_rand_traffic}}"
                                                           onchange="updateFromInput('max_rand_traffic','{{$min_rand_traffic}}',false)"/>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> MB </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="promo" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="referral_status">推广功能</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="checkbox" id="referral_status" data-plugin="switchery" @if($referral_status) checked
                                                           @endif onchange="updateFromOther('switch','referral_status')">
                                                </div>
                                                <span class="text-help"> 关闭后用户不可见，但是不影响其正常邀请返利 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="referral_type">返利模式</label>
                                            <div class="col-md-9">
                                                <select id="referral_type" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','referral_type')">
                                                    <option value="">关闭</option>
                                                    <option value="1">首购返利</option>
                                                    <option value="2">循环返利</option>
                                                </select>
                                                <span class="text-help"> 切换模式后旧数据不变，新的返利按新的模式计算 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="referral_traffic">注册送流量</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="referral_traffic" value="{{$referral_traffic}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">MB</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('referral_traffic','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 根据推广链接、邀请码注册则赠送相应的流量 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="referral_percent">返利比例</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="referral_percent" value="{{$referral_percent * 100}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('referral_percent','0','100')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 根据推广链接注册的账号每笔消费推广人可以分成的比例 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="referral_money">提现限制</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="referral_money" value="{{$referral_money}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">元</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('referral_money','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 满多少元才可以申请提现 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="notify" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="account_expire_notification">账号过期通知</label>
                                            <div class="col-md-9">
                                                <select id="account_expire_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','account_expire_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="database">站内通知</option>
                                                </select>
                                                <span class="text-help"> 通知用户账号即将到期 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="expire_days">过期警告阈值</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="expire_days" value="{{$expire_days}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">天</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('expire_days','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 【账号过期通知】开始阈值，每日通知用户 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="data_exhaust_notification">流量耗尽通知</label>
                                            <div class="col-md-9">
                                                <select id="data_exhaust_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','data_exhaust_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="database">站内通知</option>
                                                </select>
                                                <span class="text-help"> 通知用户流量即将耗尽 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="traffic_warning_percent">流量警告阈值</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="traffic_warning_percent" value="{{$traffic_warning_percent}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('traffic_warning_percent','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 【流量耗尽通知】开始阈值，每日通知用户 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="node_offline_notification">节点离线提醒</label>
                                            <div class="col-md-9">
                                                <select id="node_offline_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','node_offline_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="telegram" disabled>Telegram</option>
                                                    <option value="beary" disabled>BearyChat</option>
                                                    <option value="bark">Bark</option>
                                                    <option value="serverChan">ServerChan</option>
                                                </select>
                                                <span class="text-help"> 每10分钟检测节点离线并提醒管理员 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="offline_check_times">离线提醒次数</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="offline_check_times" value="{{$offline_check_times}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">次</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('offline_check_times','0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 24小时内提醒n次后不再提醒 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="node_blocked_notification">节点阻断提醒</label>
                                            <div class="col-md-9">
                                                <select id="node_blocked_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','node_blocked_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="telegram" disabled>Telegram</option>
                                                    <option value="beary" disabled>BearyChat</option>
                                                    <option value="serverChan">ServerChan</option>
                                                </select>
                                                <span class="text-help"> 每小时检测节点是否被阻断并提醒管理员 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="detection_check_times">阻断检测提醒</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="detection_check_times" value="{{$detection_check_times}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">次</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('detection_check_times','0','12')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 提醒N次后自动下线节点，为0时不限制，不超过12 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="payment_received_notification">支付成功通知</label>
                                            <div class="col-md-9">
                                                <select id="payment_received_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','payment_received_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="database">站内通知</option>
                                                </select>
                                                <span class="text-help"> 用户支付订单后通知用户订单状态 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="ticket_closed_notification">工单关闭通知</label>
                                            <div class="col-md-9">
                                                <select id="ticket_closed_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','ticket_closed_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="telegram" disabled>Telegram</option>
                                                    <option value="beary" disabled>BearyChat</option>
                                                    <option value="bark">Bark</option>
                                                    <option value="serverChan">ServerChan</option>
                                                </select>
                                                <span class="text-help"> 工单关闭通知用户 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="ticket_created_notification">新工单通知</label>
                                            <div class="col-md-9">
                                                <select id="ticket_created_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','ticket_created_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="telegram" disabled>Telegram</option>
                                                    <option value="beary" disabled>BearyChat</option>
                                                    <option value="bark">Bark</option>
                                                    <option value="serverChan">ServerChan</option>
                                                </select>
                                                <span class="text-help"> 新工单通知管理/用户，取决于谁创建了新工单， </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="ticket_replied_notification">工单回复通知</label>
                                            <div class="col-md-9">
                                                <select id="ticket_replied_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','ticket_replied_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="telegram" disabled>Telegram</option>
                                                    <option value="beary" disabled>BearyChat</option>
                                                    <option value="bark">Bark</option>
                                                    <option value="serverChan">ServerChan</option>
                                                </select>
                                                <span class="text-help"> 工单回复通知对方 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="server_chan_key">SCKEY</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="server_chan_key" value="{{$server_chan_key}}" placeholder="请到ServerChan申请"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('server_chan_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">启用ServerChan，请务必填入本值（<a href="http://sc.ftqq.com" target="_blank">申请SCKEY</a>） @can('admin.test.notify')（<a
                                                        href="javascript:sendTestNotification('serverChan');
">发送测试消息</a>）@endcan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="bark_key">Bark设备号</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="url" class="form-control" id="bark_key" value="{{$bark_key}}" placeholder="安装并打开Bark后取得"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('bark_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help">推送消息到iOS设备，需要在iOS设备里装一个名为Bark的应用，取网址后的一长串代码，启用Bark，请务必填入本值 @can('admin.test.notify')（<a href="javascript:sendTestNotification('bark');
">发送测试消息</a>）@endcan </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_push_bear">PushBear</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_push_bear" data-plugin="switchery" @if($is_push_bear) checked
                                                       @endif onchange="updateFromOther('switch','is_push_bear')">
                                                <span class="text-help">使用PushBear推送微信消息给用户（<a href="https://pushbear.ftqq.com/admin/#/signin" target="_blank">创建消息通道</a>）</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="push_bear_send_key">PushBear SendKey</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="push_bear_send_key" value="{{$push_bear_send_key}}" placeholder="创建消息通道后即可获取"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('push_bear_send_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 启用PushBear，请务必填入本值 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="push_bear_qrcode">PushBear订阅二维码</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="url" class="form-control" id="push_bear_qrcode" value="{{$push_bear_qrcode}}" placeholder="填入消息通道的二维码URL"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('push_bear_qrcode')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 创建消息通道后，在二维码上点击右键“复制图片地址”并粘贴至此处 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="auto" role="tabpanel">
                            <form action="#" method="post" role="form" class="form-horizontal">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_clear_log">自动清除日志</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_clear_log" data-plugin="switchery" @if($is_clear_log) checked
                                                       @endif onchange="updateFromOther('switch','is_clear_log')">
                                                <span class="text-help"> （推荐）启用后自动清除无用日志 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="reset_traffic">流量自动重置</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="reset_traffic" data-plugin="switchery" @if($reset_traffic) checked
                                                       @endif onchange="updateFromOther('switch','reset_traffic')">
                                                <span class="text-help"> 用户会按其购买套餐的日期自动重置可用流量 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_subscribe_ban">订阅异常自动封禁</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_subscribe_ban" data-plugin="switchery" @if($is_subscribe_ban) checked
                                                       @endif onchange="updateFromOther('switch','is_subscribe_ban')">
                                                <span class="text-help"> 启用后用户订阅链接请求超过设定阈值则自动封禁 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="subscribe_ban_times">订阅请求阈值</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="subscribe_ban_times" value="{{$subscribe_ban_times}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('subscribe_ban_times','0')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                                <span class="text-help"> 24小时内订阅链接请求次数限制 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_traffic_ban">异常自动封号</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_traffic_ban" data-plugin="switchery" @if($is_traffic_ban) checked
                                                       @endif onchange="updateFromOther('switch','is_traffic_ban')"/>
                                                <span class="text-help"> 1小时内流量超过异常阈值则自动封号（仅禁用代理） </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="data_anomaly_notification">流量异常通知</label>
                                            <div class="col-md-9">
                                                <select id="data_anomaly_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','data_anomaly_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="telegram" disabled>Telegram</option>
                                                    <option value="beary" disabled>BearyChat</option>
                                                    <option value="bark">Bark</option>
                                                    <option value="serverChan">ServerChan</option>
                                                </select>
                                                <span class="text-help"> 1小时内流量超过异常阈值通知超管 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="traffic_ban_value">流量异常阈值</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="traffic_ban_value" value="{{$traffic_ban_value}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">GB</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('traffic_ban_value', '1')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 1小时内超过该值，则触发自动封号 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="traffic_ban_time">封号时长</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="traffic_ban_time" value="{{$traffic_ban_time}}"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">分钟</span>
                                                        <button class="btn btn-primary" type="button"
                                                                onclick="updateFromInput('traffic_ban_time', '0')">{{trans('common.update')}}</button>
                                                    </div>
                                                </div>
                                                <span class="text-help"> 触发流量异常导致用户被封禁的时长，到期后自动解封 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="auto_release_port">端口回收机制</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="auto_release_port" data-plugin="switchery" @if($auto_release_port) checked
                                                       @endif onchange="updateFromOther('switch','auto_release_port')">
                                                <span class="text-help"> 被封禁/过期{{config('tasks.release_port')}}天的账号端口自动释放 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="is_ban_status">过期自动封禁</label>
                                            <div class="col-md-9">
                                                <input type="checkbox" id="is_ban_status" data-plugin="switchery" @if($is_ban_status) checked
                                                       @endif onchange="updateFromOther('switch','is_ban_status')">
                                                <span class="text-help">(慎重)封禁整个账号会重置账号的所有数据且会导致用户无法登录,不开启状态下只封禁用户代理 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-md-3 col-form-label" for="node_daily_notification">节点使用报告</label>
                                            <div class="col-md-9">
                                                <select id="node_daily_notification" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                        onchange="updateFromOther('select','node_daily_notification')" multiple>
                                                    <option value="mail">邮箱</option>
                                                    <option value="telegram" disabled>Telegram</option>
                                                    <option value="beary" disabled>BearyChat</option>
                                                    <option value="serverChan">ServerChan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="other" role="tabpanel">
                            @if($errors->any())
                                <x-alert type="danger" :message="$errors->all()"/>
                            @endif
                            @if (Session::has('successMsg'))
                                <x-alert type="success" :message="Session::get('successMsg')"/>
                            @endif
                            <div class="form-row">
                                <form action="{{route('admin.system.extend')}}" method="post" enctype="multipart/form-data" class="upload-form col-lg-12 row" role="form"
                                      id="setExtend">@csrf
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-form-label col-md-3" for="website_home_logo">首页LOGO</label>
                                            <div class="col-md-9">
                                                <input type="file" id="website_home_logo" name="website_home_logo" data-plugin="dropify"
                                                       data-default-file="{{asset($website_home_logo ?? '/assets/images/default.png')}}"/>
                                                <button type="submit" class="btn btn-success float-right mt-10"> 提 交</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="row">
                                            <label class="col-form-label col-md-3" for="website_logo">站内LOGO</label>
                                            <div class="col-md-9">
                                                <input type="file" id="website_logo" name="website_logo" data-plugin="dropify"
                                                       data-default-file="{{asset($website_logo ?? '/assets/images/default.png')}}"/>
                                                <button type="submit" class="btn btn-success float-right mt-10"> 提 交</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group col-lg-6">
                                    <div class="row">
                                        <label class="col-form-label col-md-3" for="website_analytics">统计代码</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="10" id="website_analytics" name="website_analytics">{{$website_analytics}}</textarea>
                                            <button class="btn btn-success float-right mt-10" type="button"
                                                    onclick="update('website_analytics')">{{trans('common.update')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="row">
                                        <label class="col-form-label col-md-3" for="website_customer_service">客服代码</label>
                                        <div class="col-md-9">
                                                <textarea class="form-control" rows="10" id="website_customer_service"
                                                          name="website_customer_service">{{$website_customer_service}}</textarea>
                                            <button class="btn btn-success float-right mt-10" type="button"
                                                    onclick="update('website_customer_service')">{{trans('common.update')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="payment" role="tabpanel">
                            <div class="tab-content pb-100">
                                <div class="tab-pane active" id="paymentSetting" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label class="col-md-3 col-form-label" for="is_AliPay">支付宝支付</label>
                                            <select class="col-md-5" id="is_AliPay" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                    onchange="updateFromOther('select','is_AliPay')">
                                                <option value="">关闭</option>
                                                <option value="f2fpay">F2F</option>
                                                <option value="codepay">码支付</option>
                                                <option value="epay">易支付</option>
                                                <option value="paybeaver">海狸支付</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="col-md-3 col-form-label" for="is_QQPay">QQ钱包</label>
                                            <select class="col-md-5" id="is_QQPay" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                    onchange="updateFromOther('select','is_QQPay')">
                                                <option value="">关闭</option>
                                                <option value="codepay">码支付</option>
                                                <option value="epay">易支付</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="col-md-3 col-form-label" for="is_WeChatPay">微信支付</label>
                                            <select class="col-md-5" id="is_WeChatPay" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                    onchange="updateFromOther('select','is_WeChatPay')">
                                                <option value="">关闭</option>
                                                <option value="codepay">码支付</option>
                                                <option value="payjs">PayJS</option>
                                                <option value="epay">易支付</option>
                                                <option value="paybeaver">海狸支付</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="col-md-3 col-form-label" for="is_otherPay">特殊支付</label>
                                            <select class="col-md-5" id="is_otherPay" data-plugin="selectpicker" data-style="btn-outline btn-primary"
                                                    onchange="updateFromOther('select','is_otherPay')">
                                                <option value="">关闭</option>
                                                <option value="bitpayx">麻瓜宝</option>
                                                <option value="paypal">PayPal</option>
                                                <option value="stripe">Stripe</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="subject_name">自定义商品名称</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="subject_name" value="{{$subject_name}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('subject_name')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help"> 用于在支付渠道的商品标题显示 </span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="website_callback_url">通用支付回调地址</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="website_callback_url" value="{{$website_callback_url}}"
                                                           placeholder="默认为 {{$website_url}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button"
                                                                    onclick="update('website_callback_url')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help">防止因为网站域名被DNS投毒后导致支付无法正常回调，需带http://或https:// </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="AlipayF2F" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">支付宝F2F</label>
                                            <div class="col-md-9">
                                                本功能需要<a href="https://open.alipay.com/platform/appManage.htm?#/create/" target="_blank">蚂蚁金服开放平台</a>申请权限及应用
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="f2fpay_app_id">应用ID</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="f2fpay_app_id" value="{{$f2fpay_app_id}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('f2fpay_app_id')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help">即：APPID</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="f2fpay_private_key">应用私钥</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input class="form-control" type="text" id="f2fpay_private_key" value="{{$f2fpay_private_key}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('f2fpay_private_key')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help">生成秘钥软件生成时，产生的应用秘钥</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="f2fpay_public_key">支付宝公钥</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="f2fpay_public_key" value="{{$f2fpay_public_key}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('f2fpay_public_key')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help"> 注意不是应用公钥！</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="CodePay" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">码支付</label>
                                            <div class="col-md-7">
                                                请到 <a href="https://codepay.fateqq.com/i/377289" target="_blank">码支付</a>申请账号，然后下载登录其挂机软件
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="codepay_url">请求URL</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="codepay_url" value="{{$codepay_url}}"
                                                           placeholder="https://codepay.fateqq.com/creat_order/?"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('codepay_url')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="codepay_id">码支付ID</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="codepay_id" value="{{$codepay_id}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('codepay_id')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="codepay_key">通信密钥</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="codepay_key" value="{{$codepay_key}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('codepay_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="EPay" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">易支付</label>
                                            @can('admin.test.epay')
                                                <div class="col-md-7">
                                                    <button class="btn btn-primary" type="button" onclick="epayInfo()">查询</button>
                                                </div>
                                            @endcan
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="epay_url">接口对接地址</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="epay_url" value="{{$epay_url}}" placeholder="https://www.example.com"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('epay_url')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="epay_mch_id">商户ID</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="epay_mch_id" value="{{$epay_mch_id}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('epay_mch_id')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="epay_key">商户密钥</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="epay_key" value="{{$epay_key}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('epay_key')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="PayJs" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">PayJs</label>
                                            <div class="col-md-7">
                                                请到<a href="https://payjs.cn/ref/zgxjnb" target="_blank">PayJs</a> 申请账号
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="payjs_mch_id">商户号</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="payjs_mch_id" value="{{$payjs_mch_id}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('payjs_mch_id')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help">在<a href="https://payjs.cn/dashboard/member" target="_blank">本界面</a>获取信息</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="payjs_key">通信密钥</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="payjs_key" value="{{$payjs_key}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('payjs_key')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="MugglePay" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">麻瓜宝 MugglePay</label>
                                            <div class="col-md-7">
                                                请到<a href="https://merchants.mugglepay.com/user/register?ref=MP904BEBB79FE0" target="_blank">麻瓜宝 MugglePay</a>申请账号
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="bitpay_secret">应用密钥</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="bitpay_secret" value="{{$bitpay_secret}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('bitpay_secret')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help">在<a href="https://merchants.mugglepay.com/basic/api" target="_blank">API设置</a>中获取后台服务器的秘钥</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="PayPal" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">PayPal</label>
                                            <div class="col-md-7">
                                                使用商家账号登录<a href="https://www.paypal.com/businessprofile/mytools/apiaccess/firstparty" target="_blank">API凭证申请页</a>, 同意并获取设置信息
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="paypal_username">API用户名</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="paypal_username" value="{{$paypal_username}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('paypal_username')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="paypal_password">API密码</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="paypal_password" value="{{$paypal_password}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('paypal_password')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="paypal_secret">签名</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="paypal_secret" value="{{$paypal_secret}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('paypal_secret')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex" hidden>
                                            <label class="col-md-3 col-form-label" for="paypal_certificate">证书</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="paypal_certificate" value="{{$paypal_certificate}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('paypal_certificate')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex" hidden>
                                            <label class="col-md-3 col-form-label" for="paypal_app_id">应用ID</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="paypal_app_id" value="{{$paypal_app_id}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('paypal_app_id')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="Stripe" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">Stripe</label>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="stripe_public_key">Public Key</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="stripe_public_key" value="{{$stripe_public_key}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('stripe_public_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="stripe_secret_key">Secret Key</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="stripe_secret_key" value="{{$stripe_secret_key}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('stripe_secret_key')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="stripe_signing_secret">WebHook Signing secret</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="stripe_signing_secret" value="{{$stripe_signing_secret}}"/>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="update('stripe_signing_secret')">{{trans('common.update')}}</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="paybeaver" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label">海狸支付 PayBeaver</label>
                                            <div class="col-md-7">
                                                请到<a href="https://merchant.paybeaver.com/?aff_code=iK4GNuX8" target="_blank">海狸支付 PayBeaver</a>申请账号
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex"></div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="paybeaver_app_id">App ID</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="paybeaver_app_id" value="{{$paybeaver_app_id}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button" onclick="update('paybeaver_app_id')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help"><a href="https://merchant.paybeaver.com/" target="_blank">商户中心</a> -&gt; 开发者 -&gt; App ID</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 d-flex">
                                            <label class="col-md-3 col-form-label" for="paybeaver_app_secret">App Secret</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="paybeaver_app_secret" value="{{$paybeaver_app_secret}}"/>
                                                    <span class="input-group-append">
                                                            <button class="btn btn-primary" type="button"
                                                                    onclick="update('paybeaver_app_secret')">{{trans('common.update')}}</button>
                                                        </span>
                                                </div>
                                                <span class="text-help"><a href="https://merchant.paybeaver.com/" target="_blank">商户中心</a> -&gt; 开发者 -&gt; App Secret</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-tabs nav-tabs-bottom nav-tabs-line dropup" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#paymentSetting" aria-controls="paymentSetting" role="tab">支付设置</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#AlipayF2F" aria-controls="AlipayF2F" role="tab">支付宝F2F</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#CodePay" aria-controls="CodePay" role="tab">码支付</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#EPay" aria-controls="EPay" role="tab">易支付</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#PayJs" aria-controls="PayJs" role="tab">PayJs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#MugglePay" aria-controls="MugglePay" role="tab">MugglePay</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#PayPal" aria-controls="PayPal" role="tab">PayPal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Stripe" aria-controls="Stripe" role="tab">Stripe</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#paybeaver" aria-controls="PayBeaver" role="tab">PayBeaver</a>
                                </li>
                                <li class="nav-item dropdown" style="display: none;">
                                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false" aria-haspopup="true">菜单</a>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" data-toggle="tab" href="#paymentSetting" aria-controls="paymentSetting" role="tab">支付设置</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#AlipayF2F" aria-controls="AlipayF2F" role="tab">支付宝F2F</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#CodePay" aria-controls="CodePay" role="tab">码支付</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#EPay" aria-controls="EPay" role="tab">易支付</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#PayJs" aria-controls="PayJs" role="tab">PayJs</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#MugglePay" aria-controls="MugglePay" role="tab">MugglePay</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#PayPal" aria-controls="PayPal" role="tab">PayPal</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#Stripe" aria-controls="Stripe" role="tab">Stripe</a>
                                        <a class="dropdown-item" data-toggle="tab" href="#paybeaver" aria-controls="PayBeaver" role="tab">PayBeaver</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="/assets/global/vendor/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/assets/global/vendor/switchery/switchery.min.js"></script>
    <script src="/assets/global/vendor/dropify/dropify.min.js"></script>
    <script src="/assets/global/js/Plugin/bootstrap-select.js"></script>
    <script src="/assets/global/js/Plugin/switchery.js"></script>
    <script src="/assets/global/js/Plugin/responsive-tabs.js"></script>
    <script src="/assets/global/js/Plugin/tabs.js"></script>
    <script src="/assets/custom/jump-tab.js"></script>
    <script src="/assets/global/js/Plugin/dropify.js"></script>
    <script>
        $(document).ready(function() {
            $('#forbid_mode').selectpicker('val', '{{$forbid_mode}}');
            $('#is_invite_register').selectpicker('val', '{{$is_invite_register}}');
            $('#is_activate_account').selectpicker('val', '{{$is_activate_account}}');
            $('#ddns_mode').selectpicker('val', '{{$ddns_mode}}');
            $('#is_captcha').selectpicker('val', '{{$is_captcha}}');
            $('#referral_type').selectpicker('val', '{{$referral_type}}');
            $('#is_email_filtering').selectpicker('val', '{{$is_email_filtering}}');
            $('#is_AliPay').selectpicker('val', '{{$is_AliPay}}');
            $('#is_QQPay').selectpicker('val', '{{$is_QQPay}}');
            $('#is_WeChatPay').selectpicker('val', '{{$is_WeChatPay}}');
            $('#is_otherPay').selectpicker('val', '{{$is_otherPay}}');
            $('#account_expire_notification').selectpicker('val', {!! $account_expire_notification !!});
            $('#data_anomaly_notification').selectpicker('val', {!! $data_anomaly_notification !!});
            $('#data_exhaust_notification').selectpicker('val', {!! $data_exhaust_notification !!});
            $('#node_blocked_notification').selectpicker('val', {!! $node_blocked_notification !!});
            $('#node_daily_notification').selectpicker('val', {!! $node_daily_notification !!});
            $('#node_offline_notification').selectpicker('val', {!! $node_offline_notification !!});
            $('#password_reset_notification').selectpicker('val', {!! $password_reset_notification !!});
            $('#payment_received_notification').selectpicker('val', {!! $payment_received_notification !!});
            $('#ticket_closed_notification').selectpicker('val', {!! $ticket_closed_notification !!});
            $('#ticket_created_notification').selectpicker('val', {!! $ticket_created_notification !!});
            $('#ticket_replied_notification').selectpicker('val', {!! $ticket_replied_notification !!});

            // Get all options within select
            disablePayment(document.getElementById('is_AliPay').getElementsByTagName('option'));
            disablePayment(document.getElementById('is_QQPay').getElementsByTagName('option'));
            disablePayment(document.getElementById('is_WeChatPay').getElementsByTagName('option'));
            disablePayment(document.getElementById('is_otherPay').getElementsByTagName('option'));

            @if (!$captcha)
            disableCaptcha(document.getElementById('is_captcha').getElementsByTagName('option'));
            @endif

        });

        function disablePayment(op) {
            for (let i = 1; i < op.length; i++) {
                @json($payments).
                includes(op[i].value)
                    ? op[i].disabled = false
                    : op[i].disabled = true;
            }
        }

        function disableCaptcha(op) {
            for (let i = 2; i < op.length; i++) {
                op[i].disabled = true;
            }
        }

        // 系统设置更新
        function systemUpdate(systemItem, value) {
            @can('admin.system.update')
            $.post('{{route('admin.system.update')}}', {_token: '{{csrf_token()}}', name: systemItem, value: value}, function(ret) {
                if (ret.status === 'success') {
                    swal.fire({title: ret.message, icon: 'success', timer: 1500, showConfirmButton: false});
                } else {
                    swal.fire({title: ret.message, icon: 'error'}).then(() => window.location.reload());
                }
            });
            @else
            swal.fire({title: '您没有权限修改系统参数！', icon: 'error', timer: 1500, showConfirmButton: false});
            @endcan
        }

        // 正常input更新
        function update(systemItem) {
            systemUpdate(systemItem, $('#' + systemItem).val());
        }

        // 需要检查限制的更新
        function updateFromInput(systemItem, lowerBound, upperBound) {
            let value = parseInt($('#' + systemItem).val());
            if (lowerBound !== false && value < lowerBound) {
                swal.fire({title: '不能小于' + lowerBound, icon: 'warning', timer: 1500, showConfirmButton: false});
            } else if (upperBound !== false && value > upperBound) {
                swal.fire({title: '不能大于' + upperBound, icon: 'warning', timer: 1500, showConfirmButton: false});
            } else {
                systemUpdate(systemItem, value);
            }
        }

        // 其他项更新选择
        function updateFromOther(inputType, systemItem) {
            let input = $('#' + systemItem);
            switch (inputType) {
                case 'select':
                    input.on('changed.bs.select', function() {
                        systemUpdate(systemItem, $(this).val());
                    });
                    break;
                case 'multiSelect':
                    input.on('changed.bs.select', function() {
                        systemUpdate(systemItem, $(this).val().join(','));
                    });
                    break;
                case 'switch':
                    systemUpdate(systemItem, document.getElementById(systemItem).checked ? 1 : 0);
                    break;
                default:
                    break;
            }
        }

        // 发送Bark测试消息
        @can('admin.test.notify')
        function sendTestNotification(channel) {
            $.post('{{route('admin.test.notify')}}', {_token: '{{csrf_token()}}', channel: channel}, function(ret) {
                if (ret.status === 'success') {
                    swal.fire({title: ret.message, icon: 'success', timer: 1500, showConfirmButton: false});
                } else {
                    swal.fire({title: ret.message, icon: 'error'});
                }
            });
        }
        @endcan

        // 生成网站安全码
        function makeWebsiteSecurityCode() {
            $.get('{{route('createStr')}}', function(ret) {
                $('#website_security_code').val(ret);
            });
        }

        @can('admin.test.epay')
        function epayInfo() {
            $.get('{{route('admin.test.epay')}}', function(ret) {
                if (ret.status === 'success') {
                    swal.fire({
                        title: '易支付信息(仅供参考)',
                        html: '商户状态: ' + ret.data['active'] + ' | 账号余额： ' + ret.data['money'] + ' | 结算账号：' + ret.data['account'] +
                            '<br\><br\>渠道手续费：【支付宝 - ' + (100 - ret.data['alirate']) + '% | 微信 - ' + (100 - ret.data['wxrate']) +
                            '% | QQ钱包 - ' + (100 - ret.data['qqrate']) + '%】<br\><br\> 请按照支付平台的介绍为准，本信息纯粹为Api获取信息',
                        icon: 'info',
                    });
                } else {
                    swal.fire({title: ret.message, icon: 'error'});
                }
            });
        }
        @endcan
    </script>
@endsection
