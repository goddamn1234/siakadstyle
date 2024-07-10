<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Principal extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mprincipal', '', true);
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
	public function info()
	{
		$this->auth();
		$data = otoritas('principal/info', $this->session->userdata('sesRole'));
		$data['parent'] = 'principal';
		$data['child'] = 'Data principal';
		$data['page'] = 'data_principal';
		$this->load->view('template', $data);
	}
	public function ajaxprincipal()
	{
		$this->auth();
		$data = otoritas('principal/info', $this->session->userdata('sesRole'));
		$data['list'] = $this->mprincipal->principalData();
		$this->load->view('ajaxPrincipal', $data);
	}
	public function faddprincipal()
	{
		$this->auth();
		$data['nationality'] = $this->mprincipal->nationality(array());
		$this->load->view('faddPrincipal', $data);
	}
	public function proses_principal()
	{
		
		$this->form_validation->set_rules('id_number', 'ID card Number', 'required|numeric');
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('spouse_name', 'Spouse Name', 'alpha');
		$this->form_validation->set_rules('birth_place', 'Birth Place', 'required|alpha');
		$this->form_validation->set_rules('birth_date', 'Birth Date', 'required');
		$this->form_validation->set_rules('address', 'Home Address', 'required');
		$this->form_validation->set_rules('phone1', 'Phone Number', 'required');
		$this->form_validation->set_rules('nationality', 'Nationality', 'greater_than[0]', array('greater_than' => 'Kolom nationality must be selected'));
		$this->form_validation->set_rules('religion', 'Religion', 'greater_than[0]', array('greater_than' => 'Kolom Religion must be selected'));
		$this->form_validation->set_rules('role', 'Role', 'greater_than[0]', array('greater_than' => 'Kolom Role must be selected'));
		
		$config['upload_path'] = './image/principal';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 200000;
		$config['file_name'] = $this->input->post('id_number');
		$this->load->library('upload', $config);
		$res = array();
		if ($this->form_validation->run() == true) {
			$data = array(
				'id_number' => $this->input->post('id_number'),
				'full_name' => ucwords(strip_tags($this->input->post('full_name'))),
				'birth_place' => $this->input->post('birth_place'),
				'birth_date' => date('Y-m-d', strtotime($this->input->post('birth_date'))),
				'address' => strip_tags($this->input->post('address')),
				'phone1' => $this->input->post('phone1'),
				'nationality' => $this->input->post('nationality'),
				'religion' => $this->input->post('religion'),
				'password' => sha1(md5('123456')),
				'role' => $this->input->post('role'),
			);

			
			if ($this->upload->do_upload('fFile')) {
				$data['image'] = $this->upload->data('file_name');
			}
			if ($this->upload->do_upload('fFile_sign')) {
				$data['signature'] = $this->upload->data('file_name');
			}
			if ($this->input->post('spouse_name') != null) {
				$data['spouse_name'] = ucwords(strip_tags($this->input->post('spouse_name')));
			}
			if ($this->input->post('phone2') != null) {
				$data['phone2'] = $this->input->post('phone2');
			}
			
			if ($this->input->post('id_user') == "kosong") {
				$this->allcrud->insertdata('principal', $data);
			} else {
				$flag = array(
					'id_user' => $this->input->post('id_user'),
				);
				$this->allcrud->editdata('principal', $flag, $data);
			}
			
			$res['status'] = true;
			
		} else {
			$res['status'] = false;
			$res['message'] = validation_errors();
		}
		echo json_encode($res);
		
	}
	
	public function feditprincipal()
	{
		$this->auth();
		$flag = array('id_user' => $this->input->post('id'));
		$data['nationality'] = $this->mprincipal->nationality(array());
		$data['principal'] = $this->mprincipal->principalData($flag)->row();
		$this->load->view('feditPrincipal', $data);
	}
	public function delprincipal($id)
	{
		$flag = array('id_user' => $id);
		$this->allcrud->deletedata('principal', $flag);
	}
	
	public function actuser($id)
	{
		$flag = array('id_user' => $id);
		$cek = $this->allcrud->getdata('principal', $flag, 0, 1)->row();
		if ($cek->status == 'aktif') {
			$this->allcrud->editdata('principal', $flag, array('status' => 'tidak aktif'));
		} else {
			$this->allcrud->editdata('principal', $flag, array('status' => 'aktif'));
		}
	}
	public function resetpas($id)
	{
		$flag = array('id_user' => $id);
		$data = array('password' => sha1(md5('123456')));
		$this->allcrud->editdata('principal', $flag, $data);
	}
	
	public function raport()
	{
		$this->auth();
		$data = otoritas('principal/raport', $this->session->userdata('sesRole'));
		$data['parent'] = 'principal';
		$data['child'] = 'Data Raport';
		$data['page'] = 'raport';
		$this->load->view('template', $data);
	}
	public function ajaxRaport()
	{
		$this->auth();
		$data = otoritas('principal/raport', $this->session->userdata('sesRole'));
		$data['list'] = $this->mprincipal->data_kelas();
		$this->load->view('ajaxRaport', $data);
	}
	
	public function view_student($id)
	{
		$data = otoritas('principal/raport', $this->session->userdata('sesRole'));
		$data['student'] = $this->mprincipal->assignList(array('student_assign.id_kelas' => $id));
		$data['grade'] = $this->allcrud->getData('kelas', array('id_kelas' => $id), 1, 0)->row();
		$this->load->view('ajaxStudent', $data);
	}
	
	public function raport_view()
	{
		$id_number = $this->input->post('id_number');
		$grade = $this->input->post('grade');
		
		switch ($grade) {
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
		$periode = $this->allcrud->getData('raport_periode', array('status' => 'active'), 1, 0)->row();
		$flag = array(
			'result.student' => $id_number,
			'raport_periode' => $periode->id_raport_periode,
		);
		$data['grade'] = $grade;
		$data['student'] = $this->mprincipal->student_data($table, array('student.id_number' => $id_number))->row();
		$data['pmd'] = $this->mprincipal->pmd_result($table, $pmd, $flag);
		$data['raport'] = $this->mprincipal->raport_result($table, $detail, $flag);
		$data['result'] = $this->allcrud->getData($table, array('student' => $id_number, 'raport_periode' => $periode->id_raport_periode), 1, 0)->row();
		
		$this->load->view('raport/student_raport', $data);
	}
	
	public function revisi_by_principal()
	{
		$id_raport_detail = $this->input->post('id_raport_detail');
		$grade = $this->input->post('grade');
		$revisi = $this->input->post('result');
		
		switch ($grade) {
			case 1:
			$table = 'raport_detail_y1';
			$result = 'raport_result_y1';
			break;
			case 2:
			$table = 'raport_detail_y2';
			$result = 'raport_result_y2';
			break;
			case 3:
			$table = 'raport_detail_y3';
			$result = 'raport_result_y3';
			break;
		}
		$flag = array('id_raport_detail' => $id_raport_detail);
		$edit = array('result' => $revisi);
		
		$this->allcrud->editdata($table, $flag, $edit);
		
		$id_result = $this->allcrud->getData($table, $flag, 1, 0)->row();
		$hasil = $this->mprincipal->last_result($table, array('raport_result' => $id_result->raport_result, 'result' => 'success'));
		
		$this->allcrud->editdata($result, array('id_raport_result' => $id_result->raport_result), array('result' => $hasil->hasil));
		
		$res['new_result'] = $hasil->hasil;
		echo json_encode($res);
	}
	
	public function revisi_user_learning_by_principal()
	{
		$id_learning = $this->input->post('id_learning');
		$id_raport_result = $this->input->post('id_raport_result');
		$grade = $this->input->post('grade');
		$revisi = $this->input->post('result');
		
		switch ($grade) {
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
		$flag = array('id_learning' => $id_learning);
		$edit = array('pmd_result' => $revisi);
		
		$this->allcrud->editdata($table, $flag, $edit);
		
		$result = $this->mprincipal->last_result_pmd($table, array('pmd.id_raport_result' => $id_raport_result, 'pmd.pmd_result' => 'Y'));
		
		if ($result->nilai == 0) {
			$result_pmd = 'pass';
		} else {
			$result_pmd = $result->flag_pmd;
		}
		$this->allcrud->editdata($raport_result, array('id_raport_result' => $id_raport_result), array('result_pmd' => $result_pmd));
		$res['learning_result'] = $result->flag_pmd;
		echo json_encode($res);
	}
	
	public function editKeterangan()
	{
		// echo json_encode($_POST);
		// exit;
		$grade = $this->input->post('grade');
		switch ($grade) {
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
			'id_raport_result' => $this->input->post('id_raport_result'),
		);
		$data = array(
			'keterangan' => strip_tags($this->input->post('ket')),
		);
		$this->allcrud->editdata($result, $flag, $data);
		
		$res['message'] = 'Data berhasil di update';
		echo json_encode($res);
	}
	
	public function submit_principal()
	{
		$id_number = $this->input->post('id_number');
		$grade = $this->input->post('grade');
		switch ($grade) {
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
		$periode = $this->allcrud->getData('raport_periode', array('status' => 'active'), 1, 0)->row();
		$flag = array(
			'student' => $id_number,
			'raport_periode' => $periode->id_raport_periode,
		);
		$edit = array(
			'submit_principle' => 1,
		);
		if (!empty($this->input->post('note'))) {
			$edit['keterangan_by_pr'] = $this->input->post('note');
			
		}
		$this->allcrud->editdata($table, $flag, $edit);
	}
	
}
