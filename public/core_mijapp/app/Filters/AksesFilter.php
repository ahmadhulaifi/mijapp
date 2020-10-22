<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AksesFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $db      = \Config\Database::connect();

        $cekuser = $db->table('karyawan')->where('id', session('id'))->get()->getRowArray();

        // $role_id = session('role_id');
        $role_kode = $cekuser['role_kode'];
        $builder = $db->table('user_menu');
        $builder2 = $db->table('user_access_menu');
        // dd(uri_string());
        $posisi = strpos(uri_string(), '/');
        if ($posisi == 0) {
            $uricurrent =  uri_string();
        } else {
            $urli = explode("/", uri_string());
            $uricurrent = $urli[0];
        }
        // dd($uricurrent);
        $querymenu   = $builder->where('controller', $uricurrent)->get()->getRowArray();
        $queryaccess = $builder2->where('menu_id', $querymenu['id'])->where('role_kode', $role_kode)->countAllResults();

        // Do something here
        if (session('username') == null) {
            return redirect()->to(base_url('/loginadmin'));
        } elseif ($queryaccess < 1) {
            return redirect()->to(base_url('/block'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
