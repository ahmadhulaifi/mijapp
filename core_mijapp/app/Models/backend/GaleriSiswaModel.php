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



    public function getGaleriSiswaFolder()
    {
        // $query = directory_map('./asset/images/siswa/')->get('user', $number, $offset)->result();
        $query = directory_map('./asset/images/siswa/');


        return $query;
    }
}
