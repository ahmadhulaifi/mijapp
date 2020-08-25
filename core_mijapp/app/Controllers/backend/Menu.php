<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use CodeIgniter\Controller;


class Menu extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
    }

    // controller menu
    public function index()
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();
        $menu = $this->menuModel->orderBy('sort', 'asc')->findAll();
        $submenu = $this->submenuModel->orderBy('menu_id', 'asc')->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Menu Management',
            'user' => $cekuser,
            'menu' => $menu,
            'submenu' => $submenu,
            'validation' => \Config\Services::validation()
        ];

        echo view('backend/layout/header_admin', $data);
        echo view('backend/menu/menu', $data);
        echo view('backend/layout/footer_admin');
    }

    public function savemenu()
    {
        if (!$this->validate([
            'menu' => [
                'rules' => 'required|is_unique[user_menu.menu]',
                'errors' => [
                    'required' => 'Menu tidak boleh kosong',
                    'is_unique' => 'Data Menu sudah ada'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon tidak boleh kosong'
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url tidak boleh kosong'
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

            return redirect()->to(base_url('/menu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $menu = $this->request->getVar('menu');
            $icon = $this->request->getVar('icon');
            $url = $this->request->getVar('url');
            $sort = $this->request->getVar('sort');

            $insert = [
                'menu' => $menu,
                'icon' => $icon,
                'url' => $url,
                'sort' => $sort
            ];


            session()->setFlashdata('pesan', 'Menu Berhasil ditambah');
            $this->menuModel->insert($insert);
            return redirect()->to(base_url('/menu'));
        }
    }

    public function editmenu($id)
    {
        if (!$this->validate([
            'menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu tidak boleh kosong'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon tidak boleh kosong'
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url tidak boleh kosong'
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

            return redirect()->to(base_url('/menu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $menu = $this->request->getVar('menu');
            $icon = $this->request->getVar('icon');
            $url = $this->request->getVar('url');
            $sort = $this->request->getVar('sort');
            $update = [
                'menu' => $menu,
                'icon' => $icon,
                'url' => $url,
                'sort' => $sort
            ];


            session()->setFlashdata('pesan', 'Menu Berhasil diupdate');
            $this->menuModel->update($id, $update);
            return redirect()->to(base_url('/menu'));
        }
    }

    public function deletemenu($id)
    {
        $this->submenuModel->where('menu_id', $id)->delete();
        $this->menuModel->where('id', $id)->delete();
    }


    // controller submenu
    public function submenu()
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();
        $menu = $this->menuModel->findAll();
        $submenu = $this->submenuModel->orderBy('menu_id', 'asc')->findAll();
        // dd($menu);

        $data = [
            'title' => 'Submenu Management',
            'user' => $cekuser,
            'menu' => $menu,
            'submenu' => $submenu,
            'validation' => \Config\Services::validation()
        ];

        echo view('backend/layout/header_admin', $data);
        echo view('backend/menu/submenu', $data);
        echo view('backend/layout/footer_admin');
    }

    public function savesubmenu()
    {
        if (!$this->validate([
            'submenu' => [
                'rules' => 'required|is_unique[user_sub_menu.sub_menu]',
                'errors' => [
                    'required' => 'Sub Menu tidak boleh kosong',
                    'is_unique' => 'Data Sub Menu sudah ada'
                ]
            ],
            'menu_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu harus dipilih'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon tidak boleh kosong'
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url tidak boleh kosong'
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

            return redirect()->to(base_url('/menu/submenu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $submenu = $this->request->getVar('submenu');
            $menuid = $this->request->getVar('menu_id');
            $icon = $this->request->getVar('icon');
            $url = $this->request->getVar('url');
            $sort = $this->request->getVar('sort');

            if ($this->request->getVar('is_active') == null) {
                $active = 0;
            } else {
                $active = 1;
            }

            $insert = [
                'sub_menu' => $submenu,
                'menu_id' => $menuid,
                'icon' => $icon,
                'url' => $url,
                'sort' => $sort,
                'is_active' => $active
            ];


            session()->setFlashdata('pesan', 'Sub Menu Berhasil ditambah');
            $this->submenuModel->insert($insert);
            return redirect()->to(base_url('/menu/submenu'));
        }
    }

    public function editsubmenu($id)
    {
        if (!$this->validate([
            'submenu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sub Menu tidak boleh kosong'
                ]
            ],
            'menu_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu harus dipilih'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon tidak boleh kosong'
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url tidak boleh kosong'
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

            return redirect()->to(base_url('/menu/submenu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $submenu = $this->request->getVar('submenu');
            $menuid = $this->request->getVar('menu_id');
            $icon = $this->request->getVar('icon');
            $url = $this->request->getVar('url');
            $sort = $this->request->getVar('sort');

            if ($this->request->getVar('is_active') == null) {
                $active = 0;
            } else {
                $active = 1;
            }

            // dd($this->request->getVar('is_active'));

            $update = [
                'sub_menu' => $submenu,
                'menu_id' => $menuid,
                'icon' => $icon,
                'url' => $url,
                'sort' => $sort,
                'is_active' => $active
            ];
            session()->setFlashdata('pesan', 'Sub Menu Berhasil diupdate');
            $this->submenuModel->update($id, $update);
            return redirect()->to(base_url('/menu/submenu'));
        }
    }

    public function deletesubmenu($id)
    {

        $this->submenuModel->where('id', $id)->delete();
    }
}
