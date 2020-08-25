<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use CodeIgniter\Controller;


class Menu extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
    }

    public function index()
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();
        $menu = $this->menuModel->findAll();
        $submenu = $this->submenuModel->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Menu',
            'user' => $cekuser,
            'menu' => $menu,
            'submenu' => $submenu,
            'validation' => \Config\Services::validation()
        ];

        echo view('backend/layout/header_admin', $data);
        echo view('backend/menu/menu', $data);
        echo view('backend/layout/footer_admin');
    }

    public function savemenu()
    {
        if (!$this->validate([
            'menu' => [
                'rules' => 'required|is_unique[user_menu.menu]',
                'errors' => [
                    'required' => 'Menu tidak boleh kosong',
                    'is_unique' => 'Data Menu sudah ada'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon tidak boleh kosong'
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url tidak boleh kosong'
                ]
            ],
            'sort' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Sort tidak boleh kosong',
                    'numeric' => 'Sort harus berupa angka'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to(base_url('/menu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $menu = $this->request->getVar('menu');
            $icon = $this->request->getVar('icon');
            $url = $this->request->getVar('url');
            $sort = $this->request->getVar('sort');

            $insert = [
                'menu' => $menu,
                'icon' => $icon,
                'url' => $url,
                'sort' => $sort
            ];


            session()->setFlashdata('pesan', 'Menu Berhasil ditambah');
            $this->menuModel->insert($insert);
            return redirect()->to(base_url('/menu'));
        }
    }
}
