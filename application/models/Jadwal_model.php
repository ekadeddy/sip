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
        
        function savePerubahanJadwal($data)
        {
            $this->db->trans_start();
            
            $this->db->insert('tb_jadwal_ganti',$data);
            
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                return false;
            }
            else
            {
                return true;
            }
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
        
        function editJadwal()
        {
            
        }
        
        function getJadwalHarianKelas($hari,$kelas,$jam)
        {
            $query = $this->db->select('jd.JAM_KULIAH_ID as JAM_KULIAH_ID, r.RUANGAN_ID, kls.KELAS_NAMA,MATA_KULIAH_NAMA, dsn.DOSEN_NAMA, JAM_KULIAH_MULAI as JAM_MULAI, jk.JAM as JAM_JK, mk.JAM as JAM_MK')
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

}
