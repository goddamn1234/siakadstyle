<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Master extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('mmaster', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	function kelas(){
		$this->auth();
		$data = otoritas('master/kelas',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Data Kelas';
		$data['page'] 	= 'kelas/data_kelas';
		$data['jenis'] = $this->allcrud->listdata('jenis_pendidikan','nama_jenis ASC');
		$data['jalur'] = $this->allcrud->listdata('jalur_pendidikan','nama_jalur ASC');
		$data['jenjang'] = $this->allcrud->listdata('jenjang_pendidikan','nama_jenjang ASC');
		$this->load->view('template',$data);
	}
	function ajaxKelas(){
		$this->auth();
		$data = otoritas('master/kelas',$this->session->userdata('sesRole'));
		$data['list']	= $this->mmaster->list_kelas();
		$this->load->view('kelas/ajaxKelas',$data);
	}
	function proses_kelas(){
		$this->auth();
		
		$data = array(
			'nama_kelas' => strtoupper(strip_tags($this->input->post('nama'))),
			'tingkat' => $this->input->post('tingkat'),
			'jenis' => $this->input->post('jenis'),
			'jalur' => $this->input->post('jalur'),
			'jenjang' => $this->input->post('jenjang'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_kelas'=>$this->input->post('id'));
			$this->allcrud->editdata('kelas',$flag,$data);
		}else{
			$this->allcrud->insertdata('kelas',$data);
		}
		
	}
	function editKelas($id){
		
		$flag = array('id_kelas'=>$id);
		$q = $this->allcrud->getData('kelas',$flag,1,0)->row();
		echo json_encode($q);
	}
	function delKelas($id){
		$flag = array('id_kelas' => $id);
		$this->allcrud->deletedata('kelas',$flag);
	}
	
	function cKelas(){
		$flag=array('tingkat'=>$this->input->post('tingkat'));
		$data = $this->allcrud->listdata('kelas','nama_kelas ASC',$flag);
		foreach($data->result() as $row){
			echo "<option value='".$row->id_kelas."'>".$row->nama_kelas."</option>";
		}
	}
	
	function mapel(){
		$this->auth();
		$data = otoritas('master/mapel',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Mata Pelajaran';
		$data['page'] 	= 'mapel/data_mapel';
		$this->load->view('template',$data);		
	}

	function ajaxMapel(){
		$this->auth();
		$data = otoritas('master/mapel',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('mata_pelajaran','nama_mapel ASC',array());
		$this->load->view('mapel/ajaxMapel',$data);
	}
	function proses_mapel(){
		$this->auth();
		$data = array(
			'nama_mapel' => ucwords(strip_tags($this->input->post('nama'))),
			'tingkat_kelas' => $this->input->post('tingkat'),
			'achiev_point' => $this->input->post('req'),
			'status' => $this->input->post('status')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_mapel'=>$this->input->post('id'));
			$this->allcrud->editdata('mata_pelajaran',$flag,$data);
		}else{
			$this->allcrud->insertdata('mata_pelajaran',$data);
		}
		
	}

	function editMapel($id){
		
		$flag = array('id_mapel'=>$id);
		$q = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delMapel($id){
		$flag = array('id_mapel' => $id);
		$this->allcrud->deletedata('mata_pelajaran',$flag);
	}
	
	function category(){
		$this->auth();
		$data = otoritas('master/category',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Category Penilaian';
		$data['page'] 	= 'category/data_category';
		$this->load->view('template',$data);		
	}

	function ajaxCategory(){
		$this->auth();
		$data = otoritas('master/category',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('point_category','nama_category ASC',array());
		$this->load->view('category/ajaxCategory',$data);
	}
	
	function proses_category(){
		$this->auth();
		$data = array(
			'nama_category' => strtoupper(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_category'=>$this->input->post('id'));
			$this->allcrud->editdata('point_category',$flag,$data);
		}else{
			$this->allcrud->insertdata('point_category',$data);
		}
		
	}
	
	function editCategory($id){
		
		$flag = array('id_category'=>$id);
		$q = $this->allcrud->getData('point_category',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delCategory($id){
		$flag = array('id_category' => $id);
		$this->allcrud->deletedata('point_category',$flag);
	}
	
	function criteria(){
		$this->auth();
		$data = otoritas('master/criteria',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Criteria Penilaian';
		$data['page'] 	= 'criteria/data_criteria';
		$data['mapel_list'] = $this->allcrud->listdata('mata_pelajaran','nama_mapel ASC');
		$data['category_list'] = $this->allcrud->listdata('point_category','nama_category ASC');
		$this->load->view('template',$data);
	}

	function ajaxCriteria(){
		$this->auth();
		$data = otoritas('master/criteria',$this->session->userdata('sesRole'));
		$data['list']	= $this->mmaster->list_criteria();
		$this->load->view('criteria/ajaxCriteria',$data);
	}
	
	function cMapel(){
		$flag=array('tingkat_kelas'=>$this->input->post('kelas'));
		$data = $this->allcrud->listdata('mata_pelajaran','nama_mapel ASC',$flag);
		foreach($data->result() as $row){
			echo "<option value='".$row->id_mapel."'>".$row->nama_mapel."</option>";
		}
	}
	
	function proses_criteria(){
		$this->auth();
		$data = array(
			'id_category' => $this->input->post('category'),
			'flag' => 'P'.$this->input->post('flag'),
			'nama_criteria' => strtolower(strip_tags($this->input->post('criteria'))),
			'point_criteria' => $this->input->post('point'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_criteria'=>$this->input->post('id'));
			$this->allcrud->editdata('point_criteria',$flag,$data);
		}else{
			$data['id_mapel'] = $this->input->post('mapel');
			$this->allcrud->insertdata('point_criteria',$data);
		}
		
	}
	
	function editCriteria($id){
		
		$flag = array('id_criteria'=>$id);
		$q = $this->mmaster->list_criteria($flag)->row();
		echo json_encode($q);
	}
	
	function delCriteria($id){
		$flag = array('id_criteria' => $id);
		$this->allcrud->deletedata('point_criteria',$flag);
	}
	
	function bulk(){
		$this->auth();
		$data = otoritas('master/bulk',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Available Bulk';
		$data['page'] 	= 'bulk/data_bulk';
		$this->load->view('template',$data);
	}
	
	function import(){
		$this->form_validation->set_rules('table','Bulk Data','required|in_list[student,parent,guru,principal]');
		
		$config['upload_path']          = './bulk/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 2000000;
		$config['overwrite']            = TRUE;
		
		$this->load->library('upload', $config);
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$log_sukses = 0;
		$log_failed = 0;
		$log_data = array();
		if($this->form_validation->run() == TRUE){
			$table = $this->input->post('table');
			if($this->upload->do_upload('fFile')){
				$medias = $this->upload->data('fFile');
				$inputFileName ='./bulk/'.$this->upload->data('file_name');
				
				try{
					$inputFileType = IOFactory::identify($inputFileName);
					$objReader	= IOFactory::createReader($inputFileType);
					$objPHPExcel= $objReader->load($inputFileName);
				} catch(Exception $e){
					die('Error loading File "'.pathinfo($inputFileName,PATHINFO_BASENAME).'":'.$e->getMessage());
				}
				
				$sheet =  $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();
				
				$success = 1; // untuk menghitung setiap proses query insert
				$failed = 1; // untuk menghitung setiap proses query insert
				
				for($row=2;$row <= $highestRow;$row++){
					$rowData = $sheet->rangeToArray(
						'A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE
					);
					
					// Populate data berdasarkan kolom dari database
					switch($table){
						case "student":
							$data = array(
								'id_number' => $rowData[0][1],
								'full_name' => $rowData[0][2],
								'spouse_name' => $rowData[0][3],
								'birth_place' => $rowData[0][4],
								'birth_date' => date('Y-m-d',strtotime('1899-12-31+'.($rowData[0][5]-1).' days')),
								'address' => $rowData[0][6],
								'phone1' => $rowData[0][7],
								'phone2' => $rowData[0][8],
								'email' => $rowData[0][9],
								'asal_sekolah' => $rowData[0][10],
								'gender' => $rowData[0][11],
								'blood_group' => $rowData[0][12],
								'nationality' => $rowData[0][13],
								'religion' => $rowData[0][14],
								'admission_date' => date('Y-m-d',strtotime('1899-12-31+'.($rowData[0][15]-1).' days')),
								'NISN' => $rowData[0][16],
								'role' => 4,
								'password' => sha1(md5($rowData[0][17]))
							);
							break;
						case "parent":
							$data = array(
								'id_number' => $rowData[0][1],
								'full_name' => $rowData[0][2],
								'spouse_name' => $rowData[0][3],
								'birth_place' => $rowData[0][4],
								'birth_date' => date('Y-m-d',strtotime('1899-12-31+'.($rowData[0][5]-1).' days')),
								'address' => $rowData[0][6],
								'phone1' => $rowData[0][7],
								'phone2' => $rowData[0][8],
								'nationality' => $rowData[0][9],
								'religion' => $rowData[0][10],
								'parent_from' => $rowData[0][11],
								'education' => $rowData[0][12],
								'occupation' => $rowData[0][13],
								'income' => $rowData[0][14],
								'role' => 6,
								'password' => sha1(md5($rowData[0][15]))
							);
							break;
						case "guru":
							$data = array(
								'id_number' => $rowData[0][1],
								'full_name' => $rowData[0][2],
								'spouse_name' => $rowData[0][3],
								'birth_place' => $rowData[0][4],
								'birth_date' => date('Y-m-d',strtotime('1899-12-31+'.($rowData[0][5]-1).' days')),
								'address' => $rowData[0][6],
								'phone1' => $rowData[0][7],
								'phone2' => $rowData[0][8],
								'nationality' => $rowData[0][9],
								'religion' => $rowData[0][10],
								'email' => $rowData[0][11],
								'no_identitas' => $rowData[0][12],
								'joining_date' => date('Y-m-d',strtotime('1899-12-31+'.($rowData[0][13]-1).' days')),
								'gender' => $rowData[0][14],
								'university' => $rowData[0][15],
								'qualification' => $rowData[0][16],
								'total_experience' => $rowData[0][17],
								'experience_detail' => $rowData[0][18],
								'marital_status' => $rowData[0][19],
								'children_count' => $rowData[0][20],
								'blood_group' => $rowData[0][21],
								'role' => 6,
								'password' => sha1(md5($rowData[0][22]))
							);
							break;
							
					}
					
					if($this->allcrud->insertdata($table,$data)){
						$log_sukses = $success++;
					}else{
						$log_failed = $failed++;
						$log_data[]  = $rowData[0][0];
					}
				
				}
				$result['debug'] = $data;
				$result['success']	= $log_sukses;
				$result['failed']	= array(
					'jml'	=> $log_failed,
					'data'	=> $log_data
				);
				$this->load->view('master/bulk/ajaxResult',$result);
				
			}else{
				echo 'File gagal di Upload'.$this->upload->display_errors();
			}
			
		}else{
			echo validation_errors();
		}
	}
	
	public function pmd(){
		$this->auth();
		$data = otoritas('master/pmd',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Criteria PMD';
		$data['page'] 	= 'criteria/data_pmd';
		$data['mapel_list'] = $this->allcrud->listdata('mata_pelajaran','nama_mapel ASC');
		$this->load->view('template',$data);
	}
	
	function ajaxPmd(){
		$this->auth();
		$data = otoritas('master/pmd',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('mata_pelajaran','nama_mapel ASC',array());
		$this->load->view('criteria/ajaxMapel',$data);
	}
	function setPmd($id_mapel){
		$flag =array('id_mapel'=>$id_mapel);
		$is_exist = $this->allcrud->listdata('point_pmd','nama_pmd ASC',$flag);
		if($is_exist->num_rows() == 0){
			$list_category = $this->allcrud->listdata('point_category','id_category ASC',array());
			foreach($list_category->result() as $row){
				$insertP = array(
					'id_mapel' => $id_mapel,
					'id_category' => $row->id_category,
					'flag_pmd'	=> 'pass',
					'nama_pmd'	=> 'template for pass PMD',
					'point_pmd'	=> 0
				);
				$insertM = array(
					'id_mapel' => $id_mapel,
					'id_category' => $row->id_category,
					'flag_pmd'	=> 'merit',
					'nama_pmd'	=> 'template for merit PMD',
					'point_pmd'	=> 0
				);
				$insertD = array(
					'id_mapel' => $id_mapel,
					'id_category' => $row->id_category,
					'flag_pmd'	=> 'distinction',
					'nama_pmd'	=> 'template for distinction PMD',
					'point_pmd'	=> 0
				);
				
				$this->allcrud->insertdata('point_pmd',$insertP);
				$this->allcrud->insertdata('point_pmd',$insertM);
				$this->allcrud->insertdata('point_pmd',$insertD);
			}
			
		}
		$data['header'] = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->row();
		$data['list']	= $this->mmaster->dataPmd(array('point_pmd.id_mapel'=>$id_mapel));
		$this->load->view('criteria/ajaxPmd',$data);
	}
	
	function savePmd(){
		$id_pmd = $this->input->post('id_pmd');
		$objective = strip_tags($this->input->post('objective'));
		$point = $this->input->post('point');
		$flag = array('id_pmd'=>$id_pmd);
		$edit = array(
			'nama_pmd' => $objective,
			'point_pmd'=> $point
		);
		$this->allcrud->editdata('point_pmd',$flag,$edit);
	}
	
	public function fmp(){
		$this->auth();
		$data = otoritas('master/fmp',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Final Major Project';
		$data['page'] 	= 'fmp/data_fmp';
		$data['category'] 	= $this->allcrud->listdata('point_category','nama_category ASC',array());
		$this->load->view('template',$data);
	}
	
	function ajaxFmp(){
		$this->auth();
		$data = otoritas('master/fmp',$this->session->userdata('sesRole'));
		$data['list']	= $this->mmaster->listFmp(array());
		$this->load->view('fmp/ajaxFmp',$data);
	}
	
	function proses_fmp(){
		$this->auth();
		$data = array(
			'category' => $this->input->post('category'),
			'flag_fmp' => $this->input->post('pmd'),
			'periode' => $this->input->post('periode'),
			'nama_fmp' => strtolower(strip_tags($this->input->post('objective'))),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_fmp'=>$this->input->post('id'));
			$this->allcrud->editdata('fmp',$flag,$data);
		}else{
			$this->allcrud->insertdata('fmp',$data);
		}
		
	}
	
	function editFmp($id){	
		$flag = array('id_fmp'=>$id);
		$q = $this->allcrud->getData('fmp',$flag,0,1)->row();
		echo json_encode($q);
	}
	
	function delFmp($id){
		$flag = array('id_fmp' => $id);
		$this->allcrud->deletedata('fmp',$flag);
	}
	
	function staf(){
		$this->auth();
		$data = otoritas('master/staf',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Staf';
		$data['page'] 	= 'staf/data_staf';
		$this->load->view('template',$data);		
	}

	function ajaxStaf(){
		$this->auth();
		$data = otoritas('master/staf',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('staf','nama_staf ASC',array());
		$this->load->view('staf/ajaxStaf',$data);
	}
	
	function proses_staf(){
		$this->auth();
		$data = array(
			'nama_staf' => ucwords(strip_tags($this->input->post('nama'))),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_staf'=>$this->input->post('id'));
			$this->allcrud->editdata('staf',$flag,$data);
		}else{
			$this->allcrud->insertdata('staf',$data);
		}
		
	}

	function edit_staf($id){
		
		$flag = array('id_staf'=>$id);
		$q = $this->allcrud->getData('staf',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delStaf($id){
		$flag = array('id_staf' => $id);
		$this->allcrud->deletedata('staf',$flag);
	}
	
   function divisi(){
		$this->auth();
		$data = otoritas('master/divisi',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master';
		$data['child'] 	= 'Divisi';
		$data['page'] 	= 'divisi/data_divisi';
		$this->load->view('template',$data);		
	}

	function ajaxdivisi(){
		$this->auth();
		$data = otoritas('master/divisi',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('divisi','nama_divisi ASC',array());
		$this->load->view('divisi/ajaxDivisi',$data);
	}
	
	function proses_divisi(){
		$this->auth();
		$data = array(
			'nama_divisi' => ucwords(strip_tags($this->input->post('nama'))),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_divisi'=>$this->input->post('id'));
			$this->allcrud->editdata('divisi',$flag,$data);
		}else{
			$this->allcrud->insertdata('divisi',$data);
		}
		
	}

	function edit_divisi($id){
		
		$flag = array('id_divisi'=>$id);
		$q = $this->allcrud->getData('divisi',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function deldivisi($id){
		$flag = array('id_divisi' => $id);
		$this->allcrud->deletedata('divisi',$flag);
	}
	
	
}

