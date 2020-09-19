<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\JabatanModel;
use App\Models\backend\UserDivisiModel;
use App\Models\backend\AbsenPegawaiModel;
use CodeIgniter\Controller;


class Profil extends Controller
{
    protected $karyawanModel;
    protected $jabatanModel;
    protected $userDivisiModel;
    protected $absenPegawaiModel;

    public function __construct()
    {
        helper('fisi');
        $this->karyawanModel = new KaryawanModel();
        $this->jabatanModel = new JabatanModel();
        $this->userDivisiModel = new UserDivisiModel();
        $this->absenPegawaiModel = new AbsenPegawaiModel();
    }

    // controller menu
    public function index()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $user = $this->karyawanModel->getProfil($cekuser['id']);
        $divisi = $this->userDivisiModel->getDivisi($cekuser['id']);
        // dd($user);

        $data = [
            'title' => 'Profil Saya',
            'user' => $user,
            'divisi' => $divisi,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/profil/profil', $data);
    }

    public function editpassword()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password tidak boleh kosong'
                    ]
                ],
                'repassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Retype password harus dipilih',
                        'matches' => 'Password tidak sesuai dengan retype'
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
                $idkaryawan = $this->request->getVar('idkaryawan');
                $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

                $update = [
                    'password' => $password
                ];

                $this->karyawanModel->update($idkaryawan, $update);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Password berhasil diupdate'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No Direct Script access allowed";
        }
    }

    public function editprofil($id)
    {
        $user = $this->karyawanModel->getProfil($id);
        // dd($user);

        $data = [
            'title' => 'Edit Profil',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/profil/editprofil', $data);
    }

    public function updateprofil()
    {
        if ($this->request->isAJAX()) {

            //cek judul
            // $username = $this->karyawanModel->getKomik($this->request->getVar('slug'));
            $username = $this->karyawanModel->where('id', $this->request->getVar('idkaryawan'))->get()->getRowArray();
            // dd($username);

            if ($username['username'] == $this->request->getVar('username')) {
                $rule_username = 'required';
            } else {
                $rule_username = 'required|is_unique[karyawan.username]';
            }

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
                'email' => [
                    'rules' => 'valid_email',
                    'errors' => [
                        'valid_email' => 'format email tidak valid'
                    ]
                ],
                'foto' => [
                    'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran gambar terlalu besar. Max 1 mb ',
                        'is_image' => 'yang anda pilih bukan gambar',
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
                // $validation = \Config\Services::validation();
                $fileFoto = $this->request->getFile('foto');

                //cek gambar, apakah tetap gambar lama
                if ($fileFoto->getError() == 4) {
                    $namaFoto = $this->request->getVar('fotoLama');
                } else {

                    if ($this->request->getVar('fotoLama') == "default.png") {
                        //generate nama file random
                        $namaFoto = $fileFoto->getRandomName();

                        //pindahkan gambar
                        $fileFoto->move('asset/images/user', $namaFoto);
                    } else {
                        //generate nama file random
                        $namaFoto = $fileFoto->getRandomName();

                        //pindahkan gambar
                        $fileFoto->move('asset/images/user', $namaFoto);

                        //hapus gambar lama
                        unlink('asset/images/user/' . $this->request->getPost('fotoLama'));
                    }
                }

                $idkaryawan = $this->request->getVar('idkaryawan');



                $update = [
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'nama_panggilan' => $this->request->getVar('nama_panggilan'),
                    'gelar' => $this->request->getVar('gelar'),
                    'tem_lahir' => $this->request->getVar('tem_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'j_kel' => $this->request->getVar('j_kel'),
                    'agama' => $this->request->getVar('agama'),
                    'status' => $this->request->getVar('status'),
                    'username' => $this->request->getVar('username'),
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
                    'foto' => $namaFoto

                ];

                $this->karyawanModel->update($idkaryawan, $update);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Profil berhasil diupdate',
                    'update' => $update
                ];
            }
            echo json_encode($data);
        } else {
            echo "No Direct Script access allowed";
        }
    }

    // controller absen saya
    public function absen()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $user = $this->karyawanModel->getProfil($cekuser['id']);
        $divisi = $this->userDivisiModel->getDivisi($cekuser['id']);
        // dd($user);

        $data = [
            'title' => 'Absen Saya',
            'user' => $user,
            'divisi' => $divisi,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/profil/absen', $data);
    }

    public function fetchabsen()
    {
        if ($this->request->isAJAX()) {
            // $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            if ($absen = $this->absenPegawaiModel->getabsenprofil(session('id'))) {
                $data = [
                    'responce' => 'success',
                    'absen' => $absen
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal fetch data submenu'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
}
