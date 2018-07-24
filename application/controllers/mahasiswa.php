<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mahasiswa extends CI_Controller {
	public $ses_data;

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['user_nama']= $session_data['user_nama'];
		$data['user_image']= $session_data['user_images'];
		$this->load->view('pages/mahasiswa/dashboard_mahasiswa_view',$data);
	}

	//Jadwal Mata Kuliah
	public function jadwalMataKuliah()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
                $data['user_email']= $this->ses_data['user_email'];
                $data['alljamkuliah']= $this->jamkuliah_mdl->getAllJamKuliah();
		$this->load->view('pages/mahasiswa/mahasiswa_jadwal_dashboard_view',$data);
	}

	//Perubahan jadwal
	public function jadwalPerubahan()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
                
                $where =  array('mhs.EMAIL' => $this->ses_data['user_email']);
                //$data['jadwal_ganti_apv'] = $this->jadwal_mdl->getApvJadwalGanti($where);
                $data['jadwal_ganti'] = $this->jadwal_mdl->getApvJadwalGanti($where);
                $kepo = $this->jadwal_mdl->getApvJadwalGanti($where);
//                foreach ($kepo as $row)
//                {
//                    //print($row->KET); exit;
//                }
                //print($kepo); exit;
                //$data['jadwal_ganti'] = $this->jadwal_mdl->getApvJadwalGanti($where);
                
		$this->load->view('pages/mahasiswa/mahasiswa_jadwal_perubahan_dashboard_view',$data);
	}
//        public function jadwalPerubahanDetail()
//        {
//            $data['user_nama']= $this->ses_data['user_nama'];
//            $data['user_image']= $this->ses_data['user_images'];
//            $data['user_akses']= $this->ses_data['user_akses'];
//            
//            $jadwal_ganti_id = $this->input->post('ijadwal_ganti_id');
//            
//            if($jadwal_ganti_id == '')
//            {
//                $jadwal_ganti_id = $this->input->post('ijadwal_ganti_id2');
//            }
//            $data['gantiJadwalDetail'] = $this->jadwal_mdl->getJadwalGantiDetail($this->ses_data['user_email'],$jadwal_ganti_id);
//            $data['jadwal_ganti'] = $jadwal_ganti_id;
//            
//            readNotif($this->ses_data['user_email'],$jadwal_ganti_id, 'MHS');
//            //$this->readNotif($jadwal_ganti_id);
//            
//            //print($jadwal_ganti_id.' in '); exit;
//
//            $this->load->view('pages/mahasiswa/mahasiswa_jadwal_perubahan_detail_view',$data);
//        }
        //Baca Notif
//        public function readNotif($jadwal_ganti_id)
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
        
	//Jadwal Mata Kuliah
	public function kalenderAkademik()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
		$this->load->view('pages/mahasiswa/mahasiswa_kalender_dashboard_view',$data);
	}

	public function eventPcr()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
		$this->load->view('pages/mahasiswa/mahasiswa_event_dashboard_view',$data);
	}

        //redirect
        private function _flashAndRedirect( $successful, $successMessage, $failureMessage,$modul,$param)
	{
		if ( $successful == true ) {
                    $this->session->set_flashdata('feedback', $successMessage);
                        if ($param == 'T')
                        {
                            $this->session->set_flashdata('feedback_class', 'alert-warning');
                        }
                        else
                        {
                            $this->session->set_flashdata('feedback_class', 'alert-success');
                        }
			
		} else {
			$this->session->set_flashdata('feedback', $failureMessage);
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		HGetRedirectJadwal($modul,$param);
	}
        
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
                    if ( $this->ses_data['user_akses']  != 'mhs' )
                    {
                        return redirect('logout','refresh');
                    }
                        
                    $this->ses_data['user_akses'] = 'Mahasiswa';
		}
                
	}
}
