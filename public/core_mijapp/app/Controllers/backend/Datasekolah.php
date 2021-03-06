<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use App\Models\backend\DivisiModel;
use App\Models\backend\JabatanModel;
use App\Models\backend\StatusPegawaiModel;
use App\Models\backend\TahunAjaranModel;
use CodeIgniter\Controller;

class Datasekolah extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;
    protected $divisiModel;
    protected $jabatanModel;
    protected $statusPegawaiModel;
    protected $tahunAjaranModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->divisiModel = new DivisiModel();
        $this->jabatanModel = new JabatanModel();
        $this->statusPegawaiModel = new StatusPegawaiModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
    }

    // controller datasekolah divisi
    public function divisi()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        // $submenu = $this->submenuModel->orderBy('menu_id', 'asc')->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Divisi',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/datasekolah/divisi', $data);
    }

    public function fetchdivisi()
    {
        if ($this->request->isAJAX()) {
            if ($divisi = $this->divisiModel->orderBy('sort', 'asc')->findAll()) {
                $data = [
                    'responce' => 'success',
                    'divisi' => $divisi
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal fetch menu'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function savedivisi()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'divisi' => [
                    'rules' => 'required|is_unique[divisi.divisi]',
                    'errors' => [
                        'required' => 'Divisi tidak boleh kosong',
                        'is_unique' => 'Data Divisi sudah ada'
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
                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
            } else {
                // validasi sukses
                $insert = $this->request->getVar();

                $this->divisiModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Divisi berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deletedivisi($id)
    {
        if ($this->request->isAJAX()) {
            $this->divisiModel->where('id', $id)->delete();
            // $this->menuModel->where('id', $id)->delete();
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editdivisimodal()
    {
        if ($this->request->isAJAX()) {
            $iddivisi = $this->request->getVar('iddivisi');
            if ($divisi = $this->divisiModel->where('id', $iddivisi)->get()->getRowArray()) {
                $data = [
                    'responce' => 'success',
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

    public function editdivisi()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'divisi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Divisi tidak boleh kosong'
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

                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
            } else {
                // validasi sukses
                $iddivisi = $this->request->getVar('iddivisi');
                $divisi = $this->request->getVar('divisi');
                $sort = $this->request->getVar('sort');
                $update = [
                    'divisi' => $divisi,
                    'sort' => $sort
                ];

                $this->divisiModel->update($iddivisi, $update);
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

    // controller datasekolah jabatan
    public function jabatan()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        // $submenu = $this->submenuModel->orderBy('menu_id', 'asc')->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Jabatan',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/datasekolah/jabatan', $data);
    }

    public function fetchjabatan()
    {
        if ($this->request->isAJAX()) {
            if ($jabatan = $this->jabatanModel->findAll()) {
                $data = [
                    'responce' => 'success',
                    'jabatan' => $jabatan
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal fetch jabatan'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function savejabatan()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jabatan' => [
                    'rules' => 'required|is_unique[jabatan.jabatan]',
                    'errors' => [
                        'required' => 'Jabatan tidak boleh kosong',
                        'is_unique' => 'Data jabatan sudah ada'
                    ]
                ],
                'jabatan_kode' => [
                    'rules' => 'required|is_unique[jabatan.jabatan_kode]',
                    'errors' => [
                        'required' => 'Kode Jabatan tidak boleh kosong',
                        'is_unique' => 'Kode jabatan sudah ada'
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

                $this->jabatanModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Jabatan berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deletejabatan($id)
    {
        if ($this->request->isAJAX()) {
            $this->jabatanModel->where('id', $id)->delete();
            // $this->menuModel->where('id', $id)->delete();
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editjabatanmodal()
    {
        if ($this->request->isAJAX()) {
            $idjabatan = $this->request->getVar('idjabatan');
            if ($jabatan = $this->jabatanModel->where('id', $idjabatan)->get()->getRowArray()) {
                $data = [
                    'responce' => 'success',
                    'jabatan' => $jabatan
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

    public function editjabatan()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jabatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan tidak boleh kosong'
                    ]
                ],
                'jabatan_kode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Jabatan tidak boleh kosong'
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
                $idjabatan = $this->request->getVar('idjabatan');
                $jabatan_kode = $this->request->getVar('jabatan_kode');
                $kodejabatanlama = $this->request->getVar('kodejabatanlama');
                $jabatan = $this->request->getVar('jabatan');

                $cekkaryawan = $this->karyawanModel->where('jabatan_kode', $kodejabatanlama)->findAll();

                $update = [
                    'jabatan_kode' => $jabatan_kode,
                    'jabatan' => $jabatan
                ];
                $updatekaryawan = [
                    'jabatan_kode' => $jabatan_kode
                ];

                foreach ($cekkaryawan as $cekkaryawan) {

                    $this->karyawanModel->update($cekkaryawan['id'], $updatekaryawan);
                }

                $this->jabatanModel->update($idjabatan, $update);


                $data = [
                    'responce' => 'success',
                    'pesan' => 'Jabatan berhasil diupdate'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    // controller datasekolah status pegawai
    public function statuspegawai()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        // $statuspegawai = $this->statusPegawaiModel->findAll();
        // dd($statuspegawai);
        // $submenu = $this->submenuModel->orderBy('menu_id', 'asc')->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Status Pegawai',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/datasekolah/statuspegawai', $data);
    }

    public function fetchstatuspegawai()
    {
        if ($this->request->isAJAX()) {
            if ($statuspegawai = $this->statusPegawaiModel->findAll()) {
                // dd($statuspegawai);
                $data = [
                    'responce' => 'success',
                    'status_pegawai' => $statuspegawai
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal fetch jabatan'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function savestatuspegawai()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'status_pegawai_kode' => [
                    'rules' => 'required|is_unique[status_pegawai.status_pegawai_kode]',
                    'errors' => [
                        'required' => 'Kode Status tidak boleh kosong',
                        'is_unique' => 'Data Status sudah ada'
                    ]
                ],
                'status_pegawai' => [
                    'rules' => 'required|is_unique[status_pegawai.status_pegawai]',
                    'errors' => [
                        'required' => 'Status Pegaawai tidak boleh kosong',
                        'is_unique' => 'Status sudah ada'
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

                $this->statusPegawaiModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Status Pegawai berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deletestatuspegawai($id)
    {
        if ($this->request->isAJAX()) {
            $this->statusPegawaiModel->where('id', $id)->delete();
            // $this->menuModel->where('id', $id)->delete();
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editstatuspegawaimodal()
    {
        if ($this->request->isAJAX()) {
            $idstatuspegawai = $this->request->getVar('idstatuspegawai');
            if ($statuspegawai = $this->statusPegawaiModel->where('id', $idstatuspegawai)->get()->getRowArray()) {
                $data = [
                    'responce' => 'success',
                    'status_pegawai' => $statuspegawai
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

    public function editstatuspegawai()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'status_pegawai_kode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode tidak boleh kosong'
                    ]
                ],
                'status_pegawai' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status tidak boleh kosong'
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
                $idstatuspegawai = $this->request->getVar('idstatuspegawai');
                $status_pegawai_kode = $this->request->getVar('status_pegawai_kode');
                $statuskodelama = $this->request->getVar('statuskodelama');
                $status_pegawai = $this->request->getVar('status_pegawai');



                $update = [
                    'status_pegawai_kode' => $status_pegawai_kode,
                    'status_pegawai' => $status_pegawai
                ];
                $updatekaryawan = [
                    'status_pegawai_kode' => $status_pegawai_kode
                ];


                $cekkaryawan = $this->karyawanModel->where('status_pegawai_kode', $statuskodelama)->findAll();


                foreach ($cekkaryawan as $cekkaryawan) {
                    $this->karyawanModel->update($cekkaryawan['id'], $updatekaryawan);
                }

                $this->statusPegawaiModel->update($idstatuspegawai, $update);


                $data = [
                    'responce' => 'success',
                    'pesan' => 'Status pegawai berhasil diupdate',
                    'cekkaryawan' => $cekkaryawan
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function tahun()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        // $submenu = $this->submenuModel->orderBy('menu_id', 'asc')->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Tahun Ajaran',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/datasekolah/tahun', $data);
    }

    public function fetchtahun()
    {
        if ($this->request->isAJAX()) {
            if ($tahun = $this->tahunAjaranModel->findAll()) {
                $data = [
                    'responce' => 'success',
                    'tahun' => $tahun
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal fetch menu'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editmodaltahun()
    {
        if ($this->request->isAJAX()) {
            $idtahun = $this->request->getVar('idtahun');
            if ($tahun = $this->tahunAjaranModel->where('id', $idtahun)->get()->getRowArray()) {
                $data = [
                    'responce' => 'success',
                    'tahun' => $tahun
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

    public function edittahun()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'tahun' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tahun tidak boleh kosong'
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
                $idtahun = $this->request->getVar('idtahun');
                $tahun = $this->request->getVar('tahun');

                if ($this->request->getVar('aktif') == null) {
                    $active = 0;
                } else {
                    $active = 1;
                }

                $update = [
                    'tahun' => $tahun,
                    'aktif' => $active
                ];

                $this->tahunAjaranModel->update($idtahun, $update);
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
}
