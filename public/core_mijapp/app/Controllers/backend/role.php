<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\RoleModel;
use App\Models\backend\MenuModel;
use App\Models\backend\RoleAksesModel;
use CodeIgniter\Controller;


class Role extends Controller
{

    protected $karyawanModel;
    protected $roleModel;
    protected $menuModel;

    public function __construct()
    {
        helper('fisi');
        $this->karyawanModel = new KaryawanModel();
        $this->roleModel = new RoleModel();
        $this->menuModel = new MenuModel();
        $this->roleAksesModel = new RoleAksesModel();
    }

    // controller role
    public function index()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();

        // dd($role);

        $data = [
            'title' => 'Role Akses',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/role/role', $data);
    }

    public function fetchrole()
    {
        if ($this->request->isAJAX()) {
            if ($role = $this->roleModel->orderBy('sort', 'asc')->findAll()) {
                $data = [
                    'responce' => 'success',
                    'role' => $role
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'role' => 'gagal fetch data'
                ];
            }
            return json_encode($data);
        } else {
            echo "No Direct script access allowed";
        }
    }
    public function saverole()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'role_kode' => [
                    'rules' => 'required|is_unique[user_role.role_kode]',
                    'errors' => [
                        'required' => 'Kode Role tidak boleh kosong',
                        'is_unique' => 'Kode Role sudah ada'
                    ]
                ],
                'role' => [
                    'rules' => 'required|is_unique[user_role.role]',
                    'errors' => [
                        'required' => 'Role tidak boleh kosong',
                        'is_unique' => 'Role sudah ada'
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
                $this->roleModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Role berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script allowed";
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $edit_id = $this->request->getPost('edit_id');


            if ($posts = $this->roleModel->where('id', $edit_id)->get()->getRowArray()) {
                $data = [
                    'responce' => 'success',
                    'posts' => $posts
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'Gagal fetch data edit'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No Direct script access allowed";
        }
    }

    public function editrole()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'editrole_kode' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Role tidak boleh kosong'
                    ]
                ],
                'editrole' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role tidak boleh kosong'
                    ]
                ],
                'editsort' => [
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
                $idrole = $this->request->getVar('idrole');
                $role_kode = $this->request->getVar('editrole_kode');
                $editrole = $this->request->getVar('editrole');
                $editsort = $this->request->getVar('editsort');

                $update = [
                    'role_kode' => $role_kode,
                    'role' => $editrole,
                    'sort' => $editsort
                ];

                $this->roleModel->update($idrole, $update);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data Role berhasil diupdate'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deleterole($id)
    {
        if ($this->request->isAJAX()) {
            $this->roleModel->where('id', $id)->delete();
        } else {
            echo "No Direct script access allowed";
        }
    }

    // controller Role Akses
    public function roleakses($role_kode)
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $menu = $this->menuModel->orderBy('sort', 'asc')->findAll();

        $userakses = $this->roleAksesModel->cekakses($role_kode);
        // $member = $this->roleAksesModel->cekmember($role_kode);
        $member = $this->roleModel->where('role_kode', $role_kode)->get()->getRowArray();
        // dd($member);

        $data = [
            'title' => 'Role Akses',
            'user' => $cekuser,
            'menu' => $menu,
            'userakses' => $userakses,
            'member' => $member
        ];

        return view('backend/role/akses', $data);
    }

    public function gantiakses()
    {
        $menu_id = $this->request->getPost('menuId');
        $role_kode = $this->request->getPost('roleKode');

        $this->roleAksesModel->gantiakses($role_kode, $menu_id);

        session()->setFlashdata('pesan', 'Akses Berubah');
    }

    public function userrole()
    {
        $cekuser = $this->karyawanModel->where('id', session('id'))->get()->getRowArray();
        $role = $this->roleModel->findAll();
        $role2 = $this->roleModel->findAll();
        // dd($role);

        $data = [
            'title' => 'User Role Akses',
            'user' => $cekuser,
            'role' => $role,
            'role2' => $role2,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/role/userrole', $data);
    }

    public function fetchrolesemuapegawai()
    {
        if ($this->request->isAJAX()) {
            if ($rolepegawai = $this->karyawanModel->where('username!=', 'adminmij')->findAll()) {
                $data = [
                    'responce' => 'success',
                    'rolepegawai' => $rolepegawai
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'role' => 'gagal fetch data'
                ];
            }
            return json_encode($data);
        } else {
            echo "No Direct script access allowed";
        }
    }

    public function fetchfilterrolepegawai()
    {
        if ($this->request->isAJAX()) {
            $satuan = $this->request->getVar('roleasal');
            // dd($satuan);
            if ($pegawaisatuan = $this->karyawanModel->where('role_kode', $satuan)->where('username!=', 'adminmij')->findAll()) {
                $data = [
                    'responce' => 'success',
                    'rolepegawai' => $pegawaisatuan
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

    public function btntujuanrolepegawai()
    {
        if ($this->request->isAJAX()) {

            if ($id = $this->request->getVar('checkbox_value')) {
                $idrole = $this->request->getVar('idroletujuan');

                for ($count = 0; $count < count($id); $count++) {
                    $update = [
                        'role_kode' => $idrole,
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
}
