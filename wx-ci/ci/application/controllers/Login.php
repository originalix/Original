<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Login extends CI_Controller
{
	public function index()
	{
		$code = $this->input->get('code');
		if (is_null($code)) {
			return $this->json(['msg' => '没有code参数']);
		}

		$client = new Client();
		$res = $client->request('GET', 'http://140.143.8.19/code-repo/PHP/lixshop/wechat/web/login/index', [
			'query' => [
				'code' => $code
			]
		]);
		$data = json_decode($res->getBody()->getContents());
		return $this->json($data);
	}
}
