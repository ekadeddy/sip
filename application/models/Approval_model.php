<?php

/**
* 
*/
class Approval_model extends CI_Model
{
	public function getLastApprovalId()
	{
		$query = $this->db->select_max('JADWAL_APPORVAL_ID')
			->get('tb_jadwal_approval')
			->row();
		return $query->JADWAL_APPORVAL_ID;
	}
        public function getApprovalDataById($id)
        {
            $query = $this->db->select('jdg.RUANGAN_ID,dsn.DOSEN_NAMA,mk.MATA_KULIAH_NAMA,jdg.TANGGAL')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_jam_kuliah jk','jd.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->where('jdg.JADWAL_GANTI_ID',$id)
                    ->get();
                    
            return $query->result();
        }
        
        function updateStatusApproval($where,$data)
        {
            $this->db->where($where)
						->update('tb_jadwal_ganti jdg', $data);
        }
        function submitJadwalGantiHistory($data)
        {         
            $this->db->insert('tb_jadwal_ganti_history',$data);
            if($this->db->affected_rows() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function reqSaveApproval($where,$dataJadwalGanti,$datajadwalGantiHistory)
        {
                $this->db->trans_start();
                $this->updateStatusApproval($where,$dataJadwalGanti);
                $this->submitJadwalGantiHistory($datajadwalGantiHistory);
                $this->db->trans_complete();
		 if ($this->db->trans_status() == TRUE)
            {
                   return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
}
