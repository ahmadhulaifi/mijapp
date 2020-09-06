<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\JabatanModel;
use CodeIgniter\Controller;


class Profil extends Controller
{
    protected $karyawanModel;
    protected $jabatanModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->jabatanModel = new JabatanModel();
    }

    // controller menu
    public function index()
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();

        $user = $this->karyawanModel->getProfil($cekuser['nip']);

        $data = [
            'title' => 'Profil Saya',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/profil/profil', $data);
    }
}
