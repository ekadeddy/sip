<?php

/**
* 
*/
class Mata_Kuliah_model extends CI_Model
{


	public function getAllMataKuliah()
	{
		return $this->db->get('tb_mata_kuliah')->result();
	}
        
        public function getMataKuliahByDosenToKelas($dosen,$kelas)
        {
            $query = $this->db->select('mk.MATA_KULIAH_ID,mk.MATA_KULIAH_NAMA,mk.STATUS,jd.JADWAL_ID')
                    ->from('tb_mata_kuliah mk')
                    ->join('tb_jadwal jd','mk.MATA_KULIAH_ID = jd.MATA_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->where('dsn.EMAIL',$dosen)
                    ->where('kls.KELAS_ID',$kelas)
                    ->group_by('jd.MATA_KULIAH_ID')
                    ->order_by('kls.KELAS_ID','asc')
                    ->get();
            
            return $query->result();
            
        }
}
