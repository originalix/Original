<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Home extends CI_Controller
{
	public function index()
	{
		$client = new Client();
		$res = $client->request('GET', 'http://140.143.8.19/code-repo/PHP/lixshop/api/web/test/index');
		$data = json_decode($res->getBody()->getContents());
		return $this->json($data);
	}
	
    public function config()
    {
		$access_token = $this->input->get_request_header('Authorization', TRUE);
		$client = new Client();
		$res = $client->request('GET', 'http://140.143.8.19/code-repo/PHP/lixshop/api/web/v1/home/index', [
			'headers' => [
				'Authorization' => 'Bearer 5ljzJarPzVS2Uzyt4KdwxlHSVfCk5_4s'
			]
		]);
		$data = json_decode($res->getBody()->getContents());
		return $this->json($data);
	}

	public function test()
	{
		$client = new Client();
		$res = $client->request('GET', 'http://140.143.8.19/code-repo/PHP/lixshop/api/web/test/index');
		$data = json_decode($res->getBody()->getContents());
		return $this->json($data);
	}
}
