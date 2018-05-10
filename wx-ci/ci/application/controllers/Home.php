<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Home extends CI_Controller
{
	public function index()
	{
		$code = $this->input->get('code');
		echo $code;
		$client = new Client();
		$res = $client->request('GET', 'http://140.143.8.19/code-repo/PHP/lixshop/api/web/test/index');
		$data = json_decode($res->getBody()->getContents());
		// return $this->json($data);
	}

	public function test()
	{
		$client = new Client();
		$res = $client->request('GET', 'http://140.143.8.19/code-repo/PHP/lixshop/api/web/test/index');
		$data = json_decode($res->getBody()->getContents());
		return $this->json($data);
	}
}
