<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Settings extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('sesStat') != 'login') {
			redirect(base_url());
		}
	}
	public function auth()
	{
		if ($this->session->userdata('sesStat') != 'login') {
			redirect(base_url());
		}
    }
    
    public function general()
	{
      
		$this->auth();
		$data = otoritas('settings/general', $this->session->userdata('sesRole'));
		$data['parent'] = 'General';
		$data['child'] = 'Data General';
		$data['page'] = 'data_general';
		$data['general'] = $this->db->get('settings');
		$this->load->view('template', $data);
	}

	public function save(){
		$this->form_validation->set_rules('school_name', 'School Name', 'required');
		
		$config['upload_path'] = './image/settings';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 200000;
		$config['file_name'] = 'stamp-'.date('YmdHis');
		$this->load->library('upload', $config);
		$res = array();
		if ($this->form_validation->run() == true) {
			$data = array(
				'school_name' => ucwords(strip_tags($this->input->post('school_name'))),
				'school_address' => strip_tags($this->input->post('school_address')),
				'school_telp' => $this->input->post('school_telp'),
				'school_email' => $this->input->post('school_email')
			);
			
			if ($this->upload->do_upload('fFile')) {
				$data['school_stamp'] = $this->upload->data('file_name');
			}
			
			foreach($data as $key => $dt){
				$this->db->set('value', $dt);
				$this->db->where('name', $key);
				$this->db->update('settings');
			}
			
			$res['status'] = true;
			
		} else {
			$res['status'] = false;
			$res['message'] = validation_errors();
		}
		echo json_encode($res);
	}
	
}
