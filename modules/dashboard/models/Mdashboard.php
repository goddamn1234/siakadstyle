<?php

class Mdashboard extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
	function rekap(){
		$this->db->select(" status, COUNT('status') AS jml ");
		$this->db->from('repair_order');
		$this->db->group_by('status');
		return $this->db->get();
	}
	function chart($flag){
		$this->db->where($flag);
		$this->db->select(" a.merek_hp, COUNT('merek_hp') AS jml ");
		$this->db->from('ref_hp a');
		$this->db->join('ref_tipe_hp b','a.id_hp=b.id_hp');
		$this->db->join('repair_order c','b.id_tipe_hp=c.hp');
		$this->db->group_by('merek_hp');
		$this->db->order_by('jml DESC');
		$this->db->limit(5);
		return $this->db->get();
	}
	function folup($flag){
		$this->db->where($flag);
		$this->db->select(" COUNT(last_konfirm) as jml ");
		$this->db->from('repair_order');
		return $this->db->get();
	}
	function laba($flag){
		$this->db->where($flag);
		$this->db->select(" SUM(biaya) as laba ");
		$this->db->from('repair_order');
		return $this->db->get();
	}

}