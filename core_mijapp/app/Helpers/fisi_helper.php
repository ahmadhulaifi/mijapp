<?php


function checkaccess($role_kode, $menu_id)
{
    $db      = \Config\Database::connect();

    $builder = $db->table('user_access_menu');

    $builder->where('role_kode', $role_kode);
    $builder->where('menu_id', $menu_id);

    // $query   = $builder->get();
    // dd($query);
    if ($builder->countAllResults() > 0) {
        return "checked='checked'";
    }
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
