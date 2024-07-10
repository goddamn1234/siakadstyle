<?php

class Mmaster extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
	
	public function list_kelas($flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" k.*, jn.nama_jenis,jl.nama_jalur,jj.nama_jenjang");
		$this->db->from('kelas AS k');
		$this->db->join('jenjang_pendidikan AS jj','k.jenjang=jj.id_jenjang','left outer');
		$this->db->join('jalur_pendidikan AS jl','k.jalur=jl.id_jalur','left outer');
		$this->db->join('jenis_pendidikan AS jn','k.jenis=jn.id_jenis','left outer');
		$this->db->order_by(" nama_jalur  ASC, nama_jenis ASC, nama_jenjang ASC ");
		return $this->db->get();
	}
	
	public function list_criteria($flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mapel.*, cat.nama_category, crit.* ");
		$this->db->from('point_criteria AS crit');
		$this->db->join('point_category AS cat','crit.id_category=cat.id_category');
		$this->db->join('mata_pelajaran AS mapel','crit.id_mapel=mapel.id_mapel');
		$this->db->order_by(" tingkat_kelas ASC, nama_mapel ASC, nama_category ASC ");
		return $this->db->get();
	}
	public function dataPmd($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mata_pelajaran.nama_mapel, mata_pelajaran.tingkat_kelas, mata_pelajaran.achiev_point, point_pmd.*, point_category.nama_category ");
		$this->db->from('point_pmd');
		$this->db->join('mata_pelajaran','point_pmd.id_mapel=mata_pelajaran.id_mapel');
		$this->db->join('point_category','point_pmd.id_category=point_category.id_category');
		return $this->db->get();
	}
	
	public function listFmp($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->from('fmp');
		$this->db->join('point_category','fmp.category=point_category.id_category');
		return $this->db->get();
	}
}