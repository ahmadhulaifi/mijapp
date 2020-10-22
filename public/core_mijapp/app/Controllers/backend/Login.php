<?php

namespace App\Controllers\backend;

use App\Models\backend\LoginModel;
use CodeIgniter\Controller;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;


class Login extends Controller
{

    protected $loginModel;
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        // $validation =  \Config\Services::validation();
    }
    public function index()
    {

        $data = [
            'title' => 'Login Karyawan',
            'validation' => \Config\Services::validation()
        ];
        return view('backend/login', $data);
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
            $ceklogcount = $this->loginModel->where('username', $username)->countAllResults();
            // dd($ceklog);

            if ($ceklogcount < 1) {
                $data = [
                    'success' => true,
                    'responce' => 'not',
                    'ceklog' => $ceklog
                ];
            } else {
                if (password_verify($password, $ceklog[0]['password'])) {
                    // if ($password == $ceklog[0]['password']) {
                    $data = [
                        'success' => true,
                        'responce' => 'yes',
                        'ceklog' => $ceklog
                    ];
                    $user = [
                        'id' => $ceklog[0]['id'],
                        'username' => $ceklog[0]['username'],
                        'password' => $ceklog[0]['password'],
                        'role_kode' => $ceklog[0]['role_kode']
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
        }

        return json_encode($data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function block()
    {

        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();
        $menu = $this->menuModel->findAll();
        $submenu = $this->submenuModel->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Block',
            'user' => $cekuser,
            'menu' => $menu,
            'submenu' => $submenu
        ];



        return view('backend/block', $data);
    }
}
