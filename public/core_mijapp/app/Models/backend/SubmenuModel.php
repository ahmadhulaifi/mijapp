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

    public function getsubmenu()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select('user_sub_menu.*,user_menu.menu');
        $builder->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getmodalsub($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select('user_sub_menu.*,user_menu.menu');
        $builder->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
        $builder->where('user_sub_menu.id', $id);
        $query = $builder->get()->getRowArray();

        return $query;
    }
}
