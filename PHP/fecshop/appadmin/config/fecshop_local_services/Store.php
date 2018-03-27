<?php
   return [
   'store' => [
        'class'  => 'fecshop\services\Store',
        'stores' => [
            'appadmin.fecshoptest.com' => [
                'language'         => 'zh_CN',
                'languageName'     => '中文',
                'localThemeDir'    => '@appadmin/theme/terry/theme01',
                'thirdThemeDir'    => [],
                'currency'         => 'CNY',
                'mobile'           => [
                    'enable'            => true,
                    'condition'         => ['phone', 'tablet'],
                    'redirectDomain'    => 'apphtml5.fecshoptest.com',
                ],
                // 第三方账号登录配置
                'thirdLogin' => [
                    // facebook账号登录
                    'thirdLogin' => [
                        'facebook' =>[                       #fb api配置 ，fb可以一个app设置pc和手机两个域名 
                            'facebook_app_id'     => '184963',
                            'facebook_app_secret' => '2e097dd7139',
                        ],
                        "google" => [                       #谷歌api visit https://code.google.com/apis/console to generate your google api
                            'CLIENT_ID'  	 => '38037grhccontent.com',
                            'CLIENT_SECRET'  => 'ei8RaoCHYm0rrwO',
                        ],
                    ]
                ],
                // 'sitemapDir' => '@apphtml5/web/cn/sitemap.xml',
            ],
        ],
    ],
];
