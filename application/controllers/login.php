<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_cek_login');

		if ($this->form_validation->run() == false)
		{
			$this->load->view('public/login_view');
		}
		else
		{
			$getdata = $this->session->userdata('logged_in');
			$akses = $getdata['user_akses'];
			if($akses == 'mhs'){
				redirect(base_url('mahasiswa/dashboard'), 'refresh');
			}elseif ($akses == 'adm'){
				redirect(base_url('admin/dashboard'), 'refresh');
			}elseif ($akses == 'dsn'){
				redirect(base_url('dosen/dashboard'), 'refresh');
			}

		}

	}
	function cek_login($password){
		$username = $this->input->post('username');
		$result = $this->login_mdl->login_valid($username,$password);

		if($result){
			$this->session->set_userdata('logged_in', $result);
			return true;
		} else{
			$this->form_validation->set_message('cek_login', 'Nama pengguna atau kata sandi salah');
			return false;
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
}
