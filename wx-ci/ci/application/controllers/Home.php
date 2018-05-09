<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Home extends CI_Controller
{
	public function index()
	{
		$client = new Client();
		$res = $client->request('GET', 'http://localhost/code-repo/PHP/lixshop/api/web/test/index');
		$data = json_decode($res->getBody()->getContents());
		return $this->json($data);
	}
}
