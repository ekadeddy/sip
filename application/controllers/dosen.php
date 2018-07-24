<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dosen extends CI_Controller {
	public $ses_data;

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['user_nama']= $session_data['user_nama'];
		$data['user_image']= $session_data['user_images'];
		
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

		foreach($ru as $row)
		{
			$data_ruangan[$row->RUANGAN_ID] = $row->RUANGAN_ID.' '.$row->KETERANGAN;
		}

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
        }
        public function simpanJadwalPerubahan()
        {
            $jadwal_ganti_id = $this->jadwal_mdl->getLastIdJadwalGanti();
            $jadwal_id = $this->input->post('ijadwal_id');
            $tanggal = $this->input->post('itanggal');
            $ruangan = $this->input->post('druangan');
            $jam_kuliah = $this->input->post('djam');
            $hari = $this->input->post('ihari');
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
            $jadwal_ganti_hostory_id = $this->jadwal_mdl->getLastIdJadwalGanti();
            $data_jadwal_ganti = 
                    array ('JADWAL_GANTI_ID' => $jadwal_ganti_id,
                        'JADWAL_ID' => $jadwal_id,
                        'TANGGAL' => nice_date($tanggal,'Y-m-d'),
                        'PERTEMUAN_KE' => '2',
                        'RUANGAN_ID' => $ruangan,
                        'JAM_KULIAH_ID' => $jam_kuliah,
                        'STATUS' => 'REQ',
                        'REQUEST_TO' => 'admin',
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
                        'RUANGAN_ID' => $ruangan,
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

        //Jadwal Event
	public function eventPcr()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['user_akses']= $this->ses_data['user_akses'];
		$this->load->view('pages/dosen/dosen_event_dashboard_view',$data);
	}

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
			$this->session->set_flashdata('feedback_class', 'alert-success');
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
                        //print($this->ses_data['user_akses']); exit;
			if ($this->ses_data['user_akses']  != 'dsn' )
                        {
                            //print($this->ses_data['user_akses']); exit;
                            return redirect('logout','refresh');                            
                        }
                        //print($this->ses_data['user_akses']); exit;
			$this->ses_data['user_akses'] = 'Dosen';
		}
	}
}


