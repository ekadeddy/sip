<?php

/**
* 
*/
class Ruangan_model extends CI_Model
{
	function getAllRuangan()
	{
            return $this->db->get('tb_ruangan')->result();
	}

        function getRuanganGantiJadwal($hari,$jam)
	{
		$qry2 = $this->db->query("select r.RUANGAN_ID,r.KETERANGAN from tb_ruangan r
		  	where r.RUANGAN_ID not in (
					select jd.RUANGAN_ID
					from tb_jadwal jd
					inner join tb_mata_kuliah mk on jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID
					where jd.HARI = '$hari'
					and $jam between jd.JAM_KULIAH_ID and jd.JAM_KULIAH_ID+mk.JAM-1)
			and r.RUANGAN_ID not in (
					select jdg.RUANGAN_ID 
                    from tb_jadwal_ganti jdg
                    inner join tb_jadwal jd on jdg.JADWAL_ID = jd.JADWAL_ID
                    inner join tb_jadwal_approval jda on jdg.JADWAL_GANTI_ID = jda.JADWAL_GANTI_ID
                    inner join tb_mata_kuliah mk on jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID
                    where jd.HARI = '$hari' 
                    and jda.APPROVAL_STATUS = 'Y'
                    and $jam between jdg.JAM_KULIAH_ID and jdg.JAM_KULIAH_ID+mk.JAM-1)");
		return $qry2->result();
        }

	function getAvailableRuangan($hari,$jam)
	{

		$qry2 = $this->db->query("select r.RUANGAN_ID,r.KETERANGAN from tb_ruangan r
		  	where r.RUANGAN_ID not in (
					select jd.ruangan_id
                         from tb_jadwal jd
					inner join tb_mata_kuliah mk on jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID
					where jd.HARI = '$hari'
					and $jam between jd.JAM_KULIAH_ID and jd.JAM_KULIAH_ID+mk.JAM-1)");
		return $qry2->result();
                
                //		$sub_qry= $this->db->select('jd.RUANGAN_ID')
//			->from('tb_jadwal jd')
//			->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
//			->where('jd.HARI',$hari)
//			->where("$jam BETWEEN jd.JAM_KULIAH_ID and jd.JAM_KULIAH_ID+mk.JAM-1")
//			->get();
//
//		$query = $this->db->select('RUANGAN_ID,KETERANGAN')
//			->from('tb_ruangan')
//			->where_not_in('RUANGAN_ID',$sub_qry->result())
//			->get();
//
//		$this->db->select('RUANGAN_ID,KETERANGAN')->from('RUANGAN_ID');
//		$sub = $this->subquery->start_subquery('where_in');
//		$sub->select('RUANGAN_ID')
//			->from('tb_jadwal jd')
//			->join('tb_mata_kuliah mk','jd.MATA_KULIAH_ID = mk.MATA_KULIAH_ID')
//			->where('jd.HARI',$hari)
//			->where("$jam BETWEEN jd.JAM_KULIAH_ID AND jd.JAM_KULIAH_ID+mk.JAM-1");
//		return $this->subquery->end_subquery('RUANGAN_ID', FALSE);
//

//




//
//		return $query->result();

	}
}
