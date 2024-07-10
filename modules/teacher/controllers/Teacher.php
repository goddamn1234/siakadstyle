<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Teacher extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('mteacher', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	function teachers(){
		$this->auth();
		$data = otoritas('teacher/teachers',$this->session->userdata('sesRole'));
		$data['parent'] = 'Pengajar';
		$data['child'] 	= 'Data Spesialis';
		$data['page'] 	= 'data_teachers';
		$this->load->view('template',$data);
	}
	function ajaxTeachers(){
		$this->auth();
		$data = otoritas('teacher/teachers',$this->session->userdata('sesRole'));
		$data['list']	= $this->mteacher->teacherData();
		$this->load->view('ajaxTeacher',$data);
	}
	function faddTeacher(){
		$this->auth();
		$data['nationality']= $this->mteacher->nationality(array());
		$this->load->view('teacher/faddTeacher',$data);
	}
	function proses_teacher(){
		$this->form_validation->set_rules('id_number','ID card Number','required|numeric');
		$this->form_validation->set_rules('full_name','Full Name','required');
		$this->form_validation->set_rules('spouse_name','Spouse Name','alpha');
		$this->form_validation->set_rules('birth_place','Birth Place','required|alpha');
		$this->form_validation->set_rules('birth_date','Birth Date','required');
		$this->form_validation->set_rules('address','Home Address','required');
		$this->form_validation->set_rules('phone1','Phone Number','required');
		$this->form_validation->set_rules('nationality','Nationality','greater_than[0]',array('greater_than'=>'Kolom nationality must be selected'));
		$this->form_validation->set_rules('religion','Religion','greater_than[0]',array('greater_than'=>'Kolom Religion must be selected'));
		$this->form_validation->set_rules('role','Role','greater_than[0]',array('greater_than'=>'Kolom Role must be selected'));
		$this->form_validation->set_rules('ktp','KTP / SIM Number','required|numeric');
		$this->form_validation->set_rules('gender','Gender','required');
		
		$config['upload_path']          = './image/teacher';
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
				'no_identitas'	=> $this->input->post('ktp'),
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
			if($this->input->post('phone2') != NULL){
				$data['phone2'] = ucwords(strip_tags($this->input->post('phone2')));
			}
			if($this->input->post('email') != NULL){
				$data['email'] = strtolower(strip_tags($this->input->post('email')));
			}
			if($this->input->post('join_date') != NULL){
				$data['joining_date'] = date('Y-m-d',strtotime($this->input->post('join_date')));
			}
			if($this->input->post('university') != NULL){
				$data['university'] = strip_tags($this->input->post('university'));
			}
			if($this->input->post('marital') != '0'){
				$data['marital_status'] = $this->input->post('marital');
			}
			
			if($this->input->post('id_user') == "kosong"){
				$this->allcrud->insertdata('guru',$data);
			}else{
				$flag = array(
					'id_user' => $this->input->post('id_user')
				);
				$this->allcrud->editdata('guru',$flag,$data);
			}
			
			$res['status'] = TRUE;
			
		}else{
			$res['status'] = FALSE;
			$res['message'] = validation_errors();
		}
		echo json_encode($res);
		
	}
	
	function feditTeacher(){
		$this->auth();
		$flag = array('id_user' => $this->input->post('id'));
		$data['nationality']= $this->mteacher->nationality(array());
		$data['teacher'] = $this->mteacher->teacherData($flag)->row();
		$this->load->view('feditTeacher',$data);
	}
	function delTeacher($id){
		$flag = array('id_user' => $id);
		$this->allcrud->deletedata('guru',$flag);
	}
	
	function actuser($id){
		$flag = array('id_user' => $id);
		$cek = $this->allcrud->getdata('guru',$flag,0,1)->row();
		if($cek->status == 'aktif'){
			$this->allcrud->editdata('guru',$flag,array('status'=>'tidak aktif'));
		}else{
			$this->allcrud->editdata('guru',$flag,array('status'=>'aktif'));
		}
	}
	function resetpas($id){
		$flag = array('id_user'=>$id);
		$data = array ('password'=>sha1(md5('123456')));
		$this->allcrud->editdata('guru',$flag,$data);
	}
	
	function assign(){
		$this->auth();
		$data = otoritas('teacher/assign',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teachers';
		$data['child'] 	= 'Assign Teacher';
		$data['page'] 	= 'assign_teachers';
		$data['teacher']= $this->mteacher->simpleTeacher('id_number, full_name');
		$data['kelas']= $this->allcrud->listdata('kelas','nama_kelas ASC');
		$data['mapel']= $this->allcrud->listdata('mata_pelajaran','nama_mapel ASC');
		$this->load->view('template',$data);
	}
	function ajaxAssign(){
		$this->auth();
		$data = otoritas('teacher/assign',$this->session->userdata('sesRole'));
		$data['list']	= $this->mteacher->assignList();
		$this->load->view('ajaxAssign',$data);
	}
	
	function proses_assign(){
		$this->auth();
		$data = array(
			'id_number' => $this->input->post('id_number'),
			'id_kelas' => $this->input->post('kelas'),
			'id_mapel' => $this->input->post('mapel'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('guru_assign',$flag,$data);
		}else{
			$this->allcrud->insertdata('guru_assign',$data);
		}
		
	}
	
	function editAssign($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->mteacher->assignList($flag)->row();
		echo json_encode($q);
	}
	
	function delAssign($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('guru_assign',$flag);
	}
	
	function homeroom(){
		$this->auth();
		$data = otoritas('teacher/homeroom',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teachers';
		$data['child'] 	= 'HomeRoom';
		$data['page'] 	= 'homeroom/homeroom';
		$flag = array('wali_kelas'=>$this->session->userdata('sesId_number'));
		$data['class']	= $this->allcrud->listdata('kelas','nama_kelas ASC',$flag);
		$this->load->view('template',$data);
	}
	
	function raport_list($id){
		$flag = array(
			'id_kelas' => $id,
			'student_assign.status' => 'aktif',
			'raport_periode.status' => 'active'
		);
		$field = $this->allcrud->getData('kelas',array('id_kelas'=>$id),1,0)->row();
		switch ($field->tingkat){
			case 1:
				$table = 'raport_result_y1';
				break;
			case 2:
				$table = 'raport_result_y2';
				break;
			case 3:
				$table = 'raport_result_y3';
				break;
		}
		$data = otoritas('teacher/homeroom',$this->session->userdata('sesRole'));
		$data['grade']	= $field->tingkat;
		$data['student']	= $this->mteacher->student_list($table,$flag);
		$this->load->view('homeroom/student_list',$data);
	}
	
	function raport_view(){
		$id_number = $this->input->post('id_number');
		$grade = $this->input->post('grade');
		
		switch ($grade){
			case 1:
				$pmd = 'raport_learning_y1';
				$table = 'raport_result_y1';
				$detail = 'raport_detail_y1';
				break;
			case 2:
				$pmd = 'raport_learning_y2';
				$table = 'raport_result_y2';
				$detail = 'raport_detail_y2';
				break;
			case 3:
				$pmd = 'raport_learning_y3';
				$table = 'raport_result_y3';
				$detail = 'raport_detail_y3';
				break;
		}
		$periode = $this->allcrud->getData('raport_periode',array('status'=>'active'),1,0)->row();
		$flag = array(
			'result.student' => $id_number,
			'raport_periode' => $periode->id_raport_periode
		);
		$page_view = 'student_raport';
		$data['grade']	= $grade;
		$data['student']	= $this->mteacher->student_data($table,array('student.id_number'=>$id_number))->row();
		$data['pmd'] = $this->mteacher->pmd_result($table,$pmd,$flag);
		$data['raport'] = $this->mteacher->raport_result($table,$detail,$flag);
		if($grade == 3){
			$data['raport'] = $this->mteacher->raport_fmp_result($flag);
			// echo '<pre>';
			// var_dump($data['raport']->result());
			// exit;
			$data['raport2'] = $this->mteacher->dataRaportList($table, $flag)->result();
			
			$page_view = 'student_raport_y3';
		}
		// echo $this->db->last_query();
		// exit;
		$data['result'] = $this->allcrud->getData($table,array('student'=>$id_number,'raport_periode'=>$periode->id_raport_periode),1,0)->row();
		
		$this->load->view("homeroom/{$page_view}",$data);
	}
	
	function submit_teacher_co(){
		$id_number = $this->input->post('id_number');
		$grade = $this->input->post('grade');
		switch ($grade){
			case 1:
			
				$table = 'raport_result_y1';
			
				break;
			case 2:
			
				$table = 'raport_result_y2';
			
				break;
			case 3:
			
				$table = 'raport_result_y3';
			
				break;
		}
		$periode = $this->allcrud->getData('raport_periode',array('status'=>'active'),1,0)->row();
		$flag = array(
			'student' => $id_number,
			'raport_periode' => $periode->id_raport_periode
		);
		$edit = array(
			'submit_teacher_co'=>1
		);
		if(!empty($this->input->post('note'))){
			$edit['keterangan_by_hr'] = $this->input->post('note');
		}
		$this->allcrud->editdata($table,$flag,$edit);
	}
	
	function revisi_by_homeroom(){
		$id_raport_detail = $this->input->post('id_raport_detail');
		$id_raport_fmp = $this->input->post('id_raport_fmp');
		$id_raport_result = $this->input->post('id_raport_result');
		$grade = $this->input->post('grade');
		$revisi = $this->input->post('result');
		
		switch ($grade){
			case 1:	
				$table = 'raport_detail_y1';
				$result = 'raport_result_y1';
				break;
			case 2:
				$table = 'raport_detail_y2';
				$result = 'raport_result_y2';
				break;
			case 3:
				$this->save_fmp($id_raport_result, $id_raport_fmp, $revisi);
				break;
		}
		$flag = array('id_raport_detail'=>$id_raport_detail);
		$edit = array('result'=>$revisi);
		
		$this->allcrud->editdata($table,$flag,$edit);
		
		$id_result = $this->allcrud->getData($table,$flag,1,0)->row();
		$hasil = $this->mteacher->last_result($table,array('raport_result'=>$id_result->raport_result,'result'=>'success'));
		
		$this->allcrud->editdata($result,array('id_raport_result'=>$id_result->raport_result),array('result'=>$hasil->hasil));
		
		$res['new_result'] = $hasil->hasil;
		echo json_encode($res);
	}

	public function save_fmp($id_raport_result, $id_raport_fmp, $result_form){
		$flag = array('id_raport_fmp' => $id_raport_fmp);
		
		$edit = array('fmp_result'=> $result_form);
		
		$this->allcrud->editdata('raport_fmp',$flag,$edit);
		
		$pass = $this->mteacher->last_result_fmp(array('raport_result'=>$id_raport_result,'flag_fmp'=>'pass'),FALSE)->row();
		$merit = $this->mteacher->last_result_fmp(array('raport_result'=>$id_raport_result,'flag_fmp'=>'merit'),FALSE)->row();
		$distinction = $this->mteacher->last_result_fmp(array('raport_result'=>$id_raport_result,'flag_fmp'=>'distinction'),FALSE)->row();
		
		if($pass->target == 'yes' && $merit->target == 'yes' && $distinction->sukses > 0){
			$this->allcrud->editdata('raport_result_y3',array('id_raport_result'=>$id_raport_result),array('result_fmp'=>'distinction'));
			$res['last_result'] = 'distinction';
			$res['enable'] = 'distinction';
		}elseif($pass->target == 'yes' && $merit->sukses > 0){
			$this->allcrud->editdata('raport_result_y3',array('id_raport_result'=>$id_raport_result),array('result_fmp'=>'merit'));
			$res['last_result'] = 'merit';
			$res['enable'] = 'merit';
		}elseif($pass->sukses > 0){
			$this->allcrud->editdata('raport_result_y3',array('id_raport_result'=>$id_raport_result),array('result_fmp'=>'pass'));
			$res['last_result'] = 'pass';
			$res['enable'] = 'pass';
		}else{
			$this->allcrud->editdata('raport_result_y3',array('id_raport_result'=>$id_raport_result),array('result_fmp'=>'none'));
			$res['enable'] = 'pass';
			$res['last_result'] = 'none';
		}
		
		echo json_encode($res);
		exit;
		
	}

	function revisi_score_result_by_homeroom(){
		$id_mapel = $this->input->post('id_mapel');
		$target = $this->allcrud->getData('mata_pelajaran',array('id_mapel'=>$id_mapel),1,0)->row();
		$grade = $this->input->post('grade');
		
		
		switch($grade){
			case 1:
				$result = 'raport_result_y1';
				break;
			case 2:
				$result = 'raport_result_y2';
				break;
			case 3:
				$result = 'raport_result_y3';
				break;
		}
		
		$edit = array(
			'keterangan' => $this->input->post('note'),
			'score' => $this->input->post('score')
		);
		if($target->achiev_point <= $this->input->post('score')){
			$edit['result'] = 'pass';
		}else{
			$edit['result'] = 'not accomplished';
		}

		$flag = array('id_raport_result' => $this->input->post('id_raport_result'));
		$res['success'] = $this->allcrud->editdata($result, $flag, $edit);
		echo json_encode($res);
	}

	function revisi_user_learning_by_homeroom(){
		$id_learning = $this->input->post('id_learning');
		$id_raport_result = $this->input->post('id_raport_result');
		$grade = $this->input->post('grade');
		$revisi = $this->input->post('result');
		
		// var_dump($id_learning);
		// var_dump($id_raport_result);
		// var_dump($grade);
		// var_dump($revisi);
		// exit;

		switch ($grade){
			case 1:	
				$table = 'raport_learning_y1';
				$raport_result = 'raport_result_y1';
				break;
			case 2:
				$table = 'raport_learning_y2';
				$raport_result = 'raport_result_y2';
				break;
			case 3:
				$table = 'raport_learning_y3';
				$raport_result = 'raport_result_y3';
				break;
		}
		$flag = array('id_learning'=>$id_learning);
		$edit = array('pmd_result'=>$revisi);
		
		$this->allcrud->editdata($table,$flag,$edit);
		
		$result = $this->mteacher->last_result_pmd($table,array('pmd.id_raport_result'=>$id_raport_result,'pmd.pmd_result'=>'Y'));
		// var_dump($result);
		// exit;
		if($result->nilai == 0){
			$result_pmd = 'pass';
		}else{
			$result_pmd = $result->flag_pmd;
		}
		$this->allcrud->editdata($raport_result,array('id_raport_result'=>$id_raport_result),array('result_pmd'=>$result_pmd));
		$res['learning_result'] = $result->flag_pmd;
		echo json_encode($res);
	}
	
	public function editKeterangan(){
		
		$grade = $this->input->post('grade');
		switch ($grade){
			case 1:	
				$result = 'raport_result_y1';
				break;
			case 2:
				$result = 'raport_result_y2';
				break;
			case 3:
				$result = 'raport_result_y3';
				break;
		}
		
		$flag = array(
			'id_raport_result' => $this->input->post('id_raport_result')
		);
		$data = array(
			'keterangan' => strip_tags($this->input->post('ket'))
		);
		$this->allcrud->editdata($result,$flag,$data);
		$res['message'] = 'Data berhasil di update';
		echo json_encode($res);
	}
	
/*assign to staf & devisi*/

    function assign_staf_devisi(){
    	$this->auth();
		$data = otoritas('teacher/assign',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teachers';
		$data['child'] 	= 'Assign Teacher to Staff and Divisi';
		$data['page'] 	= 'assign_staf_divisi';
		$data['teacher']= $this->mteacher->simpleTeacher('id_user,id_number, full_name');
		$data['staf']= $this->allcrud->listdata('staf','nama_staf ASC');
		$data['divisi']= $this->allcrud->listdata('divisi','nama_divisi ASC');
		$this->load->view('template',$data);
	}
	
	function ajaxAssign_staf_divisi(){
		$this->auth();
		$data = otoritas('teacher/assign',$this->session->userdata('sesRole'));
		$data['list']	= $this->mteacher->teacher_staf_div();
		$this->load->view('ajaxAssign_staf_divisi',$data);
	}
	
	function proses_assign_staf_divisi(){
		$this->auth();
		$data = array(
			'id_number' => $this->input->post('id_number'),
			'staf' => $this->input->post('staf'),
			'divisi' => $this->input->post('divisi'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('guru_assign_staf',$flag,$data);
		}else{
			$this->allcrud->insertdata('guru_assign_staf',$data);
		}
		
	}
	
	function editAssign_staf_divisi($id){
		$flag = array('id_assign'=>$id);
		$q = $this->mteacher->assignList($flag)->row();
		echo json_encode($q);
	}
	
	function delAssign_staf_divisi($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('guru_assign_staf',$flag);
	}
	
/* specialist */

	function specialist(){
		$this->auth();
		$data = otoritas('teacher/specialist',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teacher';
		$data['child'] 	= 'Specialist';
		$data['page'] 	= 'data_specialist';
		$this->load->view('template',$data);		
	}

	function ajaxSpecialist(){
		$this->auth();
		$data = otoritas('teacher/specialist',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('specialist','nama_special ASC',array());
		$this->load->view('ajaxSpecialist',$data);
	}
	
	function proses_specialist(){
		$this->auth();
		$data = array(
			'nama_special' => ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_special'=>$this->input->post('id'));
			$this->allcrud->editdata('specialist',$flag,$data);
		}else{
			$this->allcrud->insertdata('specialist',$data);
		}
		
	}

	function edit_specialist($id){
		
		$flag = array('id_special'=>$id);
		$q = $this->allcrud->getData('specialist',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delSpecialist($id){
		$flag = array('id_special' => $id);
		$this->allcrud->deletedata('specialist',$flag);
	}
	
	/* Guru Tamu */
	function guru_tamu(){
		$this->auth();
		$data = otoritas('teacher/guru_tamu',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teacher';
		$data['child'] 	= 'Guru Tamu';
		$data['page'] 	= 'data_guru_tamu';
		$this->load->view('template',$data);		
	}

	function ajaxGuru_tamu(){
		$this->auth();
		$data = otoritas('teacher/guru_tamu',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('guru_tamu','nama_guru_tamu ASC',array());
		$this->load->view('ajaxGuru_tamu',$data);
	}
	
	function proses_guru_tamu(){
		$this->auth();
		$data = array(
			'nama_guru_tamu' => ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_guru_tamu'=>$this->input->post('id'));
			$this->allcrud->editdata('guru_tamu',$flag,$data);
		}else{
			$this->allcrud->insertdata('guru_tamu',$data);
		}
		
	}

	function edit_guru_tamu($id){
		
		$flag = array('id_guru_tamu'=>$id);
		$q = $this->allcrud->getData('guru_tamu',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delGuru_tamu($id){
		$flag = array('id_guru_tamu' => $id);
		$this->allcrud->deletedata('guru_tamu',$flag);
	}
	
/* assign to specialist */
	function assign_guru_specialist(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_specialist',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teacher';
		$data['child'] 	= 'Assign Guru to Specialist';
		$data['page'] 	= 'data_assign_guru_specialist';
		$data['teacher']= $this->mteacher->simpleTeacher('id_user,id_number, full_name');
		$data['specialist']= $this->allcrud->listdata('specialist','nama_special ASC');
		$this->load->view('template',$data);		
	}

	function ajaxAssign_guru_specialist(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_specialist',$this->session->userdata('sesRole'));
		$data['list']	= $this->mteacher->teacher_specialist();
		$this->load->view('ajaxAssign_guru_specialist',$data);
	}
	
	function proses_assign_guru_specialist(){
		$this->auth();
		$data = array(
			'guru' => $this->input->post('guru'),
			'specialist' => $this->input->post('specialist')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('assign_guru_specialist',$flag,$data);
		}else{
			$this->allcrud->insertdata('assign_guru_specialist',$data);
		}
		
	}

	function edit_assign_guru_specialist($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('assign_guru_specialist',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_guru_specialist($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('assign_guru_specialist',$flag);
	}
	
/* assign to guru tamu */
	function assign_guru_tamu(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_tamu',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teacher';
		$data['child'] 	= 'Assign Guru to Guru Tamu';
		$data['page'] 	= 'data_assign_guru_tamu';
		$data['teacher']= $this->mteacher->simpleTeacher('id_user,id_number, full_name');
		$data['tamu']= $this->allcrud->listdata('guru_tamu','nama_guru_tamu ASC');
		$this->load->view('template',$data);		
	}

	function ajaxAssign_guru_tamu(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_tamu',$this->session->userdata('sesRole'));
		$data['list']	= $this->mteacher->teacher_tamu();
		$this->load->view('ajaxAssign_guru_tamu',$data);
	}
	
	function proses_assign_guru_tamu(){
		$this->auth();
		$data = array(
			'guru' => $this->input->post('guru'),
			'tamu' => $this->input->post('tamu')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('assign_guru_tamu',$flag,$data);
		}else{
			$this->allcrud->insertdata('assign_guru_tamu',$data);
		}
		
	}

	function edit_assign_guru_tamu($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('assign_guru_tamu',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_guru_tamu($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('assign_guru_tamu',$flag);
	}
	
	/* assign to guru fasilitator */
	function assign_guru_fasilitator(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_fasilitator',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teacher';
		$data['child'] 	= 'Assign Teacher to Fasilitator';
		$data['page'] 	= 'data_assign_guru_fasilitator';
		$data['teacher']= $this->mteacher->simpleTeacher('id_user,id_number, full_name');
		$data['kelas']= $this->allcrud->listdata('kelas','nama_kelas ASC');
		$this->load->view('template',$data);		
	}

	function ajaxAssign_guru_fasilitator(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_fasilitator',$this->session->userdata('sesRole'));
		$data['list']	= $this->mteacher->teacher_fasilitator();
		$this->load->view('ajaxAssign_guru_fasilitator',$data);
	}
	
	function proses_assign_guru_fasilitator(){
		$this->auth();
		$guru=$this->input->post('guru');
		$teacher_list=$this->mteacher->teacher_number($guru);
		foreach($teacher_list->result() as $teacher_data);
		$id_guru = $teacher_data->id_number;
		$data = array(
			'guru' => $guru
		);
     	$config['upload_path']          = './image/signature/fasil';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200000;
		$config['file_name']            = $id_guru;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('fFile')){
			$data['image_ttd'] = $this->upload->data('file_name');
		}
		
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('guru_assign_fasilitator',$flag,$data);
		}else{
			$this->allcrud->insertdata('guru_assign_fasilitator',$data);
		}
	}

	function edit_assign_guru_fasilitator($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('guru_assign_fasilitator',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_guru_fasilitator($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('guru_assign_fasilitator',$flag);
	}
	
	/* assign to guru final corrector */
	function assign_guru_final_corrector(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_final_corrector',$this->session->userdata('sesRole'));
		$data['parent'] = 'Teacher';
		$data['child'] 	= 'Assign Teacher to Final Corector';
		$data['page'] 	= 'data_assign_guru_final_corrector';
		$data['teacher']= $this->mteacher->simpleTeacher('id_user,id_number, full_name');
		$this->load->view('template',$data);		
	}

	function ajaxAssign_guru_final_corrector(){
		$this->auth();
		$data = otoritas('teacher/assign_guru_final_corrector',$this->session->userdata('sesRole'));
		$data['list']	= $this->mteacher->teacher_final_corrector();
		$this->load->view('ajaxAssign_guru_final_corrector',$data);
	}
	
	function proses_assign_guru_final_corrector(){
		$this->auth();
		$data = array(
			'id_assign' => $this->input->post('id'),
			'guru' => $this->input->post('guru')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('guru_assign_final_corrector',$flag,$data);
		}else{
			$this->allcrud->insertdata('guru_assign_final_corrector',$data);
		}
	}

	function edit_assign_guru_final_corrector($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('guru_assign_final_corrector',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_guru_final_corrector($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('guru_assign_final_corrector',$flag);
	}
}