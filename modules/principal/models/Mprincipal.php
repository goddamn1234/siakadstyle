<?php

class Mprincipal extends CI_Model {

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
	
	function principalData($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select("principal.*, user_role.*, ref_religion.*, ref_nationality.num_code, ref_nationality.nationality AS reg");
		$this->db->from('principal');
		$this->db->join('user_role','principal.role=user_role.id_role');
		$this->db->join('ref_nationality','principal.nationality=ref_nationality.num_code');
		$this->db->join('ref_religion','principal.religion=ref_religion.id_religion');
		$this->db->order_by('id_number ASC');
		return $this->db->get();
	}
	
	function assignList($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->where('student_assign.status','aktif');
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
	
	function data_kelas(){
		$flag = array(
			'student_assign.status'=>'aktif',
		);
		$this->db->where($flag);
		$this->db->select("kelas.nama_kelas, kelas.id_kelas, guru.full_name, COUNT(student_assign.id_number)AS jml_student");
		$this->db->from('kelas');
		$this->db->join('guru','kelas.wali_kelas=guru.id_number');
		$this->db->join('student_assign','kelas.id_kelas=student_assign.id_kelas');
		$this->db->group_by('kelas.id_kelas');
		$this->db->order_by('nama_kelas ASC');
		return $this->db->get();
	}
	
	function student_data($table, $flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->where('student_assign.status','aktif');
		$this->db->from('student');
		$this->db->join('student_assign','student.id_number=student_assign.id_number');
		$this->db->join('kelas','student_assign.id_kelas=kelas.id_kelas');
		$this->db->join($table,'student.id_number='.$table.'.student');
		$this->db->join('raport_periode','raport_periode.id_raport_periode='.$table.'.raport_periode');
		return $this->db->get();
	}
	
	public function raport_result($result,$detail,$flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mapel.id_mapel, mapel.nama_mapel, detail.id_raport_detail, result.id_raport_result ");
		$this->db->select(" CASE WHEN cat.nama_category='DISCOVERY' THEN cri.nama_criteria END DISCOVERY, CASE WHEN cat.nama_category='DISCOVERY' THEN detail.result END r_self ");
		$this->db->select(" CASE WHEN cat.nama_category='EXPLORATION' THEN cri.nama_criteria END EXPLORATION, CASE WHEN cat.nama_category='EXPLORATION' THEN detail.result END r_expl ");
		$this->db->select(" CASE WHEN cat.nama_category='PRESENTATION' THEN cri.nama_criteria END PRESENTATION, CASE WHEN cat.nama_category='PRESENTATION' THEN detail.result END r_pres ");
		$this->db->select(" CASE WHEN cat.nama_category='PERSONALITY' THEN cri.nama_criteria END PERSONALITY, CASE WHEN cat.nama_category='PERSONALITY' THEN detail.result END r_pers ");
		$this->db->select(" CASE WHEN cat.nama_category='ACHIEVEMENT' THEN cri.nama_criteria END ACHIEVEMENT, CASE WHEN cat.nama_category='ACHIEVEMENT' THEN detail.result END r_achi ");
		$this->db->select(" result.result, result.keterangan");
		$this->db->from('point_category cat');
		$this->db->join('point_criteria cri','cri.id_category=cat.id_category');
		$this->db->join($detail.' detail','detail.criteria=cri.id_criteria');
		$this->db->join($result.' result','result.id_raport_result=detail.raport_result');
		$this->db->join('mata_pelajaran mapel','mapel.id_mapel=result.mapel');
		$this->db->group_by('cri.id_criteria');
		$this->db->order_by('cri.id_criteria ASC');
		return $this->db->get();
	}

	public function pmd_result($result,$pmd,$flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mapel.nama_mapel, pmd.flag_pmd, learn.id_learning, result.id_raport_result ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='DISCOVERY' THEN pmd.nama_pmd END) DISCOVERY, CASE WHEN c.nama_category='DISCOVERY' THEN learn.pmd_result END r_self ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='EXPLORATION' THEN pmd.nama_pmd END) EXPLORATION, CASE WHEN c.nama_category='EXPLORATION' THEN learn.pmd_result END r_expl ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='PRESENTATION' THEN pmd.nama_pmd END) PRESENTATION, CASE WHEN c.nama_category='PRESENTATION' THEN learn.pmd_result END r_pres ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='PERSONALITY' THEN pmd.nama_pmd END) PERSONALITY, CASE WHEN c.nama_category='PERSONALITY' THEN learn.pmd_result END r_pers ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='ACHIEVEMENT' THEN pmd.nama_pmd END) ACHIEVEMENT, CASE WHEN c.nama_category='ACHIEVEMENT' THEN learn.pmd_result END r_achi ");
		$this->db->from('mata_pelajaran mapel');
		$this->db->join('point_pmd pmd','pmd.id_mapel=mapel.id_mapel');
		$this->db->join('point_category c','c.id_category=pmd.id_category');
		$this->db->join($pmd.' learn','learn.id_pmd=pmd.id_pmd');
		$this->db->join($result.' result','result.id_raport_result=learn.id_raport_result');
		// $this->db->group_by('pmd.flag_pmd');
		$this->db->group_by('learn.id_learning');
		$this->db->order_by('mapel.nama_mapel ASC');
		$this->db->order_by('pmd.flag_pmd ASC');
		return $this->db->get();
	}
	
	public function last_result($table,$flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select($table.".*, mata_pelajaran.achiev_point, SUM(point_criteria.point_criteria) AS nilai, if(achiev_point <= SUM(point_criteria),'pass','not accomplished') AS hasil");
		$this->db->from('point_criteria');
		$this->db->join($table,$table.'.criteria=point_criteria.id_criteria');
		$this->db->join('mata_pelajaran','point_criteria.id_mapel=mata_pelajaran.id_mapel');
		return $this->db->get()->row();
	}

	public function last_result_pmd($pmd,$flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select("point_pmd.flag_pmd, SUM(point_pmd.point_pmd) AS nilai");
		$this->db->from('point_pmd');
		$this->db->join($pmd.' pmd','pmd.id_pmd=point_pmd.id_pmd');
		$this->db->group_by('point_pmd.flag_pmd');
		$this->db->order_by('nilai DESC');
		$this->db->limit(0,1);
		return $this->db->get()->row();
	}

	public function last_result_fmp($flag=NULL,$filter){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" flag_fmp, COUNT(fmp_result) AS total, COUNT(CASE WHEN fmp_result='Y' THEN fmp_result END) AS sukses ");
		$this->db->select(" IF(COUNT(fmp_result)=COUNT(CASE WHEN fmp_result='Y' THEN fmp_result END),'yes','no') as target ");
		$this->db->from('raport_fmp');
		$this->db->join('fmp','raport_fmp.criteria=fmp.id_fmp');
		if($filter == TRUE){
			$this->db->having('sukses > 0');
		}
		$this->db->group_by('flag_fmp');
		$this->db->order_by('flag_fmp DESC');
		return $this->db->get();		
	}

	public function raport_fmp_result($flag = NULL){
		
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select("*");
		$this->db->select(" CASE WHEN cat.nama_category='DISCOVERY' THEN _fmp.nama_fmp END DISCOVERY, CASE WHEN cat.nama_category='DISCOVERY' THEN fmp.fmp_result END r_self ");
		$this->db->select(" CASE WHEN cat.nama_category='EXPLORATION' THEN _fmp.nama_fmp END EXPLORATION, CASE WHEN cat.nama_category='EXPLORATION' THEN fmp.fmp_result END r_expl ");
		$this->db->select(" CASE WHEN cat.nama_category='PRESENTATION' THEN _fmp.nama_fmp END PRESENTATION, CASE WHEN cat.nama_category='PRESENTATION' THEN fmp.fmp_result END r_pres ");
		$this->db->select(" CASE WHEN cat.nama_category='PERSONALITY' THEN _fmp.nama_fmp END PERSONALITY, CASE WHEN cat.nama_category='PERSONALITY' THEN fmp.fmp_result END r_pers ");
		$this->db->select(" CASE WHEN cat.nama_category='ACHIEVEMENT' THEN _fmp.nama_fmp END ACHIEVEMENT, CASE WHEN cat.nama_category='ACHIEVEMENT' THEN fmp.fmp_result END r_achi ");
		$this->db->from('raport_result_y3 result');
		$this->db->join('mata_pelajaran mp','mp.id_mapel = result.mapel');
		$this->db->join('raport_fmp fmp', 'result.id_raport_result = fmp.raport_result');
		$this->db->join('fmp _fmp','_fmp.id_fmp = fmp.criteria');
		$this->db->join('point_category cat','_fmp.category = cat.id_category');
		$this->db->group_by('_fmp.id_fmp');
		$this->db->order_by('_fmp.flag_fmp ASC');
		return $this->db->get();
	}

	public function dataRaportList($result,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select("id_mapel, nama_mapel, result.id_raport_result, result.score, result.result, result.result_fmp, result.keterangan");
		$this->db->from($result.' result');
		$this->db->join('mata_pelajaran mapel','result.mapel=mapel.id_mapel');
		return $this->db->get();
	}


}