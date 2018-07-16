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
    public function getJumlahNotifUnread($email)
    {
        $tgl_sekarang = date('Y-m-d');
            $query = $this->db->query("select  count(jdg.JADWAL_GANTI_ID) as TOTAL from tb_jadwal_ganti jdg 
                                    inner join tb_jadwal_approval jda on jdg.JADWAL_GANTI_ID = jda.JADWAL_GANTI_ID
                                    inner join tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
                                    inner join tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
                                    inner join tb_mahasiswa mhs on kls.KELAS_ID = mhs.KELAS_ID
                                    where jda.APPROVAL_STATUS = 'Y'
                                    AND jdg.TANGGAL >= '$tgl_sekarang'
                                    AND mhs.EMAIL ='$email'
                                    AND jdg.JADWAL_GANTI_ID not in 
                                    (select jdn.JADWAL_GANTI_ID from tb_jadwal_notif jdn 
                                    inner join tb_jadwal_ganti jdgs on jdn.JADWAL_GANTI_ID = jdgs.JADWAL_GANTI_ID
                                    where jdn.EMAIL = '$email')");
            return $query->row()->TOTAL;

    }
    public function getNotifUnread($email)
    {
        $tgl_sekarang = date('Y-m-d');
            $query = $this->db->query("select  mk.MATA_KULIAH_NAMA, jdg.JADWAL_GANTI_ID, jdg.JADWAL_ID from tb_jadwal_ganti jdg 
                                    INNER JOIN tb_jadwal_approval jda on jdg.JADWAL_GANTI_ID = jda.JADWAL_GANTI_ID
                                    INNER JOIN tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
                                    INNER JOIN tb_kelas kls on jd.KELAS_ID = kls.KELAS_ID
                                    INNER JOIN tb_mahasiswa mhs on kls.KELAS_ID = mhs.KELAS_ID
                                    INNER JOIN tb_mata_kuliah mk on jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID
                                    INNER JOIN tb_dosen dsn on jd.DOSEN_ID = dsn.DOSEN_ID
                                    INNER JOIN tb_jam_kuliah jk on jdg.JAM_KULIAH_ID = jk.JAM_KULIAH_ID
                                    INNER JOIN tb_ruangan r on jdg.RUANGAN_ID = r.RUANGAN_ID
                                    where jda.APPROVAL_STATUS = 'Y'
                                    AND jdg.TANGGAL >= '$tgl_sekarang'
                                    AND mhs.EMAIL ='$email'
                                    AND jdg.JADWAL_GANTI_ID not in 
                                    (select jdn.JADWAL_GANTI_ID from tb_jadwal_notif jdn 
                                    inner join tb_jadwal_ganti jdgs on jdn.JADWAL_GANTI_ID = jdgs.JADWAL_GANTI_ID
                                    where jdn.EMAIL = '$email')");
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
    public function __construct()
    {
            parent::__construct();
            date_default_timezone_set('Asia/Jakarta');
    }

        
	
}
