<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public $ses_data;
	public $semester;

	public function __construct()
	{
            parent::__construct();
            //service calendar
            require_once APPPATH.'third_party/src/Google_Client.php';
            require_once APPPATH.'third_party/src/contrib/Google_CalendarService.php';
            date_default_timezone_set('Asia/Jakarta');
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
            
            
            //DOsen
            $dosen = $this->dosen_mdl->getAllDosen();
            $data_dosen=array('0'=> '--pilih--');
            foreach($dosen as $row)
            {
                    $data_dosen[$row->DOSEN_ID] = $row->DOSEN_NAMA;
            }
            $data['dosen'] = $data_dosen;
            
            
            //prog studi
            if ($progstudi != '')
            {
                $kelas = $this->kls_mdl->getKelasByProgramStudi($progstudi);
                $dataps=array($progstudi=> '--pilih PS--');
//                /print($kls);exit;
                
            }
            else
            {
                $kelas = $this->kls_mdl->getAllKelas();
                $dataps=array('0'=> '--pilih PS--');
            }
                //kelas
		
            if($kls != 0)
            {
                //print($kls);exit;
                $data_kls = array($kls => '--pilih kelas--');
                $dataps=array($progstudi=> '--pilih PS--');
                
            }
            else
            {
                $data_kls = array(0 => '--pilih kelas--');
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

//            $AllDay =HgetHariKuliah();
//            $data_hari = array('0'=> '--pilih Hari--');
//            for ($i=0; $i < count($AllDay); $i++)
//            {
//                $data_hari[$AllDay[]]
//            }
            $data['dhari']= HgetHariKuliah();

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
        function saveJadwal()
        {
            $btnAction = $this->input->post('btnSave');
            $data_jadwal = array('MATA_KULIAH_ID' => $this->input->post('dmatakuliah'),
                'JAM_KULIAH_ID' => $this->input->post('djam'),
                'RUANGAN_ID' => $this->input->post('druangan'),
                'DOSEN_ID' => $this->input->post('ddosen'),
                'HARI' => $this->input->post('dhari'),
                'RUANGAN_ID' => $this->input->post('druangan'),
                'DTMUPD' => date('Y-m-d H:i:s')
                );
            
            
//            //TGL START
            if($this->input->post('ihari2') == 'SENIN')
                {
                    $tgl_jadwal = '2018-08-06';
                }
                elseif($this->input->post('ihari2') == 'SELASA')
                {
                    $tgl_jadwal = '2018-08-07';
                }
                elseif($this->input->post('ihari2') == 'RABU')
                {
                    $tgl_jadwal = '2018-08-08';
                }
                elseif($this->input->post('ihari2') == 'KAMIS')
                {
                    $tgl_jadwal = '2018-08-09';
                }
                elseif($this->input->post('ihari2') == 'JUMAT')
                {
                    $tgl_jadwal = '2018-08-10';
                }
//            //END
            
            if($btnAction == 'Simpan')
            {
            $where = $this->input->post('ijadwal_id');
            $this->_flashAndRedirect(
			$this->jadwal_mdl->updateJadwal($data_jadwal,$where),'Jadwal Berhasil di Ubah','Gagal Mengubah Jadwal','SAVEEDITJADWAL',''
		);  
            }
            elseif($btnAction == 'Hapus')
            {
                $where = $this->input->post('ijadwal_id2');
                $this->_flashAndRedirect(
			$this->jadwal_mdl->delJadwal($where),'Jadwal Berhasil di Hapus','Gagal Menghapus Jadwal','SAVEEDITJADWAL','T'
		); 
            }
            elseif($btnAction == 'Tambah')
            {
                $jadwal_id = $this->jadwal_mdl->getLastId();
                $jadwal_id++;
		$semester = $this->input->post('semester');
                
                //ical
                
                //simpan ke google calendar
                //event dikirim ke library
                $event_id =$this->g_event->get_new_event_id('JD');
                //data jam
                $jam_jadwal = $this->jadwal_mdl->getDataMatkul($this->input->post('ihjam2'),$this->input->post('dmatakuliah2'),$this->input->post('ikelas2'),$this->input->post('ddosen2'));
//                //end
//                
                $start_date = nice_date($tgl_jadwal,'Y-m-d').'T'.$jam_jadwal->JAM_MULAI.'+07:00';
                $end_date = nice_date($tgl_jadwal,'Y-m-d').'T'.(($jam_jadwal->JAM_JK+$jam_jadwal->JAM_MK)-1).':45:00+07:00';
//                
                //print($start_date.'<br>'.$end_date);exit;
                $summary = ''.$jam_jadwal->MATA_KULIAH_NAMA.' R'.$this->input->post('druangan2');
                
                $g_event = array(
                    'id' => $event_id,
                    'summary' => $summary,
                    'location' => 'Politeknik Caltex Riau R'.$this->input->post('druangan2'),
                    'description' => 'Jadwal Perkuliahan Rutin',
                    'start' => array(
                    'dateTime' => $start_date,
                    'timeZone' => 'Asia/Jakarta',
                    ),
                    'hangoutLink' => '-',
                    'end' => array(
                      'dateTime' => $end_date,
                      'timeZone' => 'Asia/Jakarta',
                    ),
                      'recurrence' => array(
                    'RRULE:FREQ=WEEKLY;COUNT=20'
                  ),
                    'attendees' => array(
//                      array('email' => $jam_jadwal->EMAIL_KLS),
                      array('email' => $jam_jadwal->EMAIL_DSN),
                      array('email' => 'wafhigamers@gmail.com'),
//                      array('email' => 'ekadeddy@alumni.pcr.ac.id'),
//                      array('email' => '15tka@mahasiswa.pcr.ac.id'), 
                    ),
                    'reminders' => array(
                      'useDefault' => FALSE,
                      'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 10),
                      ),
                    ),
                  );
                
                //kirim ke librari untuk di create eventa di google calendar
                $this->g_synch->sync_i_c_jd($g_event);
                //end
                //
                
                
		$data_jadwal =
			array('JADWAL_ID' => $jadwal_id,
                                'EVENT_ID' => $event_id,
				'MATA_KULIAH_ID' => $this->input->post('dmatakuliah2'),
				'DOSEN_ID' => $this->input->post('ddosen2'),
				'KELAS_ID' => $this->input->post('ikelas2'),
				'RUANGAN_ID' => $this->input->post('druangan2'),
				'JAM_KULIAH_ID' => $this->input->post('ihjam2'),
				'HARI' => $this->input->post('ihari2'),
				'STATUS' => 'AKTIF',
                                'DTMUPD' => date('Y-m-d H:i:s'));
                
                //print_r($data_jadwal);exit;
                
		$this->_flashAndRedirect(
			$this->jadwal_mdl->saveJadwal($data_jadwal),'Berhasil membuat jadwal','Gagal membuat jadwal','SAVEJADWAL',$semester
		);
            }
                
        }
        
        function ajax_edit_jadwal()
        {
            $cek = $this->input->post('cek');
            $jadwal_id = $this->input->post('jadwal_id');
            
            if($cek == "cekEditJadwal")
		{
			$jadwal = $this->jadwal_mdl->getJadwalByJadwalId($jadwal_id);
			foreach($jadwal as $row)
			{
				$data_jadwal = array (
                                    'dosen_id' => $row->DOSEN_ID,
                                    'mata_kuliah_id' => $row->MATA_KULIAH_ID,
                                    'jam' => $row->JAM_KULIAH_ID,
                                    'ruangan_id' => $row->RUANGAN_ID,
                                    'hari' => strtolower($row->HARI),
                                    'kelas_id' => $row->KELAS_ID,
                                    'jadwal_id' => $row->JADWAL_ID
                                    
                                );
			}
			echo json_encode($data_jadwal);
		}
		else
		{

		}
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
            $data['aprroval_list'] = $this->jadwal_mdl->getAllReqJadwalGanti();
            
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
        Public function addEvent()
    {
        // $result=$this->evn_mdl->addEvent();
        // echo $result;
        //service google
            $gClient = new Google_Client();
            $gClient->setAccessToken($_SESSION['token']);
            $googleCal = new Google_CalendarService($gClient);
            //end service google
            
             //service calendar
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $color = $this->input->post('color');
            $start = $this->input->post('start');
            $start_time = $this->input->post('start_time');
            $end = $this->input->post('end');
            $end_time = $this->input->post('end_time');
           
          $event = new Google_Event(array(
           'summary' => $title,
           'location' => 'Politeknik Caltex Riau',
           'description' => $description,
           'start' => array(
             'dateTime' => $start.'T'.$start_time,
             'timeZone' => 'Asia/Jakarta',
           ),
           'end' => array(
             'dateTime' => $start.'T'.$start_time,
             'timeZone' => 'Asia/Jakarta',
           ),
           'colorId' => $color,
           'attendees' => array(
             array('email' => 'shelinna15tk@pcr.ac.id'),
             array('email' => 'rahmat@alumni.pcr.ac.id'),
           ),
           'reminders' => array(
             'useDefault' => FALSE,
             'overrides' => array(
               array('method' => 'email', 'minutes' => 24 * 60),
               array('method' => 'popup', 'minutes' => 10),
             ),
           ),
         ));
            $calendarId = 'pcr.ac.id_lf7v1s4ngrsepmjd7niva64h1s@group.calendar.google.com';
    
            $event = $googleCal->events->insert($calendarId, $event);
            
    }
    /*Update Event */
    Public function updateEvent()
    {
        $result=$this->evn_mdl->updateEvent();
        echo $result;
    }
    /*Delete Event*/
    Public function deleteEvent()
    {
        $result=$this->evn_mdl->deleteEvent();
        echo $result;
    }
    Public function dragUpdateEvent()
    {   

        $result=$this->evn_mdl->dragUpdateEvent();
        echo $result;
    }
        public function approvalSave()
        {
//            //service google
//            $gClient = new Google_Client();
//            $gClient->setAccessToken($_SESSION['token']);
//            $googleCal = new Google_CalendarService($gClient);
//            $calendarId = 'pcr.ac.id_gpi2bjmlveu6rkgmipdkn4saqs@group.calendar.google.com';
//            //end service google
//            
            $jadwal_ganti_id = $this->input->post('jadwal_ganti_id');
            //$jadwal_id = $this->input->post('');
            $approval_status = $this->input->post('approval_status');
            $ket = $this->input->post('iket');
            $tjam = $this->input->post('tjam');
            $approv_by = $this->ses_data['user_email'];
            $reject_by = $this->ses_data['user_email'];
            
            $event_id = $this->evn_mdl->getLastIdEventTemp();
            
            if($event_id==null)
            {
                $event_id = 'eventjdgsip000001';
            }
            else
            {
             $event_id++;   
            }
            $jadwal_ganti_hostory_id = $this->jadwal_mdl->getLastIdJadwalGantiHistory();
            
            if ($approval_status == 'Y')
            {
                $reject_by = '-';
                $status = 'APV';
                $successMessage = 'Approval Berhasil';
            }
            else
            {
                $approv_by = '-';
                $status = 'RJC';
                $successMessage = 'Reject Berhasil';
            }
            if($ket==null)
            {
                $ket ='cuti';
            }
          
            $jadwal_ganti_hostory_id++;
            $where = array('jdg.JADWAL_GANTI_ID' => $jadwal_ganti_id);
            $oldjadwalGanti = $this->jadwal_mdl->getJadwalGantiById($where);
            foreach ($oldjadwalGanti as $row)
            {
                $start_date = nice_date($row->TANGGAL, 'Y-m-d').'T'.$row->JAM_MULAI.'+07:00';
                $end_date = $row->TANGGAL.'T'.(($row->JAM_JK+($row->JAM_MK*$row->JUMLAH_JAM))-1).':45:00+07:00';
                $email_kls = $row->EMAIL_KLS;
                $email_dsn = $row->EMAIL;
                $summary ='Pergantian Jadwal Kuliah '.$row->MATA_KULIAH_NAMA.' Oleh Dosen '.$row->DOSEN_NAMA;
                 

               //event dikirim ke library
                $g_event = array(
                    'id' => $event_id,
                    'summary' => $summary,
                    'location' => 'Politeknik Caltex Riau R'.$row->RUANGAN_ID,
                    'description' => $row->KET,
                    'start' => array(
                    'dateTime' => $start_date,
                    'timeZone' => 'Asia/Jakarta',
                    ),
                    'end' => array(
                      'dateTime' => $end_date,
                      'timeZone' => 'Asia/Jakarta',
                    ),
                      'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=1'
                  ),
                    'attendees' => array(
//                      array('email' => $email_kls),
//                      array('email' => $email_dsn),
//                      array('email' => 'wafhigamers@gmail.com'),
//                      array('email' => 'ekadeddy@alumni.pcr.ac.id'),
//                      array('email' => '15tka@mahasiswa.pcr.ac.id'), 
                    ),
                    'reminders' => array(
                      'useDefault' => FALSE,
                      'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 10),
                      ),
                    ),
                  );
                
                //kirim ke librari untuk di create eventa di google calendar
                $synch_gcal = $this->g_synch->sync_i_c_jd_ganti($g_event);
                //end

                //UPDATE STATUS
                $datajadwalGanti = 
                    array ('STATUS' => $status,
                        'APPROVAL_BY' => $approv_by,
                        'EVENT_ID' => $event_id,
                        'REJECT_BY' => $reject_by,
                        'KET_ADMIN' => $ket,
                        'DTMUPD' => date('Y-m-d H:i:s'));
                //INSERT HOSTORY
                $datajadwalGantiHistory = 
                    array ('JADWAL_GANTI_HISTORY_ID' => $jadwal_ganti_hostory_id,
                        'JADWAL_GANTI_ID' => $jadwal_ganti_id,
                        'JADWAL_ID' => $row->JADWAL_ID,
                        'TANGGAL' => $row->TANGGAL,
                        'PERTEMUAN_KE' => '0',
                        'RUANGAN_ID' => $row->RUANGAN_ID,
                        'JAM_KULIAH_ID' => $row->JAM_KULIAH_ID,
                        'STATUS' => $status,
                        'APPROVAL_BY' => $approv_by,
                        'REJECT_BY' => $reject_by,
                        'HARI' => $row->HARI,
                        'KET_ADMIN' => $ket,
                        'DTMUPD' => date('Y-m-d H:i:s'));
                $data_mk = $this->mk_mdl->getMataKuliahJadwalId($row->JADWAL_ID);
                 
                 //event local
            $data = array('id' =>$event_id,
            'title' => $summary,
            'description' => $row->KET,
            'color' => '#40E0D0',
            'start' => $start_date,
            'end' =>$end_date,
            'dtmupd' => date('Y-m-d H:i:s'),
            );
        
        //simpan event local
        $this->evn_mdl->addEventTemp($data,$event_id);

            $this->_flashAndRedirect(
                    $this->approval_mdl->reqSaveApproval($where,$datajadwalGanti,$datajadwalGantiHistory),$successMessage,'Approval Gagal Dilakukan!','APPROVALSAVE',$approval_status);
            }   
        }
        public function getEventGoogle()
        {
              //service google
//            $gClient = new Google_Client();
//            $gClient->setAccessToken($_SESSION['token']);
//            $googleCal = new Google_CalendarService($gClient);
            //end service google
//            $calendarId = 'pcr.ac.id_lf7v1s4ngrsepmjd7niva64h1s@group.calendar.google.com';
//            $calendar = $googleCal->calendars->get($calendarId);

            echo $calendar->getSummary();
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
            $this->load->view('public/kalendar_new',$data);
        }


        private function _flashAndRedirect( $successful, $successMessage, $failureMessage,$modul,$param)
	{
		if ( $successful == true ) {
                    $this->session->set_flashdata('feedback', $successMessage);
                    $this->session->set_flashdata('txt_alert', 'Berhasil');
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
                        $this->session->set_flashdata('txt_alert', 'Gagal');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		HGetRedirectJadwal($modul,$param);
	}

	
}
