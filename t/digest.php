<?php

$realm = 'Restricted area';

//user => password
$users = array('admin' => 'mypass', 'guest' => 'guest');
if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm. '" qop="auth" nonce="'.uniqid().'" opaque="'.md5($realm).'"');
    die('Text to send if user hits Cancel button');
}

//analyze the PHP_AUTH_DIGEST variable
if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']])) {
    die('Wrong Credentials!');
}

//generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $data['uri']);
$valid_response = md5($A1 . ':' . $data['nonce'] . ':' . $data['nc'] . ':' . $data['cnonce'] . ':' . $data['qop'] . ':' . $A2);

if ($data['response'] != $valid_response) {
    die('Wrong Credentials!');
}

echo 'Your are logged in as: ' . $data['username'];

function http_digest_parse($txt)
{
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'conoce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();

    preg_match_all('@(\w+)=([\'"]?)([a-zA-Z0-9=./\_-]+)\2@', $txt, $matches, PERG_SET_ORDER);
    foreach ($matches as $m) {
        $data[$m[1]] = $m[3];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}