<?php

/**
* 
*/
class Login_model extends CI_Model
{
	
	public function login_valid($username, $password)
	{
		$query = $this->db->where('USER_ID',$username)
			->where('USER_PASSWORD',md5($password))
			->get('tb_users');
		if ($query->num_rows() !=0){
				if ($query->row()->USER_AKSES == 'mhs'){
					$query_mhs = $this->db->where('EMAIL',$query->row()->USER_ID)
						->get('tb_mahasiswa');
					$row['user_id'] = $query_mhs->row()->MAHASISWA_ID;
					$row['user_nama'] = $query_mhs->row()->MAHASISWA_NAMA;
					$row['user_alamat'] = $query_mhs->row()->ALAMAT;
					$row['user_status'] = $query_mhs->row()->STATUS;
					$row['user_email'] = $query_mhs->row()->EMAIL;
					$row['user_akses'] = $query->row()->USER_AKSES;
					$row['user_images'] = $query_mhs->row()->MAHASISWA_IMAGE_PATH;
					//next here
					return $row;

				}elseif ($query->row()->USER_AKSES == 'adm'){
					$query_adm = $this->db->where('EMAIL',$query->row()->USER_ID)
						->get('tb_admin');
					$row['user_id'] = $query_adm->row()->ADMIN_ID;
					$row['user_nama'] = $query_adm->row()->ADMIN_NAMA;
					$row['user_alamat'] = $query_adm->row()->ALAMAT;
					$row['user_status'] = $query_adm->row()->STATUS;
					$row['user_email'] = $query_adm->row()->EMAIL;
					$row['user_akses'] = $query->row()->USER_AKSES;
					$row['user_images'] = $query_adm->row()->ADMIN_IMAGE_PATH;
					return $row;
				}else{
					$query_dsn = $this->db->where('EMAIL',$query->row()->USER_ID)
						->get('tb_dosen');
					$row['user_id'] = $query_dsn->row()->DOSEN_ID;
					$row['user_nama'] = $query_dsn->row()->DOSEN_NAMA;
					$row['user_alamat'] = $query_dsn->row()->ALAMAT;
					$row['user_status'] = $query_dsn->row()->STATUS;
					$row['user_email'] = $query_dsn->row()->EMAIL;
					$row['user_akses'] = $query->row()->USER_AKSES;
					$row['user_images'] = $query_dsn->row()->DOSEN_IMAGE_PATH;
					return $row;
				}
		}else{
			return FALSE;
		}

	}
}
