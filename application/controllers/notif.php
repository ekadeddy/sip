<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notif extends CI_Controller {
	public $ses_data;
        
        public function listPerubahanJadwal()
	{
            $akses = $this->ses_data['user_akses'];
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $data['user_akses']= $akses;
            $email = $this->ses_data['user_email'];

            if($akses == 'Mahasiswa')
            {
                $where =  array('mhs.EMAIL' => $email);
            }
            elseif($akses == 'Dosen')
            {
                $where =  array('dsn.EMAIL' => $this->ses_data['user_email']);
            }
            else
            {
                 $where =  array('jdg.REQUEST_TO' => $email);
            }
                    
                
                
                $data['jadwal_ganti'] = $this->jadwal_mdl->getReqJadwalGanti($where);
                $data['jadwal_ganti_rjc'] = $this->jadwal_mdl->getRjcJadwalGanti($where);
                $data['jadwal_ganti_apv'] = $this->jadwal_mdl->getApvJadwalGanti($where);
                
                $data['navbar']= HGetNavbarUser($this->ses_data['user_akses']);
		$this->load->view('pages/jadwal/jadwal_perubahan_view',$data);
	}
        
        public function notifDetail()
        {
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $data['user_akses']= $this->ses_data['user_akses'];
            
            $jadwal_ganti_id = $this->input->post('ijadwal_ganti_id');
            
            if($jadwal_ganti_id == '')
            {
                $jadwal_ganti_id = $this->input->post('ijadwal_ganti_id2');
            }
            
            if($this->ses_data['user_akses'] == 'Mahasiswa')
            {
                $where = array ('mhs.EMAIL' => $this->ses_data['user_email']);
            }
            elseif($this->ses_data['user_akses'] == 'Dosen')
            {
                $where = array ('dsn.EMAIL' => $this->ses_data['user_email']);
            }
            else
            {
                $where = array ('jdg.REQUEST_TO' => $this->ses_data['user_email']);
            }
            
            //$where = array ($where => $this->ses_data['user_email']);
            $data['gantiJadwalDetail'] = $this->jadwal_mdl->getJadwalGantiDetail1($where,$jadwal_ganti_id);
            $data['jadwal_ganti'] = $jadwal_ganti_id;
            
            readNotif($this->ses_data['user_email'],$jadwal_ganti_id, setTipeNotif($this->ses_data['user_akses']));
            //$this->readNotif($jadwal_ganti_id);
            
            //print($this->ses_data['user_akses']); exit;
            $data['navbar']= HGetNavbarUser($this->ses_data['user_akses']);
            $this->load->view('pages/notif/notif_detail_view',$data);
        }
//	public function readNotif($jadwal_ganti_id)
//        {
//            
//            $lastID = $this->notif_mdl->getLastIdNotif();
//            $lastID++;
//            $data_notif = array('JADWAL_NOTIF_ID' => $lastID,
//                'JADWAL_GANTI_ID' => $jadwal_ganti_id,
//                'EMAIL' => $this->ses_data['user_email'],
//                'READ_STATUS' => '1',
//                'NOTIF_TIPE' => 'MHS',
//                'DTMUPD' => date('Y-m-d H:i:s'));
//            $where = array (
//                'JADWAL_GANTI_ID' => $jadwal_ganti_id,
//                'EMAIL' => $this->ses_data['user_email']
//                );
//            $this->notif_mdl->readNotif($data_notif,$where);
//        }
	//untuk melakukan cek session
	public function __construct()
	{
		parent::__construct();
                date_default_timezone_set('Asia/Jakarta');
		$user = $this->session->userdata('logged_in');
		if (!$user)
		{
			return redirect('logout','refresh');
		}
		else
		{
			$this->ses_data =  $this->session->userdata('logged_in');
                        $this->ses_data['user_akses'] = HGetAksesProfil($this->ses_data['user_akses']);
                        

			
		}
	}
}
