<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	   <div class="x_title">
			<div class="clearfix"></div>
        </div>
        <?php foreach($proyek as $pro); 
            foreach($murid as $mrd);
            ;?>
        <table class="table cellspan:2px">
            <tr><td>Nomer Induk</td><td><?php echo $mrd->id_number;?></td>
            <td align="right"><i class="glyphicon glyphicon-calendar"></i> <?php echo $pro->tgl_awal.' s/d '.$pro->tgl_akhir;?></td></tr>
            <tr><td>Nama Siswa</td><td colspan="2"><?php echo $mrd->full_name;?></td></tr>
            <tr><td>Guru Fasilitator</td><td colspan="2"><?php foreach($fasilitator as $fas){ echo $fas->full_name;}?></td></tr>
            <tr><td>Kelas </td><td colspan="2"><?php  foreach($kelas as $kel) echo $kel->nama_kelas;?></td></tr>
            <tr><td>Proyek ke </td><td colspan="2"><?php echo $pro->ke;?></td></tr>
        </table>
        <form class="form-horizontal form-label-left" id="fCatat">
        <input type="hidden" name="id_proyek" id="id_proyek" value="<?php echo $pro->id_proyek;?>">     
        <h4>
          <table class="table table-bordered">
              <tr><td width="150px" style="background:#ffe4e4">Nama Proyek</td><td><input class="form-control" name="nama" id="nama" type="text" value="<?php echo $pro->nama?>"></td></tr>
              <tr><td style="background:#ffe4e4">Penjelasan Proyek</td><td><textarea class="form-control" name="penjelasan" id="penjelasan"><?php echo $pro->penjelasan?></textarea> </td></tr>
          </table>
        </h4>  
        <div class="x_content" id="isi">

		</div>
		<h2><button <?php echo $otoC;?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Tambah Kriteria</button></h2>
		  <table class="table table-bordered">
              <tr><td width="150px">Durasi Proyek<br>Muncul Di Output <select name="dur_dioutput" id="dur_dioutput"><option value='T' <?php if ($pro->dur_dioutput=='T') echo 'selected'?>>Tidak</option>
                       <option value='Y' <?php if ($pro->dur_dioutput=='Y') echo 'selected'?>>Ya</option></select></td><td><input class="form-control" name="durasi" id="durasi" type="text" value="<?php echo $pro->durasi ?>"></tr>
              <tr><td>Catatan Siswa<br><br>Muncul Di Output <select name="csis_dioutput" id="csis_dioutput"><option value='T' <?php if ($pro->csis_dioutput=='T') echo 'selected'?>>Tidak</option>
                             <option value='Y' <?php if ($pro->csis_dioutput=='Y') echo 'selected'?>>Ya</option></select></td><td><input class="form-control" name="catatan_siswa" id="catatan_siswa" type="text" value="<?php echo $pro->catatan_siswa ?>"></td></tr>
              <tr><td>Catatan Spesialis<br>Muncul Di Output <select name="csp_dioutput" id="csp_dioutput"><option value='T' <?php if ($pro->csp_dioutput=='T') echo 'selected'?>>Tidak</option>
                             <option value='Y' <?php if ($pro->csp_dioutput=='Y') echo 'selected'?>>Ya</option></select></td><td><input class="form-control" name="catatan_spesial" id="catatan_spesial" type="text" value="<?php echo $pro->catatan_spesial?>"></td></tr>
             <!-- <tr><td>Catatan Khusus<br>Muncul Di Output <select name="ckh_dioutput" id="ckh_dioutput"><option value='T' <?php if ($pro->ckh_dioutput=='T') echo 'selected'?>>Tidak</option>
                             <option value='Y' <?php if ($pro->ckh_dioutput=='Y') echo 'selected'?>>Ya</option></select></td><td><input class="form-control" name="catatan_khusus" id="catatan_khusus" type="text" value="<?php echo $pro->catatan_spesial?>"></td></tr>-->
              <tr><td>Target Capaian Siswa<br>Muncul Di Output <select name="ccp_dioutput" id="ccp_dioutput"><option value='T' <?php if ($pro->ccp_dioutput=='T') echo 'selected'?>>Tidak</option>
                             <option value='Y' <?php if ($pro->ccp_dioutput=='Y') echo 'selected'?>>Ya</option></select></td><td><input class="form-control" name="catatan_target" id="catatan_target" type="text" value="<?php echo $pro->catatan_target?>"></td></tr>
         
          </table>
          <h2><button  class="btn btn-default" type="button" onclick="window.history.back();">Close</button>
            <button  class="btn btn-primary" type="button" id="save2">Save</button>
            <button  class="btn btn-success" type="button" id="submit"><i class="glyphicon glyphicon-ok"> Submit</i></button></h2>
      	</div>	
      	</form>
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
    $("#isi").load('ajaxPengisian_nilai/<?php echo $id_proyek?>');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
        $("#siklus").val('0');
		$("#ke").val('');
		$("#kriteria").val('');
		$("#tampil").val('');
		$("#nilai").val('Y');
		$("#konversi").val('');
	});
	
	$("#save").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_proyek/simpan_pengisian_nilai",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Disimpan'
					});
					$("#isi").load('ajaxPengisian_nilai/<?php echo $id_proyek?>');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	
	$("#save2").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_proyek/simpan_catatan",
				type:"post",
				data:$("#fCatat").serialize(),
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Disimpan'
					});
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	<?php if ($final=='1'){ ?>
	$("#submit").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_proyek/submit_penilaian_final",
				type:"post",
				data:$("#fCatat").serialize(),
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Disimpan'
					});
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	<?php } else { ?>
		$("#submit").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_proyek/submit_penilaian",
				type:"post",
				data:$("#fCatat").serialize(),
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Disimpan'
					});
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		
	});
	<?php } ?>
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/raport_proyek/edit_proyek_detail/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_detail']);
			$("#siklus").val(response['siklus']);
			$("#ke").val(response['ke']);
			$("#kriteria").val(response['kriteria']);
			$("#tampil").val(response['tampil']);
			$("#nilai").val(response['nilai']);
			$("#konversi").val(response['konversi']);
		}
	);
}
function del(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/raport_proyek/delete_proyek_detail/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						 $("#isi").load('ajaxPengisian_nilai/<?php echo $id_proyek?>');
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

</script>

<div class="modal fade bs-example-modal-lg" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal">
				<div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Siklus</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" id="id" name="id" value="kosong" />
					<input type="hidden" id="id_proyek" name="id_proyek" value="<?php echo $id_proyek?>" />
                    <select class="form-control" id="siklus" name="siklus">
                    	<option value="0">Pilih Siklus</option>
                         <?php foreach($siklus->result() as $sk){?>
							<option value="<?php echo $sk->id_siklus;?>"><?php echo $sk->nama_siklus;?></option>
						<?php }?>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">P-Ke</label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
				    <input type="text" class="form-control" id="ke" name="ke" placeholder="P-Ke" maxlength="5"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Kriteria</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <textarea class="form-control" id="kriteria" name="kriteria" rows="3"></textarea>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Tampil di Output</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <select class="form-control" id="tampil" name="tampil">
				        <option value="Y">Ya</option>
				        <option value="T">Tidak</option>
				    </select>
                  </div>
                </div>  
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Hasil</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <select class="form-control" id="nilai" name="nilai">
				        <option value="Y">Ya</option>
				        <option value="T">Tidak</option>
				    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Konversi</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <input type="number" class="form-control" id="konversi" name="konversi">
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
</script>