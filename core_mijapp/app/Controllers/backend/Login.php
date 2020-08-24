<?php

namespace App\Controllers\backend;

use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Login Karyawan'
        ];
        echo view('backend/layout/header_login', $data);
        echo view('backend/login');
        echo view('backend/layout/footer_login');
    }
}
