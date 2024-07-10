<?php

class Mraport extends CI_Model {

	 	function __construct () {
		parent::__construct();
		
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

	public function assignClass($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select('kelas.nama_kelas, kelas.tingkat, guru_assign.*');
		$this->db->from('kelas');
		$this->db->join('guru_assign','kelas.id_kelas=guru_assign.id_kelas');
		return $this->db->get();
	}
	
	public function raport_point($table, $flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" kelas.*, $table.*, raport_periode.periode, raport_periode.tahun_akademik ");
		$this->db->select(" student.id_number, student.full_name, mata_pelajaran.nama_mapel, mata_pelajaran.id_mapel ");
		$this->db->from($table);
		$this->db->join('kelas','kelas.id_kelas='.$table.'.kelas');
		$this->db->join('raport_periode',$table.'.raport_periode=raport_periode.id_raport_periode');
		$this->db->join('student',$table.'.student=student.id_number');
		$this->db->join('mata_pelajaran',$table.'.mapel=mata_pelajaran.id_mapel');
		return $this->db->get();
	}
	
	public function detailRaport($result,$detail,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" student.id_number,student.full_name, $result.mapel, $detail.*, raport_periode.* ");
		$this->db->select(' mata_pelajaran.nama_mapel, point_category.nama_category, point_criteria.nama_criteria, point_criteria.flag ');
		$this->db->from($result);
		$this->db->join($detail,$result.'.id_raport_result='.$detail.'.raport_result');
		$this->db->join('student',$result.'.student=student.id_number');
		$this->db->join('mata_pelajaran',$result.'.mapel=mata_pelajaran.id_mapel');
		$this->db->join('point_criteria',$detail.'.criteria=point_criteria.id_criteria');
		$this->db->join('point_category','point_criteria.id_category=point_category.id_category');
		$this->db->join('raport_periode',$result.'.raport_periode=raport_periode.id_raport_periode');
		$this->db->order_by('mata_pelajaran.id_mapel ASC, point_criteria.flag ASC');
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
	
	public function raport_y3($table,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->from($table);
		$this->db->join('student',$table.'.student=student.id_number');
		$this->db->join('mata_pelajaran',$table.'.mapel=mata_pelajaran.id_mapel');
		return $this->db->get();
	}
	
	public function pmd_result($flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mapel.nama_mapel, pmd.flag_pmd ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='DISCOVERY' THEN pmd.nama_pmd END) DISCOVERY ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='EXPLORATION' THEN pmd.nama_pmd END) EXPLORATION ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='PRESENTATION' THEN pmd.nama_pmd END) PRESENTATION ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='PERSONALITY' THEN pmd.nama_pmd END) PERSONALITY ");
		$this->db->select(" GROUP_CONCAT(CASE WHEN c.nama_category='ACHIEVEMENT' THEN pmd.nama_pmd END) ACHIEVEMENT ");
		$this->db->from('mata_pelajaran mapel');
		$this->db->join('point_pmd pmd','pmd.id_mapel=mapel.id_mapel');
		$this->db->join('point_category c','c.id_category=pmd.id_category');
		$this->db->group_by('pmd.flag_pmd');
		$this->db->order_by('pmd.flag_pmd DESC');
		return $this->db->get();
	}
	
	public function get_pmd_list($pmd,$result,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mata_pelajaran.nama_mapel, result.*, pmd.*, point_category.nama_category, point_pmd.* ");
		$this->db->from($result.' result');
		$this->db->join($pmd.' pmd','pmd.id_raport_result=result.id_raport_result');
		$this->db->join('point_pmd','pmd.id_pmd=point_pmd.id_pmd');
		$this->db->join('point_category','point_pmd.id_category=point_category.id_category');
		$this->db->join('mata_pelajaran','result.mapel=mata_pelajaran.id_mapel');
		$this->db->order_by('point_pmd.flag_pmd ASC, point_category.nama_category DESC ');
		return $this->db->get();
	}
	
	public function student_by_raport_result($table,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		
		$this->db->select('student.id_number, student.full_name,'.$table.'.*');
		$this->db->from('student');
		$this->db->join($table,$table.'.student=student.id_number');
		return $this->db->get()->row();
	}
	
	public function no_raport_detail($table,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		
		$this->db->select($table.".*, mata_pelajaran.nama_mapel");
		$this->db->from($table);
		$this->db->join('mata_pelajaran','mata_pelajaran.id_mapel='.$table.'.mapel');
		return $this->db->get();
	}
	
	public function aktif_fmp(){
		$this->db->where('raport_periode.status','aktif');
		$this->db->select('fmp.*, raport_periode.status ');
		$this->db->from('fmp');
		$this->db->join('raport_periode','fmp.periode=raport_periode.periode');
		return $this->db->get();
	}
	
	public function final_major_project($flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" fmp.*, point_category.nama_category, raport_fmp.id_raport_fmp, raport_fmp.fmp_result");
		$this->db->from('raport_result_y3');
		$this->db->join('raport_fmp','raport_result_y3.id_raport_result=raport_fmp.raport_result');
		$this->db->join('fmp','raport_fmp.criteria=fmp.id_fmp');
		$this->db->join('point_category','point_category.id_category=fmp.category');
		$this->db->order_by('flag_fmp ASC');
		return $this->db->get();
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
	
	public function list_raport_output($filter,$table){
		$this->db->where($filter);
		$this->db->from($table);
		$this->db->join('kelas',$table.'.kelas=kelas.id_kelas');
		$this->db->join('student',$table.'.student=student.id_number');
		$this->db->join('raport_periode',$table.'.raport_periode=raport_periode.id_raport_periode');
		$this->db->group_by('student.id_number');
		$this->db->order_by('nama_kelas ASC, full_name ASC');
		return $this->db->get();
	}
	
	public function dataRaport($result,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" $result.raport_periode, $result.keterangan, $result.keterangan_by_hr, $result.keterangan_by_pr, student.id_number,student.full_name, student.admission_date, raport_periode.*, kelas.*, guru.full_name nama_guru ");
		$this->db->from($result);
		$this->db->join('student',$result.'.student=student.id_number');
		$this->db->join('raport_periode',$result.'.raport_periode=raport_periode.id_raport_periode');
		$this->db->join('kelas',$result.'.kelas=kelas.id_kelas');
		$this->db->join('guru','kelas.wali_kelas=guru.id_number');
		return $this->db->get();
	}
	public function raport_result($result,$detail,$flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mapel.id_mapel, mapel.nama_mapel, detail.id_raport_detail, cri.flag ");
		$this->db->select(" CASE WHEN cat.nama_category='DISCOVERY' THEN cri.nama_criteria END DISCOVERY, CASE WHEN cat.nama_category='DISCOVERY' THEN detail.result END r_self ");
		$this->db->select(" CASE WHEN cat.nama_category='EXPLORATION' THEN cri.nama_criteria END EXPLORATION, CASE WHEN cat.nama_category='EXPLORATION' THEN detail.result END r_expl ");
		$this->db->select(" CASE WHEN cat.nama_category='PRESENTATION' THEN cri.nama_criteria END PRESENTATION, CASE WHEN cat.nama_category='PRESENTATION' THEN detail.result END r_pres ");
		$this->db->select(" CASE WHEN cat.nama_category='PERSONALITY' THEN cri.nama_criteria END PERSONALITY, CASE WHEN cat.nama_category='PERSONALITY' THEN detail.result END r_pers ");
		$this->db->select(" CASE WHEN cat.nama_category='ACHIEVEMENT' THEN cri.nama_criteria END ACHIEVEMENT, CASE WHEN cat.nama_category='ACHIEVEMENT' THEN detail.result END r_achi ");
		$this->db->select(" result.result, result.result_pmd, result.keterangan");
		$this->db->from('point_category cat');
		$this->db->join('point_criteria cri','cri.id_category=cat.id_category');
		$this->db->join($detail.' detail','detail.criteria=cri.id_criteria');
		$this->db->join($result.' result','result.id_raport_result=detail.raport_result');
		$this->db->join('mata_pelajaran mapel','mapel.id_mapel=result.mapel');
		$this->db->group_by('cri.id_criteria');
		$this->db->order_by('mapel.id_mapel ASC, cri.flag ASC');
		return $this->db->get();
	}
	
		public function learning_result($result,$learning,$flag = NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select(" mapel.id_mapel, mapel.nama_mapel, pmd.flag_pmd, pmd.nama_pmd, c.nama_category, learning.pmd_result, result.result_pmd, result.keterangan");
		$this->db->from('point_pmd pmd');
		$this->db->join('mata_pelajaran mapel','pmd.id_mapel=mapel.id_mapel');
		$this->db->join('point_category c','c.id_category=pmd.id_category');
		$this->db->join($learning.' learning','learning.id_pmd=pmd.id_pmd','LEFT');
		$this->db->join($result.' result','result.id_raport_result=learning.id_raport_result','LEFT');
		return $this->db->get();
	}

	public function get_mapel_learning($learning,$result) {
		$this->db->distinct();
		$this->db->select("pmd.id_mapel, mapel.nama_mapel");
		$this->db->from($learning);
		$this->db->join($result.' result',"result.id_raport_result=$learning.id_raport_result",'LEFT');
		$this->db->join('point_pmd pmd',"$learning.id_pmd=pmd.id_pmd");
		$this->db->join('mata_pelajaran mapel','pmd.id_mapel=mapel.id_mapel');
		return $this->db->get();
	}

	public function dataRaportList($result,$flag=NULL){
		if($flag != NULL){
			$this->db->where($flag);
		}
		$this->db->select("id_mapel,nama_mapel, result.score, result.result, result.result_fmp, result.keterangan");
		$this->db->from($result.' result');
		$this->db->join('mata_pelajaran mapel','result.mapel=mapel.id_mapel');
		return $this->db->get();
	}
	
	public function published($grade){
		$flag = array(
			'raport_periode.status' => 'aktif',
		);
		
		switch($grade){
			case 1 :
				$raport = 'raport_result_y1';
				break;
			case 2 :
				$raport = 'raport_result_y2';
				break;
			case 3 :
				$raport = 'raport_result_y3';
				break;
		}
		
		$this->db->where($flag);
		$this->db->select(" kelas.nama_kelas, kelas.tingkat, student.full_name, student.id_number, raport_periode.periode, $raport.published, $raport.id_raport_result ");
		$this->db->from($raport);
		$this->db->join('student',"student.id_number=$raport.student");
		$this->db->join('kelas',"kelas.id_kelas=$raport.kelas");
		$this->db->join('raport_periode',"raport_periode.id_raport_periode=$raport.raport_periode");
		$this->db->group_by("$raport.student");
		$this->db->order_by("kelas.nama_kelas");
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

	public function periode_aktif(){
		return $this->db->query("select id_raport_periode from raport_periode where status='aktif'");
	} 
	
    public function list_raport_gabungan(){
	    return $this->db->query("SELECT n.*,s.full_name,p.periode as nperiode,p.tahun_akademik,p.id_raport_periode from nilai n 
            left outer join student s on(s.id_number=n.murid) 
            left outer join raport_periode p on(p.id_raport_periode=n.periode)
            where n.sdh_final='1' group by murid,periode order by murid,periode");
	} 
	
	public function list_kriteria_nilai($periode,$murid,$pelajaran){
		return $this->db->query("SELECT k.id_kriteria,ke,s.nama_siklus,isi_kriteria,n.nilai,n.konversi FROM kriteria_pelajaran k 
		              left outer join siklus_belajar s on(s.id_siklus=k.siklus)
		              left outer join nilai_detail n on(n.id_kriteria=k.id_kriteria and n.periode=$periode and n.murid='$murid')
		              WHERE subjek=$pelajaran order by k.ke");
    }
    
    public function list_raport_header($murid,$periode){
		return $this->db->query("select s.id_number,s.full_name,s.angkatan,rp.periode,rp.image_ttd as ttd_kepsek,rp.image_ttd3 as ttd_kepsek3,gf.image_ttd as ttd_fasil,pr.image_ttd as ttd_ortu,rp.tahun_akademik,pe.ket as judul,pe.semester,k.nama_kelas,k.tingkat,k.jenjang,rp.tgl_raport,rp.kepsek,rp.kepsek3,g.full_name as fasil,pr.full_name as ortu from student s 
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
	
	public function list_raport_mpp($murid,$periode){
	    if ($periode<=21){
		return $this->db->query("SELECT d.*,k.*,m.nama_mapel,g.full_name as nguru,tp.nama_tipe,sk.nama_siklus,n.nilai as hasil,n.catatan,m.syarat,n.dioutput,n.evaluasi,n.hasil_konversi,n.hasil_dioutput,n.nilai_dioutput,n.syarat_dioutput,n.tercapai_dioutput,n.evaluasi,(select count(nilai) from nilai_detail ka where ka.pelajaran=m.id_mapel and ka.murid='$murid' and ka.periode=$periode) as jml FROM nilai_detail d 
		left outer join kriteria_pelajaran k on (k.id_kriteria=d.id_kriteria) 
		left outer join mata_pelajaran_lama m on(m.id_mapel=k.subjek) 
		left outer join mata_pelajaran_periode mp on(m.id_mapel=mp.pelajaran and mp.periode=$periode) 
	    left outer join guru g on(g.id_user=mp.guru) 
	  	left outer join nilai n on(n.murid=d.murid and n.pelajaran=k.subjek and n.periode=d.periode)
		left outer join siklus_belajar sk on(sk.id_siklus=k.siklus) 
		left outer join tipe_pelajaran tp on(tp.id_tipe=m.tipe_pelajaran) where d.murid='$murid' and d.periode=$periode
		order by m.tipe_pelajaran,m.nama_mapel,k.ke");
	    } else {
	     return $this->db->query("SELECT d.*,k.*,m.nama_mapel,g.full_name as nguru,tp.nama_tipe,sk.nama_siklus,n.nilai as hasil,n.catatan,m.syarat,n.dioutput,n.evaluasi,n.hasil_konversi,n.hasil_dioutput,n.nilai_dioutput,n.syarat_dioutput,n.tercapai_dioutput,(select count(nilai) from nilai_detail ka where ka.pelajaran=m.id_mapel and ka.murid='$murid' and ka.periode=$periode) as jml FROM nilai_detail d 
		left outer join kriteria_pelajaran k on (k.id_kriteria=d.id_kriteria) 
		left outer join mata_pelajaran m on(m.id_mapel=k.subjek) 
		left outer join mata_pelajaran_periode mp on(m.id_mapel=mp.pelajaran and mp.periode=$periode) 
	    left outer join guru g on(g.id_user=mp.guru) 
	  	left outer join nilai n on(n.murid=d.murid and n.pelajaran=k.subjek and n.periode=d.periode)
		left outer join siklus_belajar sk on(sk.id_siklus=k.siklus) 
		left outer join tipe_pelajaran tp on(tp.id_tipe=m.tipe_pelajaran) where d.murid='$murid' and d.periode=$periode
		order by m.tipe_pelajaran,m.nama_mapel,k.ke");     
	    }
	}
	
	public function list_catatan_mpp($murid,$periode){
		return $this->db->query("SELECT * from catatan_final where murid='$murid' and periode=$periode");
	}
	
	public function list_raport_proyek_header($id_proyek){
	  return $this->db->query("select p.*,s.full_name,s.angkatan,rp.periode,rp.tahun_akademik,rp.image_ttd as ttd_kepsek,rp.image_ttd3 as ttd_kepsek3,gf.image_ttd as ttd_fasil,pr.image_ttd as ttd_ortu,
	                           pe.ket as judul,pe.semester,k.nama_kelas,k.tingkat,k.jenjang,rp.tgl_raport,rp.kepsek,rp.kepsek3,g.full_name as fasil,pr.full_name as ortu  from proyek p 
	             left outer join student s on(s.id_number=p.murid) 
	             left outer join raport_periode rp on(rp.status='aktif') 
	             left outer join periode pe on(pe.kode=rp.periode) 
	             left outer join student_assign a on(a.id_number=p.murid AND a.status='aktif') 
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
	    return $this->db->query("SELECT count(siklus) as jml FROM `proyek_detail` WHERE id_proyek=$id_proyek AND tampil='Y' group by siklus order by count(siklus) desc limit 1");
	} 
	
	public function siklus_proyek($id_proyek){
	    return $this->db->query("SELECT distinct siklus,s.nama_siklus FROM `proyek_detail` p 
	    left outer join siklus_belajar s on(s.id_siklus=p.siklus) where tampil='Y' and id_proyek=$id_proyek order by siklus");
	} 
	
	public function list_catatan_final($murid,$periode){
		return $this->db->query("SELECT * from catatan_final where murid='$murid' and periode=$periode");
	}
	
	public function cek_guru_final_corector($guru){
	    return $this->db->query("select count(guru) as hasil from guru_assign_final_corrector a left outer join guru g on(g.id_user=a.guru) where g.id_number='$guru'");
	}
	
	public function list_raport_pub_gabungan($guru,$filter){
	    if ($guru!='') $bts=" and n.murid in (select sf.murid from student_assign_fasilitator sf left outer join guru tc on(tc.id_user=sf.guru) where tc.id_number='$guru')"; else $bts="";
	    return $this->db->query("SELECT distinct n.murid, s.full_name,k.nama_kelas,jj.nama_jenjang,jl.nama_jalur,jn.nama_jenis, p.periode as nperiode, p.tahun_akademik,k.tingkat,p.id_raport_periode,n.periode from nilai n 
	                left outer join raport_periode p on(p.id_raport_periode=n.periode) 
	                left outer join student s on(s.id_number=n.murid) 
	                left outer join student_assign a on(n.murid=a.id_number and a.start_date<=p.awal and (a.end_date>=p.akhir or a.end_date is null))  
	                left outer join kelas k on(k.id_kelas=a.id_kelas) 
	                left outer join jenis_pendidikan jn on(k.jenis=jn.id_jenis) 
	                left outer join jenjang_pendidikan jj on(k.jenjang=jj.id_jenjang) 
	                left outer join jalur_pendidikan jl on(k.jalur=jl.id_jalur) 
	                where n.sdh_final='1' and n.murid in (select murid from proyek where sdh_final='1') $bts $filter order by murid,p.periode ");
	} 
	
	public function list_raport_pub2($guru,$filter){
	    if ($guru!='') $bts=" and n.murid in (select sf.murid from student_assign_fasilitator sf left outer join guru tc on(tc.id_user=sf.guru) where tc.id_number='$guru')"; else $bts="";
	    return $this->db->query("SELECT distinct n.murid, s.full_name,n.periode,k.nama_kelas,jj.nama_jenjang,jl.nama_jalur,jn.nama_jenis, p.periode as nperiode, p.tahun_akademik,p.id_raport_periode,pb.pub,pb.pub2,pb.pub_konversi,pb.pub_konversi2 from nilai n  
	                left outer join raport_pub pb on(pb.murid=n.murid and pb.periode=n.periode) 
	                left outer join student s on(s.id_number=n.murid) 
	                left outer join student_assign a on(a.id_number=n.murid and a.status='aktif') 
	                left outer join kelas k on(k.id_kelas=a.id_kelas) 
	                left outer join jenis_pendidikan jn on(k.jenis=jn.id_jenis) 
	                left outer join jenjang_pendidikan jj on(k.jenjang=jj.id_jenjang) 
	                left outer join jalur_pendidikan jl on(k.jalur=jl.id_jalur) 
	                 left outer join raport_periode p on(p.id_raport_periode=n.periode)
	                where n.sdh_final='1' $bts $filter order by murid,p.periode ");
	} 
	
	
	public function list_proyek_di_raport_murid($murid,$per){
         	return $this->db->query("SELECT id_proyek FROM proyek p left outer join raport_periode r on(r.id_raport_periode=$per) where sdh_final='1' and ((p.tgl_awal>=r.awal and p.tgl_awal<=r.akhir) or (p.tgl_akhir>=r.awal and p.tgl_akhir<=r.akhir) or (p.tgl_awal<=r.awal and p.tgl_akhir>=r.akhir)) and murid='$murid' ");	    
	}

}