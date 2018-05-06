<?php

class Test extends CI_Controller
{
    public function index()
    {
        $this->load->model('HttpRequest', 'http');
        
        // return $this->json([
        //     'code' => 200,
        //     'message' => $this->http->get('http://localhost/code-repo/PHP/lixshop/api/web/test/index')
        // ]);

        return $this->json($this->http->get('http://localhost/code-repo/PHP/lixshop/api/web/test/index'));
    }
}
