<?php

/**
* 
*/
class Profil_model extends CI_Model
{
	public function updatePassword($user_id,Array $data_post)
	{

//		print_r($user_id);
//		exit;
		$password = array('USER_PASSWORD' => md5($data_post['password']));
		$this->db->where('USER_ID', $user_id)
						->update('tb_users', $password);
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

        public function getProfilLengkapMahasiswa($mahasiswa)
        {
            $query = $this->db->select('*')
                    ->from('tb_mahasiswa mhs')
                    ->join('tb_kelas kls','on mhs.KELAS_ID = kls.KELAS_ID')
                    ->join('tb_program_studi ps','on kls.PROGRAM_STUDI_ID = ps.PROGRAM_STUDI_ID')
                    ->where('mhs.EMAIL',$mahasiswa)
                    ->get();
            
            return $query->result();
        }
}
