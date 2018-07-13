<?php

/**
* 
*/
class Admin_model extends CI_Model
{
	public function getProgramStudi($dosenId)
	{
		$query = $this->db->select('PROGRAM_STUDI_NAMA,GENERASI')
			->from('tb_program_studi ps')
			->join('tb_dosen dsn','ps.PROGRAM_STUDI_ID = dsn.PROGRAM_STUDI_ID','inner')
			->where('dsn.DOSEN_ID',$dosenId)
			->get();
		return $query->result();

	}
	public function getAllProgramStudi()
	{
		$query = $this->db->from('tb_program_studi ps')
			->join('tb_dosen dsn','ps.PROGRAM_STUDI_ID = dsn.PROGRAM_STUDI_ID','inner')
			->get();
		return $query->result();

	}
}
