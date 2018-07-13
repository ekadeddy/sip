<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public $ses_data;
	public $semester;

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['user_nama']= $session_data['user_nama'];
		$data['user_image']= $session_data['user_images'];
		$this->load->view('pages/admin/admin_dashboard_view',$data);
	}
	// Manage daftar Kuliah
        
        public function manageJadwalDashboard()
        {
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $this->load->view('pages/admin/admin_mng_jadwal_dashboard_new_view',$data);
        }


        public function manageJadwalKuliahDashboard()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$this->load->view('pages/admin/admin_mng_jadwal_dashboard_view',$data);
	}

        public function manageEditJadwal()
	{
            
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $data['user_email']= $this->ses_data['user_email'];
            $data['alljamkuliah']= $this->jamkuliah_mdl->getAllJamKuliah();
            $kls =$this->input->post('dkelas');
            $progstudi =$this->input->post('dprogramstudi');
            
            
            $data['kls'] = $kls;
            $data['progstudi'] = $progstudi;
            
            //prog studi
            if ($progstudi != '')
            {
                $kelas = $this->kls_mdl->getKelasByProgramStudi($progstudi);
                $dataps=array($progstudi=> '--pilih PS--');
            }
            else
            {
                $kelas = $this->kls_mdl->getAllKelas();
                $dataps=array('0'=> '--pilih PS--');
            }
                //kelas
		
            if($kls != '')
            {
                $data_kls = array($kls => '--pilih kelas--');
                $dataps=array($progstudi=> '--pilih PS--');
                
            }
            else
            {
                $data_kls = array('0'=> '--pilih kelas--');
            }
                
                
            $data['semester']= '1';
            $ps = $this->admin_mdl->getAllProgramStudi();

            foreach($ps as $row)
            {
                    $dataps[$row->PROGRAM_STUDI_ID] = $row->PROGRAM_STUDI_NAMA;
            }
            $data['ps']= $dataps;



            foreach($kelas as $row)
            {
                    $data_kls[$row->KELAS_ID] = $row->KELAS_NAMA;
            }
            $data['kelas'] = $data_kls;


            $data['hari']= 'senin';

            //matakuliah
		$matakuliah = $this->mk_mdl->getAllMataKuliah();
		$data_mk = array('0'=> '--pilih Mata Kuliah--');
		foreach($matakuliah as $row)
		{
			$data_mk[$row->MATA_KULIAH_ID] = $row->MATA_KULIAH_NAMA.' - '.$row->STATUS;
		}
		$data['matakuliah'] = $data_mk;
            
            //jam
            $jam = $this->jamkuliah_mdl->getAllJamKuliah();
            $data_jam = array('0'=> '--pilih jam--');
            foreach($jam as $row)
            {
                    $data_jam[$row['JAM_KULIAH_ID']] = $row['JAM_KULIAH_MULAI'];
            }
            $data['jam'] = $data_jam;
                
            //ruangan
		$jam_kuliah_id = 3;
		$jam = 4;

		$ru = $this->r_mdl->getAllRuangan();
		$data_ruangan = array('0'=> '--pilih Ruangan--');

		foreach($ru as $row)
		{
			$data_ruangan[$row->RUANGAN_ID] = $row->RUANGAN_ID.' '.$row->KETERANGAN;
		}

		$data['ruangan'] = $data_ruangan;
                
            $this->load->view('pages/admin/admin_mng_edit_jadwal_view',$data);
	}
        
        function ajax_edit_jadwal()
        {
            
        }
                function manageJadwalKuliah($smt)
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['jam_kuliah'] =$this->jamkuliah_mdl->getAllJamKuliah();
		$data['time_string'] = "%H:%i %a";
		$data['semester']= $smt;
		$data['hari']= array('','senin','selasa','rabu','kamis','jumat');
		$data['semester']= $smt;

		$dosen = $this->dosen_mdl->getAllDosen();
		$datak=array('0'=> '--pilih--');
		foreach($dosen as $row)
		{
			$datak[$row->DOSEN_ID] = $row->DOSEN_NAMA;
		}
		$data['dosen'] = $datak;
		$data['ldosen'] = array(
			'pilih'      =>'--pilih--');
		$data['ldosen_s'] =$attribute1 = array(
			'class'     => 'form-control select2',
			'id'        => 'ldosen',
			'name'      => 'ldosen');

		$this->load->view('pages/admin/admin_mng_jadwal_view',$data);

	}

	function manageJadwalKuliahEdit($smt,$hari)
	{

		$data['hari']= $hari;
		$data['semester']= $smt;

		//dosen
		$dosen = $this->dosen_mdl->getAllDosen();
		$data_dsn = array('0'=> '--pilih dosen--');
		foreach($dosen as $row)
		{
			$data_dsn[$row->DOSEN_ID] = $row->DOSEN_NAMA;
		}
		$data['dosen'] = $data_dsn;

		//kelas
		$kelas = $this->kls_mdl->getAllKelas();
		$data_kls = array('0'=> '--pilih kelas--');
		foreach($kelas as $row)
		{
			$data_kls[$row->KELAS_ID] = $row->KELAS_NAMA;
		}
		$data['kelas'] = $data_kls;

		//matakuliah
		$matakuliah = $this->mk_mdl->getAllMataKuliah();
		$data_mk = array('0'=> '--pilih Mata Kuliah--');
		foreach($matakuliah as $row)
		{
			$data_mk[$row->MATA_KULIAH_ID] = $row->MATA_KULIAH_NAMA.' - '.$row->STATUS;
		}
		$data['matakuliah'] = $data_mk;

		//jam
		$jam = $this->jamkuliah_mdl->getAllJamKuliah();
		$data_jam = array('0'=> '--pilih jam--');
		foreach($jam as $row)
		{
			$data_jam[$row['JAM_KULIAH_ID']] = $row['JAM_KULIAH_MULAI'];
		}
		$data['jam'] = $data_jam;


		//ruangan
		$jam_kuliah_id = 3;
		$jam = 4;

		$ru = $this->r_mdl->getAvailableRuangan('senin',4);
		$data_ruangan = array('0'=> '--pilih Ruangan--');

		foreach($ru as $row)
		{
			//$data_ruangan[$row->RUANGAN_ID] = $row->RUANGAN_ID.' '.$row->KETERANGAN;
		}

//		for ($jam_kuliah_id; $jam_kuliah_id <=$range; $jam_kuliah_id++ )
//		{
//			$data_ruangan[$jam_kuliah_id] = $jam_kuliah_id;
//		}
		$data['ruangan'] = $data_ruangan;
		
                $jadwal_id = $this->jadwal_mdl->getLastId();
                $jadwal_id++;
                $data['lastid'] = $jadwal_id;
                  


		$this->load->view('pages/admin/admin_mng_jadwal_edit_view',$data);
	}

	function ajax_edit_manageJadwalKuliah()
	{
		$cek = $this->input->post('cek');
		$hari = $this->input->post('hari');
		$jam = $this->input->post('jam');

		if($cek == "cekJam")
		{
			$ru = $this->r_mdl->getAvailableRuangan($hari,$jam);
			$data_ruangan="<option value='pilih'>--pilih Ruangan--</option>";
			foreach($ru as $row)
			{
				$data_ruangan.= "<option value='$row->RUANGAN_ID'>$row->RUANGAN_ID $row->KETERANGAN</option>";
			}
			echo $data['ruangan'] = $data_ruangan;
			// json_encode($data_ruangan);
		}
		else
		{

		}

	}

	function manageJadwalKuliahSave()
	{
		$jadwal_id = $this->jadwal_mdl->getLastId();
                $jadwal_id++;
		$semester = $this->input->post('semester');
		$data_jadwal =
			array('JADWAL_ID' => $jadwal_id,
				'MATA_KULIAH_ID' => $this->input->post('dmatakuliah'),
				'DOSEN_ID' => $this->input->post('ddosen'),
				'KELAS_ID' => $this->input->post('dkelas'),
				'RUANGAN_ID' => $this->input->post('druangan'),
				'JAM_KULIAH_ID' => $this->input->post('djam'),
				'HARI' => $this->input->post('hari'),
				'STATUS' => 'AKTIF'
		);
		$this->_flashAndRedirect(
			$this->jadwal_mdl->saveJadwal($data_jadwal),'Berhasil membuat jadwal','Gagal membuat jadwal','SAVEJADWAL',$semester
		);

	}

	//Manage Kalender Akademik
	public function manageKalenderAkademik()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$this->load->view('pages/admin/admin_mng_kalender_dashboard_view',$data);
	}

	//Manage Event PCR
	public function manageEventPcr()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$this->load->view('pages/admin/admin_mng_event_dashboard_view',$data);
	}
        
        public function approvalGantiJadwal()
        {
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $data['aprroval_list'] = $this->jadwal_mdl->getApprovalData();
            
//            $aprroval_list = $this->approval_mdl->getApprovalDataById('JG00000007');
//             foreach ($aprroval_list as $row)
//                {
//                   
//                print ($row->DOSEN_NAMA);
//                exit;
//                    
//                }
//               
            
            $this->load->view('pages/admin/admin_approval_dashboard_view',$data);
        }
        public function approvalSave()
        {
            $jadwal_approval_id = $this->approval_mdl->getLastApprovalId();
            $jadwal_ganti_id = $this->input->post('jadwal_ganti_id');
            //$jadwal_id = $this->input->post('');
            $approval_status = $this->input->post('approval_status');
            $ket = $this->input->post('iket');
            $approv_by = $this->ses_data['user_email'];
            $reject_by = $this->ses_data['user_email'];

            $jadwal_approval_id++;
            
            if ($approval_status == 'Y')
            {
                $reject_by = '-';
                $successMessage = 'Approval Berhasil';
            }
            else
            {
                $approv_by = '-';
                $successMessage = 'Reject Berhasil';
            }
          
            
            $data_approval = array ('JADWAL_APPORVAL_ID' => $jadwal_approval_id,
                'JADWAL_GANTI_ID' => $jadwal_ganti_id,
                'APPROVAL_STATUS' => $approval_status,
                'APPROVAL_BY'     => $approv_by,
                'REJECT_BY'       => $reject_by,
                'KET'             => $ket,
                'DTMUPD'          => date('Y-m-d H:i:s'));
            
            $this->_flashAndRedirect(
                    $this->approval_mdl->saveApproval($data_approval),$successMessage,'Approval Gagal Dilakukan!','APPROVALSAVE',$approval_status);
            
        }
        
        public function ajaxApproval()
        {
            $jadwal_ganti_id = $this->input->post('jadwal_ganti_id');
            $cekApproval = $this->input->post('cekApproval');
            
            $aprroval_list = $this->approval_mdl->getApprovalDataById($jadwal_ganti_id);
            
            if ($cekApproval == 'ApprovalConfirm')
            {
                foreach ($aprroval_list as $row)
                {
                    $data_approval = array ('jadwal_ganti_id' => $jadwal_ganti_id,
                        'mata_kuliah_nama' => $row->MATA_KULIAH_NAMA,
                        'dosen_nama' => $row->DOSEN_NAMA,
                        'ruangan_id' => $row->RUANGAN_ID,
                        'tanggal' => $row->TANGGAL);
                    
                }
                
                echo json_encode($data_approval);
            }
        }
        public function kalender()
        {
              $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $this->load->view('public/tes_kalender2',$data);
        }


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
		if ( ! $this->session->userdata('logged_in') ){
			$this->ses_data = null;
			return redirect('logout');
		}
		else
		{
			$this->ses_data =  $this->session->userdata('logged_in');

			if ( $this->ses_data['user_akses']  != 'adm' )
				return redirect('login');
		}
	}
}