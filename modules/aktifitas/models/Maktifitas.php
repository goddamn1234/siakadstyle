<?php

class Maktifitas extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
		
	public function periode_aktif(){
		return $this->db->query("select id_raport_periode from raport_periode where status='aktif'");
	} 
	
	public function cek_krs($periode,$mapel,$murid){
		$dt=$this->db->query("select id_krs from krs where periode=$periode and murid='$murid' and pelajaran=$mapel");
		return $dt->num_rows();
	} 
	
	public function lihat_tipe($pelajaran){
		return $this->db->query("select tipe_pelajaran from mata_pelajaran where id_mapel=$pelajaran");
	} 

	public function lihat_kelas_murid($murid){
		return $this->db->query("select id_kelas from student_assign where id_number='$murid' and status='aktif'");
	} 
	
	
	public function list_krs_murid(){
		return $this->db->query("
		            SELECT t.nama_tipe,t.id_tipe,rp.id_raport_periode,rp.periode,rp.tahun_akademik,k.status,count(id_krs) as jml FROM mata_pelajaran p
		            left outer join  krs k  on(p.id_mapel=k.pelajaran) 
		            LEFT OUTER JOIN tipe_pelajaran t on(t.id_tipe=p.tipe_pelajaran) 
		            left outer join raport_periode rp on(rp.status='aktif') 
		            where p.tipe_pelajaran<>'' and p.ikut_krs='YA' and p.status='active' and rp.status='aktif' group by p.tipe_pelajaran
		            order by id_raport_periode DESC, id_tipe ASC");
	} 
	
	public function list_krs_guru(){
		return $this->db->query("SELECT t.nama_tipe,p.tipe_pelajaran,k.periode,rp.periode as nperiode,rp.tahun_akademik,k.status FROM  krs k 
		           left outer join mata_pelajaran p on(p.id_mapel=k.pelajaran) 
		           LEFT OUTER JOIN tipe_pelajaran t on(t.id_tipe=p.tipe_pelajaran) 
		           left outer join raport_periode rp on(rp.id_raport_periode=k.periode) 
		           where p.tipe_pelajaran<>'' order by id_raport_periode DESC, id_tipe ASC");
	}
	
	public function list_murid_disetujui($pel,$periode){
		return $this->db->query("SELECT s.id_number,s.full_name,k.nama_kelas FROM student s 
		           left outer join student_assign a on(a.id_number=s.id_number and a.status='aktif') 
		           left outer join kelas k on(k.id_kelas=a.id_kelas) 
		           where s.id_number in (select murid from krs where status=1 and periode=$periode and pelajaran=$pel) order by s.id_number");
	}

	public function list_daftar_krs($periode,$tipe,$murid,$kelas){
		return $this->db->query("SELECT p.*,t.nama_tipe,k.id_krs,k.status,g.full_name,tr.nama_tipe as nama_tipe_raport,k.tgl_daftar  FROM mata_pelajaran p 
		         left outer join tipe_pelajaran t on(t.id_tipe=p.tipe_pelajaran)  
		         left outer join tipe_raport tr on(tr.id_tipe=p.tipe_raport) 
		         left outer join guru g on(g.id_user=p.guru) 
		         left outer join krs k on(k.periode=$periode and k.murid='$murid' and k.pelajaran=p.id_mapel) where p.ikut_krs='YA' and p.status='active' 
				  and p.tipe_pelajaran=$tipe and p.kelas=$kelas");
	} 
	
	public function list_status_krs($periode,$murid){
		return $this->db->query("SELECT k.*,p.nama_mapel,p.kuota,p.tgl_krs,g.full_name FROM krs k 
                                left outer join mata_pelajaran p on(p.id_mapel=k.pelajaran)
                                left outer join guru g on(g.id_user=p.guru) where k.murid=$murid and k.periode=$periode");
	} 
	
	public function list_mapel_pengajuan_krs($periode,$tipe,$guru){
		if ($guru!='') $wguru=" and g.id_number=$guru"; else $wguru="";
		return $this->db->query("select p.id_mapel,p.nama_mapel,kl.nama_kelas,g.full_name,$periode as periode,count(k.id_krs) as jml FROM krs k 
		        left outer join mata_pelajaran p on(k.pelajaran=p.id_mapel) 
		        left outer join guru g on(g.id_user=p.guru)
                left outer join student m on(m.id_number=k.murid)
                left outer join kelas kl on(kl.id_kelas=p.kelas)		
                left outer join student_assign_fasilitator sf on(sf.murid=k.murid)
                left outer join guru g2 on(g2.id_user=sf.guru)
				where k.periode=$periode and p.tipe_pelajaran=$tipe $wguru group by p.id_mapel order by p.nama_mapel");
	}
	
	
	public function list_pengajuan_krs($periode,$mapel,$guru){
		if ($guru!='') $wguru=" and g.id_number=$guru"; else $wguru="";
		return $this->db->query("SELECT k.id_krs,k.status,g.full_name as nguru,g2.full_name as nwali,k.tgl_daftar,m.id_number,m.full_name as nmurid,kl.nama_kelas,kl.tingkat,p.nama_mapel,kl.wali_kelas FROM krs k 
		        left outer join mata_pelajaran p on(k.pelajaran=p.id_mapel) 
		        left outer join guru g on(g.id_user=p.guru)
                left outer join student m on(m.id_number=k.murid)
                left outer join kelas kl on(kl.id_kelas=p.kelas)		
                left outer join student_assign_fasilitator sf on(sf.murid=k.murid)
                left outer join guru g2 on(g2.id_user=sf.guru)
				where k.periode=$periode and k.pelajaran=$mapel $wguru order by m.id_number");
	}
	
	public function list_kriteria($pelajaran,$periode){
		return $this->db->query("SELECT k.*,s.nama_siklus FROM kriteria_pelajaran k
                      left outer join siklus_belajar s on(k.siklus=s.id_siklus) where subjek=$pelajaran and periode=$periode order by ke");
	}
	
	public function kelas_siswa($user_num){
	    return $this->db->query("select id_kelas from student_assign where status='aktif' and id_number=$user_num)");
	}
	
	public function list_lihat_jadwal($pelajaran,$periode){
		return $this->db->query("SELECT * from jadwal_pelajaran where pelajaran=$pelajaran and periode=$periode order by id_jadwal");
	}
	
	public function list_jadwal($periode,$jenjang,$tingkat,$kelas,$user_num,$hari){
	    if ($jenjang!='') $bts2=" and p.jenjang=$jenjang"; else $bts2="";
	    if ($tingkat!='') $bts3=" and p.tingkat=$tingkat"; else $bts3="";
	    if ($kelas!='') $bts4=" and p.kelas=$kelas"; else $bts4="";
	    
	    return $this->db->query("select p.id_mapel,p.nama_mapel,tp.nama_tipe,g.full_name,k.nama_kelas,jj.nama_jenjang,jn.nama_jenis,jl.nama_jalur,rp.id_raport_periode,rp.periode as nperiode,tahun_akademik,dari,sampai,hari  from  jadwal_pelajaran j  
	                            left outer join mata_pelajaran p on(p.id_mapel=j.pelajaran)
	                            left outer join guru g on(g.id_user=p.guru)
                                left outer join kelas k on(k.id_kelas=p.kelas) 
                                left outer join tipe_pelajaran tp on(tp.id_tipe=p.tipe_pelajaran) 
                                left outer join jenjang_pendidikan jj on(jj.id_jenjang=k.jenjang) 
                                left outer join jalur_pendidikan jl on(jl.id_jalur=k.jalur)
                                left outer join jenis_pendidikan jn on(jn.id_jenis=k.jenis)
                                left outer join raport_periode rp on(rp.id_raport_periode=$periode) where j.periode=$periode and j.hari=$hari and p.id_mapel in (select pelajaran from mata_pelajaran_periode where periode=$periode )  
	                            $bts2 $bts3 $bts4
	                            order by k.jenis,k.jalur,k.jenjang,k.nama_kelas,p.tipe_pelajaran,p.nama_mapel");
	}
	
	public function list_jadwal_siswa($periode,$user_num,$hari){
	    return $this->db->query("select p.id_mapel,p.nama_mapel,tp.nama_tipe,g.full_name,k.nama_kelas,jj.nama_jenjang,jn.nama_jenis,jl.nama_jalur,rp.id_raport_periode,rp.periode as nperiode,tahun_akademik,dari,sampai,hari  from  jadwal_pelajaran j  
	                            left outer join mata_pelajaran p on(p.id_mapel=j.pelajaran)
	                            left outer join guru g on(g.id_user=p.guru)
                                left outer join kelas k on(k.id_kelas=p.kelas) 
                                left outer join tipe_pelajaran tp on(tp.id_tipe=p.tipe_pelajaran) 
                                left outer join jenjang_pendidikan jj on(jj.id_jenjang=k.jenjang) 
                                left outer join jalur_pendidikan jl on(jl.id_jalur=k.jalur)
                                left outer join jenis_pendidikan jn on(jn.id_jenis=k.jenis)
                                left outer join raport_periode rp on(rp.id_raport_periode=$periode) 
                                where j.periode=$periode and j.hari=$hari and p.id_mapel in (select pelajaran from mata_pelajaran_periode where periode=$periode and kelas=(select id_kelas from student_assign where status='aktif' and id_number=$user_num))  
	                            order by k.jenis,k.jalur,k.jenjang,k.nama_kelas,p.tipe_pelajaran,p.nama_mapel");
	}
	
	public function list_jadwal_individu($periode,$jenjang,$tingkat,$kelas){
	    if ($jenjang!='') $bts2=" and k.jenjang=$jenjang"; else $bts2="";
	    if ($tingkat!='') $bts3=" and k.tingkat=$tingkat"; else $bts3="";
	    if ($kelas!='') $bts4=" and k.id_kelas=$kelas"; else $bts4="";
	     return $this->db->query("SELECT r.id_raport_periode,s.id_number,full_name,kl.nama_kelas,r.periode AS nperiode,tahun_akademik,j.nama_jenjang,i.jadwal FROM student s
                                        LEFT OUTER JOIN raport_periode r ON(r.id_raport_periode=$periode)
                                        LEFT OUTER JOIN student_assign a on(a.id_number=s.id_number and a.status='aktif')
                                        inner JOIN kelas kl ON(kl.id_kelas=a.id_kelas) 
                                        left outer join jenjang_pendidikan j on(j.id_jenjang=kl.jenjang)
                                        left outer join jadwal_individu i on(i.periode=$periode and i.siswa=s.id_number)
                                        WHERE r.id_raport_periode=$periode $bts2 $bts3 $bts4 
	                               ");
	                                 /* LEFT OUTER JOIN student_assign a ON(a.id_number=s.id_number AND a.start_date<=r.awal AND (a.end_date>=r.akhir OR a.end_date IS NULL)) */
	}
	
	public function list_non_pelajaran($periode,$jenjang,$tingkat,$kelas,$hari){
	    if ($jenjang!='') $bts2=" and k.jenjang=$jenjang"; else $bts2="";
	    if ($tingkat!='') $bts3=" and k.tingkat=$tingkat"; else $bts3="";
	    if ($kelas!='') $bts4=" and k.id_kelas=$kelas"; else $bts4="";
	    if ($hari!='') $bts5=" and hari=$hari"; else $bts5="";
	     return $this->db->query("select j.*,nama_kelas,jj.nama_jenjang,rp.id_raport_periode,rp.periode as nperiode,tahun_akademik from jadwal_non_pelajaran j
	                               left outer join jenjang_pendidikan jj on(jj.id_jenjang=j.jenjang) 
	                               left outer join kelas k on(k.id_kelas=j.kelas) 
	                               left outer join raport_periode rp on(rp.id_raport_periode=$periode) where j.periode=$periode $bts2 $bts3 $bts4 $bts5
	                               ");
	}	
	
	public function list_non_pelajaran_siswa($periode,$user_num,$hari){
	     return $this->db->query("select j.*,nama_kelas,jj.nama_jenjang,rp.id_raport_periode,rp.periode as nperiode,tahun_akademik from jadwal_non_pelajaran j
	                               left outer join jenjang_pendidikan jj on(jj.id_jenjang=j.jenjang) 
	                               left outer join kelas k on(k.id_kelas=j.kelas) 
	                               left outer join raport_periode rp on(rp.id_raport_periode=$periode) where j.periode=$periode and j.kelas=(select id_kelas from student_assign where status='aktif' and id_number=$user_num)
	                               ");
	}	
	
	
	public function list_kalender(){
	     return $this->db->query("SELECT id_raport_periode,r.periode as nperiode,tahun_akademik,id_jenjang,nama_jenjang,k.kalender FROM raport_periode r
                                    CROSS JOIN jenjang_pendidikan j 
                                    LEFT OUTER JOIN kalender_akademik k ON(k.periode=r.id_raport_periode AND k.jenjang=j.id_jenjang)
                                    WHERE id_jenjang IN (3,4) ORDER BY id_raport_periode DESC, id_jenjang
	                               ");
	}
	
	
	public function list_lpds($periode,$jenjang,$tingkat,$kelas){
	    if ($jenjang!='') $bts2=" and k.jenjang=$jenjang"; else $bts2="";
	    if ($tingkat!='') $bts3=" and k.tingkat=$tingkat"; else $bts3="";
	    if ($kelas!='') $bts4=" and k.id_kelas=$kelas"; else $bts4="";
	     return $this->db->query("SELECT r.id_raport_periode,s.id_number,full_name,kl.nama_kelas,r.periode AS nperiode,tahun_akademik,j.nama_jenjang,l.lpds FROM student s
                                        LEFT OUTER JOIN raport_periode r ON(r.id_raport_periode=$periode)
                                        LEFT OUTER JOIN student_assign a on(a.id_number=s.id_number and a.status='aktif')
                                        inner JOIN kelas kl ON(kl.id_kelas=a.id_kelas) 
                                        left outer join jenjang_pendidikan j on(j.id_jenjang=kl.jenjang)
                                        left outer join lpds l on(l.periode=$periode and l.siswa=s.id_number)
                                        WHERE r.id_raport_periode=$periode $bts2 $bts3 $bts4 
	                               ");
	                                 /* LEFT OUTER JOIN student_assign a ON(a.id_number=s.id_number AND a.start_date<=r.awal AND (a.end_date>=r.akhir OR a.end_date IS NULL)) */
	}
	
	public function list_kalender_siswa($periode,$user_num){
	     return $this->db->query("SELECT kalender from kalender_akademik where periode=$periode and jenjang=(select jenjang from kelas where id_kelas=(select id_kelas from student_assign where status='aktif' and id_number=$user_num))
	   ");
	}
	
	public function ortu_siswa($user_num){
	     return $this->db->query("SELECT parent_from from parent where id_number='$user_num'
	   ");
	}
	
	public function list_jadwal_individu_siswa($periode,$user_num){
	     return $this->db->query("SELECT jadwal from jadwal_individu where periode=$periode and siswa=$user_num ");
	}
	
	public function list_lpds_siswa($user_num){
	     return $this->db->query("SELECT r.periode,tahun_akademik,nama_kelas,nama_jenjang,kl.tingkat,lpds from lpds l 
	                              LEFT OUTER JOIN raport_periode r ON(r.id_raport_periode=l.periode)
	                              left outer join student_assign a ON(a.id_number=l.siswa and a.start_date<=r.awal and (a.end_date>=r.akhir or a.end_date is null)) 
	                              left outer join kelas kl on(kl.id_kelas=a.id_kelas)
                                  left outer join jenjang_pendidikan j on(j.id_jenjang=kl.jenjang)
	                              where siswa=$user_num");
	}
	
	public function jml_kalender($periode,$jenjang){
	     return $this->db->query("select count(*) as jml from kalender_akademik where periode=$periode and jenjang=$jenjang");
	}
	
	public function jml_jadwal_individu($periode,$siswa){
	     return $this->db->query("select count(*) as jml from jadwal_individu where periode=$periode and siswa=$siswa");
	}
	
	public function jml_lpds($periode,$siswa){
	     return $this->db->query("select count(*) as jml from lpds where periode=$periode and siswa=$siswa");
	}
	
	public function list_daftar_murid_kelas($kelas){
	    return $this->db->query("select * from student where id_number in (select id_number from student_assign where id_kelas=$kelas)");
	}   
	
	public function list_daftar_murid_krs($pel){
	    return $this->db->query("select * from student where id_number in (select id_number from krs where status=1 and pelajaran=$pel)");
	}   
	
	public function list_ijin_keluar($user){
	    if ($user!='') $b1="where id_user=$user"; else $b1='';
	    return $this->db->query("SELECT * FROM ijin_keluar $b1");
	} 
	
	public function list_persetujuan_ijin_keluar(){
	    return $this->db->query("SELECT * FROM ijin_keluar");
	} 
}