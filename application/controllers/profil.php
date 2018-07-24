<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profil extends CI_Controller {
	public $ses_data;
	public function index()
	{

		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['navbar']= HGetNavbarUser($this->ses_data['user_akses']);
		$data['user_is'] = $this->ses_data['user_akses'];
//                /print($this->ses_data['user_akses']);exit;
		if ($this->ses_data['user_akses'] == 'Mahasiswa')
		{
			$ps = $this->profil_mdl->getProfilLengkapMahasiswa($this->ses_data['user_email']);
			foreach ($ps as $row)
			{
				$data['programStudi']= $row->PROGRAM_STUDI_NAMA;
				$data['email']= $row->EMAIL;
				$data['generasi']= $row->GENERASI;
                                $data['kelas']= $row->KELAS_NAMA;
                                
			}
		}
		else if ($this->ses_data['user_akses'] == 'Dosen')
		{
			$ps = $this->dosen_mdl->getProgramStudi($this->ses_data['user_id']);
			foreach ($ps as $row)
			{
				$data['programStudi']= $row->PROGRAM_STUDI_NAMA;
				$data['email']= $row->EMAIL;
				$data['generasi']= $row->GENERASI;
			}
		}
		else
		{
			$data['programStudi']= "BAAK";
			$data['email']= $this->ses_data['user_nama'];
			$data['generasi']= "2012";
		}

		$attributes = array('class' => 'email', 'id' => 'form-horizontal');
		$data['updateProfil'] = form_open('profil/edit/save', $attributes);
		$data['attribute'] = 'class = "row hidden"';

		//view
		$this->load->view('pages/profil/dashboard_profil_view',$data);
	}

	public function updateProfil()
	{
		$data['user_nama']= $this->ses_data['user_nama'];
		$data['user_image']= $this->ses_data['user_images'];
		$data['navbar']= HGetNavbarUser($this->ses_data['user_akses']);

		$attributes = array('class' => 'form-horizontal');
		$data['updateProfil'] = form_open('profil/edit', $attributes);
		$data['attribute'] = 'class = "row"';

		$data['passwd'] = array(
								'name' => 'password',
								'type'=> 'password',
								'id' => 'password',
								'class'=>'form-control',
								'placeholder'=>'Password'
		);

		if ($this->form_validation->run('ubah_password_rule'))
		{
			$user_id = $this->ses_data['user_email'];
			$data_post = $this->input->post();
			unset($data_post['submit']);

			$this->_flashAndRedirect(
				$this->profil_mdl->updatePassword($user_id, $data_post),"Profil berhasil diedit.","Gagal edit profil. Silahkan Coba Lagi."
			);

		}

		$this->load->view('pages/profil/dashboard_profil_edit_view',$data);
	}
	function updateProfilSave()
	{


	}


	private function _flashAndRedirect( $successful, $successMessage, $failureMessage)
	{
		if ( $successful == true ) {
			$this->session->set_flashdata('feedback', $successMessage);
			$this->session->set_flashdata('feedback_class', 'alert-success');
		} else {
			$this->session->set_flashdata('feedback', $failureMessage);
			$this->session->set_flashdata('feedback_class', 'alert-danger');
		}
		HGetRedirectProfil($this->ses_data['user_akses']);
	}

	public function __construct()
	{
		parent::__construct();
                date_default_timezone_set('Asia/Jakarta');
		if ( ! $this->session->userdata('logged_in') ){
			$this->ses_data = null;
			return redirect('login');
		}
		else
		{
			$this->ses_data =  $this->session->userdata('logged_in');
                         $this->ses_data['user_akses'] = HGetAksesProfil($this->ses_data['user_akses']);
		}


	}


#END REGION
        
}
