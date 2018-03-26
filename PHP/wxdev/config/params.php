<?php

return [
    'adminEmail' => 'admin@example.com',
    'Lix' => 'Lixxxxxxx',
    'WX_APP_ID' => 'wx543ed3903a242eb6',
    'WX_APP_SECRET' => '972d0295533d95069c14338296e1bff7',
    'WX_ACCESS_TOKEN' => '8_o2i-NI-zLJBOK2vxbTDTahFbAPvmmBtWVeHOgeAwDrO0joEqEXeemtuaNS4wH4NWNQiuY1-dwukFvi4LEzYwhZipAZFAsRReX3ErYrpWmKy7g3_SK1c6cmqhFvIzHoL40pGKLB8MJGEuILQUVUBiABAMLS',
    'WECHAT' => [
        'debug'  => true,
        'app_id' => 'wx543ed3903a242eb6',
        'secret' => '972d0295533d95069c14338296e1bff7',
        'token'  => 'weixin',
    
        // 'aes_key' => null, // 可选
    
        'log' => [
            'level'      => 'debug',
            'permission' => 0777,
            'file'       => '/tmp/easywechat.log',
        ],
    
        //...
    ],
];
