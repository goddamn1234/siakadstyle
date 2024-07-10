<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Parents extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('mparent', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	function parent_data(){
		$this->auth();
		$data = otoritas('parents/parent_data',$this->session->userdata('sesRole'));
		$data['parent'] = 'Orang Tua Siswa';
		$data['child'] 	= 'Data Orang Tua Siswa';
		$data['page'] 	= 'data_parent';
		$this->load->view('template',$data);
	}
	function ajaxParent(){
		$this->auth();
		$data = otoritas('parents/parent_data',$this->session->userdata('sesRole'));
		$data['list']	= $this->mparent->parentData();
		$this->load->view('ajaxParent',$data);
	}
	function faddParent(){
		$this->auth();
		$select = "id_number, full_name";
		$data['nationality']= $this->mparent->nationality(array());
		$data['children']= $this->mparent->simpleStudent($select,NULL);
		$this->load->view('faddParent',$data);
	}
	function proses_parent(){
		$this->form_validation->set_rules('id_number','ID card Number','required|numeric');
		$this->form_validation->set_rules('full_name','Full Name','required');
		$this->form_validation->set_rules('spouse_name','Spouse Name','alpha');
		$this->form_validation->set_rules('birth_place','Birth Place','required|alpha');
		$this->form_validation->set_rules('birth_date','Birth Date','required');
		$this->form_validation->set_rules('address','Home Address','required');
		$this->form_validation->set_rules('phone1','Phone Number','required');
		$this->form_validation->set_rules('children[]','Children','required');
		$this->form_validation->set_rules('nationality','Nationality','greater_than[0]',array('greater_than'=>'Kolom nationality must be selected'));
		$this->form_validation->set_rules('religion','Religion','greater_than[0]',array('greater_than'=>'Kolom Religion must be selected'));
		$this->form_validation->set_rules('role','Role','greater_than[0]',array('greater_than'=>'Kolom Role must be selected'));
		
		$config['upload_path']          = './image/parent';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200000;
		$config['file_name']            = $this->input->post('id_number');
		$this->load->library('upload', $config);
		$res = array();
		if($this->form_validation->run() == TRUE){
			$data = array(
				'id_number' => $this->input->post('id_number'),
				'full_name' => ucwords(strip_tags($this->input->post('full_name'))),
				'birth_place' => $this->input->post('birth_place'),
				'birth_date' => date('Y-m-d',strtotime($this->input->post('birth_date'))),
				'address'	=> strip_tags($this->input->post('address')),
				'phone1'	=> $this->input->post('phone1'),
				'parent_from'	=> implode(',',$this->input->post('children')),
				'nationality'	=> $this->input->post('nationality'),
				'religion'	=> $this->input->post('religion'),
				'password' 	=> sha1(md5('123456')),
				'role' 		=> $this->input->post('role'),
			);
			$this->upload->initialize($config);
			if($this->upload->do_upload('fFile')){
				$data['image'] = $this->upload1->data('file_name');
			}
			
			$config['upload_path'] = './image/signature/parent';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 200000;
            $config['file_name'] = $this->input->post('id_number');
    		$this->upload->initialize($config);
    		$this->load->library('upload', $config);
    		
    		if($this->upload->do_upload('fFile2')){
				$data['image_ttd'] = $this->upload->data('file_name');
			}
			if($this->input->post('spouse_name') != NULL){
				$data['spouse_name'] = ucwords(strip_tags($this->input->post('spouse_name')));
			}
			if($this->input->post('phone2') != NULL){
				$data['phone2'] = $this->input->post('phone2');
			}
			if($this->input->post('education') != NULL){
				$data['education'] = $this->input->post('education');
			}
			if($this->input->post('occupation') != NULL){
				$data['occupation'] = $this->input->post('occupation');
			}
			if($this->input->post('income') != NULL){
				$data['income'] = $this->input->post('income');
			}
			
			if($this->input->post('id_user') == "kosong"){
				$this->allcrud->insertdata('parent',$data);
			}else{
				$flag = array(
					'id_user' => $this->input->post('id_user')
				);
				$this->allcrud->editdata('parent',$flag,$data);
			}
			
			$res['status'] = TRUE;
			
		}else{
			$res['status'] = FALSE;
			$res['message'] = validation_errors();
		}
		echo json_encode($res);
		
	}
	
	function feditParent(){
		$this->auth();
		$flag = array('id_user' => $this->input->post('id'));
		$select = "id_number, full_name";
		
		$data['nationality']= $this->mparent->nationality(array());
		$data['children']= $this->mparent->simpleStudent($select,NULL);
		$data['parent'] = $this->mparent->parentData($flag)->row();
		$this->load->view('feditParent',$data);
	}
	function delparent($id){
		$flag = array('id_user' => $id);
		$this->allcrud->deletedata('parent',$flag);
	}
	
	function actuser($id){
		$flag = array('id_user' => $id);
		$cek = $this->allcrud->getdata('parent',$flag,0,1)->row();
		if($cek->status == 'aktif'){
			$this->allcrud->editdata('parent',$flag,array('status'=>'tidak aktif'));
		}else{
			$this->allcrud->editdata('parent',$flag,array('status'=>'aktif'));
		}
	}
	function resetpas($id){
		$flag = array('id_user'=>$id);
		$data = array ('password'=>sha1(md5('123456')));
		$this->allcrud->editdata('parent',$flag,$data);
	}
	function get_child($id){
		$flag = array(
			'id_number' => $id
		);
		$q = $this->allcrud->getdata('parent',$flag,1,0);
		echo json_encode($q);
	}
	
	function report(){
		$this->auth();
		$data = otoritas('parents/report',$this->session->userdata('sesRole'));
		$data['parent'] = 'Parent';
		$data['child'] 	= 'Report';
		$data['page'] 	= 'data_output';
		$this->load->view('template',$data);
	}
	
	function report_student(){
		$this->auth();
		$data = otoritas('parents/report',$this->session->userdata('sesRole'));
		
		$all_data = array();
		$all_students = array();
		
		$flag_parent = array(
			'id_number' => $this->session->userdata('sesId_number')
		);
		
		$data_parent = $this->allcrud->getdata('parent',$flag_parent,1,0)->row();
		
		if(!empty($data_parent->parent_from)){
			$get_students = explode(",",$data_parent->parent_from);
			
			if(is_array($get_students)){
				foreach($get_students as $students){
					$student = $this->allcrud->getdata('student',array('id_number'=>$students),1,0)->row();
					if(!empty($student)){
				
						$flag = array(
							'published' => 'yes',
							'student' => $student->id_number
						);
						
						$q1 = $this->mparent->report_student(1,$flag)->result();
						$q2 = $this->mparent->report_student(2,$flag)->result();
						$q3 = $this->mparent->report_student(3,$flag)->result();
						
						$students = array_merge($q1, $q2, $q3);
					}
					$all_data = array_merge($all_data, $students);
				}
			}else{
				$student = $this->allcrud->getdata('student',array('id_number'=>$student->parent_from),1,0)->row();
					if(!empty($student)){
				
						$flag = array(
							'published' => 'yes',
							'student' => $student->id_number
						);
						
						$q1 = $this->mparent->report_student(1,$flag)->result();
						$q2 = $this->mparent->report_student(2,$flag)->result();
						$q3 = $this->mparent->report_student(3,$flag)->result();
						
						$all_data = array_merge($q1, $q2, $q3);
					}
					
			}
			
		}
		
		$data['list'] = $all_data;
	    $ortu=$this->session->userdata('sesId_number');
	    $murid = $this->mparent->cek_murid($ortu)->result();
	    foreach($murid as $mrd);
	       if ($mrd->parent_from!='') $filter=" and s.id_number='".$mrd->parent_from."'";
	       
		$data['list2'] = $this->mparent->list_raport_pub2('',$filter);
		$this->load->view('ajaxReport_list',$data);
	}
	
	
}

