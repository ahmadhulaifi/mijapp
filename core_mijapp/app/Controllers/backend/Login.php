<?php

namespace App\Controllers\backend;

use App\Models\backend\LoginModel;
use CodeIgniter\Controller;


class Login extends Controller
{

    protected $loginModel;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->loginModel = new LoginModel();
        // $validation =  \Config\Services::validation();
    }
    public function index()
    {

        $data = [
            'title' => 'Login Karyawan',
            'validation' => \Config\Services::validation()
        ];
        echo view('backend/layout/header_login', $data);
        echo view('backend/login', $data);
        echo view('backend/layout/footer_login', $data);
    }

    public function ceklogin()
    {
        if (!$this->validate([
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username tidak boleh kosong.'
                ]
            ],
            'password'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.'
                ]
            ],
        ])) {

            $validation =  \Config\Services::validation();
            $valid = [
                'username' => $validation->getError('username'),
                'password' => $validation->getError('password'),
            ];
            $data = [
                'success' => false,
                'validation' => $valid
            ];
        } else {
            // validasi sukses
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $ceklog = $this->loginModel->where('username', $username)->findAll();
            // dd($ceklog);

            // if (password_verify($password, $ceklog['password'])) {
            if ($password == $ceklog[0]['password']) {
                $data = [
                    'success' => true,
                    'responce' => 'yes',
                    'ceklog' => $ceklog
                ];
                $user = [
                    'email' => $ceklog[0]['username'],
                    'nama' => $ceklog[0]['password']
                ];
                session()->set($user);
            } else {
                $data = [
                    'success' => true,
                    'responce' => 'not',
                    'ceklog' => $ceklog
                ];
            }
        }

        return json_encode($data);
    }
}
