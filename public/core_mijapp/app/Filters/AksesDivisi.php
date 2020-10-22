<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AksesDivisi implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $db      = \Config\Database::connect();

        $cekuser = $db->table('karyawan')->where('id', session('id'))->get()->getRowArray();

        // $divisiasal = strpos($cekuser['divisi'], ',');
        $divisiasal = explode(",", $cekuser['divisi']);
        // dd($divisiasal);


        $urli = explode("/", uri_string());
        $uricurrent = $urli[2];
        $cekdivisi = $db->table('divisi')->where('id', $uricurrent)->get()->getRowArray();

        // $hasil_posisi = strpos($cekuser['divisi'], $cekdivisi['divisi']);
        // dd(in_array($cekdivisi['divisi'], $divisiasal));



        // Do something here
        // if (in_array($cekdivisi['divisi'], $divisiasal) == false or in_array('Umum', $divisiasal) == false) {
        if (in_array('Umum', $divisiasal) == false) {
            if (in_array($cekdivisi['divisi'], $divisiasal) == false) {
                return redirect()->to(base_url('/block'));
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
