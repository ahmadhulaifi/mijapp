<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table      = 'karyawan';
    protected $allowedFields = ['id', 'nip', 'role_kode', 'nama_lengkap', 'nama_panggilan', 'gelar', 'tem_lahir', 'tgl_lahir', 'j_kel', 'agama', 'status', 'username', 'password', 'jalan_no', 'rt', 'rw', 'desa_kel', 'kecamatan', 'kota', 'kd_pos', 'jalan_no_domisili', 'rt_domisili', 'rw_domisili', 'desa_kel_domisili', 'kecamatan_domisili', 'kota_domisili', 'kd_pos_domisili', 'email', 'telepon', 'no_ktp', 'no_kk', 'foto', 'created_at', 'updated_at', 'created_at'];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;


    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getProfil($id)
    {
        $builder = $this->table($this->table);
        $builder->select('karyawan.*, jabatan.jabatan,status_pegawai.status_pegawai');
        $builder->join('jabatan', 'jabatan.jabatan_kode = karyawan.jabatan_kode');
        $builder->join('status_pegawai', 'status_pegawai.status_pegawai_kode = karyawan.status_pegawai_kode');
        $builder->where('karyawan.id', $id);
        $query = $builder->get()->getRowArray();

        return $query;
    }
}
