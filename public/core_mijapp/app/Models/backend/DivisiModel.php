<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table      = 'divisi';
    protected $allowedFields = ['divisi', 'sort'];

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

    public function getDivisiGaleri($divisiall)
    {

        $arr_divisi = explode(",", $divisiall);
        $jmldivisi = count($arr_divisi);

        for ($i = 0; $i < $jmldivisi; $i++) {
            $builder2 = $this->db->table('divisi');
            $builder2->select('*');
            $builder2->where('divisi', $arr_divisi[$i]);
            $query2 = $builder2->get()->getRowArray();

            $arr_iddivisi[] = $query2['id'];
        }

        $builder = $this->db->table($this->table);
        $builder->select('divisi.*');

        if (in_array('Umum', $arr_divisi) == false) {
            $builder->whereIn('id', $arr_iddivisi);
        }
        // $builder->where('id_divisi', $divisiall);


        $builder->orderby('divisi.sort', 'asc');

        $query = $builder->get()->getResultArray();

        return $query;
    }
}
