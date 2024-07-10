<?php

class mRaport_bipp extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
		}
	
	public function periode_aktif(){
		return $this->db->query("select id_raport_periode from raport_periode where status='aktif'");
	} 
	
	public function lihat_pelajaran($id_kriteria){
		return $this->db->query("select subjek from kriteria_pelajaran where id_kriteria='$id_kriteria'");
	} 
	
	public function lihat_kelas($id_number){
		return $this->db->query("select nama_kelas,nama_jenjang from student_assign a left outer join kelas k on(k.id_kelas=a.id_kelas) left outer join jenjang_pendidikan j on(j.id_jenjang=k.jenjang) where a.id_number='$id_number' and status='aktif'");
	} 
	
	public function cek_guru_final_corector($guru){
	    return $this->db->query("select count(guru) as hasil from guru_assign_final_corrector a left outer join guru g on(g.id_user=a.guru) where g.id_number='$guru'");
	}
	
	public function metode_penilaian($pelajaran){
		return $this->db->query("select metode,point from mata_pelajaran where id_mapel=$pelajaran");
	}
	
	public function kriteria_terpenuhi($murid,$pelajaran,$periode){
		return $this->db->query("select count(nilai) as jml from nilai_detail where murid='$murid' and pelajaran=$pelajaran and periode=$periode and nilai='Y'");
	} 
	
	public function hit_kriteria($pelajaran,$periode){
		return $this->db->query("select count(ke) as jml from kriteria_pelajaran where subjek=$pelajaran and periode=$periode");
	} 
	
	public function tdk_memenuhi_syarat($murid,$pelajaran,$periode){
		return $this->db->query("SELECT count(nilai) as jml FROM nilai_detail n left outer join kriteria_pelajaran k on (k.id_kriteria=n.id_kriteria) where n.murid='$murid' 
		           and pelajaran=$pelajaran and n.periode=$periode and syarat='Y' and nilai='T'");
	} 
	
	public function memenuhi_syarat($murid,$pelajaran,$periode){
		return $this->db->query("SELECT count(nilai) as jml FROM nilai_detail n left outer join kriteria_pelajaran k on (k.id_kriteria=n.id_kriteria) where n.murid='$murid' 
		           and pelajaran=$pelajaran and n.periode=$periode and nilai='Y'");
	} 
	
	public function fix_syarat($murid,$pelajaran,$periode){
		return $this->db->query("SELECT count(nilai) as jml FROM nilai_detail n left outer join kriteria_pelajaran k on (k.id_kriteria=n.id_kriteria) where n.murid='$murid' 
		           and pelajaran=$pelajaran and n.periode=$periode and syarat='Y'");
	}
	
	public function list_penilaian($periode,$guru){
		if ($guru!='') $wguru=" and g.id_number='$guru'"; else  $wguru='';
		return $this->db->query("select m.id_mapel,m.nama_mapel,m.kelas,kl.nama_kelas,m.guru,g.full_name,r.periode,r.tahun_akademik,count(m.id_mapel) as jumlah from student s
		                            left outer join raport_periode r on(r.id_raport_periode=$periode)
                                    left outer join student_assign a on(a.id_number=s.id_number and a.start_date<=r.awal and (a.end_date>=r.akhir or a.end_date is null)) 
                                    left outer join mata_pelajaran m on(m.kelas=a.id_kelas) left outer join kelas kl on(kl.id_kelas=a.id_kelas)
                                    left outer join nilai n on(n.murid=s.id_number and n.pelajaran=m.id_mapel and n.periode=$periode)
                                    left outer join guru g on(g.id_user=m.guru)
                                    where (m.ikut_krs='TIDAK') and m.id_mapel in (select pelajaran from mata_pelajaran_periode where periode=$periode) $wguru 
                                    group by id_mapel,kl.nama_kelas
                                    union all
                                    select k.pelajaran,p.nama_mapel,sa.id_kelas,kl.nama_kelas,p.guru,g.full_name,r.periode,r.tahun_akademik,count(k.id_krs) from krs k 
                                    left outer join raport_periode r on(r.id_raport_periode=$periode) 
                                    left outer join mata_pelajaran p on (p.id_mapel=k.pelajaran) 
                                    left outer join student s on(s.id_number=k.murid) 
                                    left outer join student_assign sa on(sa.id_number=k.murid and sa.start_date<=r.awal and (sa.end_date>=r.akhir or sa.end_date is null)) 
                                    left outer join kelas kl on (kl.id_kelas=sa.id_kelas) 
                                    left outer join guru g on(g.id_user=p.guru) 
                                    where k.status='1' and k.periode=$periode $wguru 
                                    group by k.pelajaran,kl.nama_kelas order by nama_mapel,nama_kelas");
	} 
	
	public function list_daftar_nilai($periode,$pelajaran,$kelas){
	    if ($pelajaran!='') $filter="and m.id_mapel=$pelajaran and m.kelas=$kelas "; else $filter='';
		return $this->db->query("select s.id_number,s.full_name as nmurid,m.nama_mapel,kl.nama_kelas,n.nilai,n.hasil_konversi,r.id_raport_periode,r.periode,r.tahun_akademik,m.id_mapel from student s 
		                            left outer join raport_periode r on(r.id_raport_periode=$periode)
                                    left outer join student_assign a on(a.id_number=s.id_number and a.start_date<=r.awal and (a.end_date>=r.akhir or a.end_date is null)) 
                                    left outer join mata_pelajaran m on(m.kelas=a.id_kelas) left outer join kelas kl on(kl.id_kelas=a.id_kelas)
                                    left outer join nilai n on(n.murid=s.id_number and n.pelajaran=m.id_mapel and n.periode=$periode)
                                    left outer join guru g on(g.id_user=m.guru)
                                    where m.ikut_krs='TIDAK' and m.id_mapel in (select pelajaran from mata_pelajaran_periode where periode=$periode) $filter 
                                    union all
                                    select s.id_number,s.full_name,m.nama_mapel,kl.nama_kelas,n.nilai,n.hasil_konversi,r.id_raport_periode,r.periode,r.tahun_akademik,m.id_mapel from krs k 
                                    left outer join mata_pelajaran m on (m.id_mapel=k.pelajaran) 
                                    left outer join student s on(s.id_number=k.murid) 
                                    left outer join student_assign sa on(sa.id_number=k.murid and sa.status='aktif')
                                    left outer join kelas kl on (kl.id_kelas=sa.id_kelas) 
                                    left outer join nilai n on(n.murid=s.id_number and n.pelajaran=m.id_mapel and n.periode=$periode)
                                    left outer join guru g on(g.id_user=m.guru) left outer join raport_periode r on(r.id_raport_periode=$periode) 
                                    where k.status='1' and k.periode=$periode $filter");
	}                                
	
	public function list_kelas_koreksi($periode,$guru){
	   	if ($guru!='') $wguru=" and  m.id_number in (select murid from student_assign_fasilitator s left outer join guru g on(g.id_user=s.guru) where g.id_number='$guru')"; else  $wguru='';
		return $this->db->query("SELECT a.id_kelas,kl.nama_kelas,j.nama_jenjang,count(kl.nama_kelas) as jml FROM student m 
                left outer join raport_periode r on(r.id_raport_periode=$periode)
                left outer join student_assign a on(a.id_number=m.id_number and a.start_date<=r.awal and (a.end_date>=r.akhir or a.end_date is null))
                left outer join kelas kl on(kl.id_kelas=a.id_kelas)
                left outer join jenjang_pendidikan j on(j.id_jenjang=kl.jenjang)
                where m.id_number in (select murid from nilai where sdh_submit='1' and periode=$periode) $wguru group by kl.nama_kelas order by m.id_number");
	}
	
	public function list_daftar_koreksi($periode,$guru,$kelas){
		if ($guru!='') $wguru=" and  m.id_number in (select murid from student_assign_fasilitator s left outer join guru g on(g.id_user=s.guru) where g.id_number='$guru')"; else  $wguru='';
      	if ($kelas!='') $wkelas="and a.id_kelas=$kelas"; else  $wkelas='';	
		return $this->db->query("SELECT m.id_number,m.full_name as nmurid,rp.periode,rp.id_raport_periode,rp.tahun_akademik,c.catatan,kl.nama_kelas FROM student m 
                left outer join raport_periode rp on(rp.id_raport_periode=$periode)
                left outer join student_assign a on(a.id_number=m.id_number and a.start_date<=rp.awal and (a.end_date>=rp.akhir or a.end_date is null))
                left outer join kelas kl on(kl.id_kelas=a.id_kelas)
                left outer join catatan_final c on(c.periode=$periode and c.murid=m.id_number)
				where m.id_number in (select murid from nilai where sdh_submit='1' and periode=$periode) $wkelas $wguru order by m.id_number");
	}
	
	public function list_lihat_nilai($periode,$murid){
		return $this->db->query("SELECT *,m.nama_mapel,tp.nama_tipe,g.full_name,n.hasil_konversi from nilai n 
		                   left outer join mata_pelajaran m on(m.id_mapel=n.pelajaran) 
		                   left outer join tipe_pelajaran tp on(tp.id_tipe=m.tipe_pelajaran) 
		                   left outer join guru g on(g.id_user=m.guru) 
		                   where n.sdh_submit='1' and n.periode=$periode and n.murid='$murid' order by m.id_mapel");
	}
	
	public function lihat_fasilitator($murid){
	    return $this->db->query("select g.full_name from student_assign_fasilitator a left outer join guru g on(g.id_user=a.guru) where murid='$murid'");
	}
	
	public function list_kelas_koreksi_final($periode,$filter){
	    if ($filter==true) { 
		   return $this->db->query("SELECT  a.id_kelas ,kl.nama_kelas,j.nama_jenjang,count(a.id_kelas) as jml FROM student m 
                left outer join student_assign a on(a.status='aktif' and a.id_number=m.id_number)
                left outer join kelas kl on(kl.id_kelas=a.id_kelas)
                left outer join jenjang_pendidikan j on(j.id_jenjang=kl.jenjang)
                left outer join catatan_final c on(c.periode=$periode and c.murid=m.id_number)
				where m.id_number in (select murid from nilai where sdh_dikoreksi='1' and periode=$periode)  group by kl.nama_kelas order by kl.nama_kelas");
	    } else return $this->db->query("select id_kelas, nama_kelas, '' as nama_jenjang, 0 as jml from kelas where id_kelas=-1"); 		
	}
	
	
	public function list_daftar_koreksi_final($periode,$kelas){
		if ($kelas!='') $wkelas=" and a.id_kelas=$kelas"; else  $wkelas='';
		return $this->db->query("SELECT m.id_number,m.full_name as nmurid,rp.periode,rp.id_raport_periode,rp.tahun_akademik,c.catatan,kl.nama_kelas FROM student m 
                left outer join raport_periode rp on(rp.id_raport_periode=$periode)
                left outer join student_assign a on(a.status='aktif' and a.id_number=m.id_number)
                left outer join kelas kl on(kl.id_kelas=a.id_kelas)
                left outer join catatan_final c on(c.periode=$periode and c.murid=m.id_number)
				where m.id_number in (select murid from nilai where sdh_dikoreksi='1' and periode=$periode)  $wkelas order by m.id_number");
	}
	
    public function list_kriteria_nilai($periode,$murid,$pelajaran){
		return $this->db->query("SELECT k.id_kriteria,ke,s.nama_siklus,isi_kriteria,n.nilai,n.konversi FROM kriteria_pelajaran k 
		              left outer join siklus_belajar s on(s.id_siklus=k.siklus)
		              left outer join nilai_detail n on(n.id_kriteria=k.id_kriteria and n.periode=$periode and n.murid='$murid')
		              WHERE subjek=$pelajaran and k.periode=$periode order by k.ke*1");
    }

    public function list_raport_per_kelas(){
		return $this->db->query("SELECT a.id_kelas,kl.nama_kelas,count(a.id_kelas) as jml from student s  
        left outer join student_assign a on(a.id_number=s.id_number and a.status='aktif') 
        left outer join kelas kl on(a.id_kelas=kl.id_kelas) where s.id_number in (select murid from nilai where sdh_final='1') GROUP by a.id_kelas order by kl.nama_kelas");
    }

    
    public function list_raport($kelas){
		return $this->db->query("SELECT distinct n.murid,n.periode,s.full_name,p.periode as nperiode,p.tahun_akademik,p.id_raport_periode from nilai n 
		             left outer join student s on(s.id_number=n.murid) left outer join raport_periode p on(p.id_raport_periode=n.periode) 
		             left outer join student_assign a on(a.id_number=n.murid and a.status='aktif')  where a.id_kelas=$kelas and sdh_final='1'");
    }
    
    public function list_raport_header($murid,$periode){
        if ($periode<=21){
		     return $this->db->query("select s.id_number,s.full_name,s.angkatan,rp.periode,rp.image_ttd as ttd_kepsek,gf.image_ttd as ttd_fasil,pr.image_ttd as ttd_ortu,rp.tahun_akademik,pe.ket as judul,pe.semester,k.nama_kelas,k.tingkat,rp.tgl_raport,rp.kepsek,g.full_name as fasil,pr.full_name as ortu from ayopostc_backupreport22042020.student s 
             left outer join ayopostc_backupreport22042020.raport_periode rp on(rp.id_raport_periode=$periode) 
             left outer join ayopostc_backupreport22042020.student_assign a on(s.id_number=a.id_number and a.start_date<=rp.awal and (a.end_date>=rp.akhir or a.end_date is null)) 
             left outer join ayopostc_backupreport22042020.periode pe on(pe.kode=rp.periode) 
             left outer join ayopostc_backupreport22042020.kelas k on(k.id_kelas=a.id_kelas)
             left outer join ayopostc_backupreport22042020.student_assign_fasilitator f on(f.murid=s.id_number)
             left outer join ayopostc_backupreport22042020.guru g on(g.id_user=f.guru)
             left outer join ayopostc_backupreport22042020.guru_assign_fasilitator gf on(gf.guru=f.guru) 
             left outer join ayopostc_backupreport22042020.parent pr on(pr.parent_from=s.id_number)
		     where s.id_number='$murid'");
        }  else  if ($periode==22){
             return $this->db->query("select s.id_number,s.full_name,s.angkatan,rp.periode,rp.image_ttd as ttd_kepsek,gf.image_ttd as ttd_fasil,pr.image_ttd as ttd_ortu,rp.tahun_akademik,pe.ket as judul,pe.semester,k.nama_kelas,k.tingkat,rp.tgl_raport,rp.kepsek,g.full_name as fasil,pr.full_name as ortu from ayopostc_backupreport04072020.student s 
             left outer join ayopostc_backupreport04072020.raport_periode rp on(rp.id_raport_periode=$periode) 
             left outer join ayopostc_backupreport04072020.student_assign a on(s.id_number=a.id_number and a.start_date<=rp.awal and (a.end_date>=rp.akhir or a.end_date is null)) 
             left outer join ayopostc_backupreport04072020.periode pe on(pe.kode=rp.periode) 
             left outer join ayopostc_backupreport04072020.kelas k on(k.id_kelas=a.id_kelas)
             left outer join ayopostc_backupreport04072020.student_assign_fasilitator f on(f.murid=s.id_number)
             left outer join ayopostc_backupreport04072020.guru g on(g.id_user=f.guru)
             left outer join ayopostc_backupreport04072020.guru_assign_fasilitator gf on(gf.guru=f.guru) 
             left outer join ayopostc_backupreport04072020.parent pr on(pr.parent_from=s.id_number)
		     where s.id_number='$murid'");
        }  else {
             return $this->db->query("select s.id_number,s.full_name,s.angkatan,rp.periode,rp.image_ttd as ttd_kepsek,gf.image_ttd as ttd_fasil,pr.image_ttd as ttd_ortu,rp.tahun_akademik,pe.ket as judul,pe.semester,k.nama_kelas,k.tingkat,rp.tgl_raport,rp.kepsek,g.full_name as fasil,pr.full_name as ortu from student s 
             left outer join raport_periode rp on(rp.id_raport_periode=$periode) 
             left outer join student_assign a on(s.id_number=a.id_number and a.start_date<=rp.awal and (a.end_date>=rp.akhir or a.end_date is null)) 
             left outer join periode pe on(pe.kode=rp.periode) 
             left outer join kelas k on(k.id_kelas=a.id_kelas)
             left outer join student_assign_fasilitator f on(f.murid=s.id_number)
             left outer join guru g on(g.id_user=f.guru)
             left outer join guru_assign_fasilitator gf on(gf.guru=f.guru) 
             left outer join parent pr on(pr.parent_from=s.id_number)
		     where s.id_number='$murid'");
        }    
	}
	
	public function list_raport_bipp($murid,$periode){
	    if ($periode<=21){
    		return $this->db->query("SELECT d.*,k.isi_kriteria,k.subjek,k.siklus,k.point,k.ke,m.nama_mapel,g.full_name as nguru,tp.nama_tipe,sk.nama_siklus,n.nilai as hasil,n.catatan,m.syarat,null as dioutput,null as evaluasi,n.konversi as hasil_konversi,n.konversi,0 as porsi_konversi,0 as porsi_partisipasi,(select count(nilai) from nilai_detail ka where ka.pelajaran=m.id_mapel and ka.murid='$murid' and ka.periode=$periode) as jml FROM ayopostc_backupreport22042020.nilai_detail d 
    		left outer join ayopostc_backupreport22042020.kriteria_pelajaran k on (k.id_kriteria=d.id_kriteria) 
    		left outer join ayopostc_backupreport22042020.mata_pelajaran m on(m.id_mapel=k.subjek) 
    		left outer join ayopostc_backupreport22042020.mata_pelajaran_periode mp on(m.id_mapel=mp.pelajaran and mp.periode=$periode) 
    	    left outer join ayopostc_backupreport22042020.guru g on(g.id_user=mp.guru) 
    	  	left outer join ayopostc_backupreport22042020.nilai n on(n.murid=d.murid and n.pelajaran=k.subjek and n.periode=d.periode)
    		left outer join ayopostc_backupreport22042020.siklus_belajar sk on(sk.id_siklus=k.siklus) 
    		left outer join ayopostc_backupreport22042020.tipe_pelajaran tp on(tp.id_tipe=m.tipe_pelajaran) where d.murid='$murid' and d.periode=$periode
    		order by m.tipe_pelajaran,m.nama_mapel, CAST(k.ke as int)");
	    } else  if ($periode==22){
    		return $this->db->query("SELECT d.*,k.isi_kriteria,k.subjek,k.siklus,k.point,k.ke,m.nama_mapel,g.full_name as nguru,tp.nama_tipe,sk.nama_siklus,n.nilai as hasil,n.catatan,m.syarat,null as dioutput,null as evaluasi,konversi as hasil_konversi,n.konversi,0 as porsi_konversi,0 as porsi_partisipasi,(select count(nilai) from nilai_detail ka where ka.pelajaran=m.id_mapel and ka.murid='$murid' and ka.periode=$periode) as jml FROM ayopostc_backupreport04072020.nilai_detail d 
    		left outer join ayopostc_backupreport04072020.kriteria_pelajaran k on (k.id_kriteria=d.id_kriteria) 
    		left outer join ayopostc_backupreport04072020.mata_pelajaran m on(m.id_mapel=k.subjek) 
    		left outer join ayopostc_backupreport04072020.mata_pelajaran_periode mp on(m.id_mapel=mp.pelajaran and mp.periode=$periode) 
    	    left outer join ayopostc_backupreport04072020.guru g on(g.id_user=mp.guru) 
    	  	left outer join ayopostc_backupreport04072020.nilai n on(n.murid=d.murid and n.pelajaran=k.subjek and n.periode=d.periode)
    		left outer join ayopostc_backupreport04072020.siklus_belajar sk on(sk.id_siklus=k.siklus) 
    		left outer join ayopostc_backupreport04072020.tipe_pelajaran tp on(tp.id_tipe=m.tipe_pelajaran) where d.murid='$murid' and d.periode=$periode
    		order by m.tipe_pelajaran,m.nama_mapel,CAST(k.ke as int)");
	    } else {
	       	return $this->db->query("SELECT d.*,k.isi_kriteria,k.subjek,k.siklus,k.point,k.ke,m.nama_mapel,g.full_name as nguru,tp.nama_tipe,sk.nama_siklus,n.nilai as hasil,n.catatan,m.syarat,n.dioutput,n.evaluasi,n.hasil_konversi,n.konversi,n.porsi_konversi,n.porsi_partisipasi,(select count(nilai) from nilai_detail ka where ka.pelajaran=m.id_mapel and ka.murid='$murid' and ka.periode=$periode) as jml FROM nilai_detail d 
    		left outer join kriteria_pelajaran k on (k.id_kriteria=d.id_kriteria) 
    		left outer join mata_pelajaran m on(m.id_mapel=k.subjek) 
    		left outer join mata_pelajaran_periode mp on(m.id_mapel=mp.pelajaran and mp.periode=$periode) 
    	    left outer join guru g on(g.id_user=mp.guru) 
    	  	left outer join nilai n on(n.murid=d.murid and n.pelajaran=k.subjek and n.periode=d.periode)
    		left outer join siklus_belajar sk on(sk.id_siklus=k.siklus) 
    		left outer join tipe_pelajaran tp on(tp.id_tipe=m.tipe_pelajaran) where d.murid='$murid' and d.periode=$periode
    		order by m.tipe_pelajaran,m.nama_mapel,CAST(k.ke as int)");
	    }
	}
	
	public function list_catatan_bipp($murid,$periode){
		return $this->db->query("SELECT * from catatan_final where murid='$murid' and periode=$periode");
	}
          
}