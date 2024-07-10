<?php

class mraport_proyek extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
	
	public function periode_aktif(){
		return $this->db->query("select id_raport_periode from raport_periode where status='aktif'");
	} 
	
	public function list_proyek($id){
	    if ($id!='') $wm="where murid='$id'"; else $wm='';
		return $this->db->query("select * from proyek $wm order by id_proyek");
	} 
	
	public function list_proyek_sekarang($id){
	    if ($id!='') $wm=" and murid='$id'"; else $wm='';
		return $this->db->query("select * from proyek p
		                         left outer join raport_periode r on(r.status='aktif')
		                         where ((p.tgl_awal>=r.awal and p.tgl_awal<=r.akhir) or (p.tgl_akhir>=r.awal and p.tgl_akhir<=r.akhir) or (p.tgl_awal<=r.awal and p.tgl_akhir>=r.akhir)) $wm order by id_proyek");
	} 
	
	public function list_proyek_detail($id){
	    return $this->db->query("select d.*,s.nama_siklus from proyek_detail d left outer join siklus_belajar s on(s.id_siklus=d.siklus) where id_proyek=$id");
	}
	
	public function lihat_fasilitator($murid){
	    return $this->db->query("select g.full_name from student_assign_fasilitator a left outer join guru g on(g.id_user=a.guru) where murid='$murid'");
	}
	
	public function lihat_kelas($murid){
	    return $this->db->query("select k.nama_kelas from student_assign a left outer join kelas k on(a.id_kelas=k.id_kelas) where id_number='$murid' and status='aktif' ");
	}
	
	public function list_siswa_yg_ada_proyek($guru){
	    if ($guru!='') $wguru="and p.murid in (select murid from student_assign_fasilitator a left outer join guru g on(g.id_user=a.guru) where g.id_number='$guru')"; else $wguru='';
	    return $this->db->query("SELECT p.periode,murid,s.full_name,k.nama_kelas,j.nama_jenjang,r.periode as nama_periode,r.tahun_akademik,count(murid) as jml FROM proyek p 
	          left outer join student s on(s.id_number=p.murid) 
	          left outer join student_assign a on(a.id_number=p.murid and a.status='aktif') 
	          left outer join kelas k on(k.id_kelas=a.id_kelas) 
	          left outer join jenjang_pendidikan j on(j.id_jenjang=k.jenjang) 
	          left outer join raport_periode r on(r.status='aktif')
		      where ((p.tgl_awal>=r.awal and p.tgl_awal<=r.akhir) or (p.tgl_akhir>=r.awal and p.tgl_akhir<=r.akhir) or (p.tgl_awal<=r.awal and p.tgl_akhir>=r.akhir))
	          $wguru group by murid");
	}
	
	public function list_siswa_yg_ada_proyek2($filter){
	    if ($filter) $wfilter="where true"; else $wfilter='where false';
	    return $this->db->query("SELECT p.periode,murid,s.full_name,k.nama_kelas,j.nama_jenjang,r.periode as nama_periode,r.tahun_akademik,count(murid) as jml FROM proyek p 
	          left outer join student s on(s.id_number=p.murid) 
	          left outer join student_assign a on(a.id_number=p.murid and a.status='aktif') 
	          left outer join kelas k on(k.id_kelas=a.id_kelas) 
	          left outer join jenjang_pendidikan j on(j.id_jenjang=k.jenjang) 
	          left outer join raport_periode r on(r.id_raport_periode=p.periode) $wfilter and ((p.tgl_awal>=r.awal and p.tgl_awal<=r.akhir) or (p.tgl_akhir>=r.awal and p.tgl_akhir<=r.akhir) or (p.tgl_awal<=r.awal and p.tgl_akhir>=r.akhir)) group by murid,p.periode");
	}
	
	public function cek_guru_final_corector($guru){
	    return $this->db->query("select count(guru) as hasil from guru_assign_final_corrector a left outer join guru g on(g.id_user=a.guru) where g.id_number='$guru'");
	}
	
	public function list_raport(){
	    return $this->db->query("select p.murid,p.id_proyek,p.nama,s.full_name,id_raport_periode from proyek p 
	            left outer join student s on(s.id_number=p.murid) 
	            left outer join raport_periode r on(r.status='aktif')
	            where sdh_final='1' and ((p.tgl_awal>=r.awal and p.tgl_awal<=r.akhir) or (p.tgl_akhir>=r.awal and p.tgl_akhir<=r.akhir) or (p.tgl_awal<=r.awal and p.tgl_akhir>=r.akhir)) order by murid");
	} 
	
	public function list_raport_header($id_proyek,$periode){
	  return $this->db->query("select p.*,s.full_name,s.angkatan,rp.periode,rp.tahun_akademik,rp.image_ttd as ttd_kepsek,rp.image_ttd3 as ttd_kepsek3,gf.image_ttd as ttd_fasil,pr.image_ttd as ttd_ortu,k.jenjang,
	                           pe.ket as judul,pe.semester,k.nama_kelas,k.tingkat,rp.tgl_raport,rp.kepsek,rp.kepsek3,g.full_name as fasil,pr.full_name as ortu  from proyek p 
	             left outer join student s on(s.id_number=p.murid) 
	             left outer join raport_periode rp on(rp.id_raport_periode=$periode) 
	             left outer join periode pe on(pe.kode=rp.periode) 
	             left outer join student_assign a on(p.murid=a.id_number and a.start_date<=rp.awal and (a.end_date>=rp.akhir or a.end_date is null))  
	             left outer join kelas k on(k.id_kelas=a.id_kelas)
	             left outer join student_assign_fasilitator f on(f.murid=s.id_number)
	             left outer join guru_assign_fasilitator gf on(gf.guru=f.guru)
	             left outer join guru g on(g.id_user=f.guru)
	             left outer join parent pr on(pr.parent_from=s.id_number)
	             where id_proyek=$id_proyek");
	} 
	
	public function list_raport_proyek_detail($id_proyek){
	    return $this->db->query("SELECT * FROM proyek_detail where tampil='Y' and id_proyek=$id_proyek order by siklus,ke");
	} 
	
	public function jml_siklus_proyek($id_proyek){
	    return $this->db->query("SELECT count(distinct siklus) as jml FROM `proyek_detail` where tampil='Y' and id_proyek=$id_proyek");
	} 

    public function max_item_siklus_proyek($id_proyek){
	    return $this->db->query("SELECT count(siklus) as jml FROM `proyek_detail` WHERE id_proyek=$id_proyek and tampil='Y' group by siklus order by count(siklus) desc limit 1");
	} 
	
	public function siklus_proyek($id_proyek){
	    return $this->db->query("SELECT distinct siklus,s.nama_siklus FROM `proyek_detail` p 
	    left outer join siklus_belajar s on(s.id_siklus=p.siklus) where tampil='Y' and id_proyek=$id_proyek order by siklus");
	} 
	
	public function list_catatan_final($murid,$periode){
		return $this->db->query("SELECT * from catatan_final where murid='$murid' and periode=$periode");
	}
	
	public function list_proyek_di_raport_murid($murid,$per){
         	return $this->db->query("SELECT id_proyek FROM proyek p left outer join raport_periode r on(r.id_raport_periode=$per) 
         	   where sdh_final='1' and ((p.tgl_awal>=r.awal and p.tgl_awal<=r.akhir) or (p.tgl_akhir>=r.awal and p.tgl_akhir<=r.akhir) or (p.tgl_awal<=r.awal and p.tgl_akhir>=r.akhir)) and murid='$murid'");	    
	}
}