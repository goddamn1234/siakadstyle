<?php

class Master2 extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model ('mmaster2', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}

/* mata pelajaran */

	function mata_pelajaran(){
		$this->auth();
		$data = otoritas('master2/mata_pelajaran',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Mata Pelajaran';
		$data['page'] 	= 'mata_pelajaran/data_mata_pelajaran';
		$data['jenis_list'] = $this->allcrud->listdata('jenis_pendidikan','nama_jenis ASC');
		$data['jalur_list'] = $this->allcrud->listdata('jalur_pendidikan','nama_jalur ASC');
		$data['jenjang_list'] = $this->allcrud->listdata('jenjang_pendidikan','nama_jenjang ASC');
		$data['kelas_list'] = $this->allcrud->listdata('kelas','nama_kelas ASC');
		$data['guru_list'] = $this->allcrud->listdata('guru','full_name ASC');
		$data['tp_raport_list'] = $this->allcrud->listdata('tipe_raport','nama_tipe ASC');
		$data['tp_pelajaran_list'] = $this->allcrud->listdata('tipe_pelajaran','nama_tipe ASC');
		$this->load->view('template',$data);		
	}

	function ajaxMata_pelajaran(){
		$this->auth();
		$data = otoritas('master2/mata_pelajaran',$this->session->userdata('sesRole'));
		$filter="";
		$jenis=$this->uri->segment(3); 
		$jalur=$this->uri->segment(4); 
		$jenjang=$this->uri->segment(5); 
		$kelas=$this->uri->segment(6); 
		$status=$this->uri->segment(7); 
		if ($jenis=='Z') $jenis='';
		if ($jalur=='Z') $jalur='';
		if ($jenjang=='Z') $jenjang='';
		if ($kelas=='Z') $kelas='';
		if ($status=='Z') $status='';
		if ($jenis!='') $filter=$filter.' jenis='.$jenis;
		if ($jalur!='') {
		    if ($filter!='') $filter= $filter.' and ';
		    $filter=$filter.'jalur='.$jalur;
		}    
		if ($jenjang!='') {
		    if ($filter!='') $filter= $filter.' and ';
		    $filter=$filter.'jenjang='.$jenjang;
		} 
		if ($kelas!='') {
		    if ($filter!='') $filter= $filter.' and ';
		    $filter=$filter.'kelas='.$kelas;
		} 
		if ($status!=''){
		    if ($filter!='') $filter= $filter.' and ';
		    $filter=$filter."status='".$status."'";
	    } 
	    //echo $filter;
	    $data['list']	= $this->mmaster2->list_matpel($filter);
		$this->load->view('mata_pelajaran/ajaxMata_pelajaran',$data);
	}
	
	function proses_mata_pelajaran(){
		$this->auth();
		$data = array(
			'nama_mapel' => ucwords(strip_tags($this->input->post('nama'))),
			'tingkat' => $this->input->post('tingkat'),
			'jenis' => $this->input->post('jenis'),
			'jalur' => $this->input->post('jalur'),
			'jenjang' => $this->input->post('jenjang'),
			'kelas' => $this->input->post('kelas'),
			'guru' => $this->input->post('guru'),
			'metode' => $this->input->post('metode'),
			'point' => $this->input->post('point'),
			'syarat' => $this->input->post('syarat'),
			'tipe_raport' => $this->input->post('tipe_raport'),
			'tipe_pelajaran' => $this->input->post('tipe_pelajaran'),
			'ikut_krs' => $this->input->post('ikut_krs'),
			'tgl_krs' => date('Y-m-d',strtotime($this->input->post('tgl_krs'))),
			'kuota' => $this->input->post('kuota'),
			'kkm' => $this->input->post('kkm'),
			'kkm_terkecil' => $this->input->post('kkm_terkecil'),
			'status' => $this->input->post('status')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_mapel'=>$this->input->post('id'));
			$this->allcrud->editdata('mata_pelajaran',$flag,$data);
		}else{
			$this->allcrud->insertdata('mata_pelajaran',$data);
		}
		
	}
	
	
	function ajaxGuru_lain(){
		$this->auth();
		$data = otoritas('master2/pelajaran_periode',$this->session->userdata('sesRole'));
		$id=$this->uri->segment(3); 
		$data['list']= $this->mmaster2->list_guru_lain($id);
	    $this->load->view('mata_pelajaran/ajaxGuru_lain',$data);
	}

	function edit_mata_pelajaran($id){
		
		$flag = array('id_mapel'=>$id);
		$q = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delMata_pelajaran($id){
		$flag = array('id_mapel' => $id);
		$this->allcrud->deletedata('mata_pelajaran',$flag);
	}

/* assign mata pelajaran to periode */

    function pelajaran_periode(){
		$this->auth();
		$data = otoritas('master2/pelajaran_periode',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Assign Mata Pelajaran to Periode';
		$data['page'] 	= 'mata_pelajaran_periode/data_pelajaran_periode';
		$data['periode_list'] = $this->allcrud->listdata('raport_periode','id_raport_periode DESC');
		$data['pelajaran_list'] = $this->mmaster2->list_matpel();
		$data['guru_list'] = $this->allcrud->listdata('guru','full_name ASC');
		$this->load->view('template',$data);		
	}

	function ajaxPelajaran_periode(){
		$this->auth();
		$data = otoritas('master2/pelajaran_periode',$this->session->userdata('sesRole'));
		$data['list']	= $this->mmaster2->list_mapel_periode();
	    $this->load->view('mata_pelajaran_periode/ajaxPelajaran_periode',$data);
	}
	
	function proses_pelajaran_periode(){
		$this->auth();
		$data = array(
			'periode' => $this->input->post('periode'),
			'pelajaran' => $this->input->post('pelajaran'),
			'guru' => $this->input->post('guru')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('mata_pelajaran_periode',$flag,$data);
		}else{
			$this->allcrud->insertdata('mata_pelajaran_periode',$data);
		}
		
	}
	
	function edit_pelajaran_periode($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('mata_pelajaran_periode',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delPelajaran_Periode($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('mata_pelajaran_periode',$flag);
	}
	
	

/* Jalur Pendidikan */

	function jalur_pendidikan(){
		$this->auth();
		$data = otoritas('master2/jalur_pendidikan',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Jalur Pendidikan';
		$data['page'] 	= 'jalur_pendidikan/data_jalur_pendidikan';
		$this->load->view('template',$data);		
	}

	function ajaxJalur_pendidikan(){
		$this->auth();
		$data = otoritas('master2/jalur_pendidikan',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('jalur_pendidikan','nama_jalur ASC',array());
		$this->load->view('jalur_pendidikan/ajaxJalur_pendidikan',$data);
	}
	
	function proses_jalur_pendidikan(){
		$this->auth();
		$data = array(
			'nama_jalur' => ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_jalur'=>$this->input->post('id'));
			$this->allcrud->editdata('jalur_pendidikan',$flag,$data);
		}else{
			$this->allcrud->insertdata('jalur_pendidikan',$data);
		}
		
	}

	function edit_jalur_pendidikan($id){
		
		$flag = array('id_jalur'=>$id);
		$q = $this->allcrud->getData('jalur_pendidikan',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delJalur_pendidikan($id){
		$flag = array('id_jalur' => $id);
		$this->allcrud->deletedata('jalur_pendidikan',$flag);
	}
	

/* Jenis Pendidikan */

	function jenis_pendidikan(){
		$this->auth();
		$data = otoritas('master2/jenis_pendidikan',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Jenis Pendidikan';
		$data['page'] 	= 'jenis_pendidikan/data_jenis_pendidikan';
		$this->load->view('template',$data);		
	}

	function ajaxJenis_pendidikan(){
		$this->auth();
		$data = otoritas('master2/jenis_pendidikan',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('jenis_pendidikan','nama_jenis ASC',array());
		$this->load->view('jenis_pendidikan/ajaxJenis_pendidikan',$data);
	}
	
	function proses_jenis_pendidikan(){
		$this->auth();
		$data = array(
			'nama_jenis' => ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_jenis'=>$this->input->post('id'));
			$this->allcrud->editdata('jenis_pendidikan',$flag,$data);
		}else{
			$this->allcrud->insertdata('jenis_pendidikan',$data);
		}
		
	}
	
	function edit_jenis_pendidikan($id){
		
		$flag = array('id_jenis'=>$id);
		$q = $this->allcrud->getData('jenis_pendidikan',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delJenis_pendidikan($id){
		$flag = array('id_jenis' => $id);
		$this->allcrud->deletedata('jenis_pendidikan',$flag);
	}
	
	
/* Jenjang Pendidikan */

	function jenjang_pendidikan(){
		$this->auth();
		$data = otoritas('master2/jenjang_pendidikan',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Jenjang Pendidikan';
		$data['page'] 	= 'jenjang_pendidikan/data_jenjang_pendidikan';
		$this->load->view('template',$data);		
	}

	function ajaxJenjang_pendidikan(){
		$this->auth();
		$data = otoritas('master2/jenjang_pendidikan',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('jenjang_pendidikan','nama_jenjang ASC',array());
		$this->load->view('jenjang_pendidikan/ajaxJenjang_pendidikan',$data);
	}
	
	function proses_jenjang_pendidikan(){
		$this->auth();
		$data = array(
			'nama_jenjang' =>  ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_jenjang'=>$this->input->post('id'));
			$this->allcrud->editdata('jenjang_pendidikan',$flag,$data);
		}else{
			$this->allcrud->insertdata('jenjang_pendidikan',$data);
		}
		
	}
	
	function edit_jenjang_pendidikan($id){
		
		$flag = array('id_jenjang'=>$id);
		$q = $this->allcrud->getData('jenjang_pendidikan',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delJenjang_pendidikan($id){
		$flag = array('id_jenjang' => $id);
		$this->allcrud->deletedata('jenjang_pendidikan',$flag);
	}
	
/* Tipe Mata pelajaran */

	function tipe_pelajaran(){
		$this->auth();
		$data = otoritas('master2/tipe_pelajaran',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Tipe Pelajaran';
		$data['page'] 	= 'tipe_pelajaran/data_tipe_pelajaran';
		$this->load->view('template',$data);		
	}

	function ajaxTipe_pelajaran(){
		$this->auth();
		$data = otoritas('master2/tipe_pelajaran',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('tipe_pelajaran','nama_tipe ASC',array());
		$this->load->view('tipe_pelajaran/ajaxTipe_pelajaran',$data);
	}
	
	function proses_tipe_pelajaran(){
		$this->auth();
		$data = array(
			'nama_tipe' => ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_tipe'=>$this->input->post('id'));
			$this->allcrud->editdata('tipe_pelajaran',$flag,$data);
		}else{
			$this->allcrud->insertdata('tipe_pelajaran',$data);
		}
		
	}
	
	function edit_tipe_pelajaran($id){
		
		$flag = array('id_tipe'=>$id);
		$q = $this->allcrud->getData('tipe_pelajaran',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function deltipe_pelajaran($id){
		$flag = array('id_tipe' => $id);
		$this->allcrud->deletedata('tipe_pelajaran',$flag);
	}
	
	/* Kreteria Mata pelajaran */

	function kriteria(){
		$this->auth();
		$data = otoritas('master2/kriteria',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Kriteria Mata Pelajaran';
		$data['page'] 	= 'kriteria/data_kriteria';
		$data['jenis_list'] = $this->allcrud->listdata('jenis_pendidikan','nama_jenis ASC');
		$data['jalur_list'] = $this->allcrud->listdata('jalur_pendidikan','nama_jalur ASC');
		$data['jenjang_list'] = $this->allcrud->listdata('jenjang_pendidikan','nama_jenjang ASC');
		$data['kelas_list'] = $this->allcrud->listdata('kelas','nama_kelas ASC');
		$data['mapel_list'] = $this->mmaster2->list_matpel();
		$data['siklus_list'] = $this->allcrud->listdata('siklus_belajar','nama_siklus ASC',array());
		$this->load->view('template',$data);		
	}

	function ajaxKriteria(){
		$this->auth();
		$data = otoritas('master2/kriteria',$this->session->userdata('sesRole'));
		$filter="";
		$jenis=$this->uri->segment(3); 
		$jalur=$this->uri->segment(4); 
		$jenjang=$this->uri->segment(5); 
		$kelas=$this->uri->segment(6); 
		if ($jenis=='Z') $jenis='';
		if ($jalur=='Z') $jalur='';
		if ($jenjang=='Z') $jenjang='';
		if ($kelas=='Z') $kelas='';
		if ($jenis!='') $filter=$filter.' jenis='.$jenis;
		if ($jalur!='') {
		    if ($filter!='') $filter= $filter.' and ';
		    $filter=$filter.'jalur='.$jalur;
		}    
		if ($jenjang!='') {
		    if ($filter!='') $filter= $filter.' and ';
		    $filter=$filter.'jenjang='.$jenjang;
		} 
		if ($kelas!='') {
		    if ($filter!='') $filter= $filter.' and ';
		    $filter=$filter.'kelas='.$kelas;
		} 
		$periode = $this->mmaster2->periode_aktif()->result();
	    foreach($periode as $period);
		$data['list']	= $this->mmaster2->list_kriteria($filter,$period->id_raport_periode);
		$this->load->view('kriteria/ajaxKriteria',$data);
	}
	
	function proses_kriteria(){
		$this->auth();
		$periode = $this->mmaster2->periode_aktif()->result();
	    foreach($periode as $period);
		$data = array(
			'subjek' => ucwords(strip_tags($this->input->post('subjek'))),
			'siklus'  => $this->input->post('siklus'),
			'ke'  => $this->input->post('ke'),
			'isi_kriteria'  => $this->input->post('isi'),
			'point'  => $this->input->post('point'),
			'syarat'  => $this->input->post('syarat'),
		    'periode'  =>$period->id_raport_periode
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_kriteria'=>$this->input->post('id'));
			$this->allcrud->editdata('kriteria_pelajaran',$flag,$data);
		}else{
			$this->allcrud->insertdata('kriteria_pelajaran',$data);
		}
		
	}
	
	function edit_kriteria($id){
		
		$flag = array('id_kriteria'=>$id);
		$q = $this->allcrud->getData('kriteria_pelajaran',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delkriteria($id){
		$flag = array('id_kriteria' => $id);
		$this->allcrud->deletedata('kriteria_pelajaran',$flag);
	}
	
	function cek_metode(){
	    $id=$this->uri->segment(3);
	    $flag = array('id_mapel'=>$id);
		$q = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->row();
	    echo json_encode($q);
	}
	
	/* Siklus Belajar */

	function siklus(){
		$this->auth();
		$data = otoritas('master2/siklus',$this->session->userdata('sesRole'));
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Siklus Belajar';
		$data['page'] 	= 'siklus/data_siklus';
		$this->load->view('template',$data);		
	}

	function ajaxSiklus(){
		$this->auth();
		$data = otoritas('master2/siklus',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('siklus_belajar','nama_siklus ASC',array());
		$this->load->view('siklus/ajaxSiklus',$data);
	}
	
	function proses_siklus(){
		$this->auth();
		$data = array(
			'nama_siklus' => ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_siklus'=>$this->input->post('id'));
			$this->allcrud->editdata('siklus_belajar',$flag,$data);
		}else{
			$this->allcrud->insertdata('siklus_belajar',$data);
		}
		
	}
	
	function edit_siklus($id){
		
		$flag = array('id_siklus'=>$id);
		$q = $this->allcrud->getData('siklus_belajar',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delSiklus($id){
		$flag = array('id_siklus' => $id);
		$this->allcrud->deletedata('siklus_belajar',$flag);
	}
	
	/* Jadwal */

	function jadwal(){
		$this->auth();
		$data = otoritas('master2/mata_pelajaran',$this->session->userdata('sesRole'));
		$data['pelajaran']=$this->input->get('p'); 
		$flag = array('id_mapel'=>$this->input->get('p'));
		$q = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->row();
		$data['mapel']	= $q;
		$data['parent'] = 'Master2';
		$data['child'] 	= 'Jadwal Pelajaran';
		$data['page'] 	= 'jadwal/data_jadwal';
		$data['list_periode']	= $this->mmaster2->list_periode();
		$this->load->view('template',$data);		
	}

	function ajaxJadwal(){
		$this->auth();
		$pel=$this->uri->segment(3); 
		$data = otoritas('master2/mata_pelajaran',$this->session->userdata('sesRole'));
		$periode = $this->mmaster2->periode_aktif()->result();
	    foreach($periode as $period);
		$data['list']	= $this->mmaster2->list_jadwal($pel,$period->id_raport_periode);
		$this->load->view('jadwal/ajaxJadwal',$data);
	}
	
	function proses_jadwal(){
		$this->auth();
		$periode = $this->mmaster2->periode_aktif()->result();
	    foreach($periode as $period);
		$data = array(
			'hari' => $this->input->post('hari'),
			'dari' => $this->input->post('dari'),
			'sampai' => $this->input->post('sampai'),
			'pelajaran' =>$this->input->post('pelajaran'),
			'periode' => $this->input->post('periode')
			
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_jadwal'=>$this->input->post('id'));
			$this->allcrud->editdata('jadwal_pelajaran',$flag,$data);
		}else{
			$this->allcrud->insertdata('jadwal_pelajaran',$data);
		}
		
	}
	
	function edit_jadwal($id){
		
		$flag = array('id_jadwal'=>$id);
		$q = $this->allcrud->getData('jadwal_pelajaran',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delJadwal($id){
		$flag = array('id_jadwal' => $id);
		$this->allcrud->deletedata('jadwal_pelajaran',$flag);
	}
}

