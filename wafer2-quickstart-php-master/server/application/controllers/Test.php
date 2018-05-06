<?php

class Test extends CI_Controller
{
    public function index()
    {
        return $this->json([
            'code' => 200,
            'message' => 'lix'
        ]);
    }
}
