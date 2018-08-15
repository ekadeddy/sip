<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class home_google extends CI_Controller {

	public function index()
	{
           $data['a'] = "-";
            $this->load->view('public/home_google_view',$data);
         


	}
	
}