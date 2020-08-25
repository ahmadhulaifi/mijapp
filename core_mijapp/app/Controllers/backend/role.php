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
        helper(['form', 'url', 'fisi']);
        $this->karyawanModel = new KaryawanModel();
        $this->roleModel = new RoleModel();
        $this->menuModel = new MenuModel();
        $this->roleAksesModel = new RoleAksesModel();
    }

    // controller role
    public function index()
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();
        $role = $this->roleModel->orderBy('sort', 'asc')->findAll();
        // dd($role);

        $data = [
            'title' => 'Role Akses',
            'user' => $cekuser,
            'role' => $role,
            'validation' => \Config\Services::validation()
        ];

        echo view('backend/layout/header_admin', $data);
        echo view('backend/role/role', $data);
        echo view('backend/layout/footer_admin');
    }


    public function saverole()
    {
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

            return redirect()->to(base_url('/role'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $role_kode = $this->request->getVar('role_kode');
            $role = $this->request->getVar('role');
            $sort = $this->request->getVar('sort');

            $insert = [
                'role_kode' => $role_kode,
                'role' => $role,
                'sort' => $sort
            ];


            session()->setFlashdata('pesan', 'Role Berhasil ditambah');
            $this->roleModel->insert($insert);
            return redirect()->to(base_url('/role'));
        }
    }

    public function editrole($id)
    {
        if (!$this->validate([
            'role_kode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Role tidak boleh kosong'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role tidak boleh kosong'
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

            return redirect()->to(base_url('/role'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $role_kode = $this->request->getVar('role_kode');
            $role = $this->request->getVar('role');
            $sort = $this->request->getVar('sort');

            $update = [
                'role_kode' => $role_kode,
                'role' => $role,
                'sort' => $sort
            ];


            session()->setFlashdata('pesan', 'Role Berhasil diupdate');
            $this->roleModel->update($id, $update);
            return redirect()->to(base_url('/role'));
        }
    }

    public function deleterole($id)
    {
        $this->roleModel->where('id', $id)->delete();
    }

    // controller Role Akses
    public function roleakses($role_kode)
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();
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

        echo view('backend/layout/header_admin', $data);
        echo view('backend/role/akses', $data);
        echo view('backend/layout/footer_admin');
    }

    public function gantiakses()
    {
        $menu_id = $this->request->getPost('menuId');
        $role_kode = $this->request->getPost('roleKode');

        $this->roleAksesModel->gantiakses($role_kode, $menu_id);

        session()->setFlashdata('pesan', 'Akses Berubah');
    }
}
