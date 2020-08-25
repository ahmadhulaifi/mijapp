<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table      = 'user_sub_menu';
    protected $allowedFields = ['menu_id', 'sub_menu', 'icon', 'url', 'sort', 'is_active'];

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
