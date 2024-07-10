<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC;?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Add Data</button></h2>
			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">

		</div>
	</div>
</div>

		
		<!-- Datatables-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxKelas');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		var tingkat = $("#tingkat").val();
		if(nama != "" && tingkat !=0){
			$.ajax({
			url :"<?php echo site_url();?>/master/proses_kelas",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxKelas');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		}
		
	});
	
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/master/editKelas/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_kelas']);
			$("#nama").val(response['nama_kelas']);
			$("#tingkat").val(response['tingkat']);
			$("#jenis").val(response['jenis']);
			$("#jalur").val(response['jalur']);
			$("#jenjang").val(response['jenjang']);
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
					url :"<?php echo site_url()?>/master/delKelas/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxKelas');
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
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Jalur Pendidikan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <select name="jalur" id="jalur" class="form-control" placeholder="Jalur Pendidikan">
							<?php foreach($jalur->result() as $jl){?>
							    <option value="0"> - Pilih Jalur -- </option>
								<option value="<?php echo $jl->id_jalur;?>"><?php echo $jl->nama_jalur;?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Jenis Pendidikan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <select name="jenis" id="jenis" class="form-control" placeholder="Jenis Pendidikan">
							<?php foreach($jenis->result() as $jn){?>
							    <option value="0"> - Pilih Jenis -- </option>
								<option value="<?php echo $jn->id_jenis;?>"><?php echo $jn->nama_jenis;?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Jejang Pendidikan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <select name="jenjang" id="jenjang" class="form-control" placeholder="Jenjang Pendidikan">
                             <option value="0"> - Pilih Jenjang -- </option>
							<?php foreach($jenjang->result() as $jj){?>
								<option value="<?php echo $jj->id_jenjang;?>"><?php echo $jj->nama_jenjang;?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Tingkat</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
					  <select name="tingkat" id="tingkat" class="form-control" >
					  <option value="0"> - Pilih Tingkat -- </option>
					  <option value="1"> 1 </option>
					  <option value="2"> 2 </option>
					  <option value="3"> 3 </option>
					  <option value="4"> 4 </option>
					  <option value="5"> 5 </option>
 				      <option value="6"> 6 </option>
					  </select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Nama Kelas</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kelas" />
                      </div>
                    </div>
			</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save">Simpan</button>
            </div>
		</div>
	</div>
</div>