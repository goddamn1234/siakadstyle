<?php

class Mparent extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
		
	function nationality($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" num_code, nationality ");
		$this->db->order_by('nationality ASC');
		return $this->db->get('ref_nationality');
	}
	
	function parentData($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select("parent.*, user_role.*, ref_religion.*, ref_nationality.num_code, ref_nationality.nationality AS reg");
		$this->db->from('parent');
		$this->db->join('user_role','parent.role=user_role.id_role');
		$this->db->join('ref_nationality','parent.nationality=ref_nationality.num_code');
		$this->db->join('ref_religion','parent.religion=ref_religion.id_religion');
		$this->db->order_by('id_number ASC');
		return $this->db->get();
	}
	
	function assignList($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" student.full_name, student.id_number, student_assign.*, kelas.*");
		$this->db->from('student_assign');
		$this->db->join('student','student_assign.id_number=student.id_number');
		$this->db->join('kelas','student_assign.id_kelas=kelas.id_kelas');
		$this->db->order_by('full_name ASC');
		return $this->db->get();
	}
	
	function simpleStudent($select,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select($select);
		return $this->db->get('student');
	}
	function report_student($grade,$flag){
		$this->db->where($flag);
		
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
		
		$this->db->from($raport);
		$this->db->join('kelas',$raport.'.kelas=kelas.id_kelas');
		$this->db->join('student',$raport.'.student=student.id_number');
		$this->db->join('raport_periode',$raport.'.raport_periode=raport_periode.id_raport_periode');
		$this->db->group_by('raport_periode');
		return $this->db->get();
	}
	
	public function cek_murid($parent){
	    return $this->db->query("select parent_from from parent where id_number='$parent'");
	}

    function list_raport_pub_gabungan($guru,$filter){
	    if ($guru!='') $bts=" and n.murid in (select sf.murid from student_assign_fasilitator sf left outer join guru tc on(tc.id_user=sf.guru) where tc.id_number='$guru')"; else $bts="";
	    return $this->db->query("SELECT distinct n.murid, s.full_name,k.nama_kelas,jj.nama_jenjang,jl.nama_jalur,jn.nama_jenis, p.periode as nperiode, p.tahun_akademik,p.id_raport_periode,pr.id_proyek,pr.pub,pr.pub_konversi,pr.pub2,pr.pub2_konversi from nilai n 
	                left outer join student s on(s.id_number=n.murid) 
	                left outer join student_assign a on(a.id_number=n.murid and a.status='aktif') 
	                left outer join kelas k on(k.id_kelas=a.id_kelas) 
	                left outer join jenis_pendidikan jn on(k.jenis=jn.id_jenis) 
	                left outer join jenjang_pendidikan jj on(k.jenjang=jj.id_jenjang) 
	                left outer join jalur_pendidikan jl on(k.jalur=jl.id_jalur) 
	                left outer join raport_periode p on(p.id_raport_periode=n.periode) 
	                left outer join proyek pr on(n.murid=pr.murid) where n.sdh_final='1' and n.murid in (select murid from proyek where sdh_final='1') $bts $filter order by murid,p.id_raport_periode desc");
	}
	
	public function list_raport_pub2($guru,$filter){
	    if ($guru!='') $bts=" and n.murid in (select sf.murid from student_assign_fasilitator sf left outer join guru tc on(tc.id_user=sf.guru) where tc.id_number='$guru')"; else $bts="";
	    return $this->db->query("SELECT distinct n.murid, s.full_name,n.periode,k.nama_kelas,k.tingkat,jj.nama_jenjang,jl.nama_jalur,jn.nama_jenis, p.periode as nperiode, p.tahun_akademik,p.id_raport_periode,pb.pub,pb.pub2,pb.pub_konversi,pb.pub_konversi2 from nilai n  
	                left outer join raport_pub pb on(pb.murid=n.murid and pb.periode=n.periode) 
	                left outer join raport_periode p on(p.id_raport_periode=n.periode)
	                left outer join student s on(s.id_number=n.murid) 
	                left outer join student_assign a on(a.id_number=n.murid and a.start_date<=p.awal and (a.end_date>=p.akhir or a.end_date is null))  
	                left outer join kelas k on(k.id_kelas=a.id_kelas) 
	                left outer join jenis_pendidikan jn on(k.jenis=jn.id_jenis) 
	                left outer join jenjang_pendidikan jj on(k.jenjang=jj.id_jenjang) 
	                left outer join jalur_pendidikan jl on(k.jalur=jl.id_jalur) 
	                where n.sdh_final='1' $bts $filter order by murid,p.id_raport_periode desc");
	} 
}