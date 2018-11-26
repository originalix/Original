<?php

//强迫重新输入用户名和密码的HTTP认证的范例

function authenticate()
{
    header('WWW-Authenticate: Basic Realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You mast enter a valid login ID and password to access this resource\n";
    exit;
}

if (!isset($_SERVER['PHP_AUTH_USER']) ||
    ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
    authenticate();
} else {
    echo "<p>Welcome : {$_SERVER['PHP_AUTH_USER']} </br>";
    echo "Old: {$_REQUEST['OldAuth']} </br>";
    echo "<form action='{$_SERVER['PHP_SELF']}' METHOD='post'>\n";
    echo "<input type='hidden' name='SeenBefore' value='1' />\n";
    echo "<input type='hidden' name='OldAuth' value='{$_SERVER['PHP_AUTH_USER']}' />\n";
    echo "<input type='submit' value='Re Authenticate'>";
    echo "</form></p>\n";
}