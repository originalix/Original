<?php
$realm = 'Restricted area';

//user => password
$users = array('admin' => 'mypass', 'guest' => 'guest');
if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm. '" qop="auth" nonce="'.uniqid().'" opaque="'.md5($realm).'"');
    die('Text to send if user hits Cancel button');
}

