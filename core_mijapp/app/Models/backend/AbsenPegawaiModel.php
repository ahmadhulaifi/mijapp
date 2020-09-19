<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class AbsenPegawaiModel extends Model
{
    protected $table      = 'absen_pegawai';
    protected $allowedFields = ['nip', 'bulan', 'tahun', 'sakit', 'izin', 'alpha', 'cuti', 'lain', 'hadir', 'user_update', 'id_karyawan'];

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

    public function getabsensemua()
    {
        $builder = $this->db->table($this->table);
        $builder->select('absen_pegawai.*,karyawan.nama_lengkap');
        $builder->join('karyawan', 'karyawan.nip = absen_pegawai.nip');
        $query = $builder->get()->getResultArray();

        return $query;
    }
}
