<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table      = 'karyawan';
    // protected $allowedFields = ['username', 'password'];

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
}
