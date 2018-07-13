<?php

/**
* 
*/
class Jam_Kuliah_model extends CI_Model
{
	public function getAllJamKuliah()
	{
		return $this->db->get('tb_jam_kuliah')->result_array();
	}
	public function getJamKuliahById($id)
	{
		$query = $this->db->from('tb_jam_kuliah')
			->where('JAM_KULIAH_ID',$id)
			->get();

		return $query->result();
	}
}
