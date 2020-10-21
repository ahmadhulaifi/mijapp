<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table      = 'kelas';
    protected $allowedFields = ['kelas', 'id_divisi'];

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

    public function getKelas($divisiall)
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
        $builder->select('kelas.*, divisi.divisi,');
        $builder->join('divisi', 'divisi.id = kelas.id_divisi');

        if ($divisiall != 'Umum') {
            $builder->whereIn('id_divisi', $arr_iddivisi);
        }
        // $builder->where('id_divisi', $divisiall);

        $builder->where('kelas !=', 'Alumni');
        $builder->where('kelas !=', 'kosong');
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

    public function getKelasGaleri($divisiall)
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
        $builder->select('kelas.*, divisi.divisi,');
        $builder->join('divisi', 'divisi.id = kelas.id_divisi');

        if ($divisiall != 'Umum') {
            $builder->whereIn('id_divisi', $arr_iddivisi);
        }
        // $builder->where('id_divisi', $divisiall);


        $builder->where('kelas !=', 'kosong');
        $builder->orderBy('id_divisi', 'asc');
        $builder->orderBy('kelas', 'asc');
        $query = $builder->get()->getResultArray();

        return $query;
    }
}
