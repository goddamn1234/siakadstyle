<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Student extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('mstudent', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	function students(){
		$this->auth();
		$data = otoritas('student/students',$this->session->userdata('sesRole'));
		$data['parent'] = 'Siswa';
		$data['child'] 	= 'Data Siswa';
		$data['page'] 	= 'data_student';
		$this->load->view('template',$data);
	}
	function ajaxStudent(){
		$this->auth();
		$data = otoritas('student/students',$this->session->userdata('sesRole'));
		$data['list']	= $this->mstudent->studentData();
		$this->load->view('ajaxStudent',$data);
	}
	function faddStudent(){
		$this->auth();
		$data['nationality']= $this->mstudent->nationality(array());
		$this->load->view('faddStudent',$data);
	}
	function proses_student(){
		$this->form_validation->set_rules('id_number','ID card Number','required|numeric');
		$this->form_validation->set_rules('full_name','Full Name','required');
		$this->form_validation->set_rules('spouse_name','Spouse Name','alpha');
		$this->form_validation->set_rules('birth_place','Birth Place','required');
		$this->form_validation->set_rules('birth_date','Birth Date','required');
		$this->form_validation->set_rules('address','Home Address','required');
		$this->form_validation->set_rules('phone1','Phone Number','required');
		$this->form_validation->set_rules('nationality','Nationality','greater_than[0]',array('greater_than'=>'Kolom nationality must be selected'));
		$this->form_validation->set_rules('religion','Religion','greater_than[0]',array('greater_than'=>'Kolom Religion must be selected'));
		$this->form_validation->set_rules('role','Role','greater_than[0]',array('greater_than'=>'Kolom Role must be selected'));
		$this->form_validation->set_rules('asal_sekolah','Asal Sekolah','required');
		$this->form_validation->set_rules('gender','Gender','required');
		
		$config['upload_path']          = './image/student';
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
				'asal_sekolah'	=> $this->input->post('asal_sekolah'),
				'angkatan'	=> $this->input->post('angkatan'),
				'nationality'	=> $this->input->post('nationality'),
				'religion'	=> $this->input->post('religion'),
				'gender'	=> $this->input->post('gender'),
				'password' 	=> sha1(md5('123456')),
				'role' 		=> $this->input->post('role'),
			);
			if($this->upload->do_upload('fFile')){
				$data['image'] = $this->upload->data('file_name');
			}
			if($this->input->post('spouse_name') != NULL){
				$data['spouse_name'] = ucwords(strip_tags($this->input->post('spouse_name')));
			}
			if($this->input->post('nisn') != NULL){
				$data['NISN'] = $this->input->post('nisn');
			}
			if($this->input->post('phone2') != NULL){
				$data['phone2'] = $this->input->post('phone2');
			}
			if($this->input->post('email') != NULL){
				$data['email'] = strtolower(strip_tags($this->input->post('email')));
			}
			if($this->input->post('addm_date') != NULL){
				$data['admission_date'] = date('Y-m-d',strtotime($this->input->post('addm_date')));
			}
			if($this->input->post('blood') != NULL){
				$data['blood_group'] = $this->input->post('blood');
			}
			
			if($this->input->post('id_user') == "kosong"){
				$this->allcrud->insertdata('student',$data);
			}else{
				$flag = array(
					'id_user' => $this->input->post('id_user')
				);
				$this->allcrud->editdata('student',$flag,$data);
			}
			
			$res['status'] = TRUE;
			
		}else{
			$res['status'] = FALSE;
			$res['message'] = validation_errors();
		}
		echo json_encode($res);
		
	}
	
	function feditStudent(){
		$this->auth();
		$flag = array('id_user' => $this->input->post('id'));
		$data['nationality']= $this->mstudent->nationality(array());
		$data['student'] = $this->mstudent->studentData($flag)->row();
		$this->load->view('feditStudent',$data);
	}
	function delStudent($id){
		$flag = array('id_user' => $id);
		$this->allcrud->deletedata('student',$flag);
	}
	
	function actuser($id){
		$flag = array('id_user' => $id);
		$cek = $this->allcrud->getdata('student',$flag,0,1)->row();
		if($cek->status == 'aktif'){
			$this->allcrud->editdata('student',$flag,array('status'=>'tidak aktif'));
		}else{
			$this->allcrud->editdata('student',$flag,array('status'=>'aktif'));
		}
	}
	function resetpas($id){
		$flag = array('id_user'=>$id);
		$data = array ('password'=>sha1(md5('123456')));
		$this->allcrud->editdata('student',$flag,$data);
	}
	
	function assign(){
		$this->auth();
		$data = otoritas('student/assign',$this->session->userdata('sesRole'));
		$data['parent'] = 'Student';
		$data['child'] 	= 'Assign Student';
		$data['page'] 	= 'assign_student';
		$data['student']= $this->mstudent->simpleStudent('id_number, full_name');
		$data['kelas']= $this->mstudent->list_kelas();
		$this->load->view('template',$data);
	}
	
	function ajaxAssign(){
		$this->auth();
		$data = otoritas('student/assign',$this->session->userdata('sesRole'));
		$data['list']	= $this->mstudent->list_assign();
		$this->load->view('ajaxAssign',$data);
	}
	
	function proses_assign(){
		$this->auth();
		$flag = array(
			'id_number' => $this->input->post('id_number'),
			'status' => 'aktif'
		);
		$cek_aktif_student = $this->allcrud->getdata('student_assign',$flag,1,0)->num_rows();
		if($cek_aktif_student != 0){
			$res['status'] ='failed';
			$res['message'] = 'Student with id_number <strong>'.$this->input->post('id_number')."</strong> has being Active";
		}else{
			$data = array(
			'id_number' => $this->input->post('id_number'),
			'id_kelas' => $this->input->post('kelas'),
			'start_date' => date('Y-m-d',strtotime($this->input->post('start'))),
			'author' => $this->session->userdata('sesId')
			);
			$this->allcrud->insertdata('student_assign',$data);
			$res['status'] = 'success';
		}
		echo json_encode($res);
	}
	
	function editAssign($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->mstudent->assignList($flag)->row();
		echo json_encode($q);
	}
	
	function delAssign($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('student_assign',$flag);
	}
	
	function proses_action(){
		$this->form_validation->set_rules('action','Action','required');
		if($this->form_validation->run() == TRUE){
			$action = $this->input->post('action');
			$flag = array(
				'id_assign' => $this->input->post('oid')
			);
			
			switch($action){
				case "mutasi":
				
				$edit = array(
					'status' => 'mutasi',
					'end_date' => date('Y-m-d'),
				);
				if(!empty($this->input->post('info'))){
					$edit['keterangan'] = strip_tags($this->input->post('info'));
				}
				
				$new_class = array(
					'id_number' => $this->input->post('oid_number'),
					'id_kelas'	=> $this->input->post('nkelas'),
					'start_date'=> date('Y-m-d'),
					'author'	=> $this->session->userdata('sesId')
				);
				$this->allcrud->editdata('student_assign',$flag,$edit);
				$this->allcrud->insertdata('student_assign',$new_class);
				
				break;
				
				case "upgrade":
				
				$edit = array(
					'status' => 'upgrade',
					'end_date' => date('Y-m-d'),
				);
				if(!empty($this->input->post('info'))){
					$edit['keterangan'] = strip_tags($this->input->post('info'));
				}
				$this->allcrud->editdata('student_assign',$flag,$edit);
				$new_class = array(
					'id_number' => $this->input->post('oid_number'),
					'id_kelas'	=> $this->input->post('nkelas'),
					'start_date'=> date('Y-m-d'),
					'author'	=> $this->session->userdata('sesId')
				);
				$this->allcrud->insertdata('student_assign',$new_class);
				break;
				
				case "pass":
				
				$edit = array(
					'status' => 'pass',
					'end_date' => date('Y-m-d'),
				);
				if(!empty($this->input->post('info'))){
					$edit['keterangan'] = strip_tags($this->input->post('info'));
				}
				$this->allcrud->editdata('student_assign',$flag,$edit);
				break;
				
				case "out":
				
				$edit = array(
					'status' => 'out',
					'end_date' => date('Y-m-d'),
				);
				if(!empty($this->input->post('info'))){
					$edit['keterangan'] = strip_tags($this->input->post('info'));
				}
				$this->allcrud->editdata('student_assign',$flag,$edit);
				break;
			}
			$res['status'] ='success';
			
		}else{
			$res['status'] ='failed';
			$res['message'] = validation_errors();
		}
		echo json_encode($res);
	}
	
	function report(){
		$this->auth();
		$data = otoritas('student/report',$this->session->userdata('sesRole'));
		$data['parent'] = 'Student';
		$data['child'] 	= 'Report';
		$data['page'] 	= 'data_output';
		$this->load->view('template',$data);
	}
	
	function report_student(){
		$this->auth();
		$data = otoritas('student/report',$this->session->userdata('sesRole'));
		
		$student = $this->allcrud->getdata('student',array('id_number'=>$this->session->userdata('sesId_number')),1,0)->row();
		$all_data = array();
		if(!empty($student)){
			
			$flag = array(
				'published' => 'yes',
				'student' => $student->id_number
			);
			
			$q1 = $this->mstudent->report_student(1,$flag)->result();
			$q2 = $this->mstudent->report_student(2,$flag)->result();
			$q3 = $this->mstudent->report_student(3,$flag)->result();
		}
		
		
		$all_data = array_merge($q1, $q2, $q3);
		
		$data['list'] = $all_data;
		$id_num=$this->session->userdata('sesId_number');
		$filter=" and s.id_number='".$id_num."'";
	       
		$data['list2'] = $this->mstudent->list_raport_pub2('',$filter);
		$this->load->view('ajaxReport_list',$data);
	}
	
	/* assign to student fasilitator */
	function assign_student_fasilitator(){
		$this->auth();
		$data = otoritas('student/assign_student_fasilitator',$this->session->userdata('sesRole'));
		$data['parent'] = 'Student';
		$data['child'] 	= 'Assign Student to Fasilitator';
		$data['page'] 	= 'data_assign_student_fasilitator';
		$data['teacher']= $this->mstudent->list_fasilitator();
		$data['student']= $this->allcrud->listdata('student','id_number ASC');
		$this->load->view('template',$data);		
	}
	
    /* Assign to Fasilitator */
	function ajaxAssign_student_fasilitator(){
		$this->auth();
		$data = otoritas('student/assign_student_fasilitator',$this->session->userdata('sesRole'));
		$data['list']	= $this->mstudent->assign_fasilitator_list();
		$this->load->view('ajaxAssign_student_fasilitator',$data);
	}
	
	function proses_assign_student_fasilitator(){
		$this->auth();
		$data = array(
			'id_assign' => $this->input->post('id'),
			'guru' => $this->input->post('guru'),
			'murid' => $this->input->post('murid')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('student_assign_fasilitator',$flag,$data);
		}else{
			$this->allcrud->insertdata('student_assign_fasilitator',$data);
		}
	}

	function edit_assign_student_fasilitator($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('student_assign_fasilitator',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_student_fasilitator($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('student_assign_fasilitator',$flag);
	}
}

