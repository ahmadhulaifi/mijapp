<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use App\Models\backend\KelasModel;
use App\Models\backend\SiswaModel;
use CodeIgniter\Controller;


class Dashboard extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;
    protected $kelasModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {

        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $menu = $this->menuModel->findAll();
        $submenu = $this->submenuModel->findAll();
        $jumlahpegawai = $this->karyawanModel->countAll();
        $jumlahkelas = $this->kelasModel->where('kelas!=', 'Alumni')->countAllResults();
        // dd($submenu);
        $jumlahsiswaaktif = $this->siswaModel->jmlhSiswaAll();
        $jumlahsiswasemua = $this->siswaModel->countAllResults();
        $jumlahalumni = $jumlahsiswasemua - $jumlahsiswaaktif;

        $data = [
            'title' => 'Dashboard',
            'user' => $cekuser,
            'menu' => $menu,
            'submenu' => $submenu,
            'jumlahpegawai' => $jumlahpegawai,
            'jumlahkelas' => $jumlahkelas,
            'jumlahsiswaaktif' => $jumlahsiswaaktif,
            'jumlahalumni' => $jumlahalumni
        ];

        return view('backend/dashboard', $data);
    }
}
