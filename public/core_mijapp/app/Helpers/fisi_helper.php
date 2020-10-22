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

function checkdivisi($id_karyawan)
{
    $db      = \Config\Database::connect();

    $builder = $db->table('user_divisi');
    $builder->select('user_divisi.*,divisi.divisi');
    $builder->join('divisi', 'divisi.id = user_divisi.id_divisi');

    $builder->where('id_karyawan', $id_karyawan);
    // $builder->where('id_divisi', $id_divisi);

    if ($builder->countAllResults() > 0) {
        $query = $builder->get()->getResultArray();
        $hasil = "ada datanya";
    } else {
        $query = "belum diatur";
        $hasil = "belum diatur";
    }

    return $hasil;
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

function password($pass)
{
    $passinput = password_hash($pass, PASSWORD_DEFAULT);

    return $passinput;
}

function tanggal($tanggal)
{

    // $base_day dikurangkan 1 untuk mendapatkan timestamp yang tepat
    // $base_timestamp = mktime(0, 0, 0, 1, $tanggal - 1, 1900);

    // Output: 01-01-1970:
    // echo date("d-m-Y", $base_timestamp);

    // $tanggal_jadi = date("Y-m-d", $base_timestamp);

    $pecah = explode('/', $tanggal);
    return $pecah[2] . '-' . $pecah[0] . '-' . $pecah[1];


    // return $tanggal_jadi;
};

function tanggalindo($tanggal)
{

    $pecah = explode('-', $tanggal);
    return $pecah[1] . '/' . $pecah[0] . '/' . $pecah[2];
};
