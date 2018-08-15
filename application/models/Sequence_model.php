<?php

/**
* 
*/
class Sequence_model extends CI_Model
{
	public function getSeqNo($modul)
	{
           
            $query = $this->db->select('SEQ_NO')
                        ->where('SEQ_MODUL',$modul)
			->get('tb_sequence')
			->row();
                
		return $query->SEQ_NO;

	}
	public function udateSeqNo($where,$data)
	{
                 $this->db->where('SEQ_MODUL', $where)
		->update('tb_sequence', $data);
            
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
