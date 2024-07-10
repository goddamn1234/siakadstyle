<?php

class Raport_proyek extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model ('mraport_proyek', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}

	function daftar_proyek(){
        $this->auth();
		$data = otoritas('raport_proyek/daftar_proyek',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport Proyek';
		$data['child'] 	= 'Daftar Proyek';
		$data['page'] 	= 'data_daftar_proyek';
		$this->load->view('template',$data);		
	}

	function ajaxDaftar_proyek(){
    	$this->auth();
        $data = otoritas('raport_proyek/daftar_proyek',$this->session->userdata('sesRole'));
	    $id_number=$this->session->userdata('sesId_number');
	    $role=$this->session->userdata('sesRole');
	    if ($role=='4') $murid=$this->session->userdata('sesId_number'); else $murid='';
	    $data['list']	= $this->mraport_proyek->list_proyek($murid);
	    $this->load->view('ajaxDaftar_proyek',$data);
	}
	
	function proses_simpan(){
		$this->auth();
		$periode = $this->mraport_proyek->periode_aktif()->result();
	    foreach($periode as $period);
		$data = array(
			'nama' => ucwords(strip_tags($this->input->post('nama'))),
			'penjelasan' => $this->input->post('penjelasan'),
			'ke' => $this->input->post('ke'),
			'murid'=> $this->session->userdata('sesId_number'),
			'status'=> '0',
			'periode'=>$period->id_raport_periode
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_proyek'=>$this->input->post('id'));
			$this->allcrud->editdata('proyek',$flag,$data);
		}else{
			$this->allcrud->insertdata('proyek',$data);
		}
		
	}
	
	function proses_simpan_tgl(){
		$this->auth();
      	$data = array(
			'tgl_awal' => $this->input->post('tgl_awal'),
			'tgl_akhir' => $this->input->post('tgl_akhir'),
		);
	    $flag = array('id_proyek'=>$this->input->post('id_prj'));
		$this->allcrud->editdata('proyek',$flag,$data);
	}
	
	function simpan_proyek_detail(){
		$this->auth();
		$data = array(
		    'id_proyek' =>$this->input->post('id_proyek'),
			'siklus' =>$this->input->post('siklus'),
			'ke' =>$this->input->post('ke'),
			'kriteria' =>$this->input->post('kriteria')
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_detail'=>$this->input->post('id'));
			$this->allcrud->editdata('proyek_detail',$flag,$data);
		}else{
			$this->allcrud->insertdata('proyek_detail',$data);
		} 
	}

	function edit_proyek($id){
		$flag = array('id_proyek'=>$id);
		$q = $this->allcrud->getData('proyek',$flag,1,0)->row();
		echo json_encode($q);
	}
	
	function edit_tgl_proyek($id){
		$flag = array('id_proyek'=>$id);
		$q = $this->allcrud->getData('proyek',$flag,1,0)->row();
		echo json_encode($q);
	}
	
	function edit_proyek_detail($id){
		$flag = array('id_detail'=>$id);
		$q = $this->allcrud->getData('proyek_detail',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delete_proyek($id){
		$flag = array('id_proyek' => $id);
		$this->allcrud->deletedata('proyek',$flag);
	}
	
	function delete_proyek_detail($id){
		$flag = array('id_detail' => $id);
		$this->allcrud->deletedata('proyek_detail',$flag);
	}
	
	function detail_proyek(){
	    $this->auth();
		$data = otoritas('raport_proyek/daftar_proyek',$this->session->userdata('sesRole'));
		$id_number=$this->input->get('m'); 
		$id_proyek=$this->input->get('p');
		$data['id_number']=$id_number; 
		$data['id_proyek']=$id_proyek;
	    $flag = array('id_proyek'=>$id_proyek);
		$data['proyek'] = $this->allcrud->getData('proyek',$flag,1,0)->result();
	    $flag = array('id_number'=>$id_number);
	   	$data['murid'] = $this->allcrud->getData('student',$flag,1,0)->result();
		$data['fasilitator'] = $this->mraport_proyek->lihat_fasilitator($id_number)->result();
		$data['siklus'] = $this->allcrud->listdata('siklus_belajar','nama_siklus ASC');
		$data['kelas'] = $this->mraport_proyek->lihat_kelas($id_number)->result();
		$data['parent'] = 'Raport Proyek';
		$data['child'] 	= 'Daftar Proyek';
		$data['page'] 	= 'data_lihat_detail';
		$this->load->view('template',$data);	
	}
	
	function ajaxDetail_proyek(){
    	$this->auth();
	    $data = otoritas('raport_proyek/daftar_proyek',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	   	$id_proyek=$this->uri->segment(3);
	    $data['list']	= $this->mraport_proyek->list_proyek_detail($id_proyek);
	    $this->load->view('ajaxLihat_detail',$data);
	}
	

	function penilaian(){
        $this->auth();
		$data = otoritas('raport_proyek/penilaian',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport Proyek';
		$data['child'] 	= 'Penilaian';
		$data['page'] 	= 'data_penilaian';
		$this->load->view('template',$data);		
	}
	
	function ajaxPenilaian(){
    	$this->auth();
	    $data = otoritas('raport_proyek/penilaian',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    if ($role==3)
	       $guru=$this->session->userdata('sesId_number');
	    else $guru='';
	    $periode = $this->mraport_proyek->periode_aktif()->result();
	    foreach($periode as $period);
	    $data['list']	= $this->mraport_proyek->list_siswa_yg_ada_proyek($guru);
	    $this->load->view('ajaxPenilaian',$data);
	}
	
	function daftar_proyek_murid(){
        $this->auth();
		$data = otoritas('raport_proyek/penilaian',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport Proyek';
		$data['child'] 	= 'Daftar Proyek';
		$id_number=$this->input->get('m'); 
		$data['final'] =$this->input->get('f'); 
		$flag = array('id_number'=>$id_number);
	   	$data['murid'] = $this->allcrud->getData('student',$flag,1,0)->result();
		$data['page'] 	= 'data_daftar_proyek_murid';
		$this->load->view('template',$data);		
	}

	function ajaxDaftar_proyek_murid(){
    	$this->auth();
	    $data = otoritas('raport_proyek/penilaian',$this->session->userdata('sesRole'));
	    $id_number=$this->uri->segment(3); 
	    $data['final']=$this->uri->segment(4); 
	    $data['list']	= $this->mraport_proyek->list_proyek_sekarang($id_number);
	    $this->load->view('ajaxDaftar_proyek_murid',$data);
	}
	
	function pengisian_nilai(){
	    $this->auth();
		$data = otoritas('raport_proyek/penilaian',$this->session->userdata('sesRole'));
		$id_number=$this->input->get('m'); 
		$id_proyek=$this->input->get('p');
		if ($this->input->get('f')=='1')
		    $data['final']='1'; else $data['final']='';    
		$data['id_number']=$id_number; 
		$data['id_proyek']=$id_proyek;
	    $flag = array('id_proyek'=>$id_proyek);
		$data['proyek'] = $this->allcrud->getData('proyek',$flag,1,0)->result();
	    $flag = array('id_number'=>$id_number);
	   	$data['murid'] = $this->allcrud->getData('student',$flag,1,0)->result();
		$data['fasilitator'] = $this->mraport_proyek->lihat_fasilitator($id_number)->result();
		$data['siklus'] = $this->allcrud->listdata('siklus_belajar','nama_siklus ASC');
		$data['kelas'] = $this->mraport_proyek->lihat_kelas($id_number)->result();
		$data['parent'] = 'Raport Proyek';
		$data['child'] 	= 'Penilaian';
		$data['page'] 	= 'data_pengisian_nilai';
		$this->load->view('template',$data);	
	}
	
	function ajaxPengisian_nilai(){
	    $this->auth();
	    $data = otoritas('raport_proyek/penilaian',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	   	$id_proyek=$this->uri->segment(3);
	    $data['list']	= $this->mraport_proyek->list_proyek_detail($id_proyek);
	    $this->load->view('ajaxPengisian_nilai',$data);
	}
	
	function simpan_pengisian_nilai(){
		$this->auth();
		$data = array(
		    'id_proyek' =>$this->input->post('id_proyek'),
			'siklus' =>$this->input->post('siklus'),
			'ke' =>$this->input->post('ke'),
			'kriteria' =>$this->input->post('kriteria'),
			'tampil' =>$this->input->post('tampil'),
			'nilai' =>$this->input->post('nilai'),
			'konversi' =>$this->input->post('konversi'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_detail'=>$this->input->post('id'));
			$this->allcrud->editdata('proyek_detail',$flag,$data);
		}else{
			$this->allcrud->insertdata('proyek_detail',$data);
		}
		$data = array(
		    'tgl_modif' =>date('Y-m-d')
	    );
		$flag = array('id_proyek'=>$this->input->post('id_proyek'));
		$this->allcrud->editdata('proyek',$flag,$data);
	}
	
	function simpan_catatan(){
		$this->auth();
		$data = array(
			'nama' =>$this->input->post('nama'),
			'penjelasan' =>$this->input->post('penjelasan'),
			'catatan_siswa' =>$this->input->post('catatan_siswa'),
			'durasi' =>$this->input->post('durasi'),
			'catatan_spesial' =>$this->input->post('catatan_spesial'),
			'catatan_khusus' =>$this->input->post('catatan_khusus'),
			'catatan_target' =>$this->input->post('catatan_target'),
			'dur_dioutput' =>$this->input->post('dur_dioutput'),
			'csis_dioutput' =>$this->input->post('csis_dioutput'),
			'csp_dioutput' =>$this->input->post('csp_dioutput'),
			'ccp_dioutput' =>$this->input->post('ccp_dioutput'),
		    'tgl_modif' =>date('Y-m-d')
	 	);
		$flag = array('id_proyek'=>$this->input->post('id_proyek'));
		$this->allcrud->editdata('proyek',$flag,$data);
	}
	
	function submit_penilaian(){
		$this->auth();
		$data = array(
			'nama' =>$this->input->post('nama'),
			'penjelasan' =>$this->input->post('penjelasan'),
			'catatan_siswa' =>$this->input->post('catatan_siswa'),
			'durasi' =>$this->input->post('durasi'),
			'catatan_spesial' =>$this->input->post('catatan_spesial'),
			'catatan_khusus' =>$this->input->post('catatan_khusus'),
		    'tgl_modif' =>date('Y-m-d'),
		    'sdh_dikoreksi' =>'1'
	 	);
		$flag = array('id_proyek'=>$this->input->post('id_proyek'));
		$this->allcrud->editdata('proyek',$flag,$data);
	}
	
	function submit_penilaian_final(){
		$this->auth();
		$data = array(
			'nama' =>$this->input->post('nama'),
			'penjelasan' =>$this->input->post('penjelasan'),
			'catatan_siswa' =>$this->input->post('catatan_siswa'),
			'durasi' =>$this->input->post('durasi'),
			'catatan_spesial' =>$this->input->post('catatan_spesial'),
			'catatan_khusus' =>$this->input->post('catatan_khusus'),
		    'tgl_modif' =>date('Y-m-d'),
		    'sdh_final' =>'1'
	 	);
		$flag = array('id_proyek'=>$this->input->post('id_proyek'));
		$this->allcrud->editdata('proyek',$flag,$data);
	}
	
	function koreksi_final(){
	    $this->auth();
		$data = otoritas('raport_proyek/koreksi_final',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport Proyek';
		$data['child'] 	= 'Penilaian Final';
		$data['page'] 	= 'data_penilaian_final';
		$this->load->view('template',$data);
	}
	
	function ajaxPenilaian_final(){
    	$this->auth();
	    $data = otoritas('raport_proyek/koreksi_final',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    $periode = $this->mraport_proyek->periode_aktif()->result();
	    foreach($periode as $period);
	    if ($role=='3') {
	        $guru=$this->session->userdata('sesId_number');
	        $guru_final = $this->mraport_proyek->cek_guru_final_corector($guru)->result();
	        foreach($guru_final as $gfinal);
	        if ($gfinal->hasil>0) $filter=true; else $filter=false;
	    } else $filter=true;  
	    $data['list']	= $this->mraport_proyek->list_siswa_yg_ada_proyek2($filter);
	    $this->load->view('ajaxPenilaian_final',$data);
	}
	
	function daftar_raport(){
        $this->auth();
		$data = otoritas('raport_proyek/daftar_raport',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport Proyek';
		$data['child'] 	= 'Daftar Raport';
		$data['page'] 	= 'data_daftar_raport'; 
		$this->load->view('template',$data);		
	}

	function ajaxDaftar_raport(){
	    echo 'test';
    	$this->auth();
        $data = otoritas('raport_proyek/daftar_raport',$this->session->userdata('sesRole'));
	    $id_number=$this->session->userdata('sesId_number');
	    $role=$this->session->userdata('sesRole');
	    $data['list']	= $this->mraport_proyek->list_raport();
	   $this->load->view('ajaxDaftar_raport',$data);
	}
	
	function create_raport(){ 
    	$this->auth();
    	$id_murid=$this->uri->segment(3);
    	$per=$this->uri->segment(4);
        $rpt=$this->mraport_proyek->list_proyek_di_raport_murid($id_murid,$per)->result();
    	foreach($rpt as $raport){
	        $header=$this->mraport_proyek->list_raport_header($raport->id_proyek,$per);
	        $data['header']=$header;
	        $jml_siklus = $this->mraport_proyek->jml_siklus_proyek($raport->id_proyek)->result();
	        $data['jml_siklus']=0;
	        foreach($jml_siklus as $jml_sik);
	        $data['jml_siklus']=$jml_sik->jml;
	        $jml_item = $this->mraport_proyek->max_item_siklus_proyek($raport->id_proyek)->result();
	        $data['jml_item']=0;
	        foreach($jml_item as $max_item);
	        $data['max_item']=$max_item->jml;
	        $data['siklus'] = $this->mraport_proyek->siklus_proyek($raport->id_proyek);
	        $detail = $this->mraport_proyek->list_raport_proyek_detail($raport->id_proyek);
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
    	    if ($per==''){
    	       $periode = $this->mraport_proyek->periode_aktif()->result();
    	       foreach($periode as $period);
    	       $per=$period->id_raport_periode;
    	    }    
    	    $data['catat']=$this->mraport_proyek->list_catatan_final($head->murid,$per);
    	}    
    
	    $html=$this->load->view('design_raport_proyek.php',$data,true);
	    $filename	= 'Download';
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename, true, 'A2', 'portrait');
    }	
    
    function create_raport_konversi(){ 
    	$this->auth();
    	$id_murid=$this->uri->segment(3);
    	$per=$this->uri->segment(4);
	    $rpt=$this->mraport_proyek->list_proyek_di_raport_murid($id_murid,$per)->result();
    	foreach($rpt as $raport){
	        $header=$this->mraport_proyek->list_raport_header($raport->id_proyek,$per);
	        $data['header']=$header;
	        $jml_siklus = $this->mraport_proyek->jml_siklus_proyek($raport->id_proyek)->result();
	        $data['jml_siklus']=0;
	        foreach($jml_siklus as $jml_sik);
	        $data['jml_siklus']=$jml_sik->jml;
	        $jml_item = $this->mraport_proyek->max_item_siklus_proyek($raport->id_proyek)->result();
	        $data['jml_item']=0;
	        foreach($jml_item as $max_item);
	        $data['max_item']=$max_item->jml;
	        $data['siklus'] = $this->mraport_proyek->siklus_proyek($raport->id_proyek);
	        $detail = $this->mraport_proyek->list_raport_proyek_detail($raport->id_proyek);
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
    	    if ($per==''){
    	       $periode = $this->mraport_proyek->periode_aktif()->result();
    	       foreach($periode as $period);
    	       $per=$period->id_raport_periode;
    	    }    
    	    $data['catat']=$this->mraport_proyek->list_catatan_final($head->murid,$per);
    	}    
    
	    $html=$this->load->view('design_raport_proyek_konversi.php',$data,true);
	    $filename	= 'Download';
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename, true, 'A2', 'portrait');
    }
}

