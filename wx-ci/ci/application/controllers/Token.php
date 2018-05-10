<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Token extends CI_Controller
{
	public function index()
	{
		$openid = $this->input->get('openid');
		if (is_null($openid)) {
			return $this->json(['msg' => '没有openid参数']);
		}

		$client = new Client();
		$res = $client->request('POST', 'http://140.143.8.19/code-repo/PHP/lixshop/api/web/v1/auth/token', [
			'query' => [
				'openId' => $openid
			]
		]);
		$data = json_decode($res->getBody()->getContents());
		return $this->json($data);
	}
}
