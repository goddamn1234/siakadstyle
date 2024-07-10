<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model ('madmin', '', TRUE);
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
		}
		$this->userid = $this->session->userdata('sesNama');
	}
	
	public function auth(){
		if($this->session->userdata('sesStat') != 'login'){
			redirect(base_url());
			die();
		}
	}
	
	function role(){
		$data = otoritas('admin/role',$this->session->userdata('sesRole'));
		$this->auth();
		$data['parent'] = 'Administrasi';
		$data['child'] 	= 'Role user';
		$data['page'] 	= 'role';
		$data['list']	= $this->allcrud->listdata('user_role','nama_role ASC',array());
		$this->load->view('template',$data);
	}
	function ajaxRole(){
		$data = otoritas('admin/role',$this->session->userdata('sesRole'));
		$this->auth();
		$data['list']	= $this->allcrud->listdata('user_role','nama_role ASC',array());
		$this->load->view('admin/ajaxRole',$data);
	}
	function addrole(){
		$this->auth();
		$data = array('nama_role' => $this->input->post('role'),'ket'=>$this->input->post('ket'));
		$this->allcrud->insertdata('user_role',$data);
	}
	function editrole($id){
		$this->auth();
		$flag = array('id_role'=>$id);
		$q = $this->allcrud->getData('user_role',$flag,1,0)->row();
		echo json_encode($q);
	}
	function newrole(){
		$this->auth();
		$flag = array('id_role'=>$this->input->post('id'));
		$edit = array('nama_role'=>$this->input->post('role'),'ket'=>$this->input->post('ket'));
		$this->allcrud->editdata('user_role',$flag,$edit);
	}
	function delrole($id){
		$this->auth();
		$flag = array('id_role' => $id);
		$this->allcrud->deletedata('user_role',$flag);
	}
	function generate($id){
		$menu = $this->allcrud->listdata('menu','nama_menu ASC',array());
		foreach ($menu->result() as $row){
			$cari = $this->allcrud->getData('menu_akses',array('id_menu'=>$row->id_menu,'id_role'=>$id))->num_rows();
			if ($cari == 0){
				$add = array ('id_menu' => $row->id_menu,'id_role' => $id);
				$this->allcrud->insertdata('menu_akses',$add);
			}
		}
	}
	function user(){
		$this->auth();
		$data = otoritas('admin/user',$this->session->userdata('sesRole'));
		$data['parent'] = 'Administrasi';
		$data['child'] 	= 'Data user';
		$data['page'] 	= 'user';
		$data['list']	= $this->madmin->userdata(array());
		$this->load->view('template',$data);
	}
	function ajaxUser(){
		$this->auth();
		$data = otoritas('admin/user',$this->session->userdata('sesRole'));
		$data['list'] = $this->madmin->userdata(array());
		$this->load->view('admin/ajaxUser',$data);
	}
	function fadduser(){
		$this->auth();
		$data['nationality']= $this->madmin->nationality(array());
		$this->load->view('fadduser',$data);
	}
	function crole(){
		$data = $this->allcrud->listdata('user_role','nama_role ASC',array());
		foreach($data->result() as $row){
			echo "<option value='".$row->id_role."'>".$row->nama_role."</option>";
		}
	}
	function creligion(){
		$data = $this->allcrud->listdata('ref_religion','religion_name ASC',array());
		foreach($data->result() as $row){
			echo "<option value='".$row->id_religion."'>".$row->religion_name."</option>";
		}
	}
	function adduser(){
		$this->auth();
		$this->form_validation->set_rules('id_number','ID card Number','required|numeric');
		$this->form_validation->set_rules('full_name','Full Name','required');
		$this->form_validation->set_rules('spouse_name','Spouse Name','alpha');
		$this->form_validation->set_rules('birth_place','Birth Place','required|alpha');
		$this->form_validation->set_rules('birth_date','Birth Date','required');
		$this->form_validation->set_rules('address','Home Address','required');
		$this->form_validation->set_rules('phone1','Phone Number','required');
		$this->form_validation->set_rules('nationality','Nationality','greater_than[0]',array('Not selected'));
		$this->form_validation->set_rules('religion','Religion','greater_than[0]',array('Not selected'));
		$this->form_validation->set_rules('role','Role','greater_than[0]',array('Not selected'));
		
		$config['upload_path']          = './image/user';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200000;
		$config['file_name']            = $this->input->post('id_number');
		$this->load->library('upload', $config);
		
		if($this->form_validation->run() == TRUE){
			if($this->upload->do_upload('userfile')){
			$file = $this->upload->data('file_name');
			}else{
				$file = 'default.jpg';
			}
			$user = array (
			'id_number' => $this->input->post('id_number'),
			'full_name' => ucwords(strip_tags($this->input->post('full_name'))),
			'birth_place' => $this->input->post('birth_place'),
			'birth_date' => date('Y-m-d',strtotime($this->input->post('birth_date'))),
			'address'	=> strip_tags($this->input->post('address')),
			'phone1'	=> $this->input->post('phone1'),
			'nationality'	=> $this->input->post('nationality'),
			'religion'	=> $this->input->post('religion'),
			'password' 	=> sha1(md5('123456')),
			'role' 		=> $this->input->post('role'),
			'image'		=> $file
			);
			if($this->input->post('spouse_name') != NULL){
				$user['spouse_name'] = ucwords(strip_tags($this->input->post('spouse_name')));
			}
			if($this->input->post('phone2') != NULL){
				$user['phone2'] = ucwords(strip_tags($this->input->post('phone2')));
			}
			$this->allcrud->insertdata('user',$user);
			redirect('admin/user');
			}else{
			redirect('admin/user');
			}
	    
	}
	function fedituser(){
		$this->auth();
		$flag = array('id_user' => $this->input->post('id'));
		$data['nationality']= $this->madmin->nationality(array());
		$data['user'] = $this->madmin->userdata($flag)->row();
		$this->load->view('fedituser',$data);
	}
	function edituser(){
		$this->auth();
		$flag 	= array ('id_user'=>$this->input->post('id_user'));
		$config['upload_path']          = './image/user';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200000;
		$config['overwrite']            = TRUE;
		$config['file_name']            = $this->input->post('username');
		$this->load->library('upload', $config);
		
		$user = array (
			'full_name' => ucwords(strip_tags($this->input->post('full_name'))),
			'spouse_name' => ucwords(strip_tags($this->input->post('spouse_name'))),
			'birth_place' => $this->input->post('birth_place'),
			'birth_date' => date('Y-m-d',strtotime($this->input->post('birth_date'))),
			'address'	=> strip_tags($this->input->post('address')),
			'phone1'	=> $this->input->post('phone1'),
			'nationality'	=> $this->input->post('nationality'),
			'religion'	=> $this->input->post('religion'),
			'role' 		=> $this->input->post('role')
			);
		if($this->input->post('phone2') != NULL){
			$user['phone2'] = $this->input->post('phone2');
		}
		if (!empty($_FILES['userfile']['name'])) {
			$this->upload->do_upload('userfile');
			$user['image'] = $this->upload->data('file_name');
		}
		
		$this->allcrud->editdata('user',$flag,$user);
		redirect('admin/user');
		
	}
	function deluser($id){
		$this->auth();
		$flag = array('id_user' => $id);
		$this->allcrud->deletedata('user',$flag);
	}
	function actuser($id){
		$flag = array('id_user' => $id);
		$cek = $this->allcrud->getdata('user',$flag,0,1)->row();
		if($cek->status == 'aktif'){
			$this->allcrud->editdata('user',$flag,array('status'=>'tidak aktif'));
		}else{
			$this->allcrud->editdata('user',$flag,array('status'=>'aktif'));
		}
	}
	function resetpas($id){
		$flag = array('id_user'=>$id);
		$data = array ('password'=>sha1(md5('demoonly')));
		$this->allcrud->editdata('user',$flag,$data);
	}
	function akses(){
		$this->auth();
		$data = otoritas('admin/akses',$this->session->userdata('sesRole'));
		$data['parent'] = 'Administrasi';
		$data['child'] 	= 'Akses User';
		$data['page'] 	= 'akses';
		$data['role']	= $this->allcrud->listdata('user_role','nama_role ASC',array());
		$this->load->view('template',$data);
	}
	function treeview($id){
		$data['id_role']	= $id;
		$this->load->view('treeview',$data);
	}
	function crakses(){
		$flag = array ('id_akses' => $this->input->post('id_akses'));
		if($this->input->post('nilai') == 0){
			$this->allcrud->editdata('menu_akses',$flag,array('buat'=>1));
		}else{
			$this->allcrud->editdata('menu_akses',$flag,array('buat'=>0));
		}
	}
	function reakses(){
		$flag = array ('id_akses' => $this->input->post('id_akses'));
		if($this->input->post('nilai') == 0){
			$this->allcrud->editdata('menu_akses',$flag,array('baca'=>1));
		}else{
			$this->allcrud->editdata('menu_akses',$flag,array('baca'=>0));
		}
	}
	function upakses(){
		$flag = array ('id_akses' => $this->input->post('id_akses'));
		if($this->input->post('nilai') == 0){
			$this->allcrud->editdata('menu_akses',$flag,array('ubah'=>1));
		}else{
			$this->allcrud->editdata('menu_akses',$flag,array('ubah'=>0));
		}
	}
	function deakses(){
		$flag = array ('id_akses' => $this->input->post('id_akses'));
		if($this->input->post('nilai') == 0){
			$this->allcrud->editdata('menu_akses',$flag,array('hapus'=>1));
		}else{
			$this->allcrud->editdata('menu_akses',$flag,array('hapus'=>0));
		}
	}
	function profile(){
		$this->auth();
		$flag = array ('id_user' => $this->session->userdata('sesId'));
		$role = $this->session->userdata('sesNrole');
		// 3 = teacher, 4 = student, 5 = principal, 6 = Parent
		if($role == 'Pengajar'){
			$user = 'guru';
		}else if($role == 'Student'){
			$user = 'student';
		}else if($role == 'Principal'){
			$user = 'principal';
		}else if($role == 'Parent'){
			$user = 'parent';
		}else{
			$user = 'user';
		}
		$data['parent'] = 'Profil';
		$data['child'] 	= 'Edit Data';
		$data['user'] = $this->madmin->userdata($flag,$user)->row();
		$data['page'] = 'profil';
		$this->load->view('template',$data);
	}
	function cekPass(){
		$flag = array('id_user'=>$this->session->userdata('sesId'),'password'=>sha1(md5($this->input->post('key'))));
		$cek = $this->allcrud->listdata('user','id_user ASC',$flag);
		if($cek->num_rows() == 1){
			$data['status'] = 'sukses';
		}else{
			$data['status'] = 'error';
		}
		echo json_encode($data);
	}
	function editprofil(){
		$this->auth();
		$flag 	= array ('id_user'=>$this->input->post('id'));
		
		$pass1	= $this->input->post('password');
		$pass2	= $this->input->post('password2');
		
		$role = $this->session->userdata('sesNrole');
		// 3 = teacher, 4 = student, 5 = principal, 6 = Parent
		if($role == 'Teacher'){
			$role = 'guru';
		}else if($role == 'Student'){
			$role = 'student';
		}else if($role == 'Principal'){
			$role = 'principal';
		}else if($role == 'Parent'){
			$role = 'parent';
		}else{
			$role = 'user';
		}
		
		if(strlen($pass1) > 1 && $pass1 == $pass2){
			$user = array (
			'password' => sha1(md5($pass1))
			);
			$this->allcrud->editdata($role,$flag,$user);
		}
		
		redirect('admin/profile');
	}
	


/* Assign User to Grub */

	function assign_user_grub(){
		$this->auth();
		$data = otoritas('admin/assign_user_grub',$this->session->userdata('sesRole'));
		$data['parent'] = 'Manage User';
		$data['child'] 	= 'Assign User to Grub';
		$data['page'] 	= 'admin/data_assign_user_grub';
		$data['user_list'] = $this->allcrud->listdata('user','full_name ASC');
		$data['grub_list'] = $this->allcrud->listdata('user_grub','nama_user_grub ASC');
		$this->load->view('template',$data);		
	}

	function ajaxAssign_user_grub(){
		$this->auth();
		$data = otoritas('admin/assign_user_grub',$this->session->userdata('sesRole'));
		$data['list']	= $this->madmin->list_assign_user_grub();
		$this->load->view('ajaxAssign_user_grub',$data);
	}
	
	function proses_assign_user_grub(){
		$this->auth();
		$data = array(
			'user' => $this->input->post('user'),
			'grub' => $this->input->post('grub'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('user_assign_grub',$flag,$data);
		}else{
			$this->allcrud->insertdata('user_assign_grub',$data);
		}
		
	}
	
	function edit_assign_user_grub($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('user_assign_grub',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_user_grub($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('user_assign_grub',$flag);
	}
	
/* Assign User to Staf */

	function assign_user_staf(){
		$this->auth();
		$data = otoritas('admin/assign_user_staf',$this->session->userdata('sesRole'));
		$data['parent'] = 'Manage User';
		$data['child'] 	= 'Assign User to Staf';
		$data['page'] 	= 'admin/data_assign_user_staf';
		$data['user_list'] = $this->allcrud->listdata('user','full_name ASC');
		$data['staf_list'] = $this->allcrud->listdata('staf','nama_staf ASC');
		$this->load->view('template',$data);		
	}

	function ajaxAssign_user_staf(){
		$this->auth();
		$data = otoritas('admin/assign_user_staf',$this->session->userdata('sesRole'));
		$data['list']	=  $this->madmin->list_assign_user_staf();
		$this->load->view('ajaxAssign_user_staf',$data);
	}
	
	function proses_assign_user_staf(){
		$this->auth();
		$data = array(
			'user' => $this->input->post('user'),
			'staf' => $this->input->post('staf'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('user_assign_staf',$flag,$data);
		}else{
			$this->allcrud->insertdata('user_assign_staf',$data);
		}
		
	}
	
	function edit_assign_user_staf($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('user_assign_staf',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_user_staf($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('user_assign_staf',$flag);
	}	
	
/* Assign User to Divisi */

	function assign_user_divisi(){
		$this->auth();
		$data = otoritas('admin/assign_user_divisi',$this->session->userdata('sesRole'));
		$data['parent'] = 'Manage User';
		$data['child'] 	= 'Assign User to Divisi';
		$data['page'] 	= 'data_assign_user_divisi';
		$data['user_list'] = $this->allcrud->listdata('user','full_name ASC');
		$data['divisi_list'] = $this->allcrud->listdata('divisi','nama_divisi ASC');
		$this->load->view('template',$data);		
	}

	function ajaxAssign_user_divisi(){
		$this->auth();
		$data = otoritas('admin/assign_user_divisi',$this->session->userdata('sesRole'));
		$data['list']	=  $this->madmin->list_assign_user_divisi();
		$this->load->view('ajaxAssign_user_divisi',$data);
	}
	
	function proses_assign_user_divisi(){
		$this->auth();
		$data = array(
			'user' => $this->input->post('user'),
			'divisi' => $this->input->post('divisi'),
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_assign'=>$this->input->post('id'));
			$this->allcrud->editdata('user_assign_divisi',$flag,$data);
		}else{
			$this->allcrud->insertdata('user_assign_divisi',$data);
		}
		
	}
	
	function edit_assign_user_divisi($id){
		
		$flag = array('id_assign'=>$id);
		$q = $this->allcrud->getData('user_assign_divisi',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delAssign_user_divisi($id){
		$flag = array('id_assign' => $id);
		$this->allcrud->deletedata('user_assign_divisi',$flag);
	}	
		
/* User Grub */

	function user_grub(){
		$this->auth();
		$data = otoritas('admin/user_grub',$this->session->userdata('sesRole'));
		$data['parent'] = 'Manage User';
		$data['child'] 	= 'User Grub';
		$data['page'] 	= 'data_user_grub';
		$this->load->view('template',$data);		
	}

	function ajaxUser_grub(){
		$this->auth();
		$data = otoritas('admin/user_grub',$this->session->userdata('sesRole'));
		$data['list']	= $this->allcrud->listdata('user_grub','nama_user_grub ASC',array());
		$this->load->view('ajaxUser_grub',$data);
	}
	
	function proses_user_grub(){
		$this->auth();
		$data = array(
			'nama_user_grub' => ucwords(strip_tags($this->input->post('nama')))
		);
		if($this->input->post('id') != 'kosong'){
			$flag = array('id_jenis'=>$this->input->post('id'));
			$this->allcrud->editdata('user_grub',$flag,$data);
		}else{
			$this->allcrud->insertdata('user_grub',$data);
		}
		
	}
	
	function edit_user_grub($id){
		
		$flag = array('id_user_grub'=>$id);
		$q = $this->allcrud->getData('user_grub',$flag,1,0)->row();
		echo json_encode($q);
	}	
	
	function delUser_grub($id){
		$flag = array('id_user_grub' => $id);
		$this->allcrud->deletedata('user_grub',$flag);
	}
	
}	
