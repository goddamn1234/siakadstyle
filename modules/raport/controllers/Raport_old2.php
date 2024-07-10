<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Raport extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('mraport', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
			exit();
		}
	}
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
			exit();
		}
	}
	function periode(){
		$this->auth();
		$data = otoritas('raport/periode',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport';
		$data['child'] 	= 'Periode Raport';
		$data['page'] 	= 'periode/data_periode';
		$this->load->view('template',$data);
	}
	function ajaxPeriode(){
		$this->auth();
		$data = otoritas('raport/periode',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('raport_periode','id_raport_periode ASC',array());
		$this->load->view('periode/ajaxPeriode',$data);
	}
	function proses_periode(){
		$this->auth();
		
		$data = array(
		    $tgl_awal=
			'periode' => $this->input->post('periode'),
			'tahun_akademik' => str_replace('_','',$this->input->post('academic')),
			'status'=> $this->input->post('status'),
			'kepsek'=> $this->input->post('kepsek'),
			'awal'=> date('Y-m-d',strtotime($this->input->post('awal'))),
			'akhir'=> date('Y-m-d',strtotime($this->input->post('akhir'))),
			'tgl_raport'=> date('Y-m-d',strtotime($this->input->post('tgl_raport')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_raport_periode'=>$this->input->post('id'));
			$this->allcrud->editdata('raport_periode',$flag,$data);
			$res['status'] = 'success';
			$res['message'] = 'Data berhaasil dirubah';
		}else{
			$flag = array('status'=>'active');
			$cek = $this->allcrud->getdata('raport_periode',$flag,1,0);
			if($cek->num_rows() == 0){
				$this->allcrud->insertdata('raport_periode',$data);
				$res['status'] = 'success';
				$res['message'] = 'Data berhasil ditambahkan';
			}else{
				$res['status'] = 'failed';
				$res['message'] = 'Data Gagal ditambahkan';
			}
			
		}
		echo json_encode($res);
	}
	function editPeriode($id){
		
		$flag = array('id_raport_periode'=>$id);
		$q = $this->allcrud->getData('raport_periode',$flag,1,0)->row();
		echo json_encode($q);
	}
	function delPeriode($id){
		$flag = array('id_raport_periode' => $id);
		$this->allcrud->deletedata('raport_periode',$flag);
	}
	
	function actPeriode($id){
		$flag = array('id_raport_periode' => $id);
		$flag2 = array('status' => 'active');
		$cek = $this->allcrud->getdata('raport_periode',$flag,1,0)->row();
		$getData = $this->allcrud->getdata('raport_periode',$flag2,1,0);
		if($cek->status == 'active'){
			$this->allcrud->editdata('raport_periode',$flag,array('status'=>'finish'));
		}else{
			if($getData->num_rows() == 0){
				$this->allcrud->editdata('raport_periode',$flag,array('status'=>'active'));
			}else{
				$this->allcrud->editdata('errorrr',$flag,array('status'=>'active'));
			}
		}
	}
	
	function result(){
		$this->auth();
		$data = otoritas('raport/result',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport';
		$data['child'] 	= 'Raport Result';
		$data['page'] 	= 'result/index_result';
		$data['kelas'] = $this->mraport->assignClass(array('id_number'=>$this->session->userdata('sesId_number')));
		$this->load->view('template',$data);
	}
	
	function point($id){
		$flag = array('id_assign' =>$id);
		$field = $this->mraport->assignClass($flag)->row();
		$periode = $this->allcrud->getdata('raport_periode',array('status'=>'active'),1,0)->row();
		$flag2 = array(
			'mapel' => $field->id_mapel,
			'kelas' => $field->id_kelas,
			'raport_periode' => $periode->id_raport_periode
		);
		
		switch($field->tingkat){
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
		$is_exist = $this->allcrud->listdata($table,'id_raport_result ASC',$flag2);
		// Jika tidak ada data pada raport_result, maka lakukan insert data
		if($is_exist->num_rows() == 0){
			$student = $this->allcrud->listdata('student_assign','id_number ASC',array('id_kelas'=>$field->id_kelas,'status'=>'aktif'));
			foreach($student->result() as $populate){
				$add = array(
					'mapel' => $field->id_mapel,
					'kelas' => $field->id_kelas,
					'student' => $populate->id_number,
					'raport_periode' => $periode->id_raport_periode
				);
				$this->allcrud->insertdata($table,$add);
			}
		}
		$filter = array(
			$table.'.kelas' => $field->id_kelas,
			$table.'.mapel' => $field->id_mapel,
			'raport_periode.status' => 'active'
		);
		$output = otoritas('raport/result',$this->session->userdata('sesRole'));
		$output['id_assign'] = $id;
		$output['raport'] = $this->mraport->raport_point($table,$filter);
		
		$this->load->view('result/ajaxResult',$output);
		
	}
	
	function nilai(){
		$id_assign = $this->input->post('id_assign');
		$id_raport_result = $this->input->post('id_raport_result');
		$flag = array('id_assign' =>$id_assign);
		$field = $this->mraport->assignClass($flag)->row();
		
		switch($field->tingkat){
			case 1:
				$result = 'raport_result_y1';
				$detail = 'raport_detail_y1';
				$pmd = 'raport_learning_y1';
				break;
			case 2:
				$result = 'raport_result_y2';
				$detail = 'raport_detail_y2';
				$pmd = 'raport_learning_y2';
				break;
			case 3:
				$result = 'raport_result_y3';
				$detail = 'raport_detail_y3';
				$pmd = 'raport_learning_y3';
				break;
		}
		
			// Cek apakah raport_detail memiliki data dari id_raport_result
			$cek = $this->mraport->detailRaport($result,$detail,array($detail.'.raport_result'=>$id_raport_result));
			if ($cek->num_rows() == 0){
				$data_mapel = $this->allcrud->getdata($result,array('id_raport_result'=>$id_raport_result),1,0)->row();
				$listCriteria = $this->allcrud->listdata('point_criteria','nama_criteria ASC',array('id_mapel'=>$data_mapel->mapel));
				foreach($listCriteria->result() as $row){
					$populate = array(
						'raport_result' => $id_raport_result,
						'criteria'	=> $row->id_criteria
					);
					$this->allcrud->insertdata($detail,$populate);
				}
			}
			// Jika sudah ada data maka tampilkan ke output
			$detail_raport = $this->mraport->detailRaport($result,$detail,array($detail.'.raport_result'=>$id_raport_result));
			$output['is_pmd'] = $this->mraport->get_pmd_list($pmd,$result,array('pmd.id_raport_result'=>$id_raport_result))->num_rows();
			$output['id_assign'] = $id_assign;
			$output['student'] = $this->mraport->student_by_raport_result($result,array('id_raport_result'=>$id_raport_result));
			$output['result'] = $this->allcrud->getdata($result,array('id_raport_result'=>$id_raport_result),1,0)->row();
			
			// kode khusus kelas 3 dengan mata pelajaran 27 ataw final major project
			if($field->id_mapel == 27){
				$cek_fmp = $this->allcrud->listdata('raport_fmp','id_raport_fmp ASC',array('raport_result'=>$id_raport_result));
				if($cek_fmp->num_rows() == 0){
					$list_fmp = $this->mraport->aktif_fmp();
					foreach($list_fmp->result() as $listing){
						$buff = array(
							'raport_result' => $id_raport_result,
							'criteria'	=> $listing->id_fmp
						);
						$this->allcrud->insertdata('raport_fmp',$buff);
					}
				}
			}
			// end kode khusus
			
			if($detail_raport->num_rows() != 0){
				$output['list'] = $detail_raport;
				$this->load->view('result/nilai',$output);
			}else{
				// field->id_mapel == 27, Ini adalah id mata_pelajaran untuk final major project
				if($field->id_mapel == 27){
					$output['list'] = $this->mraport->final_major_project(array('id_raport_result'=>$id_raport_result));
					$this->load->view('result/ajaxFmp',$output);
				}else{
					$output['list'] = $this->mraport->no_raport_detail($result,array('id_raport_result'=>$id_raport_result));
					// echo $this->db->last_query();
					// exit;
					$this->load->view('result/ajaxResult_y3',$output);
				}
				
			}
			
				
	}
	
	public function nilai_y3(){
		$id_assign = $this->input->post('id_assign');
		$id_raport_result = $this->input->post('id_raport_result');
		$notes = $this->input->post('notes');
		$nilai = $this->input->post('score');
		
		$flag = array('id_assign' =>$id_assign);
		$field = $this->mraport->assignClass($flag)->row();
		$edit = array(
			'keterangan' => $notes,
			'score'	=> $nilai,
			'submit_teacher' =>1
		);
		
		$target_point = $this->allcrud->getData('mata_pelajaran',array('id_mapel'=>$field->id_mapel),1,0)->row();
		if($target_point->achiev_point <= $nilai){
			$edit['result'] = 'pass';
		}else{
			$edit['result'] = 'not accomplished';
		}
		
		$this->allcrud->editdata('raport_result_y3',array('id_raport_result'=>$id_raport_result),$edit);
		
		$filter = array(
			'raport_result_y3.kelas' => $field->id_kelas,
			'raport_result_y3.mapel' => $field->id_mapel,
			'raport_periode.status' => 'active'
		);
		$output = otoritas('raport/result',$this->session->userdata('sesRole'));
		$output['id_assign'] = $id_assign;
		$output['raport'] = $this->mraport->raport_point('raport_result_y3',$filter);
		$this->load->view('result/ajaxResult_y3',$output);
		
	}
	
	public function save_point(){
		$id_assign = $this->input->post('id_assign');
		$flag = array('id_assign' =>$id_assign);
		$id_raport_result = $this->input->post('id_raport_result');
		
		$field = $this->mraport->assignClass($flag)->row();
		switch($field->tingkat){
			case 1:
				$table = 'raport_detail_y1';
				$raport_result = 'raport_result_y1';
				break;
			case 2:
				$table = 'raport_detail_y2';
				$raport_result = 'raport_result_y2';
				break;
			case 3:
				$table = 'raport_detail_y3';
				$raport_result = 'raport_result_y3';
				break;
		}
		
		$flag2 = array(
			'id_raport_detail' => $this->input->post('id_raport_detail'),
		);
		$edit = array(
			'result' => $this->input->post('result')
		);
		if($this->allcrud->editdata($table,$flag2,$edit)){
			$res['status'] = 'success';
		}else{
			$res['status'] = 'failed';
		}
		$filter = array(
			'id_raport_detail' => $this->input->post('id_raport_detail'),
		);
		
		$result = $this->mraport->last_result($table,array('raport_result'=>$id_raport_result,'result'=>'success'));
		$this->allcrud->editdata($raport_result,array('id_raport_result'=>$id_raport_result),array('result'=>$result->hasil));
		$res['last_result'] = $result->hasil;
		echo json_encode($res);
		
	}
	
	public function save_pmd(){
		$id_assign = $this->input->post('id_assign');
		$flag = array('id_assign' =>$id_assign);
		$id_raport_result = $this->input->post('id_raport_result');
		
		$field = $this->mraport->assignClass($flag)->row();
		switch($field->tingkat){
			case 1:
				$pmd = 'raport_learning_y1';
				$raport_result = 'raport_result_y1';
				break;
			case 2:
				$pmd = 'raport_learning_y2';
				$raport_result = 'raport_result_y2';
				break;
			case 3:
				$pmd = 'raport_learning_y3';
				$raport_result = 'raport_result_y3';
				break;
		}
		
		$flag2 = array(
			'id_learning' => $this->input->post('id_learning'),
		);
		$edit = array(
			'pmd_result' => $this->input->post('result')
		);
		if($this->allcrud->editdata($pmd,$flag2,$edit)){
			$res['status'] = 'success';
		}else{
			$res['status'] = 'failed';
		}
		$filter = array(
			'id_learning' => $this->input->post('id_learning'),
		);
		
		$result = $this->mraport->last_result_pmd($pmd,array('pmd.id_raport_result'=>$id_raport_result,'pmd.pmd_result'=>'Y'));
		if($result->nilai == 0){
			$result_pmd = 'pass';
		}else{
			$result_pmd = $result->flag_pmd;
		}
		$this->allcrud->editdata($raport_result,array('id_raport_result'=>$id_raport_result),array('result_pmd'=>$result_pmd));
		$res['learning_result'] = $result->flag_pmd;
		echo json_encode($res);
		
	}
	
	function last_result(){
		$id_assign = $this->input->post('id_assign');
		$flag = array('id_assign' =>$id_assign);
		$flag2 = array('id_raport_result' =>$this->input->post('id_raport_result'));
		$field = $this->mraport->assignClass($flag)->row();
		switch($field->tingkat){
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
			'keterangan' => $this->input->post('desc'),
			'submit_teacher' => 1
		);
		$this->allcrud->editdata($result,$flag2,$edit);
		$this->point($id_assign);
	}
	function last_result_v2(){
		$id_assign = $this->input->post('id_assign');
		$flag = array('id_assign' =>$id_assign);
		$flag2 = array('id_raport_result' =>$this->input->post('id_raport_result'));
		$field = $this->mraport->assignClass($flag)->row();
		
		$target = $this->allcrud->getData('mata_pelajaran',array('id_mapel'=>$field->id_mapel),1,0)->row();
		
		
		switch($field->tingkat){
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
			'keterangan' => $this->input->post('desc'),
			'submit_teacher' => 1,
			'score' => $this->input->post('score')
		);
		if($target->achiev_point <= $this->input->post('score')){
			$edit['result'] = 'pass';
		}else{
			$edit['result'] = 'not accomplished';
		}
		
		$this->allcrud->editdata($result,$flag2,$edit);
		$this->point($id_assign);
	}
	
	public function gen_pmd(){
		$id_assign = $this->input->post('id_assign');
		$id_raport_result = $this->input->post('id_raport_result');
		$flag = array('id_assign' =>$id_assign);
		$field = $this->mraport->assignClass($flag)->row();
		
		switch($field->tingkat){
			case 1:
				$pmd = 'raport_learning_y1';
				$result = 'raport_result_y1';
				break;
			case 2:
				$pmd = 'raport_learning_y2';
				$result = 'raport_result_y2';
				break;
			case 3:
				$pmd = 'raport_learning_y3';
				$result = 'raport_result_y3';
				break;
		}
		// cek tabel raport_learning, apakah data raport result sudah terinput
		$cek = $this->allcrud->listdata($pmd,'id_pmd ASC',array('id_raport_result'=>$id_raport_result));
		if($cek->num_rows() == 0){
			$listPmd = $this->allcrud->listdata('point_pmd','id_pmd ASC',array('id_mapel'=>$field->id_mapel));
			foreach($listPmd->result() as $row){
				$populate = array(
						'id_raport_result' => $id_raport_result,
						'id_pmd'	=> $row->id_pmd
					);
				$this->allcrud->insertdata($pmd,$populate);
			}
		}
		$output['resulted'] = $this->allcrud->getdata($result,array('id_raport_result'=>$id_raport_result),1,0)->row();
		$output['pmd'] = $this->mraport->get_pmd_list($pmd,$result,array('pmd.id_raport_result'=>$id_raport_result));
		$this->load->view('result/ajaxPmd',$output);
		
	}
	public function del_pmd(){
		$id_assign = $this->input->post('id_assign');
		$id_raport_result = $this->input->post('id_raport_result');
		$flag = array('id_assign' =>$id_assign);
		$field = $this->mraport->assignClass($flag)->row();
		
		switch($field->tingkat){
			case 1:
				$pmd = 'raport_learning_y1';
				$result = 'raport_result_y1';
				break;
			case 2:
				$pmd = 'raport_learning_y2';
				$result = 'raport_result_y2';
				break;
			case 3:
				$pmd = 'raport_learning_y3';
				$result = 'raport_result_y3';
				break;
		}
		$this->allcrud->deletedata($pmd,array('id_raport_result'=>$id_raport_result));
		$this->allcrud->editdata($result,array('id_raport_result'=>$id_raport_result),array('result_pmd'=>'none'));
		$output['resulted'] = $this->allcrud->getdata($result,array('id_raport_result'=>$id_raport_result),1,0)->row();
		$output['pmd'] = $this->mraport->get_pmd_list($pmd,$result,array('pmd.id_raport_result'=>$id_raport_result));
		$this->load->view('result/ajaxPmd',$output);
		
	}
	
	public function ajaxPmd(){
		$id_assign = $this->input->post('id_assign');
		$id_raport_result = $this->input->post('id_raport_result');
		$flag = array('id_assign' =>$id_assign);
		$field = $this->mraport->assignClass($flag)->row();
		
		switch($field->tingkat){
			case 1:
				$pmd = 'raport_learning_y1';
				$result = 'raport_result_y1';
				break;
			case 2:
				$pmd = 'raport_learning_y2';
				$result = 'raport_result_y2';
				break;
			case 3:
				$pmd = 'raport_learning_y3';
				$result = 'raport_result_y3';
				break;
		}
		
		$output['resulted'] = $this->allcrud->getdata($result,array('id_raport_result'=>$id_raport_result),1,0)->row();
		$output['pmd'] = $this->mraport->get_pmd_list($pmd,$result,array('pmd.id_raport_result'=>$id_raport_result));
		// echo $this->db->last_query();
		$this->load->view('result/ajaxPmd',$output);
		
	}
	
	public function save_fmp(){
		$id_assign = $this->input->post('id_assign');
		$id_raport_result = $this->input->post('id_raport_result');
		$id_raport_fmp = $this->input->post('id_raport_fmp');
		$result_form = $this->input->post('result');
		
		$flag = array('id_raport_fmp' => $id_raport_fmp);
		
		$edit = array('fmp_result'=> $result_form);
		
		$this->allcrud->editdata('raport_fmp',$flag,$edit);
		
		$pass = $this->mraport->last_result_fmp(array('raport_result'=>$id_raport_result,'flag_fmp'=>'pass'),FALSE)->row();
		$merit = $this->mraport->last_result_fmp(array('raport_result'=>$id_raport_result,'flag_fmp'=>'merit'),FALSE)->row();
		$distinction = $this->mraport->last_result_fmp(array('raport_result'=>$id_raport_result,'flag_fmp'=>'distinction'),FALSE)->row();
		
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
		
	}
	
	public function output(){
		$this->auth();
		$data = otoritas('raport/output',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport';
		$data['child'] 	= 'Output Raport';
		$data['page'] 	= 'output/data_output';
		$data['periode']= $this->allcrud->listdata('raport_periode','id_raport_periode ASC',array());
		$this->load->view('template',$data);
	}
	public function filter_output(){
		$this->auth();
		$data = otoritas('raport/output',$this->session->userdata('sesRole'));
		$grade = $this->input->post('grade');
		$filter = array(
			'tingkat'=>$grade
		);
		if($this->input->post('class') != 'all'){
			$filter['kelas.id_kelas'] = $this->input->post('class');
		}
		if($this->input->post('periode') != 'all'){
			$filter['raport_periode.id_raport_periode'] = $this->input->post('periode');
		}
		switch($grade){
			case 1 :
				$raport_result = 'raport_result_y1';
			break;
			case 2 :
				$raport_result = 'raport_result_y2';
			break;
			case 3 :
				$raport_result = 'raport_result_y3';
			break;
		}
		
		$data['list'] = $this->mraport->list_raport_output($filter,$raport_result);
		$this->load->view('output/ajaxListRaport',$data	);
	}
	public function output_pdf($id_raport_result,$grade){
		
		$principal = $this->allcrud->getData('principal',array(),1,0)->row();
		$gen_setting = $this->db->get_where('settings', array('name' => 'school_stamp') )->row();
		
		$data['principal_name'] = str_replace('(Principal)','',$principal->full_name);
		$data['principal_signature'] = 'image/principal/'.$principal->signature;
		$data['school_stamp'] = 'image/settings/'.$gen_setting->value;
		
		switch($grade){
			case 1 :
				// $raport_result = 'raport_result_y1';
				// $raport_data = $this->mraport->dataRaport($raport_result,array($raport_result.'.id_raport_result'=>$id_raport_result))->row();
				// output_pdf_grade1($raport_data);
				$raport_result 			= 'raport_result_y1';
				$data['raport_header'] 	= $this->mraport->dataRaport($raport_result,array($raport_result.'.id_raport_result'=>$id_raport_result))->row();
				$flag 					= array(
					'result.student' 	=> $data['raport_header']->id_number,
					'raport_periode' 	=> $data['raport_header']->raport_periode
				);
				$raport 				= $this->mraport->raport_result('raport_result_y1','raport_detail_y1',$flag)->result();

				$data['raport_list']	= array();
				foreach($raport as $r) {
					$data['raport_list'][$r->nama_mapel]['id_mapel'] 						= $r->id_mapel;
					$data['raport_list'][$r->nama_mapel]['result'] 							= $r->result;
					$data['raport_list'][$r->nama_mapel]['result_pmd'] 						= $r->result_pmd;
					$data['raport_list'][$r->nama_mapel]['keterangan'] 						= $r->keterangan;
					$data['raport_list'][$r->nama_mapel]['detail'][$r->id_raport_detail] 	= $r;
				}
				$data['learning'] = array('pass','merit','distinction');
				$data['category'] = array('DISCOVERY','EXPLORATION','PRESENTATION','PERSONALITY','ACHIEVEMENT');
				foreach($data['raport_list'] as $rl) {
				    
					$learning 				= $this->mraport->learning_result('raport_result_y1','raport_learning_y1',$flag)->result();
					foreach($learning as $l) {
						if(isset($data['raport_list'][$l->nama_mapel])) {
							$data['raport_list'][$l->nama_mapel]['pmd'][$l->flag_pmd][$l->nama_category] = $l;
						}
					}
				}
				// echo '<pre>';
				// print_r($raport);
				// echo '</pre>'; die;
				$html = $this->load->view('raport/output/raport_y1',$data,true);
			break;
			case 2 :
				$raport_result 			= 'raport_result_y2';
				
				$data['raport_header'] 	= $this->mraport->dataRaport($raport_result,array($raport_result.'.id_raport_result'=>$id_raport_result))->row();
				$flag 					= array(
					'result.student' 	=> $data['raport_header']->id_number,
					'raport_periode' 	=> $data['raport_header']->raport_periode
				);
				$raport 				= $this->mraport->raport_result('raport_result_y2','raport_detail_y2',$flag)->result();

				$data['raport_list']	= array();
				foreach($raport as $r) {
					$data['raport_list'][$r->nama_mapel]['id_mapel'] 						= $r->id_mapel;
					$data['raport_list'][$r->nama_mapel]['result'] 							= $r->result;
					$data['raport_list'][$r->nama_mapel]['result_pmd'] 						= $r->result_pmd;
					$data['raport_list'][$r->nama_mapel]['keterangan'] 						= $r->keterangan;
					$data['raport_list'][$r->nama_mapel]['detail'][$r->id_raport_detail] 	= $r;
				}
				$data['learning'] = array('pass','merit','distinction');
				$data['category'] = array('DISCOVERY','EXPLORATION','PRESENTATION','PERSONALITY','ACHIEVEMENT');
				foreach($data['raport_list'] as $rl) {
				
					$learning 				= $this->mraport->learning_result('raport_result_y2','raport_learning_y2',$flag)->result();
					foreach($learning as $l) {
						if(isset($data['raport_list'][$l->nama_mapel])) {
							$data['raport_list'][$l->nama_mapel]['pmd'][$l->flag_pmd][$l->nama_category] = $l;
						}
					}
				}
				// echo '<pre>';
				// print_r($raport);
				// echo '</pre>'; die;
				$html = $this->load->view('raport/output/raport_y1',$data,true);
			break;
			case 3 :
				$raport_result 			= 'raport_result_y3';
				$data['raport_header'] 	= $this->mraport->dataRaport($raport_result,array($raport_result.'.id_raport_result'=>$id_raport_result))->row();
				
				$flag 					= array(
					'result.student' 	=> $data['raport_header']->id_number,
					'raport_periode' 	=> $data['raport_header']->raport_periode
				);
				$data['raport_list'] 	= $this->mraport->dataRaportList($raport_result, $flag)->result();
				$data['raport_fmp'] 	= $this->mraport->raport_fmp_result($flag)->result();
				
				//to create pmd rowspan
				$flag_span =[];
				foreach($data['raport_fmp'] as $key => $cc){
					if($cc->flag_fmp == 'pass'){
						$_pass[] = $key;
					}
					if($cc->flag_fmp == 'merit'){
						$_merit[] = $key;
					}
					if($cc->flag_fmp == 'distinction'){
						$_distinction[] = $key;
					}
				}

				$flag_span['pass'] = ['start' => $_pass[0], 'rowspan' => count($_pass) ];
				$flag_span['merit'] = ['start' => $_merit[0], 'rowspan' => count($_merit) ];
				$flag_span['distinction'] = ['start' => $_distinction[0], 'rowspan' => count($_distinction) ];
				$data['flag_span'] = $flag_span;

				$mapel 					= $this->mraport->get_mapel_learning('raport_learning_y3',$raport_result)->result();
				$data['pmd']			= array();
				$data['learning'] 		= array('pass','merit','distinction');
				$data['category'] 		= array('DISCOVERY','EXPLORATION','PRESENTATION','PERSONALITY','ACHIEVEMENT');
				foreach($mapel as $m) {
					$flag 					= array(
						'pmd.id_mapel' 		=> $m->id_mapel
					);
					$learning 				= $this->mraport->learning_result('raport_result_y3','raport_learning_y3',$flag)->result();
					foreach($learning as $l) {
						$data['pmd'][$l->nama_mapel]['result_pmd'] 						= $l->result_pmd;
						$data['pmd'][$l->nama_mapel]['keterangan'] 						= $l->keterangan;
						$data['pmd'][$l->nama_mapel][$l->flag_pmd][$l->nama_category] 	= $l;
					}
				}
				$flag 					= array(
					'result.student' 	=> $data['raport_header']->id_number,
					'raport_periode' 	=> $data['raport_header']->raport_periode
				);
				// echo '<pre>';
				// print_r($data['raport_list']);
				// echo '</pre>'; die;
				$html = $this->load->view('raport/output/raport_y3',$data,true);
			break;
		}
		
        $filename	= 'Download';
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename, true, 'A3', 'portrait');
	}
	
	function getClass(){
		$grade = $this->input->post('grade');
		$list_class = $this->allcrud->listdata('kelas','nama_kelas ASC',array('tingkat'=>$grade));
		if(!empty($list_class)){
				echo "<option value='all'> All Class</option>";
			foreach($list_class->result() as $class){
				echo "<option value='".$class->id_kelas."'> ".$class->nama_kelas."</option>";
			}
		}else{
			echo "<option value='all'> All Class</option>";
		}
	}
	
	function published(){
		$this->auth();
		$data = otoritas('raport/published',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport';
		$data['child'] 	= 'Published';
		$data['page'] 	= 'published/data_published';
		$this->load->view('template',$data);
	}
	
	function ajaxPublished(){
		$this->auth();
		$data = otoritas('raport/published',$this->session->userdata('sesRole'));
	    $data['list']= $this->mraport->list_raport_gabungan();
	    echo var_dump($data['list']);
		//$this->load->view('published/ajaxPublished',$data);
	}
	
	function toggle_published(){
		$id_number = $this->input->post('id_number');
		$grade = $this->input->post('tingkat');
		$published = $this->input->post('flaging');
		
		if($published == 'yes'){
			$tag = 'no';
		}else{
			$tag = 'yes';
		}
		
		$periode = $this->allcrud->getData('raport_periode',array('status'=>'active'),1,0)->row();
		
		if(!empty($periode) && !empty($id_number) && !empty($grade)){
			switch($grade){
				case 1 :
					$raport = 'raport_result_y1';
					break;
				case 2 :
					$raport = 'raport_result_y2';
					break;
				case 3 :
					$raport = 'raport_result_y3';
					break;
			}
			
			$update = array('published'=>$tag);
			
			$flag = array(
				'student' => $id_number,
				'raport_periode' => $periode->id_raport_periode
			);
			
			if($this->allcrud->editdata($raport,$flag,$update)){
				$res['status'] = 'success';
				$res['message'] = 'Data Berhasil Di update';
			}else{
				$res['status'] = 'failed';
				$res['message'] = 'Data Gagal Di update';
			}
		}else{
			$res['status'] = 'failed';
			$res['message'] = 'Variable not complete';
		}
		
		echo json_encode($res);
	}
	
	public function publish_all(){
		$periode = $this->allcrud->getData('raport_periode',array('status'=>'active'),1,0)->row();
		$publish = $this->input->post('publish');
		
		if(!empty($periode)){
			
			
			$update = array('published'=> $publish);
			$flag = array(
				'raport_periode' => $periode->id_raport_periode
			);
			$output = array();
			for($x=1;$x <= 3;$x++){
				switch($x){
				case 1 :
					$raport = 'raport_result_y1';
					break;
				case 2 :
					$raport = 'raport_result_y2';
					break;
				case 3 :
					$raport = 'raport_result_y3';
					break;
				}
				
				$this->allcrud->editdata($raport,$flag,$update);
			}
			$res['status'] = 'success';
			$res['message'] = 'Data Generated';
			$res['debug'] = $raport;
		}else{
			$res['status'] = 'failed';
			$res['message'] = 'No periode is active';
		}
		
		echo json_encode($res);
	}
	
	
	public function proses_upload(){
	    error_reporting(0);
	    if (!empty($_FILES["file_raport"]["name"])) {
            $conf = array();
    	    $conf['upload_path']          = './uploads/raport/';
            $conf['allowed_types']        = 'pdf';
            $conf['file_name']            = 'raport_'.$this->input->post('key');//.'_'.$this->input->post('id');
            $conf['overwrite']			= true;
            $conf['max_size']             = 3072; // 1MB
            // $conf['max_width']            = 1024;
            // $conf['max_height']           = 768;
        
            $this->load->library('upload', $conf);
        
            if ($this->upload->do_upload('file_raport')) {
                $res['upload_data'] =  $conf['file_name'].'.'.$conf['allowed_types'];
                $res['status'] = 'success';
            }
            else{
                $res['status'] = 'failed';
                $res['message'] = 'Upload file gagal';
            }
    		
        } else {
            $res['status'] = 'failed';
            $res['message'] = 'File tidak boleh kosong';
        }
	    
		echo json_encode($res);
	}
	
	function raport_gabungan(){
        $this->auth();
		$data = otoritas('raport/raport_gabungan',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport';
		$data['child'] 	= 'Rapor MPP + Proyek';
		$data['page'] 	= 'gabungan/data_raport_gabungan';
		$this->load->view('template',$data);		
	}

	function ajaxRaport_gabungan(){ 
    	$this->auth();
	    $data = otoritas('raport/raport_gabungan',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    $data['list']= $this->mraport->list_raport_gabungan();
	    $this->load->view('gabungan/ajaxRaport_gabungan',$data);
	}
	
	function create_raport(){ 
    	$this->auth();
    	$murid=$this->uri->segment(3);
	    $periode=$this->uri->segment(4);
	    $id_proyek=$this->uri->segment(5);
    	$flag = array('id_raport_periode'=>$periode);
        $cek = $this->allcrud->getdata('raport_periode',$flag,1,0);
	    $data['periode']=$cek;
	    $data['header']=$this->mraport->list_raport_header($murid,$periode);
	    $data['raport']=$this->mraport->list_raport_mpp($murid,$periode);
	    $data['catat']=$this->mraport->list_catatan_mpp($murid,$periode);
   
	    $header=$this->mraport->list_raport_proyek_header($id_proyek);
	    $data['header_pro']=$header;
	    $jml_siklus = $this->mraport->jml_siklus_proyek($id_proyek)->result();
	    $data['jml_siklus']=0;
	    foreach($jml_siklus as $jml_sik);
	    $data['jml_siklus']=$jml_sik->jml;
	    $jml_item = $this->mraport->max_item_siklus_proyek($id_proyek)->result();
	    $data['jml_item']=0;
	    foreach($jml_item as $max_item);
	    $data['max_item']=$max_item->jml;
	    $data['siklus'] = $this->mraport->siklus_proyek($id_proyek);
	    $detail = $this->mraport->list_raport_proyek_detail($id_proyek);
	    $d=array();
	    $n=array();
	    $i=0;
	    foreach($detail->result() as $det){
	        $i++;
	        $d[$det->siklus][]=$det->kriteria;
	        $n[$det->siklus][]=$det->nilai;
	    };
	    $data['detail']=$d;
	    $data['nilai']=$n;
	    foreach($header->result() as $head);
	    $periode = $this->mraport->periode_aktif()->result();
	    foreach($periode as $period);
	    $data['catat']=$this->mraport->list_catatan_final($head->murid,$period->id_raport_periode);
	    
	    $this->load->view('gabungan/design_raport.php',$data);
	    //$filename	= 'Download';
        //$this->load->library('pdfgenerator');
        //$this->pdfgenerator->generate($html, $filename, true, 'A3', 'portrait');
    }	
	
	
	
	
	
	
	
} // END of Raport Controller