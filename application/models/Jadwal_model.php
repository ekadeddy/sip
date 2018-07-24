<?php

/**
* 
*/
class Jadwal_model extends CI_Model
{
	function getJadwaByIdMahasiswa($id)
	{
		$query = $this->db->from('tb_jadwal')
			->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID','INNER')
			->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID','INNER')
			->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID','INNER')
			->join('tb_ruangan r','jd.RUANGAN_ID = r.RUANGAN_ID','INNER')
			->join('tb_jam_kuliah jk','jd.JAM_KULIAH_ID = jk.JAM_KULIAH_ID','INNER')
			->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID','INNER')
			->where('mhs.EMAIL',$id)
			->get();
		return $query->result();
	}
        
        function getJadwalByJadwalId($where)
        {
            $query = $this->db->select('*')
                    ->where('JADWAL_ID',$where)
                    ->get('tb_jadwal');
            return $query->result();
        }
        //ambil jadwal by dosen, kelas dan matkul
        function getJadwalBy($dosen,$kelas,$matakuliah)
        {
            $query = $this->db->select('jd.JADWAL_ID,jd.HARI')
                    ->from('tb_jadwal jd')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->where('dsn.EMAIL',$dosen)
                    ->where('jd.KELAS_ID',$kelas)
                    ->where('jd.MATA_KULIAH_ID',$matakuliah)
                    ->get();
            
            return $query->result();  
            
            
        }
        function getJadwalByHari($dosen,$kelas,$matakuliah,$hari)
        {
            $query = $this->db->select('JADWAL_ID')
                    ->from('tb_jadwal jd')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->where('dsn.EMAIL',$dosen)
                    ->where('jd.KELAS_ID',$kelas)
                    ->where('jd.MATA_KULIAH_ID',$matakuliah)
                    ->where('jd.HARI',$hari)
                    ->get()
                    ->row();
            
            return $query->JADWAL_ID;        
        }
        function getHari()
        {
            $query = $this->db->select('HARI')
                    ->group_by('HARI')
                    ->order_by('HARI','desc')
                    ->get('tb_jadwal');
            
            return $query->result();
        }
        function getApprovalData()
        {
            $date_now = date('Y-m-d');
            $query = $this->db->query("select * from tb_jadwal_ganti jdg
                inner join tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
                inner join tb_dosen dsn on jd.DOSEN_ID = dsn.DOSEN_ID
                inner join tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
                inner join tb_mata_kuliah mk on jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID
                where JADWAL_GANTI_ID not in 
                                        (select JADWAL_GANTI_ID from tb_jadwal_approval jda)
                and TANGGAL > '$date_now'
                order by jdg.JADWAL_GANTI_ID asc");
            
            return $query->result();
        }
        //ambil jadwal by dosen, kelas, matkul dan hari
	function getLastId()
	{
		$query = $this->db->select_max('JADWAL_ID')
			->get('tb_jadwal')
			->row();
		return $query->JADWAL_ID;
	}
        function getLastIdJadwalGanti()
        {
            $query = $this->db->select_max('JADWAL_GANTI_ID')
			->get('tb_jadwal_ganti')
			->row();
		return $query->JADWAL_GANTI_ID;
        }
        function getLastIdJadwalGantiHistory()
        {
            $query = $this->db->select_max('JADWAL_GANTI_HISTORY_ID')
			->get('tb_jadwal_ganti_history')
			->row();
		return $query->JADWAL_GANTI_HISTORY_ID;
        }
        
        function getJadwalHarianMahasiswa($hari,$mahasiswa,$jam)
        {
            $query = $this->db->select('jd.JAM_KULIAH_ID as JAM_KULIAH_ID, r.RUANGAN_ID, kls.KELAS_NAMA,MATA_KULIAH_NAMA, mhs.MAHASISWA_NAMA, JAM_KULIAH_MULAI as JAM_MULAI, jk.JAM as JAM_JK, mk.JAM as JAM_MK')
                    ->from('tb_mata_kuliah mk')
                    ->join('tb_jadwal jd','mk.MATA_KULIAH_ID = jd.MATA_KULIAH_ID')
                    ->join('tb_jam_kuliah jk','jd.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->join('tb_ruangan r','jd.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('jd.HARI',$hari)
                    ->where('mhs.EMAIL',$mahasiswa)
                    ->where('jd.JAM_KULIAH_ID',$jam)
                    ->order_by('jd.JAM_KULIAH_ID','asc')
                    ->get();
            
//            print ('asa');
//            exit;
            
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
            
        }
        function getJadwalGanti($where)
        {
            $query = $this->db->select('jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->where('jdg.STATUS','APV')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where($where)
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
            return $query->result();
        }
         function getAllReqJadwalGanti()
        {
            $query = $this->db->select('jdg.APPROVAL_BY, jdg.REJECT_BY,jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where('jdg.STATUS','REQ')
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
            return $query->result();
        }
         function getReqJadwalGanti($where)
        {
            $query = $this->db->select('jdn.EMAIL as N_EMAIL,jdn.JADWAL_NOTIF_ID,jdn.READ_STATUS,jdg.APPROVAL_BY, jdg.REJECT_BY,jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_jadwal_notif jdn','jdg.JADWAL_GANTI_ID = jdn.JADWAL_GANTI_ID','left')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where($where)
                    ->where('jdg.STATUS','REQ')
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
            return $query->result();
        }
        function getApvJadwalGanti($where)
        {
            $query = $this->db->select('jdn.EMAIL as N_EMAIL,jdn.JADWAL_NOTIF_ID,jdn.READ_STATUS, jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->join('tb_jadwal_notif jdn','jdg.JADWAL_GANTI_ID = jdn.JADWAL_GANTI_ID','left')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where($where)
                    //->where('jdn.EMAIL',$email)
                    ->where('jdg.STATUS','APV')
                    ->group_by('jdg.JADWAL_GANTI_ID','jdg')
                    ->get();
            
            
            //print($query->row()->KET); exit;
//            for($i = 0 ; $i <= count($query);$i++)
//            {
//                print($query[$i]); exit;  
//                
//            }
//            foreach ($query->result() as $row)
//            {
//                print($row->KET); exit;
//            }
            return $query->result();
            
        }
        function getRjcJadwalGanti($where)
        {
            $query = $this->db->select('jdn.EMAIL as N_EMAIL,jdn.JADWAL_NOTIF_ID,jdn.READ_STATUS,jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->join('tb_jadwal_notif jdn','jdg.JADWAL_GANTI_ID = jdn.JADWAL_GANTI_ID','left')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where($where)
                    ->where('jdg.STATUS','RJC')
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
            return $query->result();
        }
        function getJadwalGantiDetail($where,$jadwal_ganti_id)
        {
            $query = $this->db->select('dsn.DOSEN_INISIAL, mk.STATUS,jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.EMAIL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal_approval jda','jdg.JADWAL_GANTI_ID = jda.JADWAL_GANTI_ID')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->where('jda.APPROVAL_STATUS','Y')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where('jdg.JADWAL_GANTI_ID', $jadwal_ganti_id)
                    ->where($where)
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
            return $query->result();
        }
         function getJadwalGantiDetail1($where,$jadwal_ganti_id)
        {
            $query = $this->db->select('jdg.DTMUPD as TGL_ACT, jdg.REJECT_BY, jdg.APPROVAL_BY, jdg.STATUS as JDG_STAT, dsn.DOSEN_INISIAL, mk.STATUS,jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.EMAIL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->where('jdg.JADWAL_GANTI_ID', $jadwal_ganti_id)
                    ->where($where)
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
            return $query->result();
        }
        function getJadwalHarianDosen($hari,$dosen,$jam)
        {
            $query = $this->db->select('jd.JAM_KULIAH_ID as JAM_KULIAH_ID, r.RUANGAN_ID, kls.KELAS_NAMA,MATA_KULIAH_NAMA, dsn.DOSEN_NAMA, JAM_KULIAH_MULAI as JAM_MULAI, jk.JAM as JAM_JK, mk.JAM as JAM_MK')
                    ->from('tb_mata_kuliah mk')
                    ->join('tb_jadwal jd','mk.MATA_KULIAH_ID = jd.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jd.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jd.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('jd.HARI',$hari)
                    ->where('dsn.EMAIL',$dosen)
                    ->where('jd.JAM_KULIAH_ID',$jam)
                    ->order_by('jd.JAM_KULIAH_ID','asc')
                    ->get();
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
        }
        function getJadwalGantiById($where)
        {
            $query = $this->db->select('*')
                    ->where($where)
                    ->get('tb_jadwal_ganti jdg');
            
            return $query->result();
        }
                function getJadwalHarianKelas($hari,$kelas,$jam)
        {
            $query = $this->db->select('jd.JADWAL_ID,jd.JAM_KULIAH_ID as JAM_KULIAH_ID, r.RUANGAN_ID, kls.KELAS_NAMA,MATA_KULIAH_NAMA, dsn.DOSEN_NAMA, JAM_KULIAH_MULAI as JAM_MULAI, jk.JAM as JAM_JK, mk.JAM as JAM_MK')
                    ->from('tb_mata_kuliah mk')
                    ->join('tb_jadwal jd','mk.MATA_KULIAH_ID = jd.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jd.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jd.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('jd.HARI',$hari)
                    ->where('kls.KELAS_ID',$kelas)
                    ->where('jd.JAM_KULIAH_ID',$jam)
                    ->order_by('jd.JAM_KULIAH_ID','asc')
                    ->get();
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
            
        }
        function getJadwalHarianDosen2($hari,$dosen,$jam)
               {
                   $query = $this->db->query("SELECT jd.JAM_KULIAH_ID as JAM_KULIAH_ID, r.RUANGAN_ID, kls.KELAS_NAMA,MATA_KULIAH_NAMA, dsn.DOSEN_NAMA, JAM_KULIAH_MULAI as JAM_MULAI, CONCAT(jk.JAM+mk.JAM-1,':45:00') as JAM_SELESAI, mk.JAM as JAM_MK  
                            FROM tb_mata_kuliah mk
                            INNER join tb_jadwal jd on mk.MATA_KULIAH_ID = jd.MATA_KULIAH_ID
                            INNER JOIN tb_dosen dsn on jd.DOSEN_ID = dsn.DOSEN_ID
                            INNER JOIN tb_jam_kuliah jk on jd.JAM_KULIAH_ID = jk.JAM_KULIAH_ID
                            INNER JOIN tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
                            INNER JOIN tb_ruangan r on jd.RUANGAN_ID = r.RUANGAN_ID
                            WHERE jd.HARI = '$hari'
                            and  dsn.EMAIL = '$dosen'
                            and jk.JAM_KULIAH_ID = '$jam'
                            order by jd.JAM_KULIAH_ID asc");
                  // return $query->result();
                   
                    
                   if($query->num_rows() > 0)
                   {
                       return $query->result();
                   }
                   else
                   {
                       return false;
                   }
               }
        
        function saveJadwal($data)
	{
		$this->db->insert('tb_jadwal', $data);
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
        
        function submitJadwalGanti($data)
        {
            $this->db->insert('tb_jadwal_ganti',$data);
            if($this->db->affected_rows() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
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
        
        function updateJadwal($data,$where)
        {
            $this->db->where('JADWAL_ID', $where)
		->update('tb_jadwal', $data);
            
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
        }
        
        function delJadwal($where)
        {
            $this->db->where('JADWAL_ID',$where)
                    ->delete('tb_jadwal');
            	if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
        }
        
        function reqJadwalGantiByDosen($dataJadwalGanti,$dataJadwalGantiHistory)
        {
            
            $this->db->trans_start();
           
            $this->submitJadwalGanti($dataJadwalGanti);
            $this->submitJadwalGantiHistory($dataJadwalGantiHistory);
            
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
        public function __construct()
	{
		parent::__construct();
                date_default_timezone_set('Asia/Jakarta');
	}
        
       

}
