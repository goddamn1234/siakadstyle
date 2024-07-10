<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('mlogin', '', TRUE);
	
	}
	public function index(){
		session_destroy();
		$this->load->view('adminlogincrawlr12#$');
	}
	function cek(){
		$user 	= $this->input->post('username');
		$pass 	= sha1(md5($this->input->post('pass')));
		$log_as = array('user','principal','guru','student','parent');
		foreach($log_as as $row){
			$cekUser= $this->mlogin->userdata($row,array('id_number'=>$user,'password'=>$pass));
			if($cekUser->num_rows() == 1){
			$auth = $cekUser->row();
			$data = array(
				'sesId' => $auth->id_user,
				'sesNama' => $auth->full_name,
				'sesRole'	=> $auth->role,
				'sesNrole'	=> $auth->nama_role,
				'sesImage'	=> $auth->image,
				'sesStat'	=> 'login',
				'sesId_number' => $auth->id_number
			);
			$this->session->set_userdata($data);
			}
		}
		if($this->session->userdata('sesStat') == 'login'){
			redirect('dashboard');
		}else{
			redirect(base_url());
		}
	}
	
	function logout(){
		session_destroy();
		redirect(base_url());
	}
}

