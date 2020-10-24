<?php

namespace App\Models\backend;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $allowedFields = ['username', 'password', 'nik', 'nisn', 'nama_lengkap', 'panggilan', 'j_kel', 'tem_lahir', 'tgl_lahir', 'alamat', 'no_hp', 'ayah', 'pekerjaan_ayah', 'pendapatan_ayah', 'ibu', 'pekerjaan_ibu', 'pendapatan_ibu', 'tahun_lulus', 'lanjut_sekolah', 'foto', 'id_rombel', 'created_at', 'updated_at', 'last_user_update', 'id_divisi'];

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

    public function getSiswa($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('siswa.id_divisi', $id);
        $builder->where('kelas.kelas!=', 'Alumni');
        $builder->orwhere('kelas.kelas', null);
        $builder->where('siswa.id_divisi', $id);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getSiswaBelum($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('siswa.id_divisi', $id);
        // $builder->where('kelas.kelas!=', 'Alumni');
        $builder->where('kelas.kelas', null);
        // $builder->where('siswa.id_divisi', $id);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getSiswaAll()
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('kelas.kelas!=', 'Alumni');
        $builder->orwhere('kelas.kelas', null);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResult();

        return $query;
    }

    public function getSiswaAllBelum()
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        // $builder->where('kelas.kelas!=', 'Alumni');
        $builder->where('kelas.kelas', null);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResult();

        return $query;
    }

    public function getSiswaKelas($id_divisi, $id_kelas)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('siswa.id_divisi', $id_divisi);
        // $builder->where('kelas.kelas!=', 'Alumni');
        $builder->where('kelas.id', $id_kelas);
        // $builder->where('siswa.id_divisi', $id);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getSiswaAllKelas($id_kelas)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        // $builder->where('siswa.id_divisi', $id_divisi);
        // $builder->where('kelas.kelas!=', 'Alumni');
        $builder->where('kelas.id', $id_kelas);
        // $builder->where('siswa.id_divisi', $id);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getSiswaRombel($id_divisi, $id_rombel)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('siswa.id_divisi', $id_divisi);
        // $builder->where('kelas.kelas!=', 'Alumni');
        $builder->where('siswa.id_rombel', $id_rombel);
        // $builder->where('siswa.id_divisi', $id);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getSiswaAllRombel($id_rombel)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        // $builder->where('siswa.id_divisi', $id_divisi);
        // $builder->where('kelas.kelas!=', 'Alumni');
        $builder->where('siswa.id_rombel', $id_rombel);
        // $builder->where('siswa.id_divisi', $id);
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function jmlhSiswaAll()
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        // $builder->where('siswa.id_divisi', $id);
        $builder->where('kelas.kelas!=', 'Alumni');
        $builder->orwhere('kelas.kelas', null);
        // $builder->where('siswa.id_divisi', $id);
        $query = $builder->countAllResults();

        return $query;
    }




    public function cekUsernameSiswa($username)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->where('siswa.username', $username);
        $builder->where('kelas.kelas !=', 'Alumni');
        $query = $builder->countAllResults();

        return $query;
    }

    public function cekNikSiswa($nik)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->where('siswa.nik', $nik);
        $builder->where('kelas.kelas !=', 'Alumni');
        $query = $builder->countAllResults();

        return $query;
    }

    public function getSiswaDetail($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('siswa.id', $id);
        $query = $builder->get()->getRowArray();

        return $query;
    }

    public function getSiswaAllAlumni()
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('kelas.kelas', 'Alumni');
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResult();

        return $query;
    }

    public function getSiswaAlumni($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('siswa.id_divisi', $id);
        $builder->where('kelas.kelas', 'Alumni');
        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getSiswaAlumniSekolah($id, $sekolahlanjut)
    {
        $builder = $this->db->table($this->table);
        $builder->select('siswa.*, kelas.kelas,rombel.rombel,divisi.divisi');
        $builder->join('rombel', 'rombel.id = siswa.id_rombel', 'left');
        $builder->join('kelas', 'kelas.id = rombel.id_kelas', 'left');
        $builder->join('divisi', 'divisi.id = siswa.id_divisi', 'left');
        $builder->where('siswa.id_divisi', $id);
        $builder->where('kelas.kelas', 'Alumni');

        if ($sekolahlanjut == 'belum') {
            $builder->where('siswa.lanjut_sekolah', '');
        } else {
            $builder->where('siswa.lanjut_sekolah!=', '');
        }

        $builder->orderBy('rombel.rombel', 'ASC');
        $builder->orderBy('siswa.nama_lengkap', 'ASC');
        $query = $builder->get()->getResultArray();

        return $query;
    }
}
