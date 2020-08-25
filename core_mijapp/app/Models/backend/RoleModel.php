<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'user_role';
    protected $allowedFields = ['role_kode', 'role', 'sort'];

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
