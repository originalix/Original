<?php

//强迫重新输入用户名和密码的HTTP认证的范例

function authenticate()
{
    header('WWW-Authenticate: Basic Realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You mast enter a valid login ID and password to access this resource\n";
    exit;
}

