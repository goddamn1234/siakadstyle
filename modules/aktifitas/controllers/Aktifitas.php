<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Aktifitas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('maktifitas', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	
	/* Jadwal */
	function jadwal_pelajaran(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Jadwal Pelajaran';
		$data['page'] 	= 'jadwal_pelajaran/data_jadwal';
		$data['teacher']= $this->allcrud->listdata('guru','full_name ASC',array());
		$data['role']=$this->session->userdata('sesRole');
		$data['periode'] =  $this->allcrud->listdata('raport_periode','id_raport_periode DESC',array());
		$data['jenjang'] =  $this->allcrud->listdata('jenjang_pendidikan','id_jenjang DESC',array());
		$data['kelas'] =  $this->allcrud->listdata('kelas','id_kelas DESC',array());
		$user_num=$this->session->userdata('sesId_number');
		$role=$this->session->userdata('sesRole');
		if ($role==6){
		    $ortu = $this->maktifitas->ortu_siswa($user_num)->result();
		    foreach($ortu as $ort);
	        $user_num=$ort->parent_from;
		}
		$data['user_num'] =$user_num;
		$periode = $this->maktifitas->periode_aktif()->result();
		foreach($periode as $period);
	       $fperiode=$period->id_raport_periode;
		$kalender_siswa= $this->maktifitas->list_kalender_siswa($fperiode,$user_num);
		$kalender='';
		if($kalender_siswa->num_rows()>0){
		    foreach($kalender_siswa->result() as $kal);
    	       $kalender=$kal->kalender;
		}
	   	$data['kalender_sis']=$kalender;    
	   	
	   	$jadwal_individu= $this->maktifitas->list_jadwal_individu_siswa($fperiode,$user_num);
		$jadwal_indi='';
		if ($jadwal_individu->num_rows() > 0){
		    foreach($jadwal_individu->result() as $jadw){
    	       $jadwal_indi=$jadw->jadwal;
		    }
	    }    
		$data['jadwal_individu_siswa']=$jadwal_indi;    
		
		$lpds= $this->maktifitas->list_lpds_siswa($fperiode,$user_num);
		$lpds_sis='';
		if ($lpds->num_rows() > 0){
		    foreach($lpds->result() as $lp){
    	       	$lpds_sis=$lp->lpds;
		    }
	    }    
		$data['lpds_siswa']=$lpds_sis;    
		
		$this->load->view('template',$data);
	}
	
    function ajaxJadwal(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$user_num=$this->session->userdata('sesId_number');
		$periode = $this->maktifitas->periode_aktif()->result();
		$fil=$this->uri->segment(3); 
		$fjenjang=$this->uri->segment(4);
		$ftingkat=$this->uri->segment(5); 
		$fkelas=$this->uri->segment(6); 
		if ($fil=='Z'){
	       foreach($periode as $period);
	       $fperiode=$period->id_raport_periode;
		} else $fperiode=$fil;
		if ($role==6){
		    $ortu = $this->maktifitas->ortu_siswa($user_num)->result();
		    foreach($ortu as $ort);
	        $user_num=$ort->parent_from;
		}
		if (($role==4)||($role==6)){
	       $data['list']= $this->maktifitas->list_jadwal_siswa($fperiode,$user_num,1);
	       $data['list2']= $this->maktifitas->list_jadwal_siswa($fperiode,$user_num,2);
	       $data['list3']= $this->maktifitas->list_jadwal_siswa($fperiode,$user_num,3);
	       $data['list4']= $this->maktifitas->list_jadwal_siswa($fperiode,$user_num,4);
	       $data['list5']= $this->maktifitas->list_jadwal_siswa($fperiode,$user_num,5);
	       $data['list6']= $this->maktifitas->list_jadwal_siswa($fperiode,$user_num,6);
	       $data['list7']= $this->maktifitas->list_jadwal_siswa($fperiode,$user_num,7);
	       $data['non']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,1);
	       $data['non2']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,2);
	       $data['non3']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,3);
	       $data['non4']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,4);
	       $data['non5']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,5);
	       $data['non6']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,6);
	       $data['non7']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,7);
	       $data['non7']= $this->maktifitas->list_non_pelajaran_siswa($fperiode,$user_num,7);
        } else { 
	       $data['list']= $this->maktifitas->list_jadwal($fperiode,$fjenjang,$ftingkat,$fkelas,'',1);
	       $data['list2']= $this->maktifitas->list_jadwal($fperiode,$fjenjang,$ftingkat,$fkelas,'',2);
	       $data['list3']= $this->maktifitas->list_jadwal($fperiode,$fjenjang,$ftingkat,$fkelas,'',3);
	       $data['list4']= $this->maktifitas->list_jadwal($fperiode,$fjenjang,$ftingkat,$fkelas,'',4);
	       $data['list5']= $this->maktifitas->list_jadwal($fperiode,$fjenjang,$ftingkat,$fkelas,'',5);
	       $data['list6']= $this->maktifitas->list_jadwal($fperiode,$fjenjang,$ftingkat,$fkelas,'',6);
	       $data['list7']= $this->maktifitas->list_jadwal($fperiode,$fjenjang,$ftingkat,$fkelas,'',7);
	       $data['non']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'1');
	       $data['non2']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'2');
	       $data['non3']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'3');
	       $data['non4']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'4');
	       $data['non5']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'5');
	       $data['non6']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'6');
	       $data['non7']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'7');
		}
		$this->load->view('jadwal_pelajaran/ajaxJadwal',$data);
	}
	
	function ajaxJadwalIndividu(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$user_num=$this->session->userdata('sesId_number');
		$periode = $this->maktifitas->periode_aktif()->result();
		$fil=$this->uri->segment(3); 
		$fjenjang=$this->uri->segment(4);
		$ftingkat=$this->uri->segment(5); 
		$fkelas=$this->uri->segment(6); 
		if ($fil=='Z'){
	       foreach($periode as $period);
	       $fperiode=$period->id_raport_periode;
		} else $fperiode=$fil;
		$data['list_individu']= $this->maktifitas->list_jadwal_individu($fperiode,$fjenjang,$ftingkat,$fkelas);
		$this->load->view('jadwal_pelajaran/ajaxJadwalIndividu',$data);
	}
	
	function ajaxNonPelajaran(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$user_num=$this->session->userdata('sesId_number');
		$periode = $this->maktifitas->periode_aktif()->result();
		$fil=$this->uri->segment(3); 
		$fjenjang=$this->uri->segment(4);
		$ftingkat=$this->uri->segment(5); 
		$fkelas=$this->uri->segment(6); 
		if ($fil=='Z'){
	       foreach($periode as $period);
	       $fperiode=$period->id_raport_periode;
		} else $fperiode=$fil;
		$data['list_non']= $this->maktifitas->list_non_pelajaran($fperiode,$fjenjang,$ftingkat,$fkelas,'');
		$this->load->view('jadwal_pelajaran/ajaxNonPelajaran',$data);
	}
	
	function ajaxLPDS(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$user_num=$this->session->userdata('sesId_number');
		$periode = $this->maktifitas->periode_aktif()->result();
		$fil=$this->uri->segment(3); 
		$fjenjang=$this->uri->segment(4);
		$ftingkat=$this->uri->segment(5); 
		$fkelas=$this->uri->segment(6); 
		if ($fil=='Z'){
	       foreach($periode as $period);
	       $fperiode=$period->id_raport_periode;
		} else $fperiode=$fil;
		$data['list_lpds']= $this->maktifitas->list_lpds($fperiode,$fjenjang,$ftingkat,$fkelas);
		$this->load->view('jadwal_pelajaran/ajaxLPDS',$data);
	}
	
	
	function proses_individu(){
	    $this->auth();
	    $periode=$this->input->post('periode');
	    $siswa=$this->input->post('siswa');
	
		$nama_file=$periode.'_'.$siswa.'.pdf';
		$config['upload_path'] =FCPATH . '/uploads/jadwal_individu';
        $config['allowed_types'] = "pdf";
        $config['overwrite'] = TRUE;
        $config['max_size'] = "2000";
		$config['file_name']  = $nama_file;
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('jadwal')){
		    
		} 
			$ind = $this->maktifitas->jml_jadwal_individu($periode,$siswa)->result();
    		 foreach($ind as $individu);
	          $jml_data=$individu->jml;
           
            if( $jml_data > 0){
               	$data= array('kalender'=>$nama_file);
		        $flag = array('periode'=>$periode,'siswa'=>$siswa);
    			$this->allcrud->editdata('jadwal_individu',$flag,$data);
        	}else{
               $data= array('jadwal'=>$nama_file,'periode'=>$periode,'siswa'=>$siswa);	    
        	   $this->allcrud->insertdata('jadwal_individu',$data);
        	}
    	
	}
	
	function proses_lpds(){
	    $this->auth();
	    $periode=$this->input->post('periode');
	    $siswa=$this->input->post('siswa');
	
		$nama_file=$periode.'_'.$siswa.'.pdf';
		$config['upload_path'] =FCPATH . '/uploads/lpds';
        $config['allowed_types'] = "pdf";
        $config['overwrite'] = TRUE;
        $config['max_size'] = "2000";
		$config['file_name']  = $nama_file;
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('lpds')){
		    
		} 
			$ind = $this->maktifitas->jml_lpds($periode,$siswa)->result();
    		 foreach($ind as $individu);
	          $jml_data=$individu->jml;
           
            if( $jml_data > 0){
               	$data= array('lpds'=>$nama_file);
		        $flag = array('periode'=>$periode,'siswa'=>$siswa);
    			$this->allcrud->editdata('lpds',$flag,$data);
        	}else{
               $data= array('lpds'=>$nama_file,'periode'=>$periode,'siswa'=>$siswa);	    
        	   $this->allcrud->insertdata('lpds',$data);
        	}
    	
	}
	
	function proses_jadwal_non(){
		$this->auth();
		$id_number=$this->session->userdata('sesId_number');
    	$data = array(
    		    'periode' => $this->input->post('periode'),
    		    'jenjang' => $this->input->post('jenjang'),
    			'tingkat' => $this->input->post('tingkat'),
    			'kelas' => $this->input->post('kelas'),
    			'hari' => $this->input->post('hari'),
    			'deskripsi' => $this->input->post('deskripsi'),
    			'dari' => $this->input->post('dari'),
    			'sampai' => $this->input->post('sampai'),
    	);
        if($this->input->post('id') != 'kosong'){
			$flag = array('id'=>$this->input->post('id'));
			$this->allcrud->editdata('jadwal_non_pelajaran',$flag,$data);
    	}else{
    	   $this->allcrud->insertdata('jadwal_non_pelajaran',$data);
    	}
	}
	
	function proses_kalender(){
	    $this->auth();
	    $periode=$this->input->post('periode');
	    $jenjang=$this->input->post('jenjang');
	    $data = array(
			'periode' => $periode, 
			'jenjang'=> $jenjang,
		);
		
		$nama_file=$periode.'_'.$jenjang.'.pdf';
		$config['upload_path'] =FCPATH . '/uploads/kalender';
        $config['allowed_types'] = "pdf";
        $config['overwrite'] = TRUE;
        $config['max_size'] = "2000";
		$config['file_name']  = $nama_file;
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('kalender')){
		    
		} 
			$kal = $this->maktifitas->jml_kalender($periode,$jenjang)->result();
    		 foreach($kal as $kalen);
	          $jml_kalender=$kalen->jml;
           
            if( $jml_kalender > 0){
               	$data= array('kalender'=>$nama_file);
		        $flag = array('periode'=>$periode,'jenjang'=>$jenjang);
    			$this->allcrud->editdata('kalender_akademik',$flag,$data);
        	}else{
               $data= array('kalender'=>$nama_file,'periode'=>$periode,'jenjang'=>$jenjang);	    
        	   $this->allcrud->insertdata('kalender_akademik',$data);
        	}
    	
	}
	
	function del_individu($periode,$siswa){
		$flag = array('periode' => $periode,'siswa' =>$siswa);
		$this->allcrud->deletedata('jadwal_individu',$flag);
	}
	
	function del_lpds($periode,$siswa){
		$flag = array('periode' => $periode,'siswa' =>$siswa);
		$this->allcrud->deletedata('lpds',$flag);
	}
	
	function del_kalender($periode,$jenjang){
		$flag = array('periode' => $periode,'jenjang' => $jenjang);
		$this->allcrud->deletedata('kalender_akademik',$flag);
	}
	
	function edit_jadwal_non($id){
		$flag = array('id'=>$id);
		$q = $this->allcrud->getData('jadwal_non_pelajaran',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function del_jadwal_non($id){
		$flag = array('id' => $id);
		$this->allcrud->deletedata('jadwal_non_pelajaran',$flag);
	}
	
	
	function ajaxKalenderAkademik(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$user_num=$this->session->userdata('sesId_number');
		$data['list_kalender']= $this->maktifitas->list_kalender();
		$this->load->view('jadwal_pelajaran/ajaxKalenderAkademik',$data);
	}
	
	function daftar_murid(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$data['pelajaran']=$this->input->get('p'); 
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Jadwal Pelajaran';
		$data['page'] 	= 'jadwal_pelajaran/data_daftar_murid';
		$this->load->view('template',$data);
	}
	
	function ajaxDaftar_murid(){
		$this->auth();
		$data = otoritas('aktifitas/jadwal_pelajaran',$this->session->userdata('sesRole'));
		$pel=$this->uri->segment(3); 
		$flag = array('id_mapel'=>$pel);
		$mapel = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->row();
		$data['mapel']=$mapel;
		if ($mapel->ikut_krs!='YA')
		   $data['list']	= $this->maktifitas->list_daftar_murid_kelas($mapel->kelas);
		else $data['list']	= $this->maktifitas->list_daftar_murid_krs($pel); 
		$flag = array('id_user'=>$mapel->guru);
		$guru = $this->allcrud->getData('guru',$flag,1,0)->row();
    	$data['guru']=$guru;
		$this->load->view('jadwal_pelajaran/ajaxDaftar_murid',$data);
	}
	
	/* krs */
	function krs(){
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'KRS System';
		if ($role=='4'){
		    //murid
    		$data['page'] 	= 'krs/data_krs_murid';
		} else {
		    //lainnya
		    $data['page'] 	= 'krs/data_krs_guru';
		}	
		$this->load->view('template',$data);
	}
	
	function ajaxKrs_murid(){
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['list']	= $this->maktifitas->list_krs_murid();
		$this->load->view('krs/ajaxKrs_murid',$data);
	}
	
	function daftar_krs(){
		$id_tipe=$this->input->get('tipe'); 
		$p=$this->input->get('p'); 
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Daftar KRS';
		$data['tipe'] = $id_tipe;
		$data['periode'] = $p;
		$data['page'] 	= 'krs/data_daftar_krs';
		$this->load->view('template',$data);
    }
	
	function ajaxDaftar_krs(){
		$id_tipe=$this->uri->segment(3); 
		$periode=$this->uri->segment(4); 
		$id_number=$this->session->userdata('sesId_number');
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$kelas1 = $this->maktifitas->lihat_kelas_murid($id_number)->result();
		if (count($kelas1)>0) {
			foreach ($kelas1 as $kls);
		    $kelas = $kls->id_kelas;
		} else $kelas=0;    
		$data['list']	= $this->maktifitas->list_daftar_krs($periode,$id_tipe,$id_number,$kelas);
		$this->load->view('krs/ajaxDaftar_krs',$data);
	}
	
	function ajaxMurid_disetujui(){
		$pelajaran=$this->uri->segment(3); 
		$periode=$this->uri->segment(4); 
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['list']	= $this->maktifitas->list_murid_disetujui($pelajaran,$periode);
		$this->load->view('krs/ajaxMurid_disetujui',$data);
	}
	
	function ajaxLihat_kriteria(){
		$pelajaran=$this->uri->segment(3); 
		$periode=$this->uri->segment(4); 
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['list']	= $this->maktifitas->list_kriteria($pelajaran,$periode);
		$this->load->view('krs/ajaxLihat_kriteria',$data);
	}
	
	function ajaxLihat_jadwal(){
		$pelajaran=$this->uri->segment(3); 
		$periode=$this->uri->segment(4); 
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['list']	= $this->maktifitas->list_lihat_jadwal($pelajaran,$periode);
		$this->load->view('krs/ajaxLihat_jadwal',$data);
	}
	
	function ajaxKrs_guru(){
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['list']	= $this->maktifitas->list_krs_murid();
		$this->load->view('krs/ajaxKrs_guru',$data);
	}
	
	function proses_daftar_krs(){
	    $pelajaran=$this->uri->segment(3); 
		$this->auth();
		$id_number=$this->session->userdata('sesId_number');
		$periode = $this->maktifitas->periode_aktif()->result();
		foreach($periode as $period);
		$cek = $this->maktifitas->cek_krs($period->id_raport_periode,$pelajaran,$id_number);
		$saatini = date('Y-m-d H:i:s');
		if ($cek==0){
    		$data = array(
    		    'periode' => $period->id_raport_periode,
    		    'murid' => $id_number,
    			'pelajaran' => $pelajaran,
				'status' => '0',
				'tgl_daftar'=>$saatini 
    		);
    		$this->allcrud->insertdata('krs',$data);
		}
		$tipe=$this->maktifitas->lihat_tipe($pelajaran)->result();
		foreach($tipe as $tp);
		redirect(site_url().'aktifitas/daftar_krs?tipe='.$tp->tipe_pelajaran.'&p='.$period->id_raport_periode);	
	}
	
	function batal_daftar(){
	    $id_krs=$this->uri->segment(3); 
		$this->auth();
		$flag = array('id_krs' => $id_krs);
		$this->allcrud->deletedata('krs',$flag);
	}
	
	
	function edit_masukan($id){
		
		$flag = array('id_krs'=>$id);
		$q = $this->allcrud->getData('krs',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function status_krs(){
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Status KRS';
		$data['page'] 	= 'krs/data_status_krs';
		$periode = $this->maktifitas->periode_aktif()->result();
		foreach($periode as $period);
		$data['periode'] =$period->id_raport_periode;
		$this->load->view('template',$data);
    }
	
	function ajaxStatus_krs(){
		$id_number=$this->session->userdata('sesId_number');
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
   	    $periode = $this->maktifitas->periode_aktif()->result();
		foreach($periode as $period);
	 	$data['list'] = $this->maktifitas->list_status_krs($period->id_raport_periode,$id_number);
		$this->load->view('krs/ajaxStatus_krs',$data);
	}
	
	function pengajuan_mapel_krs(){
		$id_tipe=$this->input->get('tipe'); 
		$p=$this->input->get('p'); 
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Pengajuan KRS';
		$data['tipe'] = $id_tipe;
		$data['periode'] = $p;
		$data['page'] 	= 'krs/data_mapel_pengajuan_krs';
		$this->load->view('template',$data);
    }
    
    function ajaxMapel_Pengajuan_krs(){
        $id_tipe=$this->uri->segment(3); 
		$periode=$this->uri->segment(4); 
		$role=$this->session->userdata('sesRole');
		if ($role=='3') $id_user=$this->session->userdata('sesId_number'); else $id_user='';
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['list']	= $this->maktifitas->list_mapel_pengajuan_krs($periode,$id_tipe,$id_user);
	    $this->load->view('krs/ajaxMapel_pengajuan_krs',$data);
	}
	
	
	function pengajuan_krs(){
		$id_pel=$this->input->get('pel'); 
		$p=$this->input->get('p'); 
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Lihat Pengajuan KRS';
		$data['mapel'] = $id_pel;
		$data['periode'] = $p;
		$data['page'] 	= 'krs/data_pengajuan_krs';
		$this->load->view('template',$data);
    }
	
	function ajaxPengajuan_krs(){
		$id_mapel=$this->uri->segment(3); 
		$periode=$this->uri->segment(4); 
		$role=$this->session->userdata('sesRole');
		if ($role=='3') $id_user=$this->session->userdata('sesId_number'); else $id_user='';
		$this->auth();
		$data = otoritas('aktifitas/krs',$this->session->userdata('sesRole'));
		$data['list']	= $this->maktifitas->list_pengajuan_krs($periode,$id_mapel,$id_user);
	    $this->load->view('krs/ajaxPengajuan_krs',$data);
	}
	
	function terima_krs(){
	    $id_krs=$this->uri->segment(3); 
		$this->auth();
		$data = array(
		    'status' => '1'
        );	
		$flag = array('id_krs'=>$id_krs);
		$this->allcrud->editdata('krs',$flag,$data);
	}
	
	function tolak_krs(){
	    $id_krs=$this->uri->segment(3); 
		$this->auth();
		$data = array(
		    'status' => '2'
        );	
		$flag = array('id_krs'=>$id_krs);
		$this->allcrud->editdata('krs',$flag,$data);
	}
	
	//ijin keluar
	function ijin_keluar(){
		$this->auth();
		$data = otoritas('aktifitas/ijin_keluar',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Ijin Keluar';
		$data['role'] = $role;
		$data['page'] 	= 'ijin_keluar/data_ijin_keluar';
		$this->load->view('template',$data);
    }
    
	function ajaxIjin_keluar(){
		$role=$this->session->userdata('sesRole');
		if (($role=='3')||($role=='4')) $id_user=$this->session->userdata('sesId_number'); else $id_user='';
		$this->auth();
		$data = otoritas('aktifitas/ijin_keluar',$this->session->userdata('sesRole'));
		$data['list'] = $this->maktifitas->list_ijin_keluar($id_user);
	    $this->load->view('ijin_keluar/ajaxIjin_keluar',$data);
	}
	
	function proses_ijin_keluar(){
	    $this->auth();
		$role=$this->session->userdata('sesRole');
		if ($role=='4') $jenis='M'; else $jenis='P';
		$id_number=$this->session->userdata('sesId_number');
		$periode = $this->maktifitas->periode_aktif()->result();
		foreach($periode as $period);
		$data2 = array(
    		    'periode' => $period->id_raport_periode,
    		    'tgl' =>  $this->input->post('tgl'),
    			'jam' =>  $this->input->post('jam'),
    			'keperluan' =>  $this->input->post('keperluan'),
    		    'id_user' => $id_number,
    		    'jns' => $jenis,
    			'status' =>  '0'
		);
		$this->allcrud->insertdata('ijin_keluar',$data2);
	}
	
	function edit_ijin_keluar($id){
		
		$flag = array('id'=>$id);
		$q = $this->allcrud->getData('ijin_keluar',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delIjin_keluar($id){
		$flag = array('id' => $id);
		$this->allcrud->deletedata('ijin_keluar',$flag);
	}
	
	//persetujuan ijin keluar
	function persetujuan_ijin_keluar(){
	    echo 'test';
		$this->auth();
		$data = otoritas('aktifitas/persetujuan_ijin_keluar',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
		$data['parent'] = 'Aktifitas Belajar';
		$data['child'] 	= 'Persetujuan Ijin Keluar';
		$data['role'] = $role;
		$data['page'] 	= 'persetujuan_ijin_keluar/data_persetujuan_ijin_keluar';
		$this->load->view('template',$data);
    }
    
	function ajaxPersetujuan_ijin_keluar(){
	    $role=$this->session->userdata('sesRole');
		if (($role=='3')||($role=='4')) $id_user=$this->session->userdata('sesId_number'); else $id_user='';
		$this->auth();
		$data = otoritas('aktifitas/persetujuan_ijin_keluar',$this->session->userdata('sesRole'));
		$data['list'] = $this->maktifitas->list_persetujuan_ijin_keluar();
	    $this->load->view('persetujuan_ijin_keluar/ajaxPersetujuan_ijin_keluar',$data);
	}
	
	function setuju($id){
		$flag = array('id' => $id);
		$data = array(
			'status' => '1'
		);	
    	$this->allcrud->editdata('ijin_keluar',$flag,$data);
	}
	
	function tolak($id){
		$flag = array('id' => $id);
		$data = array(
			'status' => '2'
		);	
    	$this->allcrud->editdata('ijin_keluar',$flag,$data);
	}
	
	/* LPDS */
	function lpds(){
		$this->auth();
		$data = otoritas('aktifitas/lpds',$this->session->userdata('sesRole'));
		$data['parent'] = 'Siswa';
		$data['child'] 	= 'LPDS';
		$data['page'] 	= 'jadwal_pelajaran/data_lpds';
		$data['teacher']= $this->allcrud->listdata('guru','full_name ASC',array());
		$data['role']=$this->session->userdata('sesRole');
		$data['periode'] =  $this->allcrud->listdata('raport_periode','id_raport_periode DESC',array());
		$data['jenjang'] =  $this->allcrud->listdata('jenjang_pendidikan','id_jenjang DESC',array());
		$data['kelas'] =  $this->allcrud->listdata('kelas','id_kelas DESC',array());
		$user_num=$this->session->userdata('sesId_number');
		$role=$this->session->userdata('sesRole');
		if ($role==6){
		    $ortu = $this->maktifitas->ortu_siswa($user_num)->result();
		    foreach($ortu as $ort);
	        $user_num=$ort->parent_from;
		}
		$data['user_num'] =$user_num;

		$this->load->view('template',$data);
	}
	
	function ajaxLpdsSiswa(){
		$this->auth();
		$data = otoritas('aktifitas/lpds',$this->session->userdata('sesRole'));
		$role=$this->session->userdata('sesRole');
	    $user_num=$this->session->userdata('sesId_number');
		$role=$this->session->userdata('sesRole');
		if ($role==6){
		    $ortu = $this->maktifitas->ortu_siswa($user_num)->result();
		    foreach($ortu as $ort);
	        $user_num=$ort->parent_from;
		}
		$data['user_num'] =$user_num;
		
		$lpds= $this->maktifitas->list_lpds_siswa($user_num);
		$data['lpds_siswa']=$lpds;    
		$this->load->view('jadwal_pelajaran/ajaxLpdsSiswa',$data);
	}
	
}
?>