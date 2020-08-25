<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use CodeIgniter\Controller;


class Dashboard extends Controller
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
            'title' => 'Dashboard',
            'user' => $cekuser,
            'menu' => $menu,
            'submenu' => $submenu
        ];

        echo view('backend/layout/header_admin', $data);
        echo view('backend/dashboard', $data);
        echo view('backend/layout/footer_admin');
    }
}
