<?php

class Madmin extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
	function userdata($flag, $user = null){
		$this->db->where($flag);
		if($user != null){
			$this->db->select($user.'.*, user_role.*');
			$this->db->from($user);
			$this->db->join('user_role',$user.'.role=user_role.id_role');
			$this->db->join('ref_nationality',$user.'.nationality=ref_nationality.num_code');
			$this->db->join('ref_religion',$user.'.religion=ref_religion.id_religion');
		}else{
			$this->db->select("user.*, user_role.*, ref_religion.*, ref_nationality.num_code, ref_nationality.nationality AS reg");
			$this->db->from('user');
			$this->db->join('user_role','user.role=user_role.id_role');
			$this->db->join('ref_nationality','user.nationality=ref_nationality.num_code');
			$this->db->join('ref_religion','user.religion=ref_religion.id_religion');
		}
		
		$this->db->order_by('id_number ASC');
		return $this->db->get();
	}
	function nationality($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" num_code, nationality ");
		$this->db->order_by('nationality ASC');
		return $this->db->get('ref_nationality');
	}
	
	function list_assign_user_grub($flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" a.*, u.full_name, g.nama_user_grub");
		$this->db->from('user_assign_grub AS a');
		$this->db->join('user AS u','u.id_user=a.user', 'left outer');
		$this->db->join('user_grub AS g','g.id_user_grub=a.grub','left outer');
		$this->db->order_by("u.full_name ASC ");
		return $this->db->get();
	}
	
	function list_assign_user_staf($flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" a.*, u.full_name, g.nama_staf");
		$this->db->from('user_assign_staf AS a');
		$this->db->join('user AS u','u.id_user=a.user', 'left outer');
		$this->db->join('staf AS g','g.id_staf=a.staf','left outer');
		$this->db->order_by("u.full_name ASC ");
		return $this->db->get();
	}
	
	function list_assign_user_divisi($flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" a.*, u.full_name, d.nama_divisi");
		$this->db->from('user_assign_divisi AS a');
		$this->db->join('user AS u','u.id_user=a.user', 'left outer');
		$this->db->join('divisi AS d','d.id_divisi=a.divisi','left outer');
		$this->db->order_by("u.full_name ASC ");
		return $this->db->get();
	}

}