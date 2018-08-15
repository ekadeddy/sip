<?php

/**
* 
*/
error_reporting(0);

class Login_model extends CI_Model
{
	
        public function getAkses($userProfile,$tokens)
        {
            if($userProfile)
            {
                $email = filter_var($userProfile['email'], FILTER_SANITIZE_EMAIL);
                $images = filter_var($userProfile['picture']);
                $name = filter_var($userProfile['name']);
                $hd = filter_var($userProfile['hd']);
                
                //print($hd);exit;
                if($hd == 'mahasiswa.pcr.ac.id')
                {
                    $query_mhs = $this->db->where('EMAIL',$email)->get('tb_mahasiswa');
                    if($query_mhs->num_rows() > 0)
                    {
                        $row['user_id'] = $query_mhs->row()->MAHASISWA_ID;
                        //$row['user_nama'] = $query_mhs->row()->MAHASISWA_NAMA;
                        $row['user_nama'] = $name;
                        $row['user_alamat'] = $query_mhs->row()->ALAMAT;
                        $row['user_status'] = $query_mhs->row()->STATUS;
                        $row['user_email'] = filter_var($userProfile['email'], FILTER_SANITIZE_EMAIL);
                        $row['user_akses'] = 'mhs';
                        $row['tokens'] = $tokens; //token aktif
                        //$row['user_images'] = $query_mhs->row()->MAHASISWA_IMAGE_PATH;
                        $row['user_images'] = $images;
                        return $row;
                    }
//                    else
//                    {
//    //                  Dosen                        
//                        $query_dsn = $this->db->where('EMAIL',$email)->get('tb_dosen');   
//                        if($query_dsn->num_rows() > 0)
//                        {
//                            $row['user_id'] = $query_dsn->row()->DOSEN_ID;
//                            $row['user_nama'] = $query_dsn->row()->DOSEN_NAMA;
//                            $row['user_alamat'] = $query_dsn->row()->ALAMAT;
//                            $row['user_status'] = $query_dsn->row()->STATUS;
//                            $row['user_email'] = $query_dsn->row()->EMAIL;
//                            $row['user_akses'] = 'dsn';
//                            $row['tokens'] = $tokens; //token aktif
//                            $row['user_images'] = $images;
//                            //$row['user_images'] = $query_dsn->row()->DOSEN_IMAGE_PATH;
//                            return $row;
//                        }
//                        else
//                        {
//    //                      Admin                 
//                            $query_adm = $this->db->where('EMAIL',$email)->get('tb_admin');
//                            if($query_adm->num_rows() > 0)
//                            {
//                                $row['user_id'] = $query_adm->row()->ADMIN_ID;
//                                $row['user_nama'] = $query_adm->row()->ADMIN_NAMA;
//                                $row['user_alamat'] = $query_adm->row()->ALAMAT;
//                                $row['user_status'] = $query_adm->row()->STATUS;
//                                $row['user_email'] = $email;
//                                $row['user_akses'] = 'adm';
//                                $row['tokens'] = $tokens; //token aktif
//                                $row['user_images'] = $images;
//                                //$row['user_images'] = $query_adm->row()->ADMIN_IMAGE_PATH;
//                                return $row;
//                            }
//                            else
//                            {   
//                                //tidak ada user terdaftar
//                                return false;
//                            }
//                        }
//                    } 
                }
                elseif($hd == 'pcr.ac.id')
                {
                    //                  Dosen                        
                        $query_dsn = $this->db->where('EMAIL',$email)->get('tb_dosen');   
                        if($query_dsn->num_rows() > 0)
                        {
                            $row['user_id'] = $query_dsn->row()->DOSEN_ID;
                            $row['user_nama'] = $name;
                            $row['user_alamat'] = $query_dsn->row()->ALAMAT;
                            $row['user_status'] = $query_dsn->row()->STATUS;
                            $row['user_email'] = $query_dsn->row()->EMAIL;
                            $row['user_akses'] = 'dsn';
                            $row['tokens'] = $tokens; //token aktif
                            $row['user_images'] = $images;
                            //$row['user_images'] = $query_dsn->row()->DOSEN_IMAGE_PATH;
                            return $row;
                        }
                        else
                        {
    //                      Admin                 
                            $query_adm = $this->db->where('EMAIL',$email)->get('tb_admin');
                            if($query_adm->num_rows() > 0)
                            {
                                $row['user_id'] = $query_adm->row()->ADMIN_ID;
                                $row['user_nama'] = $name;
                                $row['user_alamat'] = $query_adm->row()->ALAMAT;
                                $row['user_status'] = $query_adm->row()->STATUS;
                                $row['user_email'] = $email;
                                $row['user_akses'] = 'adm';
                                $row['tokens'] = $tokens; //token aktif
                                $row['user_images'] = $images;
                                //$row['user_images'] = $query_adm->row()->ADMIN_IMAGE_PATH;
                                return $row;
                            }
                            else
                            {   
                                //tidak ada user terdaftar
                                return false;
                            }
                        }
                }
                else
                {
                    //                      Admin                 
                    $query_adm = $this->db->where('EMAIL',$email)->get('tb_admin');
                    $query_dsn = $this->db->where('EMAIL',$email)->get('tb_dosen');
                    $query_mhs = $this->db->where('EMAIL',$email)->get('tb_mahasiswa');
                    //Mahasiswa
                    if($query_mhs->num_rows() > 0){
                        $row['user_id'] = $query_mhs->row()->MAHASISWA_ID;
                        //$row['user_nama'] = $query_mhs->row()->MAHASISWA_NAMA;
                        $row['user_nama'] = $name;
                        $row['user_alamat'] = $query_mhs->row()->ALAMAT;
                        $row['user_status'] = $query_mhs->row()->STATUS;
                        $row['user_email'] = filter_var($userProfile['email'], FILTER_SANITIZE_EMAIL);
                        $row['user_akses'] = 'mhs';
                        $row['tokens'] = $tokens; //token aktif
                        //$row['user_images'] = $query_mhs->row()->MAHASISWA_IMAGE_PATH;
                        $row['user_images'] = $images;
                        return $row;
                        //$this->cek_user($email,'mhs',$userProfile,$tokens);
                    }
                    elseif($query_dsn->num_rows() > 0)
                    {
                        $row['user_id'] = $query_dsn->row()->DOSEN_ID;
                        //$row['user_nama'] = $query_dsn->row()->DOSEN_NAMA;
                        $row['user_nama'] = $name;
                        $row['user_alamat'] = $query_dsn->row()->ALAMAT;
                        $row['user_status'] = $query_dsn->row()->STATUS;
                        $row['user_email'] = $query_dsn->row()->EMAIL;
                        $row['user_akses'] = 'dsn';
                        $row['tokens'] = $tokens; //token aktif
                        $row['user_images'] = $images;
                        //$row['user_images'] = $query_dsn->row()->DOSEN_IMAGE_PATH;
                        return $row;
                        //$this->cek_user($query_dsn,'dsn',$userProfile,$tokens);
                    }
                    else
                    {
                        $row['user_id'] = $query_adm->row()->ADMIN_ID;
                        //$row['user_nama'] = $query_adm->row()->ADMIN_NAMA;
                        $row['user_nama'] = $name;
                        $row['user_alamat'] = $query_adm->row()->ALAMAT;
                        $row['user_status'] = $query_adm->row()->STATUS;
                        $row['user_email'] = $email;
                        $row['user_akses'] = 'adm';
                        $row['tokens'] = $tokens; //token aktif
                        $row['user_images'] = $images;
                        //$row['user_images'] = $query_adm->row()->ADMIN_IMAGE_PATH;
                        return $row;
//                        /$this->cek_user($query_adm,'adm',$userProfile,$tokens);
                    }

                }
                if($query_adm->num_rows() > 0)
                {
                    $row['user_id'] = $query_adm->row()->ADMIN_ID;
                    //$row['user_nama'] = $query_adm->row()->ADMIN_NAMA;
                    $row['user_nama'] = $name;
                    $row['user_alamat'] = $query_adm->row()->ALAMAT;
                    $row['user_status'] = $query_adm->row()->STATUS;
                    $row['user_email'] = $email;
                    $row['user_akses'] = 'adm';
                    $row['tokens'] = $tokens; //token aktif
                    $row['user_images'] = $images;
                    //$row['user_images'] = $query_adm->row()->ADMIN_IMAGE_PATH;
                    return $row;
                }
                else
                {   
                    //tidak ada user terdaftar
                    return false;
                }
                }
               
            }
                
        
    
        function cek_user($email,$modul,$userProfile,$tokens)
        {
            //print($email);exit;
            $query_adm = $this->db->where('EMAIL',$email)->get('tb_admin');
            $query_dsn = $this->db->where('EMAIL',$email)->get('tb_dosen');
            $query_mhs = $this->db->where('EMAIL',$email)->get('tb_mahasiswa');
            
            //$email = filter_var($userProfile['email'], FILTER_SANITIZE_EMAIL);
            $images = filter_var($userProfile['picture']);
            $name = filter_var($userProfile['name']);
            //$hd = filter_var($userProfile['hd']);
            if($modul=='mhs')
            {
                $row['user_id'] = $query_mhs->row()->MAHASISWA_ID;
                //$row['user_nama'] = $query_mhs->row()->MAHASISWA_NAMA;
                $row['user_nama'] = $name;
                $row['user_alamat'] = $query_mhs->row()->ALAMAT;
                $row['user_status'] = $query_mhs->row()->STATUS;
                $row['user_email'] = $email;
                $row['user_akses'] = 'mhs';
                $row['tokens'] = $tokens; //token aktif
                //$row['user_images'] = $query_mhs->row()->MAHASISWA_IMAGE_PATH;
                $row['user_images'] = $images;
               // print_r($row);exit;
                return $row;
            }
            elseif ($modul=='dsn') 
            {
                $row['user_id'] = $query_user->row()->DOSEN_ID;
                $row['user_nama'] = $query_user->row()->DOSEN_NAMA;
                $row['user_alamat'] = $query_user->row()->ALAMAT;
                $row['user_status'] = $query_user->row()->STATUS;
                $row['user_email'] = $query_user->row()->EMAIL;
                $row['user_akses'] = 'dsn';
                $row['tokens'] = $tokens; //token aktif
                $row['user_images'] = $images;
                //$row['user_images'] = $query_dsn->row()->DOSEN_IMAGE_PATH;
                return $row;
            }
            
        }
        


        public function login_valid($username, $password)
	{
		$query = $this->db->where('USER_ID',$username)
			->where('USER_PASSWORD',md5($password))
			->get('tb_users');
                
                
		if ($query->num_rows() !=0){
				// if ($query->row()->USER_AKSES == 'mhs'){
				// 	$query_mhs = $this->db->where('EMAIL',$query->row()->USER_ID)
				// 		->get('tb_mahasiswa');
				// 	$row['user_id'] = $query_mhs->row()->MAHASISWA_ID;
				// 	$row['user_nama'] = $query_mhs->row()->MAHASISWA_NAMA;
				// 	$row['user_alamat'] = $query_mhs->row()->ALAMAT;
				// 	$row['user_status'] = $query_mhs->row()->STATUS;
				// 	$row['user_email'] = $query_mhs->row()->EMAIL;
				// 	$row['user_akses'] = $query->row()->USER_AKSES;
				// 	$row['user_images'] = $query_mhs->row()->MAHASISWA_IMAGE_PATH;
				// 	//next here
				// 	return $row;

				// }else
				if ($query->row()->USER_AKSES == 'adm'){
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
//                                        foreach ($query_dsn->result() as $row)
//                                        {
//                                            print($row->DOSEN_ID); exit;
//                                        }
                                        if($query_dsn->num_rows() > 0)
                                        {
                    $row['user_id'] = $query_dsn->row()->DOSEN_ID;
                    $row['user_nama'] = $query_dsn->row()->DOSEN_NAMA;
                    $row['user_alamat'] = $query_dsn->row()->ALAMAT;
                    $row['user_status'] = $query_dsn->row()->STATUS;
                    $row['user_email'] = $query_dsn->row()->EMAIL;
                    $row['user_akses'] = $query->row()->USER_AKSES;
                    $row['user_images'] = $query_dsn->row()->DOSEN_IMAGE_PATH;
                    return $row;
                    }
                    else
                    {
                        return false;
                    }
					
				}
		}else{
                        $nim    	= $username;
                        //$email          = $username;
		        //$password  	= $password;//$this->input->post('password');

		        $parameter 	= "ws_user=iEgmDitiTqnD&username=$nim&password=$password";
                        //$parameter 	= "ws_user=iEgmDitiTqnD&username=$nim";

		        //$url = curl_init('http://api.pcr.ac.id/akademik/login_mahasiswa');
                        //$url = curl_init('http://api.pcr.ac.id/akademik/get_mahasiswa_by_nim');
                        $url = curl_init();
                        curl_setopt ($url, CURLOPT_URL, "http://api.pcr.ac.id/akademik/login_mahasiswa");
		         
                        curl_setopt($url, CURLOPT_POST, 5);
		        //curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
		        curl_setopt($url, CURLOPT_POSTFIELDS, $parameter);
		        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		        curl_setopt($url, CURLOPT_HTTPHEADER, array(
		            'Content-Type: application/x-www-form-urlencoded',
		            'Content-Length: ' . strlen($parameter))
		        );
		        curl_setopt($url, CURLOPT_TIMEOUT, 5);
		        curl_setopt($url, CURLOPT_CONNECTTIMEOUT, 5);
		        //execute post
		        $result = curl_exec($url);
		        //close connection
		        curl_close($url);
		        $data = json_decode($result);
                        
                        print($parameter);//exit;
                        
                        //print($data);
		        //pengecekan status login
		        if(count($data) > 0){
		        	$row['user_id'] = $data->data[0]->nim;
					$row['user_nama'] = $data->data[0]->nama;
					$row['user_alamat'] = "Y";
					$row['user_status'] = "Y";
					$row['user_email'] = $this->input->post('password');
					$row['user_akses'] = "mhs";
					$row['user_images'] = $data->data[0]->gambar_link;
                                        
                                        print($data->data[0]->status);exit;
					return $row;
		        }else{
		            return false;
		        }
			//return FALSE;
		}

	}
}

