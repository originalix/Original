<?php
   return [
   'store' => [
		'class' => 'fecshop\services\Store',
		'stores' => [
			# 数据的key就是域名
			'appfront.fecshoptest.com' => [
				'language' 		=> 'zh_CN',   # 语言必须在上面第五步的fecshoplang中定义，否则将无法得到语言属性。
				'languageName' 	=> '简体中文', # 在添加store的时候，必须查看 添加的语言在 fecshoplang中是否定义。
				# 定义本地模板路径，用来重写fecshop的模板，或者开发新的模板文件。
				//'localThemeDir'	=> '@appfront/theme/terry/theme01',
				# 定义第三方模板路径，用来重写fecshop的模板，或者开发新的模板文件。
				'thirdThemeDir'	=> [],
				# 当前语言的默认货币，货币必须在上面第六步的配置中存在
				'currency' 		=> 'USD',
				'mobile'		=> [ # 当设备满足什么条件的时候，进行跳转。
					'enable'		=> true,
					'condition'		=> ['phone','tablet'], # phone 代表手机，tablet代表平板
					'redirectUrl' 	=> 'apphtml5.fecshoptest.com',	# 如果是移动设备访问进行域名跳转
				],
				# 第三方账号登录配置
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

				//'image'	=> [
				//	'domain' => 'img.appfront.fancyecommerce.com',
				//	'baseDir'=> '@appimage/appfront',
				//]
			],
			'appfront.fecshoptest.com/fr' => [
				'language' 		=> 'fr_FR',
				'languageName' 	=> 'Fran?ais',
				'localThemeDir'	=> '@appfront/theme/terry/theme01',
				'thirdThemeDir'	=> [],
				'currency' 		=> 'RMB',
				'mobile'		=> [
					'enable'			=> true,
					'condition'			=> ['phone'], # phone 代表手机，tablet代表平板。
					'redirectDomain' 	=> 'apphtml5.fecshoptest.com/fr', # 跳转后的url。
				],
			],
			'appfront.fecshoptest.es' => [
				'language' 		=> 'es_ES',
				'languageName' 	=> 'Espa?ol',
				'localThemeDir'	=> '@appfront/theme/terry/theme01',
				'thirdThemeDir'	=> [],
				'currency' 		=> 'USD',
				'mobile'		=> [
					'enable'		=> true,
					'condition'		=> ['tablet'],
					'redirectDomain' 	=> 'fecshop.apphtml5.es.fancyecommerce.com',	
				],
			],
			'appfront.fecshoptest.com/cn' => [
				'language' 		=> 'zh_CN',
				'languageName' 	=> '中文',
				'localThemeDir'	=> '@appfront/theme/terry/theme01',
				'thirdThemeDir'	=> [],
				'currency' 		=> 'RMB',
				'mobile'		=> [
					'enable'		=> false,
					'condition'		=> ['phone','tablet'],
					'redirectDomain' 	=> 'fecshop.apphtml5.fancyecommerce.com/cn',	
				],
			],
		],
		
	],
			
];
