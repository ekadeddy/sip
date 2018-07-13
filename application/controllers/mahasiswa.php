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
		$this->load->view('pages/mahasiswa/mahasiswa_jadwal_perubahan_dashboard_view',$data);
	}

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


	//untuk melakukan cek session
	public function __construct()
	{
		parent::__construct();
		$user = $this->session->userdata('logged_in');
		if (!$user)
		{
			return redirect('logout','refresh');
		}
		else
		{
			$this->ses_data =  $this->session->userdata('logged_in');
			if ( $this->ses_data['user_akses']  != 'mhs' )
				return redirect('logout','refresh');


			$this->ses_data['user_akses'] = 'Mahasiswa';
		}
	}
}
