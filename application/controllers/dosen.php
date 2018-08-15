<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dosen extends CI_Controller {
	public $ses_data;

	public function index()
	{
		
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		
		$this->load->view('pages/dosen/dosen_dashboard_view',$data);
	}

	//Jadwal Mata Kuliah
	public function jadwalMataKuliah()
	{
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $data['user_akses']= $this->ses_data['user_akses'];
            $data['user_email']= $this->ses_data['user_email'];
            $data['alljamkuliah']= $this->jamkuliah_mdl->getAllJamKuliah();
            
            //matakuliah
            $matakuliah = $this->mk_mdl->getAllMataKuliah();
            $data_mk = array('0'=> '--pilih Mata Kuliah--');
            foreach($matakuliah as $row)
            {
                    $data_mk[$row->MATA_KULIAH_ID] = $row->MATA_KULIAH_NAMA.' - '.$row->STATUS;
            }
            $data['matakuliah'] = $data_mk;
            //end matakuliah
            
            //jam
            $jam = $this->jamkuliah_mdl->getAllJamKuliah();
            $data_jam = array('0'=> '--pilih jam--');
            foreach($jam as $row)
            {
                    $data_jam[$row['JAM_KULIAH_ID']] = $row['JAM_KULIAH_MULAI'];
            }
            $data['jam'] = $data_jam;
            //end jam
            
            //ruangan
            $ru = $this->r_mdl->getAllRuangan();
            $data_ruangan = array('0'=> '--pilih Ruangan--');

            foreach($ru as $row)
            {
                    $data_ruangan[$row->RUANGAN_ID] = $row->RUANGAN_ID.' '.$row->KETERANGAN;
            }

            $data['ruangan'] = '$data_ruangan';
            //end ruangan
            
            //Hari
            $data['dhari']= HgetHariKuliah();
            //end hari
            //
            //DOsen
            $dosen = $this->dosen_mdl->getAllDosen();
            $data_dosen=array('0'=> '--pilih--');
            foreach($dosen as $row)
            {
                    $data_dosen[$row->DOSEN_ID] = $row->DOSEN_NAMA;
            }
            $data['dosen'] = $data_dosen;
            
            //Banyak pertemuan
            $data_pertemuan=array('0'=> '--pilih--');
            $pertemuan = array (1,2,3,4,5);
            for($i = 0; $i <count($pertemuan);$i++)
            {
                    $data_pertemuan[$pertemuan[$i]] = $pertemuan[$i];
            }
            $data['npertemuan'] = $data_pertemuan;
            //end dosen
//            $itanggal = '2018-07-31';
//            print(HgetStatusTanggal($itanggal));exit;
                
            
            //testing
            
//                $ruangan = $this->r_mdl->getAvailableRuangan('SENIN','1');
//                $data_ruangan="<option value='pilih'>--pilih Hari--</option>";
//			foreach($ruangan as $row)
//			{
//				$data_ruangan.= "<option value='$row->RUANGAN_ID'>".$row->RUANGAN_ID.' '.$row->KETERANGAN."</option>";
//                                
//			}
//                echo $data_ruangan;
//                print($data_ruangan); exit;
            //end testing
		$this->load->view('pages/dosen/dosen_jadwal_dashboard_view',$data);
	}

	//Ubah Jadwal Kuliah
	public function ubahJadwalKuliah()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
                $data['semester']= '1';
                $data['hari'] = 'senin';
                
                //kelas
		$kelas = $this->kls_mdl->getKelasByDosen($this->ses_data['user_email']);
		$data_kls = array('pilih'=> '--pilih kelas--');
		foreach($kelas as $row)
		{
			$data_kls[$row->KELAS_ID] = $row->KELAS_NAMA;
		}
		$data['kelas'] = $data_kls;
                
                //mata kuliah
                $data_mk = array('pilih'=> '--pilih Mata Kuliah--');
                $matakuliah = $this->mk_mdl->getAllMataKuliah();
                foreach($matakuliah as $row)
		{
			//$data_mk[$row->MATA_KULIAH_ID] = $row->MATA_KULIAH_NAMA.' - '.$row->STATUS;
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
                $ru = $this->r_mdl->getAllRuangan();
		$data_ruangan = array('0'=> '--pilih Ruangan--');

//		foreach($ru as $row)
//		{
//			$data_ruangan[$row->RUANGAN_ID] = $row->RUANGAN_ID.' '.$row->KETERANGAN;
//		}

		$data['ruangan'] = $data_ruangan;
                
                // alert
                $data['ltanggal_stat'] = 'asa';
                
                $jadwal_hari = $this->jadwal_mdl->getHari();
                $data_hari = array('0'=> '--pilih Hari--');
                
                foreach ($jadwal_hari as $row) {
                    $data_hari[$row->HARI] = strtoupper($row->HARI);
                }
                $data['jadwal_hari'] = $data_hari;
                
                
                
//                $a = $this->jadwal_mdl->getJadwalByHari($this->ses_data['user_email'],'3TKA','MK00000002','senin');
////                foreach ($a as  $row)
////                {
//                    print $a;
////                    print $row->HARI;
////                    
////                }
//		exit;
                
                
		$this->load->view('pages/dosen/dosen_jadwal_perubahan_dashboard_view',$data);
	}
        
        public function ajax_get_mk_by_dosen_to_kelas()
        {
            $cek = $this->input->post('cek');
            $kelas = $this->input->post('dkelas');
            $itanggal = $this->input->post('itanggal');
            $dmatakuliah = $this->input->post('dmatakuliah');
            $hari = $this->input->post('ihari');
            $dhari = $this->input->post('dhari');
            $jam = $this->input->post('djam');
            $jadwal_id = $this->input->post('jadwal_id');
            
            
            if($cek == 'cekKelas')
            {
                $mk = $this->mk_mdl->getMataKuliahByDosenToKelas($this->ses_data['user_email'],$kelas);
			$data_mk="<option value='pilih'>--pilih Matkul kelas--</option>";
			foreach($mk as $row)
			{
				$data_mk.= "<option value='$row->MATA_KULIAH_ID'>$row->MATA_KULIAH_NAMA $row->STATUS</option>";
			}
			echo $data['matakuliah'] = $data_mk;
            }
            elseif($cek == 'cekTanggal')
            {
                
                $jadwal_id = $this->jadwal_mdl->getJadwalByHari($this->ses_data['user_email'],$kelas,$dmatakuliah,$dhari);
                
                $hari = array('hari' => HgetStringHari($itanggal),
                    'jadwal_id' => $jadwal_id,
                    'status' => HgetStatusTanggal($itanggal));
                
                
                //echo $data['hari']=$hari;
                echo json_encode($hari);
            }
            elseif($cek == 'cekJam')
            {
                
                $ru = $this->r_mdl->getRuanganGantiJadwal($hari,$jam);
			
                        $data_ruangan="<option value='pilih'>--pilih Ruang kelas--</option>";
			foreach($ru as $row)
			{
				$data_ruangan.= "<option value='$row->RUANGAN_ID'>$row->RUANGAN_ID $row->KETERANGAN</option>";
                                
			}
			echo $data_ruangan;
            }
             elseif($cek == 'cekMatkul')
            {
                $hari =  $jadwal_id = $this->jadwal_mdl->getJadwalBy($this->ses_data['user_email'],$kelas,$dmatakuliah);
			
                        $data_jadwal="<option value='pilih'>--pilih Hari--</option>";
			foreach($hari as $row)
			{
				$data_jadwal.= "<option value='$row->HARI'>".strtoupper($row->HARI)."</option>";
                                
			}
			echo $data_jadwal;
            }
            elseif($cek  == 'gantiJadwal')
            {
                $data_jadwal = $this->jadwal_mdl->getJadwalLengkapByJadwalId($jadwal_id);
                echo json_encode($data_jadwal);
                
            }
            elseif ($cek == 'CEK_TANGGAL')
            {                
                $hari = array(
                    'hari' => HgetStringHari($itanggal),
                    'status' => HgetStatusTanggal($itanggal));
                
                
                //echo $data['hari']=$hari;
                echo json_encode($hari);
            
        }
        }
        
        public function ajax_get_data()
        {
            $cek = $this->input->post('cek');
            $jadwal_id = $this->input->post('jadwal_id');
            if($cek  == 'gantiJadwal')
            {
                $data_jadwal = $this->jadwal_mdl->getJadwalLengkapByJadwalId($jadwal_id);
                echo json_encode($data_jadwal);
                
            }
        }


        public function ajax_change_jadwal()
        {
            $cek = $this->input->post('cek');
            $jadwal_id = $this->input->post('jadwal_id');
            $itanggal = $this->input->post('itanggal');
           
            if($cek  == 'gantiJadwal')
            {
                $data_jadwal = $this->jadwal_mdl->getJadwalLengkapByJadwalId($jadwal_id);
                echo json_encode($data_jadwal);
                
            }
            elseif($cek == 'CEKTANGGAL')
            {
                  $hari = array('hari' => HgetStringHari($itanggal),
                    'jadwal_id' => $jadwal_id,
                    'status' => HgetStatusTanggal($itanggal));
                
                echo json_encode($hari);
            }
            elseif($cek == 'CEKJAM')
            {
//                 $hari = array('hari' => $ihari,
//                    'jam' => $djam);
//                
//                echo json_encode($hari);
            $ihari = $this->input->post('ihari');
            $djam = $this->input->post('djam');
//            $ruangan = $this->r_mdl->getAvailableRuangan($ihari,$djam);
//                $data_ruangan="<option value='pilih'>--pilih Hari--</option>";
//			foreach($ruangan as $row)
//			{
//				$data_ruangan.= "<option value='$row->RUANGAN_ID'>".$row->KETERANGAN."</option>";
//                                
//			}
//                echo $data_ruangan;
                
                 $ru = $this->r_mdl->getRuanganGantiJadwal($ihari,$djam);
			
                        $data_ruangan="<option value='pilih'>--pilih Ruang kelas--</option>";
			foreach($ru as $row)
			{
				$data_ruangan.= "<option value='$row->RUANGAN_ID'>$row->RUANGAN_ID $row->KETERANGAN</option>";
                                
			}
			//echo json_encode($data_ruangan);
                        echo $data['ruangan'] = $data_ruangan;
            }
            elseif($cek == "CEKIN")
		{
			$ru = $this->r_mdl->getAvailableRuangan('SENIN','1');
                          echo json_encode($ru);
//			$data_ruangan="<option value='pilih'>--pilih Ruangan--</option>";
//			foreach($ru as $row)
//			{
//				$data_ruangan.= "<option value='$row->RUANGAN_ID'>$row->RUANGAN_ID $row->KETERANGAN</option>";
//			}
//			echo $data['ruangan'] = $data_ruangan;
//			// json_encode($data_ruangan);
		}
            
        }
        function ajax_ganti_jad()
	{
            $cek = $this->input->post('cek');
            $ihari = $this->input->post('ihari');
            $djam = $this->input->post('djam');
            if($cek =='CEKJAM')
            {
            $data_jadwal = $this->r_mdl->getAvailableRuangan2($ihari,$djam);
                echo json_encode($data_jadwal);    
            }
            elseif($cek=='AH')
            {
                
                
//                $states = array();
////                $country_id = $this->input->post('country_id');
////                if($country_id){
//                    //$con['conditions'] = array('country_id'=>$country_id);
//                    $states = $this->r_mdl->getAvailableRuangan2('SENIN','1');
//                //}
//                echo json_encode($states);
            }
            else
            {

            }

	}
        public function simpanJadwalPerubahan()
        {
            $jadwal_ganti_id = $this->jadwal_mdl->getLastIdJadwalGanti();
            $jadwal_id = $this->input->post('ijadwal_id');
            $tanggal = $this->input->post('itanggal');
            $ruangan = $this->input->post('druangan');
            $jam_kuliah = $this->input->post('djam');
            $npertemuan = $this->input->post('npertemuan');
            $hari = $this->input->post('iharih');
            $ket = $this->input->post('iket');
            $semester = '1';
            
            
            IF($jadwal_ganti_id =='')
            {
                $jadwal_ganti_id='JDG0000001';
            }
            ELSE
            {
                $jadwal_ganti_id++;
            }
            if($npertemuan=='0')
            {
                $npertemuan = '1';
            }
//            $jadwal_ganti_hostory_id = $this->jadwal_mdl->getLastIdJadwalGanti();
//            if($jadwal_ganti_hostory_id == '')
//            {
//                
//            }
            $data_jadwal_ganti = 
                    array ('JADWAL_GANTI_ID' => $jadwal_ganti_id,
                        'JADWAL_ID' => $jadwal_id,
                        'TANGGAL' => nice_date($tanggal,'Y-m-d'),
                        'PERTEMUAN_KE' => '2',
                        'RUANGAN_ID' => substr($ruangan, 0, 3),
                        'JAM_KULIAH_ID' => $jam_kuliah,
                        'JUMLAH_JAM' => $npertemuan,
                        'STATUS' => 'REQ',
                        'REQUEST_TO' => 'shelinna15tk@mahasiswa.pcr.ac.id',
                        'APPROVAL_BY' => '-',
                        'REJECT_BY' => '-',
                        'HARI' => strtoupper($hari),
                        'KET' => $ket,
                        'DTMUPD' => date('Y-m-d H:i:s')
            );
            
            //HISTORY
            
             $jadwal_ganti_history_id= $this->jadwal_mdl->getLastIdJadwalGantiHistory();
            
             IF($jadwal_ganti_history_id =='')
            {
                $jadwal_ganti_history_id='JGH0000001';
            }
            ELSE
            {
                $jadwal_ganti_history_id++;
            }
             $data_jadwal_ganti_hostory = array ('JADWAL_GANTI_HISTORY_ID' => $jadwal_ganti_history_id,
                        'JADWAL_GANTI_ID' => $jadwal_ganti_id,
                        'JADWAL_ID' => $jadwal_id,
                        'TANGGAL' => nice_date($tanggal,'Y-m-d'),
                        'PERTEMUAN_KE' => '2',
                        'RUANGAN_ID' => substr($ruangan, 0, 3),
                        'JAM_KULIAH_ID' => $jam_kuliah,
                        'STATUS' => 'REQ',
                        'APPROVAL_BY' => '-',   
                        'REJECT_BY' => '-',
                        'HARI' => strtoupper($hari),
                        'KET' => $ket,
                        'DTMUPD' => date('Y-m-d H:i:s')
            );
            
            $this->_flashAndRedirect(
			$this->jadwal_mdl->reqJadwalGantiByDosen($data_jadwal_ganti,$data_jadwal_ganti_hostory),'Pergantian jadwal telah diajukan','Pengajuan jadwal Gagal','SAVEJADWALGANTI',$semester
		);
        }
//tes kalendar
        public function tesKalendar()
        {
            
            //$result=$this->evn_mdl->getEvents();
            echo 'aini '. $result->start.' <br>';
            ///echo '<br>'.$result['start'].' ada';
             $resulta=$this->evn_mdl->getLastIdEventTemp('eventjdgsip20180813021855000001');
             foreach ($resulta as $ff)
             {
                print_r($ff);    
             }
             
//             
//             for($i = 0; $i<count($result);$i++)
//             {
//                 print $result[$i].' man';
//                 
//             }
            $c=1;
//            $aev  = 'eventeka123123';
//            $eventsa=$this->evn_mdl->getEventTempById($aev);
//             foreach($eventsa as $row)
//             {
//                 //print_r(json_encode($result));
//                 echo $c.' '.$row->start.'aa <br>';
//                 $c++;
//             }
             //print_r(json_encode($result));
             //print_f(json_encode($result));
             //exit;
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $data['user_akses']= $this->ses_data['user_akses'];
            
            $gClient = new Google_Client();
            $gClient->setAccessToken($_SESSION['token']);
            $googleCal = new Google_CalendarService($gClient);
            
            //$calendarId = 'pcr.ac.id_lf7v1s4ngrsepmjd7niva64h1s@group.calendar.google.com';
            $calendarId = 'pcr.ac.id_gpi2bjmlveu6rkgmipdkn4saqs@group.calendar.google.com';
            //$calendarId = 'pcr.ac.id_h2dcflu336s8ichefm2v9ouku0@group.calendar.google.com';
            
//            $optParams = array(
//                "calendarId"   => $calendarId,
//                "singleEvents" => true,
//                "timeZone"     => "Asia/Jakarta",
//                "maxResults"   => 250,
//                "timeMin"      => date("c", strtotime("midnight")), /* to get events from today... */
//                "timeMax"      => date("c",strtotime('+30 day')), /* ...to the 3 next days */
//                "orderBy"      => "startTime");
            
            //$eventx = $googleCal->events->get($calendarId, "sipevent12345");

           // echo $eventx->getSummary();

            // Get the API client and construct the service object.
            //$client = getClient();
            //$service = new Google_Service_Calendar($client);

            // Print the next 10 events on the user's calendar.
            //$calendarId = 'primary';
            $optParams = array(
              'maxResults' => 30,
              'orderBy' => 'startTime',
              'singleEvents' => true,
              'timeMin' => date('c'),
            );
            $gClient->setUseObjects(true);
            $results = $googleCal->events->listEvents($calendarId);
            $events = $results->getItems();

            
            
            
            $l_event_id ="";
            if (empty($events)) {
                print "No upcoming events found.\n";
            } else {
                print "Upcoming events:\n";
                foreach ($events as $event) {
                    $l_event_id = $event->id;
                    $eventId = $event->id;
                    $eventdesc = $event->iCalUID;
                    $eventsum = $event->summary;
                    $start = $event->start->dateTime;
                    $end = $event->end->dateTime;
                    if (empty($start)) {
                        $start = $event->start->date;
                        
                    }
                    
//                    foreach ($events as $event) {
//                    $eventId = $event->id;
                    
                    $eventIds = substr($event->id, 0, 17);
                    //print_r('-- '.$eventIds.' -- ');
                    $eventsp=$this->evn_mdl->getEventTempById($eventId);
                    foreach ($eventsp as $eve) {
                    //print_r($eve);
                        
                    
//                    }
                    //echo json_encode($eventsp);
                }
                    //echo 'ID : '.$eventId.'|'.$eventdesc.' | '.$eventsum.'<br>';
                    
                    
//                    print_r($event);
//                    exit;
                        //printf("%s (%s)\n", $event->getSummary(), $start);
                    //echo $eventId.' ada';
                        //echo '<br>'.$event->start->dateTime;
                   // printf("%s (%s)\n", $event->getSummary(), $end);
                    //printf("%s (%s)\n", $event->getSummary(), $start);
                }
                echo 'ID : '.$l_event_id.' | '.$eventsum.'<br>';
                
            }
            //            
            $eventt = $googleCal->events->get($calendarId, "eventeka123123");
//             /print_r($eventt);
            echo 'start -'.$eventt->start->dateTime.' to ';
            echo 'end -'.$eventt->end->dateTime.'';
            echo ' ID -'.$eventt->id.'';
            echo ' description -'.$eventt->description.'';
            echo ' ss -'.$eventSumm.'';            
            echo ' summary -'.$eventt->summary.'';
//            
            //echo $event->getSummary();
            $a=1;
            //new
//             $gClient = new Google_Client();
//        $gClient->setAccessToken($_SESSION['token']);
//        $googleCal = new Google_CalendarService($gClient);
//        $calendarId = 'pcr.ac.id_gpi2bjmlveu6rkgmipdkn4saqs@group.calendar.google.com';
//        
//        $gClient->setUseObjects(true);
//        $results = $googleCal->events->listEvents($calendarId);
//        $events = $results->getItems();
        //$event_id ="eventeka123123";
        
//         foreach ($events as $event) {
//                    $eventId = $event->id;
//                    $eventsp=$this->evn_mdl->getEventTempById($eventId);
//                    print_r($eventsp);
//                    //echo json_encode($eventsp);
//                }
            //end new
  
            $this->load->view('pages/dosen/dosen_test_calendar_view',$data);
        }
        
        //Jadwal Event
	public function eventPcr()
	{
            $data['user_nama']= $this->ses_data['user_nama'];
            $data['user_image']= $this->ses_data['user_images'];
            $data['user_akses']= $this->ses_data['user_akses'];
            $this->load->view('pages/dosen/dosen_event_dashboard_view',$data);
	}
        
        public function getEventGoogle()
        {
              //service google
            $gClient = new Google_Client();
            $gClient->setAccessToken($_SESSION['token']);
            $googleCal = new Google_CalendarService($gClient);
            //end service google
            $event = $googleCal->events->get('primary', "eventId");

            echo $event->getSummary();
        }
    Public function viewEvent()
    {
//        $gClient = new Google_Client();
//        $gClient->setAccessToken($_SESSION['token']);
//        $googleCal = new Google_CalendarService($gClient);
//
//        $calendarId = 'pcr.ac.id_gpi2bjmlveu6rkgmipdkn4saqs@group.calendar.google.com';
//        
//        $gClient->setUseObjects(true);
//            $results = $googleCal->events->listEvents($calendarId);
//            $events = $results->getItems();
//
//            
//            
//            
//            $l_event_id ="";
//            if (empty($events)) {
//                print "No upcoming events found.\n";
//            } else {
//                print "Upcoming events:\n";
//                foreach ($events as $event) {
//                    if (empty($start)) {
//                        $start = $event->start->date;
//                    }                    
//                    
//                    }
//                 echo json_encode($events);
//                //echo 'ID : '.$l_event_id.' | '.$eventsum.'<br>';
//                
//            }
        
//         $gClient->setUseObjects(true);
//        $results = $googleCal->events->listEvents($calendarId);
//        $events = $results->getItems();
//        
//        $l_event_id ="";
//        foreach ($events as $gev)
//        {
//            $l_event_id = substr($gev->id, 0, 17);
//            $eventsp=$this->evn_mdl->getEventTempById($l_event_id);
//            echo json_encode($eventsp);
//        }
        //$event_id ="eventeka123123";
        
//         foreach ($events as $event) {
//                    $eventId = substr($event->id, 0, 17);
//                    
//                    //$result = substr($eventId, 0, 17);
//                    $eventsp=$this->evn_mdl->getEventTempById($eventId);
//                      // print_r($result.'ada ya');
//                    echo json_encode($eventsp);
//                }
                
       
        
//         $data = array('id' =>$eventt->id,
//            'title' => 'eka1',
//            'description' => 'iyaaa',
//            'color' => '#40E0D0',
//            'start' => $eventt->start->dateTime,
//            'end' => $eventt->end->dateTime,
//            'dtmupd' => date('Y-m-d H:i:s'),
//            );
//        $this->evn_mdl->addEventTemp($data,$event_id);
//        
      
        
//        $eventt = $googleCal->events->get($calendarId, "eventeka123123");
//        
       // echo json_encode($eventt);
        $result=$this->evn_mdl->getEventTemp();
//        
//        
//         $hari = array('start' =>  date('Y-m-d H:i:s'),
//                    'end' =>   date('Y-m-d H:i:s'),
//                    'titel' => 'aYO',
//                    'description' => 'iyaa',
//                    'color' => '#40E0D0',
//                    'id' => '39');
                
                //echo json_encode($hari);
        //echo $data['hari']=$hari;
        //echo json_encode($hari);
//        
//        foreach ($result as $row)
//        {
//            print_r($row);
//        }
//        exit;
        echo json_encode($result);
    }
    /*Add new event */
    Public function addEvent()
    {
        $result=$this->evn_mdl->addEvent();
        echo $result;
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
        //end event
	//Kalender Akademik
	public function kalenderAkademik()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
		$this->load->view('pages/dosen/dosen_kalender_dashboard_view',$data);
	}
                
        //list perubahan jadwal
        public function jadwalPerubahan()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
                
                $where =  array('dsn.EMAIL' => $this->ses_data['user_email'],'jdn.EMAIL' => $this->ses_data['user_email']);
                $data['jadwal_ganti_apv'] = $this->jadwal_mdl->getApvJadwalGanti($where);
                $data['jadwal_ganti'] = $this->jadwal_mdl->getReqJadwalGanti($where);
                $data['jadwal_ganti_rjc'] = $this->jadwal_mdl->getRjcJadwalGanti($where);
                
                
                $data['navbar']= HGetNavbarUser($this->ses_data['user_akses']);
		$this->load->view('pages/jadwal/jadwal_perubahan_view',$data);
	}
        
        //flash save or no
        private function _flashAndRedirect( $successful, $successMessage, $failureMessage,$modul,$param ="")
	{
		if ( $successful == true ) {
			$this->session->set_flashdata('feedback', $successMessage);
                        $this->session->set_flashdata('txt_alert', 'Berhasil');
			$this->session->set_flashdata('feedback_class', 'alert-success');
		} else {
			$this->session->set_flashdata('feedback', $failureMessage);
                        $this->session->set_flashdata('txt_alert', 'Gagal');
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}

		HGetRedirectJadwal($modul,$param);
	}
        
	//untuk melakukan cek session
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
                    if ( $this->ses_data['user_akses']  != 'dsn' )
                            return redirect('login');
            }
	}
}




