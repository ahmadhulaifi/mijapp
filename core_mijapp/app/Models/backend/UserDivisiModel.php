<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class UserDivisiModel extends Model
{
    protected $table      = 'user_divisi';
    protected $allowedFields = ['id_karyawan', 'id_divisi'];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    // protected $primaryKey = 'id';

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;


    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getDivisi($id)
    {
        $builder = $this->table($this->table);
        $builder->select('user_divisi.*, karyawan.nama_panggilan,divisi.divisi');
        $builder->join('karyawan', 'karyawan.id = user_divisi.id_karyawan');
        $builder->join('divisi', 'divisi.id = user_divisi.id_divisi');
        $builder->where('user_divisi.id_karyawan', $id);
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getdivisisemua()
    {
        $builder = $this->table($this->table);

        $builder->select('user_divisi.*,karyawan.id as nik,karyawan.nama_lengkap,,karyawan.nip,divisi.divisi');
        $builder->join('karyawan', 'karyawan.id=user_divisi.id_karyawan', 'right');
        $builder->join('divisi', 'divisi.id=user_divisi.id_divisi', 'left outer');

        $query = $builder->get()->getResultArray();

        return $query;
    }



    public function getdivisisatuan($id)
    {
        $builder = $this->table($this->table);
        $builder->select('user_divisi.*,karyawan.id as nik,karyawan.nama_lengkap,karyawan.nip,divisi.divisi');
        // $builder->select('user_divisi.*,karyawan.nama_lengkap,,karyawan.nip,divisi.divisi');
        $builder->join('karyawan', 'karyawan.id=user_divisi.id_karyawan', 'right');
        $builder->join('divisi', 'divisi.id=user_divisi.id_divisi', 'left outer');

        $builder->where('user_divisi.id_divisi', $id);
        $query = $builder->get()->getResultArray();

        return $query;
    }
}
