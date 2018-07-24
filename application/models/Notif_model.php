<?php

/**
* 
*/
class Notif_model extends CI_Model
{
    function getLastIdNotif()
    {
     $query = $this->db->select_max('JADWAL_NOTIF_ID')
			->get('tb_jadwal_notif')
			->row();
		return $query->JADWAL_NOTIF_ID;   
    }
    public function getJumlahNotifUnread($where,$where_notif)
    {
            $subQry = "(select jdn.JADWAL_GANTI_ID from tb_jadwal_notif jdn 
                                        inner join tb_jadwal_ganti jdgs on jdn.JADWAL_GANTI_ID = jdgs.JADWAL_GANTI_ID
                                        $where_notif GROUP BY jdgs.JADWAL_GANTI_ID)";
        $tgl_sekarang = date('Y-m-d');
            $query = $this->db->query("select  count(jdg.JADWAL_GANTI_ID) as TOTAL from tb_jadwal_ganti jdg 
                                    inner join tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
                                    inner join tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
                                    inner join tb_mahasiswa mhs on kls.KELAS_ID = mhs.KELAS_ID
                                    inner join tb_dosen dsn on jd.DOSEN_ID = dsn.DOSEN_ID
                                    $where
                                    AND jdg.STATUS in ('APV','RJC')
                                    AND jdg.TANGGAL >= '$tgl_sekarang'                                    
                                    AND jdg.JADWAL_GANTI_ID not in 
                                    $subQry");
            
            
            return $query->row()->TOTAL;
            
//             $query = $this->db->query("select  count(jdg.JADWAL_GANTI_ID) as TOTAL from tb_jadwal_ganti jdg 
//                                    inner join tb_jadwal_approval jda on jdg.JADWAL_GANTI_ID = jda.JADWAL_GANTI_ID
//                                    inner join tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
//                                    inner join tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
//                                    inner join tb_mahasiswa mhs on kls.KELAS_ID = mhs.KELAS_ID
//                                    where jda.APPROVAL_STATUS = 'Y'
//                                    AND jdg.TANGGAL >= '$tgl_sekarang'
//                                    AND mhs.EMAIL ='$email'
//                                    AND jdg.JADWAL_GANTI_ID not in 
//                                    (select jdn.JADWAL_GANTI_ID from tb_jadwal_notif jdn 
//                                    inner join tb_jadwal_ganti jdgs on jdn.JADWAL_GANTI_ID = jdgs.JADWAL_GANTI_ID
//                                    where jdn.EMAIL = '$email' and jdn.NOTIF_TIPE ='MHS' )");

    }
    public function getNotifUnread($where,$where_notif)
    {
        //declare variabel
        
        //$where = "AND mhs.EMAIL ='$email'";
        //where jdn.EMAIL = '$email' and jdn.NOTIF_TIPE ='MHS'
        $subQry = "(select jdn.JADWAL_GANTI_ID from tb_jadwal_notif jdn 
                                    inner join tb_jadwal_ganti jdgs on jdn.JADWAL_GANTI_ID = jdgs.JADWAL_GANTI_ID
                                    $where_notif)";
        $tgl_sekarang = date('Y-m-d');
                    $query = $this->db->query("select jdg.STATUS, mk.MATA_KULIAH_NAMA, jdg.JADWAL_GANTI_ID, jdg.JADWAL_ID from tb_jadwal_ganti jdg 
                                    INNER JOIN tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
                                    INNER JOIN tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
                                    INNER JOIN tb_mahasiswa mhs on kls.KELAS_ID = mhs.KELAS_ID   
                                    INNER JOIN tb_mata_kuliah mk on jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID
                                    INNER JOIN tb_dosen dsn on jd.DOSEN_ID = dsn.DOSEN_ID
                                    INNER JOIN tb_jam_kuliah jk on jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID
                                    INNER JOIN tb_ruangan r on jdg.RUANGAN_ID = r.RUANGAN_ID
                                    $where                                    
                                    AND jdg.STATUS in ('APV','RJC')
                                    AND jdg.TANGGAL >= '$tgl_sekarang'
                                    AND jdg.JADWAL_GANTI_ID not in 
                                    $subQry
                                    GROUP BY jdg.JADWAL_GANTI_ID");
//            $query = $this->db->query("select  mk.MATA_KULIAH_NAMA, jdg.JADWAL_GANTI_ID, jdg.JADWAL_ID from tb_jadwal_ganti jdg 
//                                    INNER JOIN tb_jadwal_approval jda on jdg.JADWAL_GANTI_ID = jda.JADWAL_GANTI_ID
//                                    INNER JOIN tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
//                                    INNER JOIN tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
//                                    INNER JOIN tb_mahasiswa mhs on kls.KELAS_ID = mhs.KELAS_ID
//                                    INNER JOIN tb_mata_kuliah mk on jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID
//                                    INNER JOIN tb_dosen dsn on jd.DOSEN_ID = dsn.DOSEN_ID
//                                    INNER JOIN tb_jam_kuliah jk on jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID
//                                    INNER JOIN tb_ruangan r on jdg.RUANGAN_ID = r.RUANGAN_ID
//                                    where jda.APPROVAL_STATUS = 'Y'
//                                    AND jdg.TANGGAL >= '$tgl_sekarang'
//                                    AND mhs.EMAIL ='$email'    
//                                    AND jdg.JADWAL_GANTI_ID not in 
//                                    (select jdn.JADWAL_GANTI_ID from tb_jadwal_notif jdn 
//                                    inner join tb_jadwal_ganti jdgs on jdn.JADWAL_GANTI_ID = jdgs.JADWAL_GANTI_ID
//                                    where jdn.EMAIL = '$email' and jdn.NOTIF_TIPE ='MHS')");
            return $query->result();

    }
    function readNotif($data,$where)
    {   
        $query = $this->db->where($where)
                ->get('tb_jadwal_notif');
        if($query->num_rows() == 0)
        {
            $this->db->insert('tb_jadwal_notif', $data);
            if ($this->db->affected_rows() > 0)
            {
                    return true;
            }
            else
            {
                    return false;
            }
        }
        
    }
    
    //DOSEN
    function getNotifDsnApvRjc($email)
    {
        $where = array('APV', 'RJC');
        $this->db->select('JADWAL_GANTI_ID');
        $this->db->from('tb_jadwal_notif')->where('EMAIL',$email);
        $where_clause = $this->db->get_compiled_select();
        
        $query = $this->db->select('jdg.JADWAL_GANTI_ID,jdg.STATUS,mk.MATA_KULIAH_NAMA')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where_in('jdg.STATUS', $where)//status
                    ->where("`JADWAL_GANTI_ID` NOT IN ($where_clause)", NULL, FALSE)
                    ->get();

//        foreach ($query->result() as $row)
//        {
//            return $row->TOTAL;
//        }
            //return $query->row()->TOTAL;
            return $query->result();
    } //jdg.JADWAL_GANTI_ID,jdg.STATUS,mk.MATA_KULIAH_NAMA
    function getTotNtfDsnApvRjc($email)
    {
        $where = array('APV', 'RJC');
        $this->db->select('JADWAL_GANTI_ID');
        $this->db->from('tb_jadwal_notif')->where('EMAIL',$email);
        $where_clause = $this->db->get_compiled_select();
        
        $query = $this->db->select('count(*) as TOTAL')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where_in('jdg.STATUS', $where)//status
                    ->where("`JADWAL_GANTI_ID` NOT IN ($where_clause)", NULL, FALSE)
                    ->get();

//        foreach ($query->result() as $row)
//        {
//            return $row->TOTAL;
//        }
            return $query->row()->TOTAL;
            
    }
    //end dosen
    function readStatus($jadwal_ganti_id,$email)
    {
        $query = $this->db->select('jdn.READ_STATUS')
                ->from('tb_jadwal_notif jdn')
                ->join('tb_jadwal_ganti jdg','jdn.JADWAL_GANTI_ID = jdg.JADWAL_GANTI_ID')
                ->where('jdn.JADWAL_GANTI_ID',$jadwal_ganti_id)
                ->where('jdn.EMAIL',$email)
                ->get();
        if($query->num_rows() > 0)
        {
            return  true;
        }
        else
        {
            //print($query->row().' apa'); exit;
            return false;
        }
        
    }
    function getNotifReq($email)
    {
        $this->db->select('JADWAL_GANTI_ID');
        $this->db->from('tb_jadwal_notif')->where('EMAIL',$email);
        //$this->db->select('JADWAL_GANTI_ID')->from('tb_jadwal_notif jdn')->where('jdn.EMAIL',$email);
        $where_clause = $this->db->get_compiled_select();
        
        $query = $this->db->select('*')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where('jdg.STATUS','REQ')
                    ->where("`JADWAL_GANTI_ID` NOT IN ($where_clause)", NULL, FALSE)
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
        
//        $query = $this->db->select('jdg.APPROVAL_BY, jdg.REJECT_BY,jdg.KET, jk.JAM as JAM_JK, mk.JAM as JAM_MK, jk.JAM_KULIAH_MULAI as JAM_MULAI, jd.JADWAL_ID, jdg.JADWAL_GANTI_ID, jdg.TANGGAL, dsn.DOSEN_NAMA, kls.KELAS_NAMA, r.RUANGAN_ID, jdg.HARI, jdg.JAM_KULIAH_ID, mk.JAM, mk.STATUS, mk.MATA_KULIAH_NAMA')
//                    ->from('tb_jadwal_ganti jdg')
//                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
//                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
//                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
//                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
//                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
//                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
//                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
//                    ->where('jdg.STATUS','REQ')
//                    ->group_by('jdg.JADWAL_GANTI_ID')
//                    ->get();
            return $query->result();
    }
    
    //ADMIN notif
    function geTotNotifReq($where,$email)
    {
        $this->db->select('JADWAL_GANTI_ID');
        $this->db->from('tb_jadwal_notif')->where('EMAIL',$email);
        
//          foreach ($this->db->get()->result() as $row)
//            {
//                print($row->JADWAL_GANTI_ID); 
//            }
            
        $where_clause = $this->db->get_compiled_select();
        
        $query = $this->db->select('count(*) as TOTAL')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where('jdg.STATUS', 'REQ')
                    ->where($where)//status
                    ->where("`JADWAL_GANTI_ID` NOT IN ($where_clause)", NULL, FALSE)
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
        
//           foreach ($query->result() as $row)
//            {
//                print($row->JADWAL_GANTI_ID); 
//            }
//        //exit;
         if($query->num_rows() > 0)
        {
            return $query->row()->TOTAL;
        }
        else
        {
            return false;
        }
        
            
    }//(SELECT jdn.JADWAL_GANTI_ID FROM tb_jadwal_notif jdn inner join tb_jadwal_ganti jdgs on jdn.JADWAl_GANTI_ID = jdgs.JADWAL_GANTI_ID)
    function getNotifMhsUnread($email)
    {
         $this->db->select('JADWAL_GANTI_ID');
        $this->db->from('tb_jadwal_notif')->where('EMAIL',$email);
        $where_clause = $this->db->get_compiled_select();
        
        $query = $this->db->select('*')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('mhs.EMAIL',$email)
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where('jdg.STATUS', 'APV')
                    ->where("`JADWAL_GANTI_ID` NOT IN ($where_clause)", NULL, FALSE)
                    ->group_by('jdg.JADWAL_GANTI_ID')
                    ->get();
      
            return $query->result();
    }
    function getTotNotifMhsUnread($email)
    {
         $this->db->select('JADWAL_GANTI_ID');
        $this->db->from('tb_jadwal_notif')->where('EMAIL',$email);
        $where_clause = $this->db->get_compiled_select();
        
        $query = $this->db->select('count(*) as TOTAL')
                    ->from('tb_jadwal_ganti jdg')
                    ->join('tb_jadwal jd','jdg.JADWAL_ID = jd.JADWAL_ID')
                    ->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
                    ->join('tb_dosen dsn','jd.DOSEN_ID = dsn.DOSEN_ID')
                    ->join('tb_jam_kuliah jk','jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID')
                    ->join('tb_kelas kls','jd.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_mahasiswa mhs','kls.KELAS_ID = mhs.KELAS_ID')
                    ->join('tb_ruangan r','jdg.RUANGAN_ID = r.RUANGAN_ID')
                    ->where('mhs.EMAIL',$email)
                    ->where('jdg.TANGGAL >=', date('Y-m-d'))
                    ->where('jdg.STATUS', 'APV')
                    ->where("`JADWAL_GANTI_ID` NOT IN ($where_clause)", NULL, FALSE)
                    ->get();
      
            return $query->row()->TOTAL;
    }
    public function __construct()
    {
            parent::__construct();
            date_default_timezone_set('Asia/Jakarta');
    }

        
	
}
