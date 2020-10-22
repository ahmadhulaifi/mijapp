<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class StatusPegawaiModel extends Model
{
    protected $table      = 'status_pegawai';
    protected $allowedFields = ['status_pegawai_kode', 'status_pegawai'];

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
}
