<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('sesStat') != 'login'){
			//redirect(base_url());
		}
		$this->load->model ('mdashboard', '', TRUE);
	
	}
	function index(){
		$data['parent'] = 'Dashboard';
		$data['child'] 	= date('F');
		$data['page']	= 'dashboard';	
		$this->load->view('template',$data);
	}

}

