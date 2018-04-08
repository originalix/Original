appfront.fecshoptest.com appfront.fecshoptest.es 指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appfront/web 
 
appadmin.fecshoptest.com 指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appadmin/web

apphtml5.fecshoptest.com 指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/apphtml5/web

appapi.fecshoptest.com 	 指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appapi/web

appserver.fecshoptest.com 指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appserver/web

img.fecshoptest.com 	指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/common

img2.fecshoptest.com 	指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appadmin

img3.fecshoptest.com 	指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appfront

img4.fecshoptest.com 	指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/apphtml5

img5.fecshoptest.com 	指向 /Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appserver

127.0.0.1       rock.fecshoptest.com     # rockmongo的域名指向，rockmongo是mongodb的可视化界面，类似于mysql的phpmyadmin
127.0.0.1       my.fecshoptest.com       # mysql的phpmyadmin的域名指向
127.0.0.1       appadmin.fecshoptest.com # 后台域名指向
127.0.0.1       appfront.fecshoptest.com # 前台pc端域名指向
127.0.0.1       appfront.fecshoptest.es  # 前台pc端 es 语言的域名指向
127.0.0.1       apphtml5.fecshoptest.com # 前台html端的域名指向
127.0.0.1       appapi.fecshoptest.com   # api端的域名指向
127.0.0.1       appserver.fecshoptest.com # server端的域名指向
127.0.0.1       img.fecshoptest.com		#appimage/common   图片的域名指向
127.0.0.1       img2.fecshoptest.com	#appimage/appadmin 图片的域名指向
127.0.0.1       img3.fecshoptest.com	#appimage/appfront 图片的域名指向
127.0.0.1       img4.fecshoptest.com	#appimage/apphtml5 图片的域名指向
127.0.0.1       img5.fecshoptest.com	#appimage/appserver图片的域名指向

<VirtualHost *:80>
    ServerName "appfront.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appfront/web"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appfront/web">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "appadmin.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appadmin/web"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appadmin/web">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "apphtml5.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/apphtml5/web"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/apphtml5/web">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "appapi.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appapi/web"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appapi/web">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "appserver.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appserver/web"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appserver/web">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "img.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/common"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/common">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "img2.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appadmin"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appadmin">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "img3.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appfront"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appfront">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "img4.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/apphtml5"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/apphtml5">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>

<VirtualHost *:80>
    ServerName "img5.fecshoptest.com"
    DocumentRoot "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appserver"

    <Directory "/Users/Lix/Documents/Sites/code-repo/PHP/fecshop/appimage/appserver">
        Allow From All
        AllowOverride All
        Options +Indexes
    </Directory>
</VirtualHost>
