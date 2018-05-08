<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;

class Login extends CI_Controller {
    public function index() {
        $headers = apache_request_headers();
        
        $result = LoginService::login();
        
        if ($result['loginState'] === Constants::S_AUTH) {
            $this->json([
                'code' => 0,
                'data' => $result['userinfo'],
                'headers' => $headers
            ]);
        } else {
            $this->json([
                'code' => -1,
                'error' => $result['error'],
                'headers' => $headers
            ]);
        }
    }

    public function test() {
        $this->json([
            'code' => 2150
        ]);
    } 
}
