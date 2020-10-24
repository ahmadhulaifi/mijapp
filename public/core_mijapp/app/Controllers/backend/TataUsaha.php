<?php

namespace App\Controllers\backend;

use PHPExcel;
// use ZIPLibrary;
use PHPExcel_IOFactory;
use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use App\Models\backend\DivisiModel;
use App\Models\backend\JabatanModel;
use App\Models\backend\StatusPegawaiModel;
use App\Models\backend\TahunAjaranModel;
use App\Models\backend\KelasModel;
use App\Models\backend\RombelModel;
use App\Models\backend\SiswaModel;
use App\Models\backend\GaleriSiswaModel;
use CodeIgniter\Controller;
use ZipArchive;

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
    protected $rombelModel;
    protected $siswaModel;
    protected $galeriSiswaModel;

    public function __construct()
    {
        helper('fisi');
        helper('filesystem');
        helper('date');
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->divisiModel = new DivisiModel();
        $this->jabatanModel = new JabatanModel();
        $this->statusPegawaiModel = new StatusPegawaiModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->kelasModel = new KelasModel();
        $this->rombelModel = new RombelModel();
        $this->siswaModel = new SiswaModel();
        $this->galeriSiswaModel = new GaleriSiswaModel();
    }

    // controller kelas
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

    // controller rombel
    public function rombel()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        $arr_iddivisi = $this->kelasModel->getiddivisi($cekuser['divisi']);
        // dd($arr_iddivisi);

        if ($cekuser['divisi'] == 'Umum') {
            $kelas = $this->kelasModel->orderBy('id_divisi', 'asc')->where('kelas.kelas !=', 'Alumni')->where('kelas.kelas !=', 'kosong')->orderBy('kelas', 'asc')->findAll();
        } else {
            $kelas = $this->kelasModel->whereIn('id_divisi', $arr_iddivisi)->where('kelas.kelas !=', 'Alumni')->where('kelas.kelas !=', 'kosong')->orderBy('id_divisi', 'asc')->orderBy('kelas', 'asc')->findAll();
        }
        // dd($kelas);

        $data = [
            'title' => 'Rombel',
            'user' => $cekuser,
            'kelas' => $kelas,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/tatausaha/rombel', $data);
    }

    public function fetchrombel()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

            if ($rombel = $this->rombelModel->getRombel($cekuser['divisi'])) {
                $data = [
                    'responce' => 'success',
                    'rombel' => $rombel
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

    public function cekdivisirombel()
    {
        if ($this->request->isAJAX()) {
            // $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $idkelas = $this->request->getVar('idkelas');
            if ($kelas = $this->kelasModel->where('id', $idkelas)->get()->getRowArray()) {

                $divisi = $this->divisiModel->where('id', $kelas['id_divisi'])->get()->getRowArray();

                $data = [
                    'responce' => 'success',
                    'divisi' => $divisi
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

    public function saverombel()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'rombel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rombel tidak boleh kosong'
                    ]
                ],
                'id_kelas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelas tidak boleh kosong'
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

                $this->rombelModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Rombel berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editmodalrombel()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $idrombel = $this->request->getVar('idrombel');
            // if ($rombel = $this->rombelModel->where('id', $idrombel)->get()->getRowArray()) {
            if ($rombel = $this->rombelModel->getRombelModal($idrombel)) {

                $arr_iddivisi = $this->kelasModel->getiddivisi($cekuser['divisi']);


                if ($cekuser['divisi'] == 'Umum') {
                    $kelas = $this->kelasModel->where('kelas.kelas !=', 'Alumni')->where('kelas.kelas !=', 'kosong')->orderBy('id_divisi', 'asc')->orderBy('kelas', 'asc')->findAll();
                } else {
                    $kelas = $this->kelasModel->whereIn('id_divisi', $arr_iddivisi)->where('kelas.kelas !=', 'Alumni')->where('kelas.kelas !=', 'kosong')->orderBy('id_divisi', 'asc')->orderBy('kelas', 'asc')->findAll();
                }

                // $divisi = $this->divisiModel->orderBy('sort', 'asc')->findAll();
                $data = [
                    'responce' => 'success',
                    'kelas' => $kelas,
                    'rombel' => $rombel,
                    // 'divisi' => $divisi
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

    public function editrombel()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'rombel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rombel tidak boleh kosong'
                    ]
                ],

                'id_kelas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelas tidak boleh kosong'
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
                $idrombel = $this->request->getVar('idrombel');
                $rombel = $this->request->getVar('rombel');
                $kelas = $this->request->getVar('id_kelas');
                $update = [
                    'rombel' => $rombel,
                    'id_kelas' => $kelas
                ];

                $this->rombelModel->update($idrombel, $update);
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

    public function deleterombel($id)
    {
        if ($this->request->isAJAX()) {
            $this->rombelModel->where('id', $id)->delete();
            // $this->menuModel->where('id', $id)->delete();
        } else {
            echo "No direct script access allowed";
        }
    }

    // controller datasiswa
    public function datasiswa()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();


        // $divisi = $this->divisiModel->where('divisi !=', 'Umum')->orderBy('sort', 'ASC')->findAll();
        $divisi = $this->divisiModel->orderBy('sort', 'ASC')->findAll();
        $kelas = $this->kelasModel->where('kelas !=', 'Alumni')->findColumn('id_divisi');
        $rombel = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('kelas.kelas !=', 'Alumni')->findColumn('id_divisi');

        $jmlhkelas = $this->kelasModel->where('kelas !=', 'Alumni')->countAllResults();
        $jmlhrombel = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('kelas.kelas !=', 'Alumni')->countAllResults();

        $jmlhSiswaAll = $this->siswaModel->jmlhSiswaAll();
        // $jmlhSiswaDivisi = $this->siswaModel->select('siswa.*,divisi.divisi,kelas.kelas')->join('rombel', 'rombel.id = siswa.id_rombel', 'left')->join('kelas', 'kelas.id = rombel.id_kelas', 'left')->join('divisi', 'divisi.id = kelas.id_divisi', 'left')->where('kelas.kelas !=', 'Alumni')->findColumn('siswa.id_divisi');

        // $kelasalumni = $this->kelasModel->where('kelas', 'Alumni')->findColumn('kelas');
        // $jmlhSiswaDivisi = $this->siswaModel->whereNotIn('username', $kelasalumni);

        $rombelalumni = ['Alumni KB', 'Alumni RA', 'Alumni MI', 'Alumni MTs', 'Alumni MA'];
        $jmlhSiswaDivisi = $this->siswaModel->select('siswa.*')->join('rombel', 'rombel.id = siswa.id_rombel', 'left')->whereNotIn('rombel.rombel', $rombelalumni)->orwhere('id_rombel', '')->findColumn('id_divisi');
        // $jmlhSiswaAlumniDivisi = $this->siswaModel->select('siswa.*')->join('rombel', 'rombel.id = siswa.id_rombel')->orWhereIn('rombel.rombel', $rombelalumni)->findAll();



        // dd($jmlhSiswaDivisi);

        $data = [
            'title' => 'Kelas',
            'user' => $cekuser,
            'divisi' => $divisi,
            'kelas' => $kelas,
            'rombel' => $rombel,
            'jmlhkelas' => $jmlhkelas,
            'jmlhrombel' => $jmlhrombel,
            'jmlhsiswaall' => $jmlhSiswaAll,
            'jmlsiswadivisi' => $jmlhSiswaDivisi

        ];

        return view('backend/tatausaha/datasiswa', $data);
    }

    public function daftarsiswa($id)
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        $iddivisi = $id;

        if ($iddivisi == 1) {
            $divisi = $this->divisiModel->where('id', $id)->get()->getRowArray();
            $siswa = $this->siswaModel->getSiswaAll();
            $rombel = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('kelas.kelas !=', 'Alumni')->orderby('rombel', 'ASC')->findAll();

            $kelas = $this->kelasModel->where('kelas!=', 'Alumni')->orderby('kelas', 'ASC')->findAll();

            $data = [
                'title' => 'Data Siswa Semua Divisi',
                'user' => $cekuser,
                'siswa' => $siswa,
                'rombel' => $rombel,
                'divisi' => $divisi,
                'iddivisii' => $iddivisi,
                'kelas' => $kelas

            ];
        } else {
            $divisi = $this->divisiModel->where('id', $id)->get()->getRowArray();
            $kelas = $this->kelasModel->where('id_divisi', $iddivisi)->where('kelas!=', 'Alumni')->orderby('kelas', 'ASC')->findAll();
            $siswa = $this->siswaModel->getSiswa($id);
            $rombel = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('kelas.kelas !=', 'Alumni')->where('divisi.divisi', $divisi['divisi'])->orderby('rombel', 'ASC')->findAll();


            $data = [
                'title' => 'Data Siswa ' . $divisi['divisi'],
                'user' => $cekuser,
                'siswa' => $siswa,
                'rombel' => $rombel,
                'divisi' => $divisi,
                'iddivisii' => $iddivisi,
                'kelas' => $kelas
            ];
        }

        return view('backend/tatausaha/daftarsiswa', $data);
    }

    public function fetchsiswa()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $id_divisi = $this->request->getVar('id_divisi');


            if ($id_divisi == 1) {
                $siswa = $this->siswaModel->getSiswaAll();
                $data = [
                    'responce' => 'success',
                    'user' => $cekuser,
                    'siswa' => $siswa,
                    'divisi' => $id_divisi
                ];
            } else {
                if ($siswa = $this->siswaModel->getSiswa($id_divisi)) {
                    $data = [
                        'responce' => 'success',
                        'user' => $cekuser,
                        'siswa' => $siswa,
                        'divisi' => $id_divisi
                    ];
                } else {
                    $data = [
                        'responce' => 'error',
                        'pesan' => 'gagal fetch kelas'
                    ];
                }
            }



            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function fetchsiswabelum()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $id_divisi = $this->request->getVar('id_divisi');

            if ($id_divisi == 1) {
                $siswa = $this->siswaModel->getSiswaAllBelum();
                $data = [
                    'responce' => 'success',
                    'user' => $cekuser,
                    'siswa' => $siswa,
                    'divisi' => $id_divisi
                ];
            } else {
                if ($siswa = $this->siswaModel->getSiswaBelum($id_divisi)) {
                    $data = [
                        'responce' => 'success',
                        'user' => $cekuser,
                        'siswa' => $siswa,
                        'divisi' => $id_divisi
                    ];
                } else {
                    $data = [
                        'responce' => 'error',
                        'pesan' => 'gagal fetch kelas'
                    ];
                }
            }



            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function fetchsiswakelas()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $id_divisi = $this->request->getVar('id_divisi');
            $id_kelas = $this->request->getVar('kelas');

            if ($id_divisi == 1) {
                $siswa = $this->siswaModel->getSiswaAllKelas($id_kelas);
                $data = [
                    'responce' => 'success',
                    'user' => $cekuser,
                    'siswa' => $siswa,
                    'divisi' => $id_divisi
                ];
            } else {
                if ($siswa = $this->siswaModel->getSiswaKelas($id_divisi, $id_kelas)) {
                    $data = [
                        'responce' => 'success',
                        'user' => $cekuser,
                        'siswa' => $siswa,
                        'divisi' => $id_divisi,
                        'kelas' => $id_kelas
                    ];
                } else {
                    $data = [
                        'responce' => 'error',
                        'pesan' => 'gagal fetch kelas',
                        'divisi' => $id_divisi,
                        'kelas' => $id_kelas
                    ];
                }
            }



            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function fetchsiswarombel()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $id_divisi = $this->request->getVar('id_divisi');
            $id_rombel = $this->request->getVar('rombel');

            if ($id_divisi == 1) {
                $siswa = $this->siswaModel->getSiswaAllRombel($id_rombel);
                $data = [
                    'responce' => 'success',
                    'user' => $cekuser,
                    'siswa' => $siswa,
                    'divisi' => $id_divisi
                ];
            } else {
                if ($siswa = $this->siswaModel->getSiswaRombel($id_divisi, $id_rombel)) {
                    $data = [
                        'responce' => 'success',
                        'user' => $cekuser,
                        'siswa' => $siswa,
                        'divisi' => $id_divisi,
                        'rombel' => $id_rombel
                    ];
                } else {
                    $data = [
                        'responce' => 'error',
                        'pesan' => 'gagal fetch kelas',
                        'divisi' => $id_divisi,
                        'rombel' => $id_rombel
                    ];
                }
            }



            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function tambahsiswa()
    {
        if ($this->request->isAJAX()) {

            $username = $this->request->getVar('username');
            $nik = $this->request->getVar('nik');

            if ($this->siswaModel->cekUsernameSiswa($username)) {
                $usernamerule = 'required|is_unique[siswa.username]';
            } else {
                $usernamerule = 'required';
            }

            if ($this->siswaModel->cekNikSiswa($nik)) {
                $nikrule = 'required|is_unique[siswa.nik]';
            } else {
                $nikrule = 'required';
            }

            if (!$this->validate([
                'username' => [
                    'rules' => $usernamerule,
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
                'nik' => [
                    'rules' => $nikrule,
                    'errors' => [
                        'required' => 'NIK tidak boleh kosong',
                        'is_unique' => 'NIK sudah ada yang punya'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap tidak boleh kosong'
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
                // validasi sukses
                $fileFoto = $this->request->getFile('foto');

                $id_divisi = $this->request->getVar('id_divisi');
                $nikk = $this->request->getVar('nik');
                $cekdivisi = $this->divisiModel->where('id', $id_divisi)->get()->getRowArray();
                $tgl_lahir = $this->request->getVar('tgl_lahir');

                $ext = $fileFoto->guessExtension();

                if ($fileFoto == '') {
                    $namaFoto = "default.png";
                } else {
                    //generate nama file random
                    // $namaFoto = $fileFoto->getRandomName();
                    $namaFoto = $cekdivisi['divisi'] . '' . $nikk . '' . $tgl_lahir . '' . now() . '.' . $ext;
                }

                $insert = [
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'nik' => $nikk,
                    'nisn' => $this->request->getVar('nisn'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'panggilan' => $this->request->getVar('panggilan'),
                    'j_kel' => $this->request->getVar('j_kel'),
                    'tem_lahir' => $this->request->getVar('tem_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'tahun_lulus' => $this->request->getVar('tahun_lulus'),
                    'lanjut_sekolah' => $this->request->getVar('lanjut_sekolah'),
                    'foto' => $namaFoto,
                    'ayah' => $this->request->getVar('ayah'),
                    'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
                    'pendapatan_ayah' => $this->request->getVar('pendapatan_ayah'),
                    'ibu' => $this->request->getVar('ibu'),
                    'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
                    'pendapatan_ibu' => $this->request->getVar('pendapatan_ibu'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'last_user_update' => $this->request->getVar('last_user_update'),
                    'id_divisi' => $id_divisi
                ];

                $this->siswaModel->insert($insert);

                if ($fileFoto != '') {
                    $fileFoto->move('asset/images/siswa', $namaFoto);
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Siswa berhasil ditambah',
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editpasswordsiswa()
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
                $idsiswa = $this->request->getVar('idsiswapassword');
                $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

                $update = [
                    'password' => $password
                ];

                $this->siswaModel->update($idsiswa, $update);

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

    public function editmodalsiswa()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $idsiswa = $this->request->getVar('idsiswa');
            if ($siswa = $this->siswaModel->where('id', $idsiswa)->get()->getRowArray()) {

                // $divisi = $this->divisiModel->orderBy('sort', 'asc')->findAll();
                $data = [
                    'responce' => 'success',
                    'siswa' => $siswa
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

    public function editsiswa()
    {
        if ($this->request->isAJAX()) {

            $username = $this->request->getVar('username');
            $nik = $this->request->getVar('nik');
            $idsiswa = $this->request->getVar('idsiswa');

            $datalama = $this->siswaModel->where('id', $idsiswa)->get()->getRowArray();

            if ($username == $datalama['username']) {
                $usernamerule = 'required';
            } else {
                if ($this->siswaModel->cekUsernameSiswa($username)) {
                    $usernamerule = 'required|is_unique[siswa.username]';
                } else {
                    $usernamerule = 'required';
                }
            }

            if ($nik == $datalama['nik']) {
                $nikrule = 'required';
            } else {
                if ($this->siswaModel->cekNikSiswa($nik)) {
                    $nikrule = 'required|is_unique[siswa.nik]';
                } else {
                    $nikrule = 'required';
                }
            }




            if (!$this->validate([
                'username' => [
                    'rules' => $usernamerule,
                    'errors' => [
                        'required' => 'Username tidak boleh kosong',
                        'is_unique' => 'Username sudah ada yang punya'
                    ]
                ],
                'nik' => [
                    'rules' => $nikrule,
                    'errors' => [
                        'required' => 'NIK tidak boleh kosong',
                        'is_unique' => 'NIK sudah ada yang punya'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap tidak boleh kosong'
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


                $id_divisi = $this->request->getVar('id_divisi');
                $nikk = $this->request->getVar('nik');
                $cekdivisi = $this->divisiModel->where('id', $id_divisi)->get()->getRowArray();
                $tgl_lahir = $this->request->getVar('tgl_lahir');

                $ext = $fileFoto->guessExtension();


                //cek gambar, apakah tetap gambar lama
                if ($fileFoto->getError() == 4) {
                    $namaFoto = $this->request->getVar('fotoLama');
                } else {
                    if ($this->request->getVar('fotoLama') == "default.png") {
                        //generate nama file random
                        // $namaFoto = $fileFoto->getRandomName();
                        $namaFoto = $cekdivisi['divisi'] . '' . $nikk . '' . $tgl_lahir . '' . now() . '.' . $ext;

                        //pindahkan gambar
                        $fileFoto->move('asset/images/siswa', $namaFoto);
                    } else {
                        //generate nama file random
                        // $namaFoto = $fileFoto->getRandomName();
                        $namaFoto = $cekdivisi['divisi'] . '' . $nikk . '' . $tgl_lahir . '' . now() . '.' . $ext;

                        //pindahkan gambar
                        $fileFoto->move('asset/images/siswa', $namaFoto);

                        //hapus gambar lama
                        unlink('asset/images/siswa/' . $this->request->getPost('fotoLama'));
                    }
                }

                $update = [
                    'username' => $this->request->getVar('username'),
                    'nik' => $nikk,
                    'nisn' => $this->request->getVar('nisn'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'panggilan' => $this->request->getVar('panggilan'),
                    'j_kel' => $this->request->getVar('j_kel'),
                    'tem_lahir' => $this->request->getVar('tem_lahir'),
                    'tgl_lahir' => $tgl_lahir,
                    'tahun_lulus' => $this->request->getVar('tahun_lulus'),
                    'lanjut_sekolah' => $this->request->getVar('lanjut_sekolah'),
                    'foto' => $namaFoto,
                    'ayah' => $this->request->getVar('ayah'),
                    'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
                    'pendapatan_ayah' => $this->request->getVar('pendapatan_ayah'),
                    'ibu' => $this->request->getVar('ibu'),
                    'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
                    'pendapatan_ibu' => $this->request->getVar('pendapatan_ibu'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'last_user_update' => $this->request->getVar('last_user_update'),
                    'id_divisi' => $this->request->getVar('id_divisi')
                ];

                $this->siswaModel->update($idsiswa, $update);


                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Siswa berhasil diupdate',
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deletesiswa()
    {
        if ($this->request->isAJAX()) {
            if ($id = $this->request->getVar('checkbox_value')) {
                for ($count = 0; $count < count($id); $count++) {
                    // $this->karyawanModel->delete_karyawan($id[$count]);
                    $siswa = $this->siswaModel->where('id', $id[$count])->get()->getRowArray();

                    if ($siswa['foto'] != 'default.png') {
                        if (file_exists('asset/images/siswa/' . $siswa['foto'])) {
                            unlink('asset/images/siswa/' . $siswa['foto']);
                        }
                    }

                    $this->siswaModel->where('id', $id[$count])->delete();
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data siswa berhasil dihapus'
                ];

                echo json_encode($data);
            }
        } else {
            echo "No direct script access allowed";
        }
    }

    public function importsiswa()
    {
        if ($this->request->isAJAX()) {

            $file = $this->request->getFile('filesiswa');

            if ($file) {
                $excelReader  = new PHPExcel();
                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();
                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
                //ambil sheet active
                $sheet    = $objPHPExcel->getActiveSheet()->toArray('', true, true, true);

                $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
                $divisi = $this->request->getVar('iddivisi');
                $angkasukses = 0;
                $angkagagal = 0;

                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if ($idx == 1) {
                        continue;
                    }

                    $username = $data['B'];
                    $password = $data['C'];
                    $nik = $data['D'];
                    $nisn = $data['E'];
                    $nama_lengkap = $data['F'];
                    $panggilan = $data['G'];
                    $j_kel = $data['H'];
                    $tem_lahir = $data['I'];
                    $tgl_lahir = $data['J'];
                    $tahun_lulus = $data['K'];
                    $lanjut_sekolah = $data['L'];
                    $ayah = $data['M'];
                    $pekerjaan_ayah = $data['N'];
                    $pendapatan_ayah = $data['O'];
                    $ibu = $data['P'];
                    $pekerjaan_ibu = $data['Q'];
                    $pendapatan_ibu = $data['R'];
                    $alamat = $data['S'];
                    $no_hp = $data['T'];
                    $foto = $data['U'];


                    // $idkaryawan = $this->karyawanModel->where('nip', $nip)->get()->getRowArray();
                    $cekdoubleuser = $this->siswaModel->cekUsernameSiswa($username);
                    $cekdoublenik = $this->siswaModel->cekNikSiswa($nik);


                    if ($cekdoubleuser > 0) {
                        // $insert = [];
                        $angkagagal++;
                    } elseif ($cekdoublenik > 0) {
                        // $insert = [];
                        $angkagagal++;
                    } else {
                        $insert = [
                            'username' => $username,
                            'password' => password($password),
                            'nik' => $nik,
                            'nisn' => $nisn,
                            'nama_lengkap' => $nama_lengkap,
                            'panggilan' => $panggilan,
                            'j_kel' => $j_kel,
                            'tem_lahir' => $tem_lahir,
                            'tgl_lahir' => tanggal($tgl_lahir),
                            'tahun_lulus' => $tahun_lulus,
                            'lanjut_sekolah' => $lanjut_sekolah,
                            'ayah' => $ayah,
                            'pekerjaan_ayah' => $pekerjaan_ayah,
                            'pendapatan_ayah' => $pendapatan_ayah,
                            'ibu' => $ibu,
                            'pekerjaan_ibu' => $pekerjaan_ibu,
                            'pendapatan_ibu' => $pendapatan_ibu,
                            'alamat' => $alamat,
                            'no_hp' => $no_hp,
                            'foto' => $foto,
                            'last_user_update' => $cekuser['nama_lengkap'],
                            'id_divisi' => $divisi
                        ];

                        $this->siswaModel->insert($insert);
                        $angkasukses++;
                    }



                    // insert data
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Import Data siswa berhasil',
                    'angkasukses' => $angkasukses,
                    'angkagagal' => $angkagagal,
                    'cekuser' => $cekdoubleuser,
                    'ceknik' => $cekdoublenik
                ];
            } else {
                //upload gagal
                $data = [
                    'responce' => 'error',
                    'pesan' => 'Import data siswa gagal'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function uploadfotosiswa()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([

                'fileuploadfoto' => [
                    'rules' => 'uploaded[fileuploadfoto]|ext_in[fileuploadfoto,zip,rar]',
                    'errors' => [
                        'uploaded' => 'file tidak boleh kosong',
                        'ext_in' => 'Gunakan file ekstensi zip atau rar'
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

                $file = $this->request->getFile('fileuploadfoto');

                $zip = new ZipArchive;

                $res = $zip->open($file);

                $path = 'asset/images/siswa/';

                if ($res == TRUE) {
                    $zip->extractTo($path);
                    $zip->close();
                    // unlink('asset/images/siswa/' . $file);
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Upload foto berhasil'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No Direct Script access allowed";
        }
    }

    public function detailsiswa($id)
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        // $siswa = $this->siswaModel->where('id', $id)->get()->getRowArray();
        $siswa = $this->siswaModel->getSiswaDetail($id);

        $data = [
            'title' => 'Kelas',
            'user' => $cekuser,
            'siswa' => $siswa

        ];

        return view('backend/tatausaha/detailsiswa', $data);
    }


    public function galerisiswa()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        $pager = \Config\Services::pager();

        // $pager->makeLinks($page, $perPage, $total, 'bootstrap');

        // $data = [
        //     'users' => $this->galeriSiswaModel->paginate(2),
        //     'pager' => $this->galeriSiswaModel->pager
        // ];


        $divisi = $this->divisiModel->getDivisiGaleri($cekuser['divisi']);


        $galerisiswa = $this->galeriSiswaModel->getGaleriSiswaFolder();

        $total = count($galerisiswa);
        $perPage = 10;
        // dd($from);
        $paager = $pager->makeLinks(1, $perPage, $total);
        // dd($paager);

        $data = [
            'title' => 'Galeri Foto Siswa',
            'user' => $cekuser,
            'divisi' => $divisi,
            'galerisiswa' => $galerisiswa,
            'pager' => $paager,

        ];

        return view('backend/tatausaha/galerisiswa', $data);
    }

    public function deletefotochecksiswa()
    {
        if ($this->request->isAJAX()) {
            if ($id = $this->request->getVar('checkbox_value')) {
                for ($count = 0; $count < count($id); $count++) {
                    // $this->karyawanModel->delete_karyawan($id[$count]);

                    if (file_exists('asset/images/siswa/' . $id[$count])) {
                        unlink('asset/images/siswa/' . $id[$count]);
                    }
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data siswa berhasil dihapus'
                ];

                echo json_encode($data);
            }
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deletefotogaleri($namafoto)
    {
        if ($this->request->isAJAX()) {
            if (file_exists('asset/images/siswa/' . $namafoto)) {
                unlink('asset/images/siswa/' . $namafoto);
            }
        } else {
            echo "No direct script access allowed";
        }
    }

    public function datasettingkelas()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();


        // $divisi = $this->divisiModel->where('divisi !=', 'Umum')->orderBy('sort', 'ASC')->findAll();
        $divisi = $this->divisiModel->where('id !=', 1)->orderBy('sort', 'ASC')->findAll();
        $kelas = $this->kelasModel->where('kelas !=', 'Alumni')->findColumn('id_divisi');


        $jmlhkelas = $this->kelasModel->where('kelas !=', 'Alumni')->countAllResults();


        $rombelalumni = ['Alumni KB', 'Alumni RA', 'Alumni MI', 'Alumni MTs', 'Alumni MA'];
        $jmlhSiswaDivisi = $this->siswaModel->select('siswa.*')->join('rombel', 'rombel.id = siswa.id_rombel', 'left')->whereNotIn('rombel.rombel', $rombelalumni)->orwhere('id_rombel', '')->findColumn('id_divisi');


        $data = [
            'title' => 'Setting Kelas',
            'user' => $cekuser,
            'divisi' => $divisi,
            'kelas' => $kelas,

            'jmlhkelas' => $jmlhkelas,

            'jmlsiswadivisi' => $jmlhSiswaDivisi

        ];

        return view('backend/tatausaha/datasettingkelas', $data);
    }

    public function settingkelas($id)
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        $iddivisi = $id;

        $divisi = $this->divisiModel->where('id', $id)->get()->getRowArray();
        $kelas = $this->kelasModel->where('id_divisi', $iddivisi)->where('kelas!=', 'Alumni')->orderby('kelas', 'ASC')->findAll();
        $siswa = $this->siswaModel->getSiswa($id);
        $rombelasal = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('divisi.divisi', $divisi['divisi'])->orderby('rombel', 'ASC')->findAll();
        $rombeltujuan = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('divisi.divisi', $divisi['divisi'])->orderby('rombel', 'ASC')->findAll();


        $data = [
            'title' => 'Setting Kelas ' . $divisi['divisi'],
            'user' => $cekuser,
            'siswa' => $siswa,
            'rombelasal' => $rombelasal,
            'rombeltujuan' => $rombeltujuan,
            'divisi' => $divisi,
            'iddivisii' => $iddivisi,
            'kelas' => $kelas
        ];

        return view('backend/tatausaha/settingkelas', $data);
    }

    public function fetchsiswakelasasal()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'rombelasal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rombel asal tidak boleh kosong'
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
                $id_rombel = $this->request->getVar('rombelasal');
                $iddivisicek = $this->request->getVar('iddivisicekasal');


                if ($id_rombel == 'belum') {
                    $siswa = $this->siswaModel->where('id_rombel', 0)->where('id_divisi', $iddivisicek)->findAll();
                } else {
                    $siswa = $this->siswaModel->where('id_rombel', $id_rombel)->findAll();
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Berhasil Fetch Kelas asal',
                    'siswa' => $siswa

                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function fetchsiswakelastujuan()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'rombeltujuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rombel Tujuan tidak boleh kosong'
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
                $id_rombel = $this->request->getVar('rombeltujuan');
                $iddivisicek = $this->request->getVar('iddivisicektujuan');


                if ($id_rombel == 'belum') {
                    $siswa = $this->siswaModel->where('id_rombel', 0)->where('id_divisi', $iddivisicek)->findAll();
                } else {
                    $siswa = $this->siswaModel->where('id_rombel', $id_rombel)->findAll();
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Berhasil Fetch Kelas asal',
                    'siswa' => $siswa

                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function pindahkelassiswa()
    {
        if ($this->request->isAJAX()) {
            $tahunlulus = $this->request->getVar('tahunlulus');
            $id_rombelasal = $this->request->getVar('rombelasal');
            $id_rombeltujuan = $this->request->getVar('rombeltujuan');
            $iddivisicekasal = $this->request->getVar('iddivisicekasal');
            $iddivisicektujuan = $this->request->getVar('iddivisicektujuan');

            $idalumni = [7, 8, 9, 10, 11];
            // $idalumni = array('7', '8,', '9', '10', '11');
            // dd(in_array($tahunlulus, $idalumni));
            if (in_array($id_rombeltujuan, $idalumni)) {
                $ruletahun = 'required';
                $update = [
                    'id_rombel' => $id_rombeltujuan,
                    'tahun_lulus' => $tahunlulus
                ];
            } else {
                $ruletahun = 'numeric';
                $update = [
                    'id_rombel' => $id_rombeltujuan
                ];
            }

            if (!$this->validate([
                'rombelasal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rombel Asal tidak boleh kosong'
                    ]
                ],
                'rombeltujuan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rombel Tujuan tidak boleh kosong'
                    ]
                ],
                'tahunlulus' => [
                    'rules' => $ruletahun,
                    'errors' => [
                        'required' => 'Tahun Lulus tidak boleh kosong',
                        'numeric' => 'Tahun Lulus harus angka',
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



                if ($id = $this->request->getVar('checkbox_value')) {
                    for ($count = 0; $count < count($id); $count++) {

                        $this->siswaModel->update($id[$count], $update);
                    }

                    if ($id_rombelasal == 'belum') {
                        $siswaasal = $this->siswaModel->where('id_rombel', 0)->where('id_divisi', $iddivisicekasal)->findAll();
                    } else {
                        $siswaasal = $this->siswaModel->where('id_rombel', $id_rombelasal)->findAll();
                    }

                    if ($id_rombeltujuan == 'belum') {
                        $siswatujuan = $this->siswaModel->where('id_rombel', 0)->where('id_divisi', $iddivisicektujuan)->findAll();
                    } else {
                        $siswatujuan = $this->siswaModel->where('id_rombel', $id_rombeltujuan)->findAll();
                    }


                    $data = [
                        'responce' => 'success',
                        'pesan' => 'Berhasil Fetch Kelas asal',
                        'siswaasal' => $siswaasal,
                        'siswatujuan' => $siswatujuan


                    ];

                    echo json_encode($data);
                }
            }
        } else {
            echo "No direct script access allowed";
        }
    }

    // controller datasiswa
    public function dataalumni()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();



        $divisi = $this->divisiModel->orderBy('sort', 'ASC')->findAll();

        $rombelalumni = ['Alumni KB', 'Alumni RA', 'Alumni MI', 'Alumni MTs', 'Alumni MA'];
        $jmlhSiswaAll = $this->siswaModel->select('siswa.*')->join('rombel', 'rombel.id = siswa.id_rombel', 'left')->whereIn('rombel.rombel', $rombelalumni)->countAllResults();


        $jmlhSiswaDivisi = $this->siswaModel->select('siswa.*')->join('rombel', 'rombel.id = siswa.id_rombel', 'left')->whereIn('rombel.rombel', $rombelalumni)->findColumn('id_divisi');


        // dd($jmlhSiswaDivisi);

        $data = [
            'title' => 'Data Alumni',
            'user' => $cekuser,
            'divisi' => $divisi,
            'jmlhsiswaall' => $jmlhSiswaAll,
            'jmlsiswadivisi' => $jmlhSiswaDivisi

        ];

        return view('backend/tatausaha/dataalumni', $data);
    }

    public function daftaralumni($id)
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        $iddivisi = $id;

        if ($iddivisi == 1) {
            $divisi = $this->divisiModel->where('id', $id)->get()->getRowArray();
            $siswa = $this->siswaModel->getSiswaAll();
            $rombel = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('kelas.kelas !=', 'Alumni')->orderby('rombel', 'ASC')->findAll();

            $kelas = $this->kelasModel->where('kelas!=', 'Alumni')->orderby('kelas', 'ASC')->findAll();

            $data = [
                'title' => 'Data Siswa Semua Divisi',
                'user' => $cekuser,
                'siswa' => $siswa,
                'rombel' => $rombel,
                'divisi' => $divisi,
                'iddivisii' => $iddivisi,
                'kelas' => $kelas

            ];
        } else {
            $divisi = $this->divisiModel->where('id', $id)->get()->getRowArray();
            $kelas = $this->kelasModel->where('id_divisi', $iddivisi)->where('kelas!=', 'Alumni')->orderby('kelas', 'ASC')->findAll();
            $siswa = $this->siswaModel->getSiswa($id);
            $rombel = $this->rombelModel->select('rombel.*,kelas.kelas,divisi.divisi')->join('kelas', 'kelas.id = rombel.id_kelas')->join('divisi', 'divisi.id = kelas.id_divisi')->where('kelas.kelas !=', 'Alumni')->where('divisi.divisi', $divisi['divisi'])->orderby('rombel', 'ASC')->findAll();


            $data = [
                'title' => 'Data Alumni ' . $divisi['divisi'],
                'user' => $cekuser,
                'siswa' => $siswa,
                'rombel' => $rombel,
                'divisi' => $divisi,
                'iddivisii' => $iddivisi,
                'kelas' => $kelas
            ];
        }

        return view('backend/tatausaha/daftaralumni', $data);
    }

    public function fetchalumni()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $id_divisi = $this->request->getVar('id_divisi');

            if ($id_divisi == 1) {
                $siswa = $this->siswaModel->getSiswaAllAlumni();
                $data = [
                    'responce' => 'success',
                    'user' => $cekuser,
                    'siswa' => $siswa,
                    'divisi' => $id_divisi
                ];
            } else {
                if ($siswa = $this->siswaModel->getSiswaAlumni($id_divisi)) {
                    $data = [
                        'responce' => 'success',
                        'user' => $cekuser,
                        'siswa' => $siswa,
                        'divisi' => $id_divisi
                    ];
                } else {
                    $data = [
                        'responce' => 'error',
                        'pesan' => 'gagal fetch kelas'
                    ];
                }
            }


            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function tambahalumni()
    {
        if ($this->request->isAJAX()) {

            $username = $this->request->getVar('username');
            $nik = $this->request->getVar('nik');

            if ($this->siswaModel->cekUsernameSiswa($username)) {
                $usernamerule = 'required|is_unique[siswa.username]';
            } else {
                $usernamerule = 'required';
            }

            if ($this->siswaModel->cekNikSiswa($nik)) {
                $nikrule = 'required|is_unique[siswa.nik]';
            } else {
                $nikrule = 'required';
            }

            if (!$this->validate([
                'username' => [
                    'rules' => $usernamerule,
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
                'nik' => [
                    'rules' => $nikrule,
                    'errors' => [
                        'required' => 'NIK tidak boleh kosong',
                        'is_unique' => 'NIK sudah ada yang punya'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap tidak boleh kosong'
                    ]
                ],
                'tahun_lulus' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tahun Lulus tidak boleh kosong'
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
                // validasi sukses
                $fileFoto = $this->request->getFile('foto');

                $id_divisi = $this->request->getVar('id_divisi');

                // 2,3,5,6,7
                // 7,8,9,10,11

                if ($id_divisi == 2) {
                    $id_rombel = 7;
                } elseif ($id_divisi == 3) {
                    $id_rombel = 8;
                } elseif ($id_divisi == 5) {
                    $id_rombel = 9;
                } elseif ($id_divisi == 6) {
                    $id_rombel = 10;
                } elseif ($id_divisi == 7) {
                    $id_rombel = 11;
                } else {
                    $id_rombel = 0;
                }

                $nikk = $this->request->getVar('nik');
                $cekdivisi = $this->divisiModel->where('id', $id_divisi)->get()->getRowArray();
                $tgl_lahir = $this->request->getVar('tgl_lahir');

                $ext = $fileFoto->guessExtension();

                if ($fileFoto == '') {
                    $namaFoto = "default.png";
                } else {
                    //generate nama file random
                    // $namaFoto = $fileFoto->getRandomName();
                    $namaFoto = $cekdivisi['divisi'] . '' . $nikk . '' . $tgl_lahir . '' . now() . '.' . $ext;
                }

                $insert = [
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'nik' => $nikk,
                    'nisn' => $this->request->getVar('nisn'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'panggilan' => $this->request->getVar('panggilan'),
                    'j_kel' => $this->request->getVar('j_kel'),
                    'tem_lahir' => $this->request->getVar('tem_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'tahun_lulus' => $this->request->getVar('tahun_lulus'),
                    'lanjut_sekolah' => $this->request->getVar('lanjut_sekolah'),
                    'foto' => $namaFoto,
                    'ayah' => $this->request->getVar('ayah'),
                    'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
                    'pendapatan_ayah' => $this->request->getVar('pendapatan_ayah'),
                    'ibu' => $this->request->getVar('ibu'),
                    'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
                    'pendapatan_ibu' => $this->request->getVar('pendapatan_ibu'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'last_user_update' => $this->request->getVar('last_user_update'),
                    'id_divisi' => $id_divisi,
                    'id_rombel' => $id_rombel
                ];

                $this->siswaModel->insert($insert);

                if ($fileFoto != '') {
                    $fileFoto->move('asset/images/siswa', $namaFoto);
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Siswa berhasil ditambah',
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editsiswaalumni()
    {
        if ($this->request->isAJAX()) {

            $username = $this->request->getVar('username');
            $nik = $this->request->getVar('nik');
            $idsiswa = $this->request->getVar('idsiswa');

            $datalama = $this->siswaModel->where('id', $idsiswa)->get()->getRowArray();

            if ($username == $datalama['username']) {
                $usernamerule = 'required';
            } else {
                if ($this->siswaModel->cekUsernameSiswa($username)) {
                    $usernamerule = 'required|is_unique[siswa.username]';
                } else {
                    $usernamerule = 'required';
                }
            }

            if ($nik == $datalama['nik']) {
                $nikrule = 'required';
            } else {
                if ($this->siswaModel->cekNikSiswa($nik)) {
                    $nikrule = 'required|is_unique[siswa.nik]';
                } else {
                    $nikrule = 'required';
                }
            }




            if (!$this->validate([
                'username' => [
                    'rules' => $usernamerule,
                    'errors' => [
                        'required' => 'Username tidak boleh kosong',
                        'is_unique' => 'Username sudah ada yang punya'
                    ]
                ],
                'nik' => [
                    'rules' => $nikrule,
                    'errors' => [
                        'required' => 'NIK tidak boleh kosong',
                        'is_unique' => 'NIK sudah ada yang punya'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap tidak boleh kosong'
                    ]
                ],
                'tahun_lulus' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tahun Lulus tidak boleh kosong'
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


                $id_divisi = $this->request->getVar('id_divisi');
                $nikk = $this->request->getVar('nik');
                $cekdivisi = $this->divisiModel->where('id', $id_divisi)->get()->getRowArray();
                $tgl_lahir = $this->request->getVar('tgl_lahir');

                $ext = $fileFoto->guessExtension();


                //cek gambar, apakah tetap gambar lama
                if ($fileFoto->getError() == 4) {
                    $namaFoto = $this->request->getVar('fotoLama');
                } else {
                    if ($this->request->getVar('fotoLama') == "default.png") {
                        //generate nama file random
                        // $namaFoto = $fileFoto->getRandomName();
                        $namaFoto = $cekdivisi['divisi'] . '' . $nikk . '' . $tgl_lahir . '' . now() . '.' . $ext;

                        //pindahkan gambar
                        $fileFoto->move('asset/images/siswa', $namaFoto);
                    } else {
                        //generate nama file random
                        // $namaFoto = $fileFoto->getRandomName();
                        $namaFoto = $cekdivisi['divisi'] . '' . $nikk . '' . $tgl_lahir . '' . now() . '.' . $ext;

                        //pindahkan gambar
                        $fileFoto->move('asset/images/siswa', $namaFoto);

                        //hapus gambar lama
                        unlink('asset/images/siswa/' . $this->request->getPost('fotoLama'));
                    }
                }

                $update = [
                    'username' => $this->request->getVar('username'),
                    'nik' => $nikk,
                    'nisn' => $this->request->getVar('nisn'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'panggilan' => $this->request->getVar('panggilan'),
                    'j_kel' => $this->request->getVar('j_kel'),
                    'tem_lahir' => $this->request->getVar('tem_lahir'),
                    'tgl_lahir' => $tgl_lahir,
                    'tahun_lulus' => $this->request->getVar('tahun_lulus'),
                    'lanjut_sekolah' => $this->request->getVar('lanjut_sekolah'),
                    'foto' => $namaFoto,
                    'ayah' => $this->request->getVar('ayah'),
                    'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
                    'pendapatan_ayah' => $this->request->getVar('pendapatan_ayah'),
                    'ibu' => $this->request->getVar('ibu'),
                    'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
                    'pendapatan_ibu' => $this->request->getVar('pendapatan_ibu'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'last_user_update' => $this->request->getVar('last_user_update'),
                    'id_divisi' => $this->request->getVar('id_divisi')
                ];

                $this->siswaModel->update($idsiswa, $update);


                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Siswa berhasil diupdate',
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function importsiswaalumni()
    {
        if ($this->request->isAJAX()) {

            $file = $this->request->getFile('filesiswa');

            if ($file) {
                $excelReader  = new PHPExcel();
                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();
                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
                //ambil sheet active
                $sheet    = $objPHPExcel->getActiveSheet()->toArray('', true, true, true);

                $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
                $divisi = $this->request->getVar('iddivisi');

                if ($divisi == 2) {
                    $id_rombel = 7;
                } elseif ($divisi == 3) {
                    $id_rombel = 8;
                } elseif ($divisi == 5) {
                    $id_rombel = 9;
                } elseif ($divisi == 6) {
                    $id_rombel = 10;
                } elseif ($divisi == 7) {
                    $id_rombel = 11;
                } else {
                    $id_rombel = 0;
                }

                $angkasukses = 0;
                $angkagagal = 0;

                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if ($idx == 1) {
                        continue;
                    }

                    $username = $data['B'];
                    $password = $data['C'];
                    $nik = $data['D'];
                    $nisn = $data['E'];
                    $nama_lengkap = $data['F'];
                    $panggilan = $data['G'];
                    $j_kel = $data['H'];
                    $tem_lahir = $data['I'];
                    $tgl_lahir = $data['J'];
                    $tahun_lulus = $data['K'];
                    $lanjut_sekolah = $data['L'];
                    $ayah = $data['M'];
                    $pekerjaan_ayah = $data['N'];
                    $pendapatan_ayah = $data['O'];
                    $ibu = $data['P'];
                    $pekerjaan_ibu = $data['Q'];
                    $pendapatan_ibu = $data['R'];
                    $alamat = $data['S'];
                    $no_hp = $data['T'];
                    $foto = $data['U'];


                    // $idkaryawan = $this->karyawanModel->where('nip', $nip)->get()->getRowArray();
                    $cekdoubleuser = $this->siswaModel->cekUsernameSiswa($username);
                    $cekdoublenik = $this->siswaModel->cekNikSiswa($nik);


                    if ($cekdoubleuser > 0) {
                        // $insert = [];
                        $angkagagal++;
                    } elseif ($cekdoublenik > 0) {
                        // $insert = [];
                        $angkagagal++;
                    } else {
                        $insert = [
                            'username' => $username,
                            'password' => password($password),
                            'nik' => $nik,
                            'nisn' => $nisn,
                            'nama_lengkap' => $nama_lengkap,
                            'panggilan' => $panggilan,
                            'j_kel' => $j_kel,
                            'tem_lahir' => $tem_lahir,
                            'tgl_lahir' => tanggal($tgl_lahir),
                            'tahun_lulus' => $tahun_lulus,
                            'lanjut_sekolah' => $lanjut_sekolah,
                            'ayah' => $ayah,
                            'pekerjaan_ayah' => $pekerjaan_ayah,
                            'pendapatan_ayah' => $pendapatan_ayah,
                            'ibu' => $ibu,
                            'pekerjaan_ibu' => $pekerjaan_ibu,
                            'pendapatan_ibu' => $pendapatan_ibu,
                            'alamat' => $alamat,
                            'no_hp' => $no_hp,
                            'foto' => $foto,
                            'last_user_update' => $cekuser['nama_lengkap'],
                            'id_divisi' => $divisi,
                            'id_rombel' => $id_rombel
                        ];

                        $this->siswaModel->insert($insert);
                        $angkasukses++;
                    }



                    // insert data
                }

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Import Data Alumni siswa berhasil',
                    'angkasukses' => $angkasukses,
                    'angkagagal' => $angkagagal,
                    'cekuser' => $cekdoubleuser,
                    'ceknik' => $cekdoublenik
                ];
            } else {
                //upload gagal
                $data = [
                    'responce' => 'error',
                    'pesan' => 'Import Data Alumni siswa gagal'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function fetchalumniceksekolah()
    {
        if ($this->request->isAJAX()) {
            $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
            $id_divisi = $this->request->getVar('id_divisi');
            $sekolahlanjut = $this->request->getVar('sekolahlanjut');

            if ($id_divisi == 1) {
                $siswa = $this->siswaModel->getSiswaAllAlumni();
                $data = [
                    'responce' => 'success',
                    'user' => $cekuser,
                    'siswa' => $siswa,
                    'divisi' => $id_divisi
                ];
            } else {
                if ($siswa = $this->siswaModel->getSiswaAlumniSekolah($id_divisi, $sekolahlanjut)) {
                    $data = [
                        'responce' => 'success',
                        'user' => $cekuser,
                        'siswa' => $siswa,
                        'divisi' => $id_divisi

                    ];
                } else {
                    $data = [
                        'responce' => 'error',
                        'pesan' => 'gagal fetch kelas',
                        'divisi' => $id_divisi

                    ];
                }
            }



            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }
}
