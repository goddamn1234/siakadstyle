<?php

class Mmaster2 extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
		
	public function list_matpel($flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" m.*, j.nama_jenjang, g.full_name, k.nama_kelas,tr.nama_tipe as nama_tipe_raport,tp.nama_tipe as nama_tipe_pelajaran,metode");
		$this->db->from('mata_pelajaran AS m');
		$this->db->join('jenjang_pendidikan AS j','m.jenjang=j.id_jenjang', 'left outer');
		$this->db->join('kelas AS k','m.kelas=k.id_kelas','left outer');
		$this->db->join('tipe_raport AS tr','m.tipe_raport=tr.id_tipe', 'left outer');
		$this->db->join('tipe_pelajaran AS tp','m.tipe_pelajaran=tp.id_tipe', 'left outer');
		$this->db->join('guru AS g','g.id_user=m.guru', 'left outer');
		$this->db->order_by("nama_mapel ASC ");
		return $this->db->get();
	}
	
	public function list_mapel_periode($periode=''){
	    if ($periode!='') $bts=" where periode=$periode"; else $bts='';
	    return $this->db->query("select m.periode,m.id_assign,p.nama_mapel,g.full_name,g2.full_name as full_name2,k.nama_kelas,jj.nama_jenjang,rp.periode as nperiode,rp.tahun_akademik from mata_pelajaran_periode m 
	                            left outer join mata_pelajaran p on(p.id_mapel=m.pelajaran) 
                                left outer join guru g on(g.id_user=p.guru)
                                left outer join guru g2 on(g2.id_user=m.guru)
                                left outer join kelas k on(k.id_kelas=p.kelas) 
                                left outer join jenjang_pendidikan jj on(jj.id_jenjang=k.jenjang) 
                                left outer join raport_periode rp on(rp.id_raport_periode=m.periode) 
	                            $bts order by m.periode,p.nama_mapel");
	}
	
	public function list_kriteria($flag = NULL,$periode){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->where('kr.periode',$periode);
		$this->db->select(" kr.*, p.nama_mapel,p.tingkat,j.nama_jenjang,k.nama_kelas,tr.nama_tipe as nama_tipe_raport,tp.nama_tipe as nama_tipe_pelajaran,metode,nama_siklus");
		$this->db->from('kriteria_pelajaran AS kr');
		$this->db->join('mata_pelajaran AS p','kr.subjek=p.id_mapel', 'left outer');
		$this->db->join('jenjang_pendidikan AS j','p.jenjang=j.id_jenjang','left outer');
		$this->db->join('kelas AS k','p.kelas=k.id_kelas','left outer');
		$this->db->join('tipe_raport AS tr','p.tipe_raport=tr.id_tipe', 'left outer');
		$this->db->join('tipe_pelajaran AS tp','p.tipe_pelajaran=tp.id_tipe', 'left outer');
		$this->db->join('siklus_belajar AS sb','sb.id_siklus=kr.siklus', 'left outer');
		$this->db->order_by("nama_mapel ASC ");
		return $this->db->get();
	}
	
	public function periode_aktif(){
		return $this->db->query("select id_raport_periode from raport_periode where status='aktif'");
	} 
	
	public function list_periode(){
		return $this->db->query("select id_raport_periode,periode,tahun_akademik from raport_periode order by id_raport_periode desc");
	} 
	
	
	public function list_jadwal($pelajaran,$periode){
	    return $this->db->query("select j.*,p.nama_mapel,g.full_name,k.nama_kelas,jj.nama_jenjang,rp.periode as nperiode,rp.tahun_akademik  from jadwal_pelajaran j 
	                            left outer join mata_pelajaran p on(p.id_mapel=j.pelajaran) 
                                left outer join guru g on(g.id_user=p.guru)
                                left outer join kelas k on(k.id_kelas=p.kelas) 
                                left outer join jenjang_pendidikan jj on(jj.id_jenjang=k.jenjang) 
                                left outer join raport_periode rp on(rp.id_raport_periode=j.periode) 
	                            where pelajaran=$pelajaran and j.periode=$periode order by hari");
	}
	
	public function list_guru_lain($pel){
		return $this->db->query("select b.id_guru_bantu,b.pelajaran,g.id_user,g.id_number,g.full_name from guru_bantu b left outer join guru g on (g.id_user=b.guru)  where b.pelajaran=$pel");
	} 
}