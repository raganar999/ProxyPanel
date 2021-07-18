<?php

return [
   
    'accept_term'     => '我已阅读并同意遵守',
    'active'          => [
        'attribute' => '激活',
        'error'     => [
            'activated' => '账号已激活，无需再次激活',
            'disable'   => '本站关闭了账号激活子系统，您可以直接去登录！',
            'throttle'  => '您已触发本站激活请求限制机制，请勿频繁操作！如有问题，请联系:email',
        ],
        'sent'      => '激活链接已发送至您的邮箱，请稍作等待或查看垃圾箱',
        'promotion' => ['0' => '账号尚未激活，请点击', '1' => '启动激活程序！'],
    ],
    'aup'             => '可接受使用条款',
    'captcha'         => [
        'attribute' => '验证码',
        'error'     => ['failed' => '验证码验证失败，请重新输入', 'timeout' => '验证码不合法！可能已过期，请刷新后重试'],
        'required'  => '请正确完成验证码操作',
        'sent'      => '验证码已发送至您的邮箱，请稍作等待或查看垃圾箱',
    ],
    'email'           => [
        'error' => ['banned' => '本站屏蔽了您使用的邮箱服务商，请使用其他有效邮箱', 'invalid' => '使用邮箱不在本站支持邮箱列表内'],
    ],
    'error'           => [
        'account_baned'  => '您的账号已被禁止登录！',
        'login_error'    => '登录错误，请稍后重试！',
        'login_failed'   => '登录失败，请检查邮箱或密码是否输入正确！',
        'repeat_request' => '请勿重复请求，请刷新后重试',
        'url_timeout'    => '链接已失效, 请重新操作',
    ],
    'invite'          => [
        'attribute'    => '邀请码',
        'error'        => ['unavailable' => '邀请码不可用，请重试'],
        'get'          => '点击获取邀请码',
        'not_required' => '无需邀请码,可直接注册！',
    ],
    'login'           => '登 录',
    'logout'          => '登 出',
    'maintenance'     => '维护',
    'maintenance_tip' => '网站维护中',
    'optional'        => '可选',
    'password'        => [
        'forget'   => '忘记密码？',
        'new'      => '输入新密码',
        'original' => '原密码',
        'reset'    => [
            'attribute' => '重置密码',
            'error'     => [
                'disabled' => '本站关闭了密码重置子系统，有事请联系 :email ',
                'failed'   => '重设密码失败',
                'throttle' => '24小时内只能重设密码 :time 次，请勿频繁操作',
                'same'     => '新密码不可与旧密码一样，请重新输入',
                'wrong'    => '旧密码错误，请重新输入',
                'demo'     => '演示环境禁止修改管理员密码',
            ],
            'sent'      => '重置成功，请查看所用邮箱（邮件可能在垃圾箱中）',
            'success'   => '新密码设置成功，请前往登录页面',
        ],
    ],
    'register'        => [
        'attribute' => '注 册',
        'code'      => '注册验证码',
        'error'     => ['disable' => '抱歉，本站关闭了注册通道', 'throttle' => '防刷机制已激活，请勿频繁注册'],
        'promotion' => '还没有账号？请去',
        'failed'    => '注册失败，请稍后尝试',
        'success'   => '注册成功',
    ],
    'remember_me'     => '记住我',
    'request'         => '获 取',
    'tos'             => '用户条款',
];
