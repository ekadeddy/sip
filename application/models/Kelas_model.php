<?php

/**
* 
*/
class Kelas_model extends CI_Model
{

	public function getProgramStudi($mahasiswaId)
	{
		$query = $this->db->select('PROGRAM_STUDI_NAMA, GENERASI,EMAIL')
			->from('tb_program_studi ps')
			->join('tb_kelas kls','ps.PROGRAM_STUDI_ID = kls.PROGRAM_STUDI_ID','inner')
			->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID','inner')
			->where('mhs.MAHASISWA_ID',$mahasiswaId)
			->get();
		return $query->result();

	}

	public function getAllKelas()
	{
		return $this->db->get('tb_kelas')->result();
	}
        
        public function getKelasByDosen($dosen)
        {
            $query = $this->db->select('kls.KELAS_NAMA,kls.KELAS_ID')
                    ->from('tb_kelas kls')
                    ->join('tb_jadwal jd','on kls.KELAS_ID = jd.KELAS_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->where('dsn.EMAIL',$dosen)
                    ->get();
            
            return $query->result();
                    
        }
        
        public function getKelasByProgramStudi($ps)
        {
            $query = $this->db->select('KELAS_ID,KELAS_NAMA')
                    ->where('PROGRAM_STUDI_ID',$ps)
                    ->get('tb_kelas');
            
            return $query->result();
        }

}
