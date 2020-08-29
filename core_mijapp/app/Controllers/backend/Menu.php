<?php

namespace App\Controllers\backend;

use App\Models\backend\KaryawanModel;
use App\Models\backend\MenuModel;
use App\Models\backend\SubmenuModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;

class Menu extends Controller
{
    protected $karyawanModel;
    protected $menuModel;
    protected $submenuModel;

    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
    }

    // controller menu
    public function index()
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();

        // $submenu = $this->submenuModel->orderBy('menu_id', 'asc')->findAll();
        // dd($submenu);

        $data = [
            'title' => 'Menu Management',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/menu/menu', $data);
    }

    public function fetchmenu()
    {
        if ($this->request->isAJAX()) {
            if ($menu = $this->menuModel->orderBy('sort', 'asc')->findAll()) {
                $data = [
                    'responce' => 'success',
                    'menu' => $menu
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

    public function savemenu()
    {
        if ($this->request->isAJAX()) {
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
                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
            } else {
                // validasi sukses
                $insert = $this->request->getVar();

                $this->menuModel->insert($insert);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Menu berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $idemenu = $this->request->getVar('idmenu');
            if ($menu = $this->menuModel->where('id', $idemenu)->get()->getRowArray()) {
                $data = [
                    'responce' => 'success',
                    'menu' => $menu
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

    public function editmenu()
    {
        if ($this->request->isAJAX()) {
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

                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
            } else {
                // validasi sukses
                $idemenu = $this->request->getVar('idmenu');
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

                $this->menuModel->update($idemenu, $update);
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

    public function deletemenu($id)
    {
        if ($this->request->isAJAX()) {
            $this->submenuModel->where('menu_id', $id)->delete();
            $this->menuModel->where('id', $id)->delete();
        } else {
            echo "No direct script access allowed";
        }
    }


    // controller submenu
    public function submenu()
    {
        $cekuser = $this->karyawanModel->where('username', session('username'))->get()->getRowArray();
        $menu = $this->menuModel->findAll();
        // dd($menu);

        $data = [
            'title' => 'Submenu Management',
            'user' => $cekuser,
            'menu' => $menu,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/menu/submenu', $data);
    }

    public function fetchsubmenu()
    {
        if ($this->request->isAJAX()) {

            if ($submenu = $this->submenuModel->getsubmenu()) {
                $data = [
                    'responce' => 'success',
                    'submenu' => $submenu
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

    public function savesubmenu()
    {
        if ($this->request->isAJAX()) {
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

                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
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

                $this->submenuModel->insert($insert);
                $data = [
                    'responce' => 'success',
                    'pesan' => 'Sub Menu berhasil ditambah'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editsub()
    {
        if ($this->request->isAJAX()) {
            $idsubmenu = $this->request->getVar('idsubmenu');

            if ($submenu = $this->submenuModel->getmodalsub($idsubmenu)) {
                $data = [
                    'responce' => 'success',
                    'submenu' => $submenu
                ];
            } else {
                $data = [
                    'responce' => 'error',
                    'pesan' => 'gagal edit modal submenu'
                ];
            }

            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function editsubmenu()
    {
        if ($this->request->isAJAX()) {
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

                $data = [
                    'responce' => 'error',
                    'pesan' => $validation->listErrors()
                ];
            } else {
                // validasi sukses
                $idsubmenu = $this->request->getVar('idsubmenu');
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

                $this->submenuModel->update($idsubmenu, $update);

                $data = [
                    'responce' => 'success',
                    'pesan' => 'Data sub menu berhasil diupdate'
                ];
            }
            echo json_encode($data);
        } else {
            echo "No direct script access allowed";
        }
    }

    public function deletesubmenu($id)
    {
        if ($this->request->isAJAX()) {
            $this->submenuModel->where('id', $id)->delete();
        } else {
            echo "No direct script access allowed";
        }
    }
}
