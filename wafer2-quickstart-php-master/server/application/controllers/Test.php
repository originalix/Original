<?php

class Test extends CI_Controller
{
    public function index()
    {
        $this->load->model('HttpRequest', 'http');

        return $this->json($this->http->get('http://localhost/code-repo/PHP/lixshop/api/web/test/index'));
    }

    public function update()
    {
        return $this->json([
            'code' => 200,
            'msg' => 'lix'
        ]);
    }
}
