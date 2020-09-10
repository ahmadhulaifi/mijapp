<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use App\Models\backend\JabatanModel;
use App\Models\backend\StatusPegawaiModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;

class Pegawai extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;
    protected $jabatanModel;
    protected $statusPegawaiModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->jabatanModel = new JabatanModel();
        $this->statusPegawaiModel = new StatusPegawaiModel();
    }

    // controller Data Pegawai
    public function index()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();



        $data = [
            'title' => 'Data Pegawai',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pegawai/pegawai', $data);
    }

    public function fetchpegawai()
    {
        if ($this->request->isAJAX()) {
            if ($pegawai = $this->karyawanModel->findAll()) {
                $data = [
                    'responce' => 'success',
                    'pegawai' => $pegawai
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal fetch'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function formtambah()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $jabatan = $this->jabatanModel->findAll();
        $statuspegawai = $this->statusPegawaiModel->findAll();
        // dd($statuspegawai);

        $data = [
            'title' => 'Tambah Pegawai',
            'user' => $cekuser,
            'jabatan' => $jabatan,
            'status' => $statuspegawai,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pegawai/formtambah', $data);
    }

    public function tambahpegawai()
    {
        if ($this->request->isAJAX()) {


            $rule_username = 'required|is_unique[karyawan.username]';


            if (!$this->validate([
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama lengkap tidak boleh kosong'
                    ]
                ],
                'nama_panggilan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama panggilan tidak boleh kosong'
                    ]
                ],
                'tem_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat lahir tidak boleh kosong'
                    ]
                ],
                'tgl_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal lahir tidak boleh kosong'
                    ]
                ],
                'j_kel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kelamin tidak boleh kosong'
                    ]
                ],
                'agama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Agama tidak boleh kosong'
                    ]
                ],
                'username' => [
                    'rules' => $rule_username,
                    'errors' => [
                        'required' => 'Username tidak boleh kosong',
                        'is_unique' => 'Username sudah ada yang punya'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password tidak boleh kosong'
                    ]
                ],
                'repassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Re-Type Password tidak boleh kosong',
                        'matches' => 'Re-Type password tidak sesuai'
                    ]
                ],

                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP tidak boleh kosong'
                    ]
                ],
                'jabatan_kode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan tidak boleh kosong'
                    ]
                ],
                'status_pegawai_kode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Pegawai tidak boleh kosong'
                    ]
                ],
                'tgl_mulai_bekerja' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal mulai bekerja tidak boleh kosong'
                    ]
                ],
                'foto' => [
                    'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran gambar terlalu besar. Max 1 mb ',
                        'is_image' => 'foto yang anda pilih bukan gambar',
                        'mime_in' => 'Gunakan file ekstensi jpg/jpeg/png'
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

                $fileFoto = $this->request->getFile('foto');



                //generate nama file random
                $namaFoto = $fileFoto->getRandomName();




                $insert = [
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'nama_panggilan' => $this->request->getVar('nama_panggilan'),
                    'gelar' => $this->request->getVar('gelar'),
                    'tem_lahir' => $this->request->getVar('tem_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'tgl_mulai_bekerja' => $this->request->getVar('tgl_mulai_bekerja'),
                    'j_kel' => $this->request->getVar('j_kel'),
                    'agama' => $this->request->getVar('agama'),
                    'status' => $this->request->getVar('status'),
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'jalan_no' => $this->request->getVar('jalan_no'),
                    'rt' => $this->request->getVar('rt'),
                    'rw' => $this->request->getVar('rw'),
                    'desa_kel' => $this->request->getVar('desa_kel'),
                    'kecamatan' => $this->request->getVar('kecamatan'),
                    'kota' => $this->request->getVar('kota'),
                    'kd_pos' => $this->request->getVar('kode_pos'),
                    'jalan_no_domisili' => $this->request->getVar('jalan_no_domisili'),
                    'rt_domisili' => $this->request->getVar('rt_domisili'),
                    'rw_domisili' => $this->request->getVar('rw_domisili'),
                    'desa_kel_domisili' => $this->request->getVar('desa_kel_domisili'),
                    'kecamatan_domisili' => $this->request->getVar('kecamatan_domisili'),
                    'kota_domisili' => $this->request->getVar('kota_domisili'),
                    'kd_pos_domisili' => $this->request->getVar('kode_pos_domisili'),
                    'email' => $this->request->getVar('email'),
                    'telepon' => $this->request->getVar('telepon'),
                    'no_ktp' => $this->request->getVar('ktp'),
                    'no_kk' => $this->request->getVar('no_kk'),
                    'nip' => $this->request->getVar('nip'),
                    'no_npwp' => $this->request->getVar('no_npwp'),
                    'no_bpjs_ketenagakerjaan' => $this->request->getVar('no_bpjs_ketenagakerjaan'),
                    'no_bpjs_kesehatan' => $this->request->getVar('no_bpjs_kesehatan'),
                    'bank' => $this->request->getVar('bank'),
                    'no_rek' => $this->request->getVar('no_rekening'),
                    'status_pegawai_kode' => $this->request->getVar('status_pegawai_kode'),
                    'jabatan_kode' => $this->request->getVar('jabatan_kode'),
                    'role_kode' => "UMUM",
                    'foto' => $namaFoto

                ];

                if ($this->karyawanModel->insert($insert)) {
                    //pindahkan gambar
                    $fileFoto->move('asset/images/user', $namaFoto);
                };

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Pegawai berhasil ditambah',
                ];
            }
            echo json_encode($data);
        } else {
            echo "No Direct Script access allowed";
        }
    }
}
