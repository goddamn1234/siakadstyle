<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
    <?php if (($role==4)||($role==6)){?>
       <!--Ort & siswa-->
        <div class="x_panel">
    		<div class="x_title">
    		    <div>
    		        <?php if ($jadwal_individu_siswa!=""){?>   
    		             <a href="<?php echo base_url()?>/uploads/jadwal_individu/<?php echo $jadwal_individu_siswa;?>" class="btn btn-primary btn-sm" target="_blank">Lihat Jadwal Individu</a> &nbsp;
    		        <?php } else {?>           
    		                 <button class="btn btn-primary btn-sm" disabled>Lihat Jadwal Individu</button>	    
    		       <?php } ?>
    		        <?php if ($kalender_sis!=""){?>   
    		                 <a href="<?php echo base_url()?>/uploads/kalender/<?php echo $kalender_sis;?>" class="btn btn-primary btn-sm" target="_blank">Lihat Kalender Akademik</a>
    		        <?php } else {?>           
    		                 <button class="btn btn-primary btn-sm" disabled>Lihat Kalender Akademik</button>	    
    		       <?php } ?>           
    		    </div>
    		    Periode
    	    	<select id="fperiode" style="padding:5px;margin:5px;" disabled>
    			    <?php foreach($periode->result() as $period){?>
    					<option value="<?php echo $period->id_raport_periode;?>"><?php echo $period->periode.' '.$period->tahun_akademik;?></option>
    				<?php }?>
    			</select>
    			<input type="hidden" id="fjenjang" value="">
    			<input type="hidden" id="ftingkat" value="">
    	    	<select id="fkelas" style="padding:5px;margin:5px;"  disabled>
    	    	    <option value="">Semua</option>
    			    <?php foreach($kelas->result() as $kls){?>
    					<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
    				<?php }?>
    			</select>
    			<div class="clearfix"></div>
            </div>
            <div class="x_content" id="isi">
                
    		</div>
    	</div>
    <?php } else { ?>
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#tab1" style="padding-left:40px;padding-right:40px;font-weight:bold">JADWAL PELAJARAN</a></li>
      <li><a data-toggle="tab" href="#tab2" style="padding-left:40px;padding-right:40px;font-weight:bold">JADWAL INDIVIDU</a></li>
      <li><a data-toggle="tab" href="#tab3" style="padding-left:40px;padding-right:40px;font-weight:bold">INPUT NON-PELAJARAN</a></li>
      <li><a data-toggle="tab" href="#tab4" style="padding-left:40px;padding-right:40px;font-weight:bold">KALENDER AKADEMIK</a></li>
      <li><a data-toggle="tab" href="#tab5" style="padding-left:40px;padding-right:40px;font-weight:bold">LPDS</a></li>
    </ul>
    
    <div class="tab-content">
      <div id="tab1" class="tab-pane fade in active">
           <div class="x_panel">
    		<div class="x_title">
    		    Periode
    	    	<select id="fperiode" style="padding:5px;margin:5px;">
    			    <?php foreach($periode->result() as $period){?>
    					<option value="<?php echo $period->id_raport_periode;?>"><?php echo $period->periode.' '.$period->tahun_akademik;?></option>
    				<?php }?>
    			</select>
    				 Jenjang
    	    	<select id="fjenjang" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($jenjang->result() as $jenjangp){?>
    					<option value="<?php echo $jenjangp->id_jenjang;?>"><?php echo $jenjangp->nama_jenjang?></option>
    				<?php }?>
    			</select>
    			Tingkat
    	    	<select id="ftingkat" style="padding:5px;margin:5px;">
    	    	    	<option value="">Semua</option>
    	    	    	<option value="1">Year 1</option>
    					<option value="2">Year 2</option>
    					<option value="3">Year 3</option>
    			</select>
    			 Kelas
    	    	<select id="fkelas" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($kelas->result() as $kls){?>
    					<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
    				<?php }?>
    			</select>
    			<button class="btn btn-primary" type="button" id="filter"><i class="fa fa-filter"></i> Filter</button>
    			<div class="clearfix"></div>
            </div>
            <div class="x_content" id="isi">
                
    		</div>
    	</div>
      </div>
      <div id="tab2" class="tab-pane fade">
         <div class="x_panel">
    		<div class="x_title">
    		    Periode
    	    	<select id="fperiode2" style="padding:5px;margin:5px;">
    			    <?php foreach($periode->result() as $period){?>
    					<option value="<?php echo $period->id_raport_periode;?>"><?php echo $period->periode.' '.$period->tahun_akademik;?></option>
    				<?php }?>
    			</select>
    				 Jenjang
    	    	<select id="fjenjang2" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($jenjang->result() as $jenjangp){?>
    					<option value="<?php echo $jenjangp->id_jenjang;?>"><?php echo $jenjangp->nama_jenjang?></option>
    				<?php }?>
    			</select>
    			Tingkat
    	    	<select id="ftingkat2" style="padding:5px;margin:5px;">
    	    	        <option value="">Semua</option>
    					<option value="1">Year 1</option>
    					<option value="2">Year 2</option>
    					<option value="3">Year 3</option>
    			</select>
    			 Kelas
    	    	<select id="fkelas2" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($kelas->result() as $kls){?>
    					<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
    				<?php }?>
    			</select>
    			<button class="btn btn-primary" type="button" id="filter2"><i class="fa fa-filter"></i> Filter</button>
    			<div class="clearfix"></div>
    		</div>
             <div class="x_content" id="isi2">
                    
        	 </div>
        </div>	 
      </div>
      <div id="tab3" class="tab-pane fade">
         <div class="x_panel">
    		<div class="x_title">
    		     <?php if (($role==1)||($role==7)){?>
    		    Periode
    	    	<select id="fperiode3" style="padding:5px;margin:5px;">
    			    <?php foreach($periode->result() as $period){?>
    					<option value="<?php echo $period->id_raport_periode;?>"><?php echo $period->periode.' '.$period->tahun_akademik;?></option>
    				<?php }?>
    			</select>
    				 Jenjang
    	    	<select id="fjenjang3" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($jenjang->result() as $jenjangp){?>
    					<option value="<?php echo $jenjangp->id_jenjang;?>"><?php echo $jenjangp->nama_jenjang?></option>
    				<?php }?>
    			</select>
    			Tingkat
    	    	<select id="ftingkat3" style="padding:5px;margin:5px;">
    	    	        <option value="">Semua</option>
    					<option value="1">Year 1</option>
    					<option value="2">Year 2</option>
    					<option value="3">Year 3</option>
    			</select>
    			 Kelas
    	    	<select id="fkelas3" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($kelas->result() as $kls){?>
    					<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
    				<?php }?>
    			</select>
    			<button class="btn btn-primary" type="button" id="filter3"><i class="fa fa-filter"></i> Filter</button>
    			<?php } ?>
    	    	<button class="btn btn-primary" type="button" id="tambah3" onclick="input_jadwal_non()"><i class="fa fa-plus"></i> Input Kegiatan Jadwal</button>	
    			<div class="clearfix"></div>
    		</div>
             <div class="x_content" id="isi3">
                    
        	 </div>
        </div>	 
      </div>
      <div id="tab4" class="tab-pane fade">
        <div class="x_panel">
    		<div class="x_title">
    		    
    		</div>
            <div class="x_content" id="isi4">
                    
        	</div>
         </div>	
      </div>
      <div id="tab5" class="tab-pane fade">
        <div class="x_panel">
    		<div class="x_title">
    		      <?php if (($role==1)||($role==7)){?>
    		    Periode
    	    	<select id="fperiode5" style="padding:5px;margin:5px;">
    			    <?php foreach($periode->result() as $period){?>
    					<option value="<?php echo $period->id_raport_periode;?>"><?php echo $period->periode.' '.$period->tahun_akademik;?></option>
    				<?php }?>
    			</select>
    				 Jenjang
    	    	<select id="fjenjang5" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($jenjang->result() as $jenjangp){?>
    					<option value="<?php echo $jenjangp->id_jenjang;?>"><?php echo $jenjangp->nama_jenjang?></option>
    				<?php }?>
    			</select>
    			Tingkat
    	    	<select id="ftingkat5" style="padding:5px;margin:5px;">
    	    	        <option value="">Semua</option>
    					<option value="1">Year 1</option>
    					<option value="2">Year 2</option>
    					<option value="3">Year 3</option>
    			</select>
    			 Kelas
    	    	<select id="fkelas5" style="padding:5px;margin:5px;">
    	    	    <option value="">Semua</option>
    			    <?php foreach($kelas->result() as $kls){?>
    					<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
    				<?php }?>
    			</select>
    			<button class="btn btn-primary" type="button" id="filter5"><i class="fa fa-filter"></i> Filter</button>
    			<?php } ?>
    	 		<div class="clearfix"></div>
    		</div>
            <div class="x_content" id="isi5">
                    
        	</div>
         </div>	
      </div>
    </div>
	<?php } ?>
</div>

		
		<!-- Datatables-->
		<style type="text/css">@import url("<?php echo base_url() . 'assets/js/datatables/jquery.dataTables.min.css'; ?>");</style>
		<style type="text/css">@import url("<?php echo base_url() . 'assets/js/datatables/buttons.bootstrap.min.css'; ?>");</style>
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
	$("#isi").load('ajaxJadwal/Z');
	$("#isi2").load('ajaxJadwalIndividu/Z');
 	$("#isi3").load('ajaxNonPelajaran/Z');
 	$("#isi4").load('ajaxKalenderAkademik');
 	$("#isi5").load('ajaxLPDS/Z');
    <?php if (($role==1)||($role==7)){?>	
	$("#filter").click(function(){
	    var fperiode=$("#fperiode").val();
	    var fjenjang=$("#fjenjang").val();
	    var ftingkat=$("#ftingkat").val();
	    var fkelas=$("#fkelas").val();
	    if (fperiode=='') fperiode='Z';
	    $("#isi").load('ajaxJadwal/'+fperiode+'/'+fjenjang+'/'+ftingkat+'/'+fkelas);
	})
	$("#filter2").click(function(){
	    var fperiode=$("#fperiode2").val();
	    var fjenjang=$("#fjenjang2").val();
	    var ftingkat=$("#ftingkat2").val();
	    var fkelas=$("#fkelas2").val();
	    if (fperiode=='') fperiode='Z';
	    $("#isi2").load('ajaxJadwalIndividu/'+fperiode+'/'+fjenjang+'/'+ftingkat+'/'+fkelas);
	})
	$("#filter3").click(function(){
	    var fperiode=$("#fperiode3").val();
	    var fjenjang=$("#fjenjang3").val();
	    var ftingkat=$("#ftingkat3").val();
	    var fkelas=$("#fkelas3").val();
	    if (fperiode=='') fperiode='Z';
	    $("#isi3").load('ajaxNonPelajaran/'+fperiode+'/'+fjenjang+'/'+ftingkat+'/'+fkelas);
	})
	$("#filter5").click(function(){
	    var fperiode=$("#fperiode5").val();
	    var fjenjang=$("#fjenjang5").val();
	    var ftingkat=$("#ftingkat5").val();
	    var fkelas=$("#fkelas5").val();
	    if (fperiode=='') fperiode='Z';
	    $("#isi2").load('ajaxLPDS/'+fperiode+'/'+fjenjang+'/'+ftingkat+'/'+fkelas);
	})
  <?php } ?>
 
  	$("#save").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/aktifitas/proses_jadwal_non",
				type:"post",
				data:$("#fModalNon").serialize(),
				beforeSend:function(){
					$("#ModalNon").modal('hide');
				},
				success:function(resp){
			        Lobibox.notify('success ', {
					msg: 'Data Berhasil Ditambahkan '+resp
					});
				 	$("#isi3").load('ajaxNonPelajaran/Z');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
	});
	
	$("#save2").click(function(){
	        var form = $("#fModalIndividu");
            var formData = new FormData(form[0]);
			$.ajax({
			url :"<?php echo site_url();?>/aktifitas/proses_individu",
			    data:formData,
				processData: false,
                contentType: false,
				type:"post",
				beforeSend:function(){
					$("#ModalIndividu").modal('hide');
				},
				success:function(resp){
			        Lobibox.notify('success ', {
					msg: 'Berhasil Upload File '+resp
					});
				 	$("#isi2").load('ajaxJadwalIndividu/Z');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Upload File'
					});
				}
			})
	});
	
	$("#save4").click(function(){
	        var form = $("#fModalKalender");
            var formData = new FormData(form[0]);
			$.ajax({
			url :"<?php echo site_url();?>/aktifitas/proses_kalender",
			    data:formData,
				processData: false,
                contentType: false,
				type:"post",
				beforeSend:function(){
					$("#ModalKalender").modal('hide');
				},
				success:function(resp){
			        Lobibox.notify('success ', {
					msg: 'Data Berhasil Ditambahkan '+resp
					});
				 	$("#isi4").load('ajaxKalenderAkademik/Z');
				},
				error:function(){
				    Lobibox.notify('error', {
					msg: 'Gagal Upload File '
					});
				}
			})
	});
	
	$("#save5").click(function(){
	        var form = $("#fModalLPDS");
            var formData = new FormData(form[0]);
			$.ajax({
			url :"<?php echo site_url();?>/aktifitas/proses_lpds",
			    data:formData,
				processData: false,
                contentType: false,
				type:"post",
				beforeSend:function(){
					$("#ModalLPDS").modal('hide');
				},
				success:function(resp){
			        Lobibox.notify('success ', {
					msg: 'Berhasil Upload File '+resp
					});
				 	$("#isi5").load('ajaxLPDS/Z');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Upload File'
					});
				}
			})
	});
});

function edit_non(id){
	$.getJSON('<?php echo site_url() ?>/aktifitas/edit_jadwal_non/'+id,
		function( response ) {
			$("#ModalNon").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id']);
			$("#periode").val(response['periode']);
			$("#jenjang").val(response['jenjang']);
			$("#tingkat").val(response['tingkat']);
			$("#kelas").val(response['kelas']);
			$("#hari").val(response['hari']);
			$("#deskripsi").val(response['deskripsi']);
			$("#dari").val(response['dari']);
			$("#sampai").val(response['sampai']);
		}
	);
}

function del_non(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/del_jadwal_non/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
					 	$("#isi3").load('ajaxNonPelajaran/Z');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Hapus data'
					});
					}
				})
			}
        }
    })
				
}


function del_kalender(periode,jenjang){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/del_kalender/"+periode+'/'+jenjang,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
					 	$("#isi4").load('ajaxKalenderAkademik/Z');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Hapus data'
					});
					}
				})
			}
        }
    })
				
}


function del_individu(periode,siswa){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/del_individu/"+periode+'/'+siswa,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
					 	$("#isi2").load('ajaxJadwalIndividu/Z');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Hapus data'
					});
					}
				})
			}
        }
    })
				
}

function del_lpds(periode,siswa){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/del_lpds/"+periode+'/'+siswa,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
					 	$("#isi5").load('ajaxLPDS/Z');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Hapus data'
					});
					}
				})
			}
        }
    })
				
}

function upload_individu(periode,siswa){
    $("#ModalIndividu").modal('show');
    $("#periode2").val(periode);
    $("#siswa").val(siswa);
}

function upload_lpds(periode,siswa){
    $("#ModalLPDS").modal('show');
    $("#periode3").val(periode);
    $("#siswa3").val(siswa);
}

function input_jadwal_non(){
    $("#ModalNon").modal('show');
}

function upload_kalender(periode,jenjang){
    $("#ModalKalender").modal('show');
    $("#periode3").val(periode);
    $("#jenjang2").val(jenjang);
}

</script>

<div class="modal fade bs-example-modal-lg" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel">Kriteria Penilaian</h4>
            </div>
			<div class="modal-body">
			    <div id="isi2"></div>    
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="Modal2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel">Jadwal Belajar</h4>
            </div>
			<div class="modal-body">
			    <div id="isi3"></div>    
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="ModalNon" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModalNon">
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Periode</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
						<select  class="form-control" id="periode" name="periode">
						    <?php foreach($periode->result() as $period){?>
            					<option value="<?php echo $period->id_raport_periode;?>"><?php echo $period->periode.' '.$period->tahun_akademik;?></option>
            				<?php }?>
						</select>    
                      </div>
                    </div>
                    <div class="form-group">
                     <label class="control-label col-sm-3 col-sm-3 col-xs-12">Jenjang</label>   
                     <div class="col-md-9 col-sm-9 col-xs-12">
						<select  class="form-control" id="jenjang" name="jenjang">
						    <option value="">- Pilih Jenjang -</option>  
						    <?php foreach($jenjang->result() as $jenjangp){?>
            					<option value="<?php echo $jenjangp->id_jenjang;?>"><?php echo $jenjangp->nama_jenjang?></option>
            				<?php }?>
						</select>    
                      </div>
                    </div>
                    <div class="form-group">
                     <label class="control-label col-sm-3 col-sm-3 col-xs-12">Tingkat</label>   
                     <div class="col-md-9 col-sm-9 col-xs-12">
						<select  class="form-control" id="tingkat" name="tingkat">
						  <option value="">- Pilih Tingkat -</option>  
						  <option value="1">Year 1</option>
    					  <option value="2">Year 2</option>
    					  <option value="3">Year 3</option>
						</select>    
                      </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-sm-3 col-sm-3 col-xs-12">Kelas</label>       
                    <div class="col-md-9 col-sm-9 col-xs-12">
						<select  class="form-control" id="kelas" name="kelas">
						   	<option value="">- Pilih Kelas -</option>  
						    <?php foreach($kelas->result() as $kls){?>
            					<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
            				<?php }?>
						</select>    
                      </div>
                    </div>
                   <div class="form-group">    
                    <label class="control-label col-sm-3 col-sm-3 col-xs-12">Hari</label>   
                    <div class="col-md-9 col-sm-9 col-xs-12">
						<select  class="form-control" id="hari" name="hari">
						    <option value="">- Pilih Hari -</option>  
						    <option value="1">Senin</option>
						    <option value="2">Selasa</option>
						    <option value="3">Rabu</option>
						    <option value="4">Kamis</option>
						    <option value="5">Jumat</option>
						    <option value="6">Sabtu</option>
						    <option value="7">Minggu</option>
						</select>    
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Deskripsi</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" />
                      </div>    
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Dari Jam</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="time" class="form-control" id="dari" name="dari" placeholder="Dari Jam" />
                      </div>    
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Sampai Jam</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="time" class="form-control" id="sampai" name="sampai" placeholder="Sampai Jam" />
                      </div>    
                    </div>
              
			</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save">Save</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="ModalIndividu" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;margin-top:200px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Upload Jadwal Individu</h4>
            </div>
			<div class="modal-body">
			    <form class="form-horizontal form-label-left" id="fModalIndividu">
			      <div class="form-group">   
			          <label class="control-label col-sm-3 col-sm-3 col-xs-12">File Pdf</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <input type="hidden" name="siswa" id="siswa" value="">  
                         <input type="hidden" name="periode" id="periode2" value="">  
    				     <input type="file" name="jadwal" id="jadwal" class="form-control" placeholder="" accept="application/pdf"/>
                      </div>
                  </div>      
                </form>  
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save2">Upload</button>
            </div>
		</div>
	</div>
</div>	

<div class="modal fade bs-example-modal-lg" id="ModalLPDS" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;margin-top:200px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Upload LPDS</h4>
            </div>
			<div class="modal-body">
			    <form class="form-horizontal form-label-left" id="fModalLPDS">
			      <div class="form-group">   
			          <label class="control-label col-sm-3 col-sm-3 col-xs-12">File Pdf</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <input type="hidden" name="siswa" id="siswa3" value="">  
                         <input type="hidden" name="periode" id="periode3" value="">  
    				     <input type="file" name="lpds" id="lpds" class="form-control" placeholder="" accept="application/pdf"/>
                      </div>
                  </div>      
                </form>  
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save5">Upload</button>
            </div>
		</div>
	</div>
</div>	

<div class="modal fade bs-example-modal-lg" id="ModalKalender" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;margin-top:200px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Upload Kalender</h4>
            </div>
			<div class="modal-body">
			    <form class="form-horizontal form-label-left" id="fModalKalender" enctype="multipart/form-data">
			      <div class="form-group">   
			          <label class="control-label col-sm-3 col-sm-3 col-xs-12">File Pdf</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <input type="hidden" name="periode" id="periode3" value="">  
                         <input type="hidden" name="jenjang" id="jenjang2" value="">  
                         <input type="file" name="kalender" id="kalender" class="form-control" placeholder="" accept="application/pdf"/>
                      </div>
                  </div> 
                </form>  
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save5">Upload</button>
            </div>
		</div>
	</div>
</div>	