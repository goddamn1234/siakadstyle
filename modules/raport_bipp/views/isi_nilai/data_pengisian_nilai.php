<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<script>
    function ubah_porsi_konversi(){
        var porsi_konversi=$("#porsi_konversi").val();
        $("#porsi_partisipasi").val(100-parseFloat(porsi_konversi));
        hit_konversi();
    }
    function ubah_porsi_partisipasi(){
        var porsi_partisipasi=$("#porsi_partisipasi").val();
        $("#porsi_konversi").val(100-parseFloat(porsi_partisipasi));
        hit_konversi();
    }
    function hit_konversi(){
        var porsi_konversi=$("#porsi_konversi").val();
        var porsi_partisipasi=$("#porsi_partisipasi").val();
        var konversi=$("#konversi2").val();
        var partispasi=$("#partisipasi").val();
        if ((!($('#manual').is(':checked')))&&((porsi_konversi==0)||(porsi_partisipasi==0))) $("#hasil_konversi").val(konversi); else 
        {
            var hasil=parseFloat(konversi)*parseFloat(porsi_konversi)/100+parseFloat(partispasi)* parseFloat(porsi_partisipasi)/100;
            $("#hasil_konversi").val(hasil);
        }
    }
    
    function cek_disable(){
        if ($('#manual').is(':checked')) $('#hasil_konversi').attr('readonly', false); else $('#hasil_konversi').attr('readonly', true); 
    }
</script>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2></h2>
			<div class="clearfix"></div>
        </div>
      <?php  
            foreach($murid as $mrd);
            ?>
        <div class='text-right'>    
        <?php 
        $st_edit="";
        $bisa_edit='1';
        foreach($nilai as $nil) {
           if (($nil->sdh_submit==1)&&($koreksi=="0")) $st_edit="visibility: hidden;"; else $st_edit="";
           if (($nil->sdh_submit==1)&&($koreksi=="0")) $bisa_edit='0'; else $bisa_edit='1';
           if ($nil->sdh_submit==1) echo "<span class='text-right'><label class='label label-default' style='font-size:14px'> Submit </label></span> &nbsp;&nbsp;";         
           if ($nil->sdh_dikoreksi==1) echo "<span class='text-right'><label class='label label-warning' style='font-size:14px'> Dikoreksi </label></span> &nbsp;&nbsp;"; 
           if ($nil->sdh_final==1) echo "<span class='text-right'><label class='label label-success' style='font-size:14px'> Final </label></span> &nbsp;&nbsp;"; ?> 
        <?php } ?>
        </div>
        <table class="table">
            <tr><td width="220">Nomer Induk</td><td><?php echo $mrd->id_number;?></td></tr>
            <tr><td>Nama Siswa</td><td><?php echo $mrd->full_name;?></td></tr>
            <tr><td>Guru Fasilitator</td><td><?php foreach($fasilitator as $fas) echo $fas->full_name;?></td></tr>
            <tr><td>Nama Mata Pelajaran</td><td><?php foreach($pelajaran as $pel) echo $pel->nama_mapel;?></td></tr>
            <tr><td>Kelas </td><td><?php foreach($kelas as $kls) echo $kls->nama_kelas.' - '.$kls->nama_jenjang;?></td></tr>
        </table>
        <div class="alert alert-info">
          <strong>Syarat Kelulusan : </strong> <?php echo $pel->syarat;?>
          <input type="hidden" id="point" name="point" value="<?php echo $pel->point;?>" />
        </div>
        <div class="alert alert-info">
          <strong>KKM : </strong> <?php echo $pel->kkm;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>KKM Minimal: </strong> <?php echo $pel->kkm_terkecil;?>
          <input type="hidden" id="kkm" name="kkm" value="<?php echo $pel->kkm;?>" />
          <input type="hidden" id="kkm_min" name="kkm_min" value="<?php echo $pel->kkm_terkecil;?>" />
        </div>
        <div class="x_content" id="isi">

		</div>
		<div>
             <form class="form-horizontal form-label-left" id="fCatat" name="fCatat">
                <input type="hidden" class="form-control" id="periode2" name="periode2" value="<?php echo $periode;?>" />
			    <input type="hidden" class="form-control" id="murid2" name="murid2" value="<?php echo $mrd->id_number;?>" />
			   <input type="hidden" class="form-control" id="pelajaran2" name="pelajaran2" value="<?php echo $pel->id_mapel;?>" />
                <table class="table table-bordered">
                 <tr><td width="150px">Hasil</td>
                    <td><input class="form-control" id="hasil" value="<?php foreach($nilai as $nil) if ($nil->nilai=="Y") echo 'Tercapai'; else if ($nil->nilai=="T") echo 'Belum Tercapai'?>" disabled></td> 
                    <td width="150px">Konversi</td>
                    <td><input type="text" name="konversi2" id="konversi2" class="form-control" value="<?php foreach($nilai as $nil) echo $nil->konversi ?>" readonly></td>
                    <td width="150px">Nilai Partisipasi</td>
                    <td><input type="number" name="partisipasi" id="partisipasi" class="form-control" value="<?php foreach($nilai as $nil) echo $nil->nilai_partisipasi ?>" onblur="hit_konversi();"></td>
                 </tr>
                 <tr>
                    <td width="150px">Hasil Konversi<br><input type="checkbox" id="manual" name="manual" value="Y" <?php foreach($nilai as $nil) if ($nil->manual=='Y') echo 'checked'; ?> onclick="cek_disable();"> Manual</td> 
                    <td><input class="form-control" id="hasil_konversi"  name="hasil_konversi"  value="<?php foreach($nilai as $nil) echo $nil->hasil_konversi ?>" <?php foreach($nilai as $nil) if ($nil->manual!='Y') echo 'readonly'?>></td> 
                    <td width="150px">Porsi Nilai Konversi (%)</td>
                    <td><input type="number" name="porsi_konversi" id="porsi_konversi" class="form-control" value="<?php foreach($nilai as $nil) echo $nil->porsi_konversi ?>" onblur="ubah_porsi_konversi();"></td> 
                    <td width="150px">Porsi Nilai Partisipasi (%)</td>
                    <td><input type="number" name="porsi_partisipasi" id="porsi_partisipasi" class="form-control" value="<?php foreach($nilai as $nil) echo $nil->porsi_partisipasi ?>" onblur="ubah_porsi_partisipasi();"></td> 
                 </tr>
                 <tr><td width="150px">Catatan Pelajaran</td><td colspan="5"><textarea class="form-control" name="catatan" id="catatan" rows="2"><?php foreach($nilai as $nil) echo $nil->catatan ?></textarea></tr>
                 <tr>
                     <td>Evaluasi Siswa<br>Muncul Di Output <select name="dioutput" id="dioutput"><option value='T' <?php foreach($nilai as $nil) if ($nil->dioutput=='T') echo 'selected'?>>Tidak</option>
                             <option value='Y' <?php foreach($nilai as $nil) if ($nil->dioutput=='Y') echo 'selected'?>>Ya</option></select></td>
                     <td colspan="5"><textarea class="form-control" name="evaluasi" id="evaluasi" rows="2"><?php foreach($nilai as $nil) echo $nil->evaluasi ?></textarea></td>
                 </tr>
               </table>
               
            </form>		
        	<button type="button" class="btn btn-default" id="close" onclick="window.history.back();">Close</button>
        	<?php if ($periode==$periode_aktif){ ?>
            <button type="button" class="btn btn-primary" id="save2" style="<?php echo $st_edit?>">Save</button>  
            <button type="button" class="btn btn-success" id="submit" style="<?php echo $st_edit?>"><i class="glyphicon glyphicon-ok"></i> Submit</button> 
            <?php } ?>
      </div>
      </div>
</div>

		
		<!-- Datatables-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
    $("#isi").load('ajaxPengisian_nilai/<?php echo $mrd->id_number?>/<?php echo $pel->id_mapel?>/<?php echo $periode?>/<?php echo $bisa_edit?>');
 
	$("#save").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_simpan_nilai",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(respon){
			        Lobibox.notify('success', {
					msg: 'Data Berhasil Disimpan '
					});
					$("#isi").load('ajaxPengisian_nilai/<?php echo $mrd->id_number?>/<?php echo $pel->id_mapel?>');
					var a = new Array();
				    a=respon.split(";");
					$("#hasil").val(a[0]);
				    var kkm=$("#kkm").val();
				    var kkm_min=$("#kkm_min").val();
					var point=$("#point").val();
					if (a[0]=='Tercapai'){
					   if (a[3]==0){ 
					      if (parseFloat(a[2])-point==0) var konv=90;    
					      else var konv=((90-parseFloat(kkm))/(parseFloat(a[2])-point))*(parseFloat(a[1])-parseFloat(point))+parseFloat(kkm);
					   } else {
					       if (parseFloat(a[2])-parseFloat(a[3])==0) var konv=90;    
					       else var konv=((90-parseFloat(kkm))/(parseFloat(a[2])-parseFloat(a[3])))*(parseFloat(a[1])-parseFloat(a[3]))+parseFloat(kkm);  
					   }    
					} else {
					   if (a[3]==0) 
					       var konv=(parseFloat(a[1])/parseFloat(point))*(parseFloat(kkm)-parseFloat(kkm_min))+parseFloat(kkm_min); 
					   else var konv=(parseFloat(a[1])/parseFloat(a[3]))*(parseFloat(kkm)-parseFloat(kkm_min))+parseFloat(kkm_min);    
					}   
					$("#konversi2").val(konv);
					
				},
				error:function(respon){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data '+respon
					});
				}
			})
		
	});
	
	$("#save2").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_simpan_catatan",
				type:"post",
				data:$("#fCatat").serialize(),
				success:function(respon){
				    Lobibox.notify('success', {
					msg: 'Data Berhasil Disimpan '
					});
				},
				error:function(respon){ 
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	
	<?php if ($koreksi=="0"){ ?>
	$("#submit").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_submit",
				type:"post",
				data:$("#fCatat").serialize(),
				success:function(respon){
				    Lobibox.notify('success', {
					msg: 'Data Berhasil Disubmit '
					});
				},
				error:function(respon){ 
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	<?php } ?>
	
	<?php if ($koreksi=="1"){ ?>
	$("#submit").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_submit2",
				type:"post",
				data:$("#fCatat").serialize(),
				success:function(respon){
				    Lobibox.notify('success', {
					msg: 'Data Berhasil Disubmit '
					});
				},
				error:function(respon){ 
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	<?php } ?>
	
	<?php if ($koreksi=="2"){ ?>
	$("#submit").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_submit3",
				type:"post",
				data:$("#fCatat").serialize(),
				success:function(respon){
				    Lobibox.notify('success', {
					msg: 'Data Berhasil Disubmit '
					});
				},
				error:function(respon){ 
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	<?php } ?>
		
});

function edit(id){
$("#id").val(id);
$("#Modal").modal('show');
	$(".modal-title").html('Edit Data');
}
</script>

<div class="modal fade bs-example-modal-lg" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal">
				<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Tercapai</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="" />
						<input type="hidden" class="form-control" id="periode" name="periode" value="<?php echo $periode;?>" />
						<input type="hidden" class="form-control" id="murid" name="murid" value="<?php echo $mrd->id_number;?>" />
                        <select class="form-control"id="nilai" name="nilai">
                           <option value=''>--</option>
                           <option value='Y'>Ya</option>
                           <option value='T'>Tidak</option>
                        </select>
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