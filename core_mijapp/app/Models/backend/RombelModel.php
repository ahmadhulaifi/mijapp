<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class RombelModel extends Model
{
    protected $table      = 'rombel';
    protected $allowedFields = ['rombel', 'id_kelas'];

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

    public function getRombel($divisiall)
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
        $builder->select('rombel.*, kelas.kelas,divisi.divisi');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas');
        $builder->join('divisi', 'divisi.id = kelas.id_divisi');

        if ($divisiall != 'Umum') {
            $builder->whereIn('id_divisi', $arr_iddivisi);
        }
        // $builder->where('id_divisi', $divisiall);

        $builder->orderBy('id_divisi', 'asc');
        $builder->orderBy('kelas', 'asc');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getiddivisi($divisiall)
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


        return $arr_iddivisi;
    }
}
