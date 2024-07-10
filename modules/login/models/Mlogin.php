<?php

class Mlogin extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
	function userdata($user,$flag){
		$this->db->where($flag);
		$this->db->from($user);
		$this->db->join('user_role',$user.'.role=user_role.id_role');
		return $this->db->get();
	}
	function lasttgl(){
		$this->db->from('tgl');
		$this->db->order_by('tgl_list DESC');
		$this->db->limit(0,1);
		return $this->db->get();
	}

}