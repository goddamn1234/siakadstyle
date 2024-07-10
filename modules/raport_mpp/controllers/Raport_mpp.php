<?php

class Raport_mpp extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model ('mRaport_mpp', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
	}
	
	function penilaian(){
        $this->auth();
		$data = otoritas('raport_mpp/penilaian',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Penilaian';
		$data['page'] 	= 'isi_nilai/data_penilaian';
	    $data['periode'] =  $this->allcrud->listdata('raport_periode','id_raport_periode DESC',array());
		$this->load->view('template',$data);		
	}

	function ajaxPenilaian(){
    	$this->auth();
	    $data = otoritas('raport_mpp/penilaian',$this->session->userdata('sesRole'));
	    if ($this->session->userdata('sesRole')=='3')
	        $guru=$this->session->userdata('sesId_number'); else $guru='';
	    $id_periode=$this->uri->segment(3);
	    if ($id_periode==''){
	      $periode = $this->mRaport_mpp->periode_aktif()->result();
	      foreach($periode as $period);
	      $id_periode=$period->id_raport_periode;
	    }  
	    $data['periode'] = $id_periode;
	    $data['list'] = $this->mRaport_mpp->list_penilaian($id_periode,$guru);
	    $this->load->view('isi_nilai/ajaxPenilaian',$data);
	}

	function daftar_nilai(){
        $this->auth();
		$data = otoritas('raport_mpp/penilaian',$this->session->userdata('sesRole'));
		$data['pelajaran']=$this->input->get('p'); 
    	$data['kelas']=$this->input->get('k');
    	$data['periode']=$this->input->get('pr');
    	$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Pengisian Nilai';
		$data['page'] 	= 'isi_nilai/data_daftar_nilai';
		$this->load->view('template',$data);		
	}

	function ajaxDaftar_nilai(){
    	$this->auth();
    	$pelajaran="";
    	$kelas="";
        $pelajaran=$this->uri->segment(3); 
		$kelas=$this->uri->segment(4);
		$per=$this->uri->segment(5);
	    $data = otoritas('raport_mpp/penilaian',$this->session->userdata('sesRole'));
	    $id_number=$this->session->userdata('sesId_number');
	    if (($per=='')||($per=='ZZ')){
	       $periode = $this->mRaport_mpp->periode_aktif()->result();
	       foreach($periode as $period);
	       $per=$period->id_raport_periode;
	    }
	    $data['list']	= $this->mRaport_mpp->list_daftar_nilai($per,$pelajaran,$kelas);
	    $this->load->view('isi_nilai/ajaxDaftar_nilai',$data);
	}
	
	function pengisian_nilai(){
	    $this->auth();
		$data = otoritas('raport_mpp/penilaian',$this->session->userdata('sesRole'));
		$id_number=$this->input->get('m'); 
		$id_mapel=$this->input->get('p'); 
		$id_periode=$this->input->get('pr'); 
		$periode = $this->mRaport_mpp->periode_aktif()->result();
        foreach($periode as $period);
        $id_periode_aktif=$period->id_raport_periode;
	    if ($id_periode==''){
	       $id_periode=$id_periode_aktif;
	    }
	    $data['periode']=$id_periode; 
	    $data['periode_aktif']=$id_periode_aktif; 
		if ($this->input->get('k')=='1') $data['koreksi']='1'; else if ($this->input->get('k')=='2')  $data['koreksi']='2'; else $data['koreksi']='0';
		$flag = array('id_mapel'=>$id_mapel);
		$data['pelajaran'] = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->result();
		$data['kelas']=$this->mRaport_mpp->lihat_kelas($id_number)->result();
		$flag = array('id_number'=>$id_number);
		$data['murid'] = $this->allcrud->getData('student',$flag,1,0)->result();
		$flag = array('murid'=>$id_number,'pelajaran'=>$id_mapel,'periode'=>$id_periode);
		$data['nilai'] = $this->allcrud->getData('nilai',$flag,1,0)->result();
		$data['fasilitator'] = $this->mRaport_mpp->lihat_fasilitator($id_number)->result();
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Pengisian Nilai';

		$data['page'] 	= 'isi_nilai/data_pengisian_nilai';
		$this->load->view('template',$data);	
	}
	
	function ajaxPengisian_nilai(){
	    $this->auth();
	    $data = otoritas('raport_mpp/penilaian',$this->session->userdata('sesRole'));
	    $id_number=$this->uri->segment(3); 
		$id_mapel=$this->uri->segment(4);
	    $id_periode=$this->uri->segment(5);
	    $bisa_edit=$this->uri->segment(6);
	    $periode = $this->mRaport_mpp->periode_aktif()->result();
        foreach($periode as $period);
        $id_periode_aktif=$period->id_raport_periode;
	    if ($id_periode==''){
	       $id_periode=$id_periode_aktif;
	    }
	    $flag = array('murid'=>$id_number,'pelajaran'=>$id_mapel,'periode'=>$id_periode);
	    $data['periode']=$id_periode; 
	    $data['periode_aktif']=$id_periode_aktif;
	    $data['bisa_edit'] = $bisa_edit;
		$data['list'] = $this->mRaport_mpp->list_kriteria_nilai($id_periode,$id_number,$id_mapel);
		$data['nilai'] = $this->allcrud->getData('nilai',$flag,1,0)->result();
	    $flag = array('id_mapel'=>$id_mapel);
		$data['pelajaran'] = $this->allcrud->getData('mata_pelajaran',$flag,1,0)->result();
		$flag = array('id_number'=>$id_number);
		$data['murid'] = $this->allcrud->getData('student',$flag,1,0)->result();
	    $this->load->view('isi_nilai/ajaxPengisian_nilai',$data);
	}
	
	function koreksi_nilai(){
        $this->auth();
		$data = otoritas('raport_mpp/koreksi_nilai',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Koreksi Nilai';
		$data['page'] 	= 'isi_nilai/data_koreksi_nilai';
		$data['periode'] =  $this->allcrud->listdata('raport_periode','id_raport_periode DESC',array());
		$this->load->view('template',$data);		
	}

    function ajaxKoreksi_nilai(){
    	$this->auth();
	    $data = otoritas('raport_mpp/koreksi_nilai',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    if ($role=='3') $guru=$this->session->userdata('sesId_number'); else $guru='';
	    $id_number=$this->session->userdata('sesId_number');
	    $id_periode=$this->uri->segment(3);
	    if ($id_periode==''){
	      $periode = $this->mRaport_mpp->periode_aktif()->result();
	      foreach($periode as $period);
	      $id_periode=$period->id_raport_periode;
	    }
	    $data['periode']=$id_periode;
	    $data['list']	= $this->mRaport_mpp->list_kelas_koreksi($id_periode,$guru);
	    $this->load->view('isi_nilai/ajaxKoreksi_nilai',$data);
	}
	
	function daftar_koreksi_nilai(){
        $this->auth();
		$data = otoritas('raport_mpp/koreksi_nilai',$this->session->userdata('sesRole'));
		$data['kelas']=$this->input->get('k'); 
		$data['periode']=$this->input->get('pr'); 
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Koreksi Nilai';
		$data['page'] 	= 'isi_nilai/data_daftar_koreksi_nilai';
		$this->load->view('template',$data);		
	}
	
	function ajaxDaftar_koreksi_nilai(){
    	$this->auth();
    	$data = otoritas('raport_mpp/koreksi_nilai',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    if ($role=='3') $guru=$this->session->userdata('sesId_number'); else $guru='';
	    $kelas=$this->uri->segment(3);
	    $id_periode=$this->uri->segment(4);
	    $id_number=$this->session->userdata('sesId_number'); 
	    if ($id_periode==''){ 
	       $periode = $this->mRaport_mpp->periode_aktif()->result();
	       foreach($periode as $period);
	       $id_periode=$period->id_raport_periode;
	    }     
	    $data['list']	= $this->mRaport_mpp->list_daftar_koreksi($id_periode,$guru,$kelas);
	    $this->load->view('isi_nilai/ajaxDaftar_koreksi_nilai',$data);
	}
	
	function lihat_nilai(){
        $this->auth();
		$data = otoritas('raport_mpp/koreksi_nilai',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Koreksi Nilai';
		$id_number=$this->input->get('m'); 
		$id_periode=$this->input->get('pr'); 
		if ($this->input->get('f')=='1')
		$data['final']='1'; else $data['final']='0';
		$data['murid']=$id_number;
		$data['periode']=$id_periode;
		$data['page'] 	= 'isi_nilai/data_lihat_nilai';
		$this->load->view('template',$data);		
	}

	function ajaxLihat_nilai(){
    	$this->auth();
	    $data = otoritas('raport_mpp/koreksi_nilai',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    $murid=$this->uri->segment(3);
	    $final=$this->uri->segment(4);
	    $id_periode=$this->uri->segment(5);
	    $data['final']=$final;
	    if ($id_periode==''){
	       $periode = $this->mRaport_mpp->periode_aktif()->result();
	       foreach($periode as $period);
	       $id_periode=$period->id_raport_periode; 
	    }    
	    $data['list']	= $this->mRaport_mpp->list_lihat_nilai($id_periode,$murid);
	    $data['periode']= $id_periode;
	    //$data['list']=$this->allcrud->getData('student',$flag,1,0)->result();
	    $this->load->view('isi_nilai/ajaxLihat_nilai',$data);
	}
	
	function edit_pengisian_nilai(){
		$murid=$this->uri->segment(3);
		$id_kriteria=$this->uri->segment(4);
		$periode = $this->mRaport_mpp->periode_aktif()->result();
	    foreach($periode as $period);
		$flag = array('id_kriteria'=>$id_kriteria,'murid'=>$murid,'periode'=>$period->id_raport_periode);
		$q = $this->allcrud->getData('nilai_detail',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function proses_simpan_nilai(){
		$this->auth();
		$pel = $this->mRaport_mpp->lihat_pelajaran($this->input->post('id'))->result();
	    foreach($pel as $mpel);
	    
		$flag = array('id_kriteria'=>$this->input->post('id'),
		               'murid'=>$this->input->post('murid'),
		               'periode'=>$this->input->post('periode')
		          );
	    $cek = $this->allcrud->getdata('nilai_detail',$flag,1,0);
		if($cek->num_rows()> 0){
		    $data = array(
    		    'nilai' => $this->input->post('nilai'),
    			'pelajaran' => $mpel->subjek
    		);
	    	$this->allcrud->editdata('nilai_detail',$flag,$data);
		}else{
		    $data = array(
		        'id_kriteria'=>$this->input->post('id'),
		        'murid'=>$this->input->post('murid'),
		        'periode'=>$this->input->post('periode'),
    		    'nilai' => $this->input->post('nilai'),
    			'pelajaran' => $mpel->subjek
    		);
			$this->allcrud->insertdata('nilai_detail',$data);
		}
		
		//otomatis penilaian

	    $metode_penilaian=$this->mRaport_mpp->metode_penilaian($mpel->subjek)->result();
	    foreach($metode_penilaian as $metode);
	    if ($metode->metode=='1'){
	        //point
	        $kriteria_terpenuhi=$this->mRaport_mpp->kriteria_terpenuhi($this->input->post('murid'),$mpel->subjek,$this->input->post('periode'))->result();
	        $kriteria=$this->mRaport_mpp->hit_kriteria($mpel->subjek,$this->input->post('periode'))->result();
	        foreach($kriteria_terpenuhi as $kr_terpenuhi);
	        foreach($kriteria as $kr);
	        if ($kr_terpenuhi->jml>=$metode->point) $hasil='Y'; else $hasil='T';
	    } else {
	        //fix syarat
	        $tdk_memenuhi_syarat=$this->mRaport_mpp->tdk_memenuhi_syarat($this->input->post('murid'),$mpel->subjek,$this->input->post('periode'))->result();
	        $memenuhi_syarat=$this->mRaport_mpp->memenuhi_syarat($this->input->post('murid'),$mpel->subjek,$this->input->post('periode'))->result();
	        $fix_syarat=$this->mRaport_mpp->fix_syarat($this->input->post('murid'),$mpel->subjek,$this->input->post('periode'))->result();
	        $kriteria=$this->mRaport_mpp->hit_kriteria($mpel->subjek,$this->input->post('periode'))->result();
	        foreach($kriteria as $kr);
	        foreach($tdk_memenuhi_syarat as $tdk_memenuhi);
	        foreach($memenuhi_syarat as $memenuhi);
	        foreach($fix_syarat as $fix);
	        if ($tdk_memenuhi->jml>0) $hasil='T'; else $hasil='Y';
	    }
	    $flag = array('pelajaran'=>$mpel->subjek,
		               'murid'=>$this->input->post('murid'),
		               'periode'=>$this->input->post('periode')
		          );
	    $cek = $this->allcrud->getdata('nilai',$flag,1,0);
		if($cek->num_rows()> 0){
		     $data = array(
    		    'nilai' => $hasil
    		);
	    	$this->allcrud->editdata('nilai',$flag,$data);
		} else {
		     $data = array(
		        'pelajaran'=>$mpel->subjek,
		        'murid'=>$this->input->post('murid'),
		        'periode'=>$this->input->post('periode'),
    		    'nilai' => $hasil,
    		    'sdh_submit'=> '0',
    			'sdh_dikoreksi'=> '0',
    			'sdh_final'=> '0'
    		);
    	
			$this->allcrud->insertdata('nilai',$data);
		}  
		if ($metode->metode=='1'){
		    if ($hasil=="Y") echo "Tercapai;".$kr_terpenuhi->jml.';'.$kr->jml.';0'; else echo "Belum Tercapai;".$kr_terpenuhi->jml.';'.$kr->jml.';0';
		} else 
		if ($hasil=="Y") echo "Tercapai;".$memenuhi->jml.";".$kr->jml.";".$fix->jml; else echo "Belum Tercapai;".$memenuhi->jml.";".$kr->jml.";".$fix->jml;
	}
	
	function proses_simpan_catatan(){
	    $this->auth();
		$flag = array('pelajaran'=>$this->input->post('pelajaran2'),
		               'murid'=>$this->input->post('murid2'),
		               'periode'=>$this->input->post('periode2')
		          );
	    $cek = $this->allcrud->getdata('nilai',$flag,1,0);
		if($cek->num_rows()> 0){
		    $data = array(
    			'konversi' => $this->input->post('konversi2'),
    			'porsi_konversi' => $this->input->post('porsi_konversi'),
    			'porsi_partisipasi' => $this->input->post('porsi_partisipasi'),
    			'nilai_partisipasi' => $this->input->post('partisipasi'),
    			'hasil_konversi' => $this->input->post('hasil_konversi'),
    			'manual' => $this->input->post('manual'),
    			'dioutput' => $this->input->post('dioutput'),
    			'catatan' => $this->input->post('catatan'),
    			'evaluasi' => $this->input->post('evaluasi'),
    			'hasil_dioutput' => $this->input->post('hasil_dioutput'),
    			'nilai_dioutput' => $this->input->post('nilai_dioutput'),
            	'syarat_dioutput' => $this->input->post('syarat_dioutput'),
            	'tercapai_dioutput' => $this->input->post('tercapai_dioutput'),
                'evaluasi' => $this->input->post('evaluasi'),
    		);
	    	$this->allcrud->editdata('nilai',$flag,$data);
		}else{
		      
		    $data = array(
		        'pelajaran'=>$this->input->post('pelajaran2'),
		        'murid'=>$this->input->post('murid2'),
		        'periode'=>$this->input->post('periode2'),
    			'konversi' => $this->input->post('konversi2'),
    			'proporsi_konversi' => $this->input->post('proporsi_konversi'),
    			'proporsi_partisipasi' => $this->input->post('proporsi_partisipasi'),
    			'nilai_partisipasi' => $this->input->post('partisipasi'),
    			'hasil_konversi' => $this->input->post('hasil_konversi'),
    			'manual' => $this->input->post('manual'),
    			'dioutput' => $this->input->post('dioutput'),
    			'catatan' => $this->input->post('catatan'),
    			'evaluasi' => $this->input->post('evaluasi'),
    			'hasil_dioutput' => $this->input->post('hasil_dioutput'),
    			'nilai_dioutput' => $this->input->post('nilai_dioutput'),
            	'syarat_dioutput' => $this->input->post('syarat_dioutput'),
            	'tercapai_dioutput' => $this->input->post('tercapai_dioutput'),
    			'sdh_dikoreksi'=> '0',
    			'sdh_final'=> '0'
    		);
    	
			$this->allcrud->insertdata('nilai',$data);
		}
	}	    

	function proses_submit(){
	    $this->auth();
		$flag = array('pelajaran'=>$this->input->post('pelajaran2'),
		               'murid'=>$this->input->post('murid2'),
		               'periode'=>$this->input->post('periode2')
		          );
	    $cek = $this->allcrud->getdata('nilai',$flag,1,0);
		if($cek->num_rows()> 0){
		    $data = array(
    		   	'konversi' => $this->input->post('konversi2'),
    			'catatan' => $this->input->post('catatan'),
    			'sdh_submit'=> '1'
    		);
	    	$this->allcrud->editdata('nilai',$flag,$data);
		}else{
		      
		    $data = array(
		        'pelajaran'=>$this->input->post('pelajaran2'),
		        'murid'=>$this->input->post('murid2'),
		        'periode'=>$this->input->post('periode2'),
    		    'nilai' => 'N',
    			'konversi' => $this->input->post('konversi2'),
    			'catatan' => $this->input->post('catatan'),
    			'sdh_submit'=> '1',
    			'sdh_dikoreksi'=> '0',
    			'sdh_final'=> '0',
    			
    		);
    	
			$this->allcrud->insertdata('nilai',$data);
		}
	}	    

   function proses_submit2(){
	    $this->auth();
		$flag = array('pelajaran'=>$this->input->post('pelajaran2'),
		               'murid'=>$this->input->post('murid2'),
		               'periode'=>$this->input->post('periode2')
		          );
	    $cek = $this->allcrud->getdata('nilai',$flag,1,0);
		if($cek->num_rows()> 0){
		    $data = array(
    			'konversi' => $this->input->post('konversi2'),
    			'catatan' => $this->input->post('catatan'),
    			'sdh_dikoreksi'=> '1'
    		);
	    	$this->allcrud->editdata('nilai',$flag,$data);
		}else{
		      
		    $data = array(
		        'pelajaran'=>$this->input->post('pelajaran2'),
		        'murid'=>$this->input->post('murid2'),
		        'periode'=>$this->input->post('periode2'),
    		    'nilai' => $this->input->post('hasil'),
    			'konversi' => $this->input->post('konversi2'),
    			'catatan' => $this->input->post('catatan'),
    			'sdh_dikoreksi'=> '1'
    		);
    	
			$this->allcrud->insertdata('nilai',$data);
		}
	}	    

    function proses_submit3(){
	    $this->auth();
		$flag = array('pelajaran'=>$this->input->post('pelajaran2'),
		               'murid'=>$this->input->post('murid2'),
		               'periode'=>$this->input->post('periode2')
		          );
	    $cek = $this->allcrud->getdata('nilai',$flag,1,0);
		if($cek->num_rows()> 0){
		    $data = array(
    			'konversi' => $this->input->post('konversi2'),
    			'catatan' => $this->input->post('catatan'),
    			'sdh_final'=> '1'
    		);
	    	$this->allcrud->editdata('nilai',$flag,$data);
		}else{
		      
		    $data = array(
		        'pelajaran'=>$this->input->post('pelajaran2'),
		        'murid'=>$this->input->post('murid2'),
		        'periode'=>$this->input->post('periode2'),
    		    'nilai' => $this->input->post('hasil'),
    			'konversi' => $this->input->post('konversi2'),
    			'catatan' => $this->input->post('catatan'),
    			'sdh_final'=> '1'
    		);
    	
			$this->allcrud->insertdata('nilai',$data);
		}
	}	    

    function cek_nilai(){
		$murid=$this->uri->segment(3);
		$pelajaran=$this->uri->segment(4);
        $periode = $this->mRaport_mpp->periode_aktif()->result();
	    foreach($periode as $period);
		$flag = array('murid'=>$murid,'pelajaran'=>$pelajaran,'periode'=>$period->id_raport_periode);
		$q = $this->allcrud->getData('nilai',$flag,1,0)->row();
		echo json_encode($q);
	}
	
	function edit_catatan_final(){
		$id=$this->uri->segment(3);
		$per=$this->uri->segment(4);
		$flag = array('murid'=>$id,'periode'=>$per);
		$q = $this->allcrud->getData('catatan_final',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function edit_catatan_siswa(){
		$id=$this->uri->segment(3);
		$per=$this->uri->segment(4);
		$flag = array('murid'=>$id,'periode'=>$per);
		$q = $this->allcrud->getData('catatan_final',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	
	function final_corector(){
        $this->auth();
		$data = otoritas('raport_mpp/final_corector',$this->session->userdata('sesRole'));
		$data['kelas']=$this->input->get('k');
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Final Corrector';
		$data['page'] 	= 'isi_nilai/data_koreksi_final';
		$data['periode'] =  $this->allcrud->listdata('raport_periode','id_raport_periode DESC',array());
		$this->load->view('template',$data);		
	}

	function ajaxKoreksi_final(){
	    $this->auth();
	    $data = otoritas('raport_mpp/final_corector',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    $id_periode=$this->uri->segment(3);
	    if ($id_periode==''){
           $periode = $this->mRaport_mpp->periode_aktif()->result();
	       foreach($periode as $period);
	       $id_periode=$period->id_raport_periode;
	    }    
	    if ($role=='3') {
	        $guru=$this->session->userdata('sesId_number');
	        $guru_final = $this->mRaport_mpp->cek_guru_final_corector($guru)->result();
	        foreach($guru_final as $gfinal);
	        if ($gfinal->hasil>0) $filter=true; else $filter=false;
	    } else $filter=true;      
        $data['periode'] =$id_periode;
	    $data['list']	= $this->mRaport_mpp->list_kelas_koreksi_final($id_periode,$filter);
	    $this->load->view('isi_nilai/ajaxKoreksi_final',$data);
	}
	
	function daftar_koreksi_final(){
        $this->auth();
		$data = otoritas('raport_mpp/final_corector',$this->session->userdata('sesRole'));
		$data['kelas']=$this->input->get('k');
		$data['periode']=$this->input->get('pr');
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Final Corrector';
		$data['page'] 	= 'isi_nilai/data_daftar_koreksi_final';
		$this->load->view('template',$data);		
	}

	function ajaxDaftar_koreksi_final(){
    	$this->auth();
	    $data = otoritas('raport_mpp/final_corector',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
        $kelas=$this->uri->segment(3);
        $id_periode=$this->uri->segment(4);
        if ($id_periode==''){
	       $periode = $this->mRaport_mpp->periode_aktif()->result();
	       foreach($periode as $period);
	       $id_periode=$period->id_raport_periode;
        }    
        $data['periode'] =$id_periode;
	    $data['list']	= $this->mRaport_mpp->list_daftar_koreksi_final($id_periode,$kelas);
	    $this->load->view('isi_nilai/ajaxDaftar_koreksi_final',$data);
	}
	
	function proses_simpan_catatan_final(){
	    $this->auth();
		$flag = array('murid'=>$this->input->post('id'),
		               'periode'=>$this->input->post('periode')
		          );
	    $cek = $this->allcrud->getdata('catatan_final',$flag,1,0);
		if($cek->num_rows()> 0){
		    $data = array(
    		    'catatan' => $this->input->post('catatan'),
    		    'catatan_dioutput' => $this->input->post('catatan_dioutput')
    		 );
    		  var_dump($flag);
	    	$this->allcrud->editdata('catatan_final',$flag,$data);
		}else{
		    $data = array(
		        'periode'=>$this->input->post('periode'),
		        'murid'=>$this->input->post('id'),
		        'catatan' => $this->input->post('catatan'),
		        'catatan_dioutput' => $this->input->post('catatan_dioutput'),
    		);
    	    var_dump($data);
			$this->allcrud->insertdata('catatan_final',$data);
		}
	}	
	
	function proses_simpan_catatan_siswa(){
	    $this->auth();
		$flag = array('murid'=>$this->input->post('id2'),
		               'periode'=>$this->input->post('periode2')
		          );
	    $cek = $this->allcrud->getdata('catatan_final',$flag,1,0);
		if($cek->num_rows()> 0){
		    $data = array(
    		    'catatan_siswa' => $this->input->post('catatan_siswa'),
		        'catatan_siswa_dioutput' => $this->input->post('catatan_siswa_dioutput')
    		 );
	    	$this->allcrud->editdata('catatan_final',$flag,$data);
	    	    var_dump($data);
		}else{
		    $data = array(
		        'periode'=>$this->input->post('periode'),
		        'murid'=>$this->input->post('id'),
		        'catatan_siswa' => $this->input->post('catatan_siswa'),
		        'catatan_siswa_dioutput' => $this->input->post('catatan_siswa_dioutput'),
		 	);
    	    var_dump($data);
			$this->allcrud->insertdata('catatan_final',$data);
		}
	}
	
	function hasil(){
        $this->auth();
		$data = otoritas('raport_mpp/hasil',$this->session->userdata('sesRole'));
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Daftar Rapor';
		$data['page'] 	= 'raport/data_hasil';
		$this->load->view('template',$data);		
	}
	
	function ajaxHasil(){ 
    	$this->auth();
	    $data = otoritas('raport_mpp/hasil',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    $data['list']= $this->mRaport_mpp->list_raport_per_kelas();
	    $this->load->view('raport/ajaxHasil',$data);
	}
	
	function daftar_raport(){
        $this->auth();
		$data = otoritas('raport_mpp/hasil',$this->session->userdata('sesRole'));
		$data['kelas']=$this->input->get('k');
		$data['parent'] = 'Raport MPP';
		$data['child'] 	= 'Daftar Rapor';
		$data['page'] 	= 'raport/data_daftar_raport';
		$this->load->view('template',$data);		
	}

	function ajaxDaftar_raport(){ 
    	$this->auth();
    	$kelas=$this->uri->segment(3);
	    $data = otoritas('raport_mpp/hasil',$this->session->userdata('sesRole'));
	    $role=$this->session->userdata('sesRole');
	    $data['list']= $this->mRaport_mpp->list_raport($kelas);
	    $this->load->view('raport/ajaxDaftar_raport',$data);
	}
	
    function create_raport(){ 
    	$this->auth();
    	$murid=$this->uri->segment(3);
	    $periode=$this->uri->segment(4);
    	$flag = array('id_raport_periode'=>$periode);
        $cek = $this->allcrud->getdata('raport_periode',$flag,1,0);
	    $data['periode']=$cek;
	    $data['header']=$this->mRaport_mpp->list_raport_header($murid,$periode);
	    $data['raport']=$this->mRaport_mpp->list_raport_mpp($murid,$periode);
	    $data['catat']=$this->mRaport_mpp->list_catatan_mpp($murid,$periode);
	    $html=$this->load->view('raport/design_raport_mpp.php',$data,true);
	    $filename	= 'Download';
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename, true, 'A2', 'portrait');
    }	
    
     function create_raport_konversi(){ 
    	$this->auth();
    	$murid=$this->uri->segment(3);
	    $periode=$this->uri->segment(4);
    	$flag = array('id_raport_periode'=>$periode);
        $cek = $this->allcrud->getdata('raport_periode',$flag,1,0);
	    $data['periode']=$cek;
	    $data['header']=$this->mRaport_mpp->list_raport_header($murid,$periode);
	    $data['raport']=$this->mRaport_mpp->list_raport_mpp($murid,$periode);
	    $data['catat']=$this->mRaport_mpp->list_catatan_mpp($murid,$periode);
	    $html=$this->load->view('raport/design_raport_mpp_konversi.php',$data,true);
	    $filename	= 'Download';
        $this->load->library('pdfgenerator');
        $this->pdfgenerator->generate($html, $filename, true, 'A2', 'portrait');
    }

	function hapus_nilai(){
	    $this->auth();
	    $murid=$this->uri->segment(3);
	    $pel=$this->uri->segment(4);
	    $id_periode=$this->uri->segment(5);
	    if ($id_periode==''){
	     	$periode = $this->mRaport_mpp->periode_aktif()->result();
	        foreach($periode as $period);
	        $id_periode=$period->id_raport_periode;
	    }     
		$flag = array('pelajaran'=>$pel,
		               'murid'=>$murid,
		               'periode'=> $id_periode
		          );
		$this->allcrud->deletedata('nilai',$flag);
	   	$this->allcrud-> deletedata('nilai_detail',$flag);
	}	    
	
	public function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}


}

