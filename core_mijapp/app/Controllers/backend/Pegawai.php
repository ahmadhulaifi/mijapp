<?php

namespace App\Controllers\backend;

use PHPExcel;
use PHPExcel_IOFactory;
use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use App\Models\backend\JabatanModel;
use App\Models\backend\StatusPegawaiModel;
use App\Models\backend\DivisiModel;
use App\Models\backend\UserDivisiModel;
use App\Models\backend\AbsenPegawaiModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use DateTime;

class Pegawai extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;
    protected $jabatanModel;
    protected $statusPegawaiModel;
    protected $divisiModel;
    protected $userDivisiModel;
    protected $absenPegawaiModel;

    public function __construct()
    {
        helper('fisi');
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->jabatanModel = new JabatanModel();
        $this->statusPegawaiModel = new StatusPegawaiModel();
        $this->divisiModel = new DivisiModel();
        $this->userDivisiModel = new UserDivisiModel();
        $this->absenPegawaiModel = new AbsenPegawaiModel();
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

    // controller tambah pegawai
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
                    'rules' => 'required|is_unique[karyawan.nip]',
                    'errors' => [
                        'required' => 'NIP tidak boleh kosong',
                        'is_unique' => 'NIP harus unik'
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

                if ($fileFoto == null) {
                    $namaFoto = "default.png";
                } else {

                    //generate nama file random
                    $namaFoto = $fileFoto->getRandomName();
                }

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

    // controller edit pegawai
    public function editformpegawai($id)
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $pegawai = $this->karyawanModel->getProfil($id);
        $jabatan = $this->jabatanModel->findAll();
        $statuspegawai = $this->statusPegawaiModel->findAll();
        // dd($user);

        $data = [
            'title' => 'Edit Pegawai',
            'user' => $cekuser,
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'status' => $statuspegawai,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pegawai/editformpegawai', $data);
    }

    public function editpegawai()
    {
        if ($this->request->isAJAX()) {

            $username = $this->karyawanModel->where('id', $this->request->getVar('idpegawai'))->get()->getRowArray();
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
                'foto' => [
                    'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'ukuran gambar terlalu besar. Max 1 mb ',
                        'is_image' => 'yang anda pilih bukan gambar',
                        'mime_in' => 'Gunakan file ekstensi jpg/jpeg/png'
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
                        'required' => 'Kode Jabatan tidak boleh kosong'
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
                        'required' => 'Tanggal Mulai bekerja tidak boleh kosong'
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

                $idpegawai = $this->request->getVar('idpegawai');

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
                    'foto' => $namaFoto,
                    'nip' => $this->request->getVar('nip'),
                    'jabatan_kode' => $this->request->getVar('jabatan_kode'),
                    'status_pegawai_kode' => $this->request->getVar('status_pegawai_kode'),
                    'tgl_mulai_bekerja' => $this->request->getVar('tgl_mulai_bekerja'),
                    'no_npwp' => $this->request->getVar('no_npwp'),
                    'no_bpjs_ketenagakerjaan' => $this->request->getVar('no_bpjs_ketenagakerjaan'),
                    'no_bpjs_kesehatan' => $this->request->getVar('no_bpjs_kesehatan'),
                    'bank' => $this->request->getVar('bank'),
                    'no_rek' => $this->request->getVar('no_rekening')

                ];

                $this->karyawanModel->update($idpegawai, $update);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Profil Pegawai berhasil diupdate'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No Direct Script access allowed";
        }
    }

    public function editpasswordpegawai()
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
                $idpegawai = $this->request->getVar('idpegawaipassword');
                $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

                $update = [
                    'password' => $password
                ];

                $this->karyawanModel->update($idpegawai, $update);

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

    public function importpegawai()
    {
        if ($this->request->isAJAX()) {

            $file = $this->request->getFile('filepegawai');

            if ($file) {
                $excelReader  = new PHPExcel();
                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();
                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
                //ambil sheet active
                $sheet    = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if ($idx == 1) {
                        continue;
                    }

                    $nip = $data['B'];
                    $username = $data['C'];
                    $password = $data['D'];
                    $nama_lengkap = $data['E'];
                    $nama_panggilan = $data['F'];
                    $gelar = $data['G'];
                    $j_kel = $data['H'];
                    $tem_lahir = $data['I'];
                    $tgl_lahir = $data['J'];
                    $jalan_no = $data['K'];
                    $rt = $data['L'];
                    $rw = $data['M'];
                    $desa_kel = $data['N'];
                    $kecamatan = $data['O'];
                    $kd_pos = $data['P'];
                    $kota = $data['Q'];
                    $telepon = $data['R'];
                    $email = $data['S'];
                    $agama = $data['T'];
                    $status = $data['U'];
                    $tgl_mulai_bekerja = $data['V'];
                    $status_pegawai_kode = $data['W'];
                    $jabatan_kode = $data['X'];
                    $no_ktp = $data['Y'];
                    $no_kk = $data['Z'];
                    $no_npwp = $data['AA'];
                    $no_bpjs_ketenagakerjaan = $data['AB'];
                    $no_bpjs_kesehatan = $data['AC'];
                    $bank = $data['AD'];
                    $no_rek = $data['AE'];


                    // insert data
                    $this->karyawanModel->insert([
                        'nip'        =>    $nip,
                        'username'        =>    $username,
                        'password'       =>    password($password),
                        'nama_lengkap'       =>    $nama_lengkap,
                        'nama_panggilan'       =>    $nama_panggilan,
                        'gelar'       =>    $gelar,
                        'j_kel'       =>    $j_kel,
                        'tem_lahir'       =>    $tem_lahir,
                        'tgl_lahir'       =>    tanggal($tgl_lahir),
                        'jalan_no'       =>    $jalan_no,
                        'rt'       =>    $rt,
                        'rw'       =>    $rw,
                        'desa_kel'       =>    $desa_kel,
                        'kecamatan'       =>    $kecamatan,
                        'kd_pos'       =>    $kd_pos,
                        'kota'       =>    $kota,
                        'telepon'       =>    $telepon,
                        'email'       =>    $email,
                        'agama'       =>    $agama,
                        'status'       =>    $status,
                        'tgl_mulai_bekerja'       =>  tanggal($tgl_mulai_bekerja),
                        'status_pegawai_kode'       =>    $status_pegawai_kode,
                        'jabatan_kode'       =>    $jabatan_kode,
                        'no_ktp'       =>    $no_ktp,
                        'no_kk'       =>    $no_kk,
                        'no_npwp'       =>    $no_npwp,
                        'no_bpjs_ketenagakerjaan'       =>    $no_bpjs_ketenagakerjaan,
                        'no_bpjs_kesehatan'       =>    $no_bpjs_kesehatan,
                        'bank'       =>    $bank,
                        'no_rek'       =>    $no_rek,
                        'role_kode'       =>    'UMUM'
                    ]);
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Import pegawai berhasil'
                ];
            } else {
                //upload gagal
                $data = [
                    'responce' => 'error',
                    'pesan' => 'Import pegawai gagal'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deletepegawai()
    {
        if ($this->request->isAJAX()) {
            if ($id = $this->request->getVar('checkbox_value')) {
                for ($count = 0; $count < count($id); $count++) {
                    // $this->karyawanModel->delete_karyawan($id[$count]);
                    $this->karyawanModel->where('id', $id[$count])->delete();
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data pegawai berhasil dihapus'
                ];

                echo json_encode($data);
            }
        } else {
            echo "No direct script access allowed";
        }
    }

    // controller divisi pegawai
    public function divisi()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $divisi = $this->divisiModel->findAll();
        $divisi2 = $this->divisiModel->findAll();
        // dd($divisi);

        $data = [
            'title' => 'Divisi Pegawai',
            'user' => $cekuser,
            'divisi' => $divisi,
            'divisi2' => $divisi2,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pegawai/divisi', $data);
    }

    // fetch divisi belum diatur
    public function fetchdivisibdpegawai()
    {

        if ($this->request->isAJAX()) {
            if ($pegawaibd = $this->karyawanModel->where('divisi', '')->findAll()) {
                $data = [
                    'responce' => 'success',
                    'pegawai' => $pegawaibd
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

    // fetch divisi semua
    public function fetchdivisisemuapegawai()
    {

        if ($this->request->isAJAX()) {
            if ($pegawaisemua = $this->karyawanModel->findAll()) {

                $data = [
                    'responce' => 'success',
                    'pegawai' => $pegawaisemua
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

    // delete divisi
    public function deletedivisipegawai($id)
    {
        if ($this->request->isAJAX()) {

            $update = [
                'divisi' => ''
            ];

            $this->karyawanModel->update($id, $update);
        } else {
            echo "No direct script access allowed";
        }
    }

    // fetch divisi satuan
    public function fetchdivisipegawai()
    {
        if ($this->request->isAJAX()) {
            $satuan = $this->request->getVar('divisiasal');
            // dd($satuan);
            if ($pegawaisatuan = $this->karyawanModel->getdivisisatuan($satuan)) {
                $data = [
                    'responce' => 'success',
                    'pegawai' => $pegawaisatuan
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



    public function btntujuandivisipegawai()
    {
        if ($this->request->isAJAX()) {
            if ($id = $this->request->getVar('checkbox_value')) {
                $iddivisi = $this->request->getVar('iddivisitujuan');

                for ($count = 0; $count < count($id); $count++) {

                    $peg = $this->karyawanModel->where('id', $id[$count])->get()->getRowArray();
                    // dd($peg);
                    $divisiawal = $peg['divisi'];

                    if ($divisiawal == null) {
                        $inputdivisi = $iddivisi;
                    } else {
                        $divisibaru = explode(",", $divisiawal);

                        $divisibaru[] = $iddivisi;
                        $inputdivisi = implode(',', $divisibaru);
                    }

                    $update = [
                        'divisi' => $inputdivisi,
                    ];
                    // $this->userDivisiModel->where('id', $id[$count])->delete();
                    $this->karyawanModel->update($id[$count], $update);
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Divisi pegawai berhasil dihapus'
                ];

                echo json_encode($data);
            }
        } else {
            echo "No direct script access allowed";
        }
    }

    // controller absen pegawai
    public function absen()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        $pegawai = $this->karyawanModel->findAll();

        $data = [
            'title' => 'Absen Pegawai',
            'user' => $cekuser,
            'pegawai' => $pegawai,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pegawai/absen', $data);
    }

    public function fetchabsenpegawai()
    {

        if ($this->request->isAJAX()) {
            if ($absen = $this->absenPegawaiModel->getabsensemua()) {
                // dd($absen);
                $data = [
                    'responce' => 'success',
                    'absen' => $absen
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

    public function saveabsenpegawai()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP tidak boleh kosong'
                    ]
                ],
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan tidak boleh kosong'
                    ]
                ],
                'tahun' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Tahun tidak boleh kosong',
                        'numeric' => 'Tahun harus berupa angka'
                    ]
                ],
                'sakit' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah sakit tidak boleh kosong',
                        'numeric' => 'Jumlah sakit harus berupa angka'
                    ]
                ],
                'izin' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah izin tidak boleh kosong',
                        'numeric' => 'Jumlah izin harus berupa angka'
                    ]
                ],
                'alpha' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah alpha tidak boleh kosong',
                        'numeric' => 'Jumlah alpha harus berupa angka'
                    ]
                ],
                'cuti' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah cuti tidak boleh kosong',
                        'numeric' => 'Jumlah cuti harus berupa angka'
                    ]
                ],
                'lain' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah lain tidak boleh kosong',
                        'numeric' => 'Jumlah lain harus berupa angka'
                    ]
                ],
                'hadir' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah hadir tidak boleh kosong',
                        'numeric' => 'Jumlah hadir harus berupa angka'
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
                $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

                $nip = $this->request->getVar('nip');
                $idkaryawan = $this->karyawanModel->where('nip', $nip)->get()->getRowArray();


                $insert = [
                    'nip' => $nip,
                    'id_karyawan' => $idkaryawan['id'],
                    'bulan' => $this->request->getVar('bulan'),
                    'tahun' => $this->request->getVar('tahun'),
                    'sakit' => $this->request->getVar('sakit'),
                    'izin' => $this->request->getVar('izin'),
                    'alpha' => $this->request->getVar('alpha'),
                    'cuti' => $this->request->getVar('cuti'),
                    'lain' => $this->request->getVar('lain'),
                    'hadir' => $this->request->getVar('hadir'),
                    'user_update' => $cekuser['nama_lengkap']
                ];

                $this->absenPegawaiModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Absen berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editmodalabsen()
    {
        if ($this->request->isAJAX()) {
            $idabsen = $this->request->getVar('idabsen');
            if ($absen = $this->absenPegawaiModel->where('id', $idabsen)->get()->getRowArray()) {
                $data = [
                    'responce' => 'success',
                    'absen' => $absen
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

    public function editabsenpegawai()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP tidak boleh kosong'
                    ]
                ],
                'bulan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Bulan tidak boleh kosong'
                    ]
                ],
                'tahun' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Tahun tidak boleh kosong',
                        'numeric' => 'Tahun harus berupa angka'
                    ]
                ],
                'sakit' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah sakit tidak boleh kosong',
                        'numeric' => 'Jumlah sakit harus berupa angka'
                    ]
                ],
                'izin' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah izin tidak boleh kosong',
                        'numeric' => 'Jumlah izin harus berupa angka'
                    ]
                ],
                'alpha' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah alpha tidak boleh kosong',
                        'numeric' => 'Jumlah alpha harus berupa angka'
                    ]
                ],
                'cuti' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah cuti tidak boleh kosong',
                        'numeric' => 'Jumlah cuti harus berupa angka'
                    ]
                ],
                'lain' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah lain tidak boleh kosong',
                        'numeric' => 'Jumlah lain harus berupa angka'
                    ]
                ],
                'hadir' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah hadir tidak boleh kosong',
                        'numeric' => 'Jumlah hadir harus berupa angka'
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
                $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
                $idabsen = $this->request->getVar('idabsen');
                $update = [
                    'nip' => $this->request->getVar('nip'),
                    'bulan' => $this->request->getVar('bulan'),
                    'tahun' => $this->request->getVar('tahun'),
                    'sakit' => $this->request->getVar('sakit'),
                    'izin' => $this->request->getVar('izin'),
                    'alpha' => $this->request->getVar('alpha'),
                    'cuti' => $this->request->getVar('cuti'),
                    'lain' => $this->request->getVar('lain'),
                    'hadir' => $this->request->getVar('hadir'),
                    'user_update' => $cekuser['nama_lengkap']
                ];


                $this->absenPegawaiModel->update($idabsen, $update);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Absen berhasil diupdate'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deleteabsenpegawai()
    {
        if ($this->request->isAJAX()) {
            if ($id = $this->request->getVar('checkbox_value')) {
                for ($count = 0; $count < count($id); $count++) {
                    $this->absenPegawaiModel->where('id', $id[$count])->delete();
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data absen berhasil dihapus'
                ];

                echo json_encode($data);
            }
        } else {
            echo "No direct script access allowed";
        }
    }

    public function importabsenpegawai()
    {
        if ($this->request->isAJAX()) {

            $file = $this->request->getFile('fileabsenpegawai');

            if ($file) {
                $excelReader  = new PHPExcel();
                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();
                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
                //ambil sheet active
                $sheet    = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if ($idx == 1) {
                        continue;
                    }

                    $nip = $data['B'];
                    $bulan = $data['D'];
                    $tahun = $data['E'];
                    $sakit = $data['F'];
                    $izin = $data['G'];
                    $alpha = $data['H'];
                    $cuti = $data['I'];
                    $lain = $data['J'];
                    $hadir = $data['K'];



                    $idkaryawan = $this->karyawanModel->where('nip', $nip)->get()->getRowArray();

                    // insert data
                    $this->absenPegawaiModel->insert([
                        'nip'        =>    $nip,
                        'id_karyawan' => $idkaryawan['id'],
                        'bulan'        =>    $bulan,
                        'tahun'       =>    $tahun,
                        'sakit'       =>    $sakit,
                        'izin'       =>    $izin,
                        'alpha'       =>    $alpha,
                        'cuti'       =>    $cuti,
                        'lain'       =>    $lain,
                        'hadir'       =>    $hadir,
                        'user_update'       =>    $cekuser['nama_lengkap']
                    ]);
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Import absen pegawai berhasil'
                ];
            } else {
                //upload gagal
                $data = [
                    'responce' => 'error',
                    'pesan' => 'Import absen pegawai gagal'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
}
