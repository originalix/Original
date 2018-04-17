<?php

return [
    [
        'realData' => true,
        'title' => '首页',
        'icon' => 'fa-tachometer',
        'redirect' => '../home/index',
        'data' => [],
    ],
    [
        'realData' => false,
        'title' => '产品管理',
        'icon' => 'fa-desktop',
        'redirect' => '',
        'data' => [
            [
                'title' => '产品信息管理',
                'redirect' => '../productform/index',
            ],
            [   
                'title' => '产品评论管理', 
                'redirect' => '../review/index',
            ],
            [
                'title' => '产品收藏管理',
                'redirect' => '../favorite/index',
            ],
            [
                'title' => '产品分类管理',
                'redirect' => '../category/index',
            ],
        ],
    ],
    [
        'realData' => false,
        'title' => '销售',
        'icon' => 'fa-cc-visa',
        'redirect' => '/home/index',
        'data' => [
            [
                'title' => '订单管理',
                'redirect' => '/home/index',
            ],
            [
                'title' => '优惠券',
                'redirect' => '../coupon/index',
            ]
        ],
    ],
    [
        'realData' => false,
        'title' => '用户管理',
        'icon' => 'fa-user-plus',
        'redirect' => '../customer/index',
        'data' => [
            [
                'title' => '账号管理',
                'redirect' => '../customer/index',
            ],
        ],
    ],
    [
        'realData' => false,
        'title' => '控制面板',
        'icon' => 'fa-paperclip',
        'redirect' => '/home/index',
        'data' => [
            [
                'title' => '我的账户',
                'redirect' => '/home/index',
            ],
            [
                'title' => '账户管理',
                'redirect' => '../user/index',
            ],
            [
                'title' => '权限管理',
                'redirect' => '/home/index',
            ],
            [
                'title' => '操作日志',
                'redirect' => '/home/index',
            ],
        ],
    ]
];
