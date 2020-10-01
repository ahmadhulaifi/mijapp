<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use App\Models\backend\DivisiModel;
use App\Models\backend\JabatanModel;
use App\Models\backend\StatusPegawaiModel;
use App\Models\backend\TahunAjaranModel;
use App\Models\backend\KelasModel;
use CodeIgniter\Controller;

class TataUsaha extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;
    protected $divisiModel;
    protected $jabatanModel;
    protected $statusPegawaiModel;
    protected $tahunAjaranModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->divisiModel = new DivisiModel();
        $this->jabatanModel = new JabatanModel();
        $this->statusPegawaiModel = new StatusPegawaiModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->kelasModel = new KelasModel();
    }

    // controller datasekolah divisi
    public function kelas()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();


        $arr_iddivisi = $this->kelasModel->getiddivisi($cekuser['divisi']);
        // dd($arr_iddivisi);

        if ($cekuser['divisi'] == 'Umum') {
            $divisi = $this->divisiModel->orderBy('sort', 'asc')->findAll();
        } else {
            $divisi = $this->divisiModel->whereIn('id', $arr_iddivisi)->orderBy('sort', 'asc')->findAll();
        }
        // dd($submenu);

        $data = [
            'title' => 'Kelas',
            'user' => $cekuser,
            'divisi' => $divisi,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/tatausaha/kelas', $data);
    }

    public function fetchkelas()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

            if ($kelas = $this->kelasModel->getKelas($cekuser['divisi'])) {
                $data = [
                    'responce' => 'success',
                    'kelas' => $kelas
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal fetch kelas'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function savekelas()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'kelas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelas tidak boleh kosong'
                    ]
                ],
                'id_divisi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Divisi tidak boleh kosong'
                    ]
                ]
            ])) {
                $validation = \Config\Services::validation();
                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
            } else {
                // validasi sukses
                $insert = $this->request->getVar();

                $this->kelasModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Kelas berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editmodalkelas()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $idkelas = $this->request->getVar('idkelas');
            if ($kelas = $this->kelasModel->where('id', $idkelas)->get()->getRowArray()) {

                $arr_iddivisi = $this->kelasModel->getiddivisi($cekuser['divisi']);
                // dd($arr_iddivisi);

                if ($cekuser['divisi'] == 'Umum') {
                    $divisi = $this->divisiModel->orderBy('sort', 'asc')->findAll();
                } else {
                    $divisi = $this->divisiModel->whereIn('id', $arr_iddivisi)->orderBy('sort', 'asc')->findAll();
                }

                // $divisi = $this->divisiModel->orderBy('sort', 'asc')->findAll();
                $data = [
                    'responce' => 'success',
                    'kelas' => $kelas,
                    'divisi' => $divisi
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal memunculkan modal edit data'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editkelas()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'kelas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelas tidak boleh kosong'
                    ]
                ],

                'id_divisi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Divisi tidak boleh kosong'
                        // 'numeric' => 'Sort harus berupa angka'
                    ]
                ]
            ])) {
                $validation = \Config\Services::validation();

                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
            } else {
                // validasi sukses
                $idkelas = $this->request->getVar('idkelas');
                $kelas = $this->request->getVar('kelas');
                $divisi = $this->request->getVar('id_divisi');
                $update = [
                    'kelas' => $kelas,
                    'id_divisi' => $divisi
                ];

                $this->kelasModel->update($idkelas, $update);
                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }


    public function deletekelas($id)
    {
        if ($this->request->isAJAX()) {
            $this->kelasModel->where('id', $id)->delete();
            // $this->menuModel->where('id', $id)->delete();
        } else {
            echo "No direct script access allowed";
        }
    }
}
