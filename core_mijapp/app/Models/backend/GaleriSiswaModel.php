<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class GaleriSiswaModel extends Model
{
    protected $table      = 'galeri_siswa';
    protected $allowedFields = ['foto', 'id_divisi'];

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

    public function getGaleriSiswa($divisiall)
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
        $builder->select('galeri_siswa.*,divisi.divisi');
        $builder->join('divisi', 'divisi.id = galeri_siswa.id_divisi');

        if (in_array('Umum', $arr_divisi) == false) {
            $builder->whereIn('id_divisi', $arr_iddivisi);
        }
        // $builder->where('id_divisi', $divisiall);


        $builder->orderBy('id_divisi', 'asc');

        $query = $builder->get()->getResultArray();

        return $query;
    }
}
