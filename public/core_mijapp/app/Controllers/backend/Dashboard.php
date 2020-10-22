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
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
    }

    public function index()
    {

        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $menu = $this->menuModel->findAll();
        $submenu = $this->submenuModel->findAll();
        $jumlahpegawai = $this->karyawanModel->countAll();
        // dd($submenu);

        $data = [
            'title' => 'Dashboard',
            'user' => $cekuser,
            'menu' => $menu,
            'submenu' => $submenu,
            'jumlahpegawai' => $jumlahpegawai
        ];

        return view('backend/dashboard', $data);
    }
}
