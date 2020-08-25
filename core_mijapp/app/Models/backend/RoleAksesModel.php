<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class RoleAksesModel extends Model
{
    protected $table      = 'user_access_menu';
    protected $allowedFields = ['role_kode', 'menu_id'];

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

    public function cekakses($role_kode)
    {
        $query = $this->table($this->table)->where('role_kode', $role_kode)->get()->getResultArray();
        // dd($query);
        return $query;
    }

    public function cekmember($role_kode)
    {
        $builder = $this->table($this->table);
        $builder->select('*');
        $builder->join('user_role', 'user_role.role_kode = user_access_menu.role_kode');
        $builder->where('user_role.role_kode', $role_kode);
        $query = $builder->get()->getRowArray();
        // dd($query);
        return $query;
    }

    public function gantiakses($role_kode, $menu_id)
    {
        $query = $this->table($this->table)->select('*')->where('role_kode', $role_kode)->where('menu_id', $menu_id);

        if ($query->countAllResults() < 1) {
            $data = [
                'role_kode' => $role_kode,
                'menu_id'  => $menu_id
            ];

            return $this->table($this->table)->insert($data);
        } else {
            return $this->table($this->table)->where('role_kode', $role_kode)->where('menu_id', $menu_id)->delete();
        }
    }
}
