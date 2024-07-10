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
		  <style>
        .lbl-circle-grey {
            width: 30px;
            height: 30px;
            padding: 8px 8px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
            color:white;
            background:#B7B7B7;
        }
        .lbl-circle-green {
            width: 30px;
            height: 30px;
            padding: 8px 8px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
            color:white;
            background:#32C670;
        }
        </style>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/moment/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
       
        
$(document).ready(function() {
	$("#isi").load('ajaxDaftar_proyek');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/raport_proyek/proses_simpan",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxDaftar_proyek');
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
	
	$("#save2").click(function(){
		var tgl_awal = $("#tgl_awal").val();
		if(tgl_awal != ""){
			$.ajax({
			url :"<?php echo site_url();?>/raport_proyek/proses_simpan_tgl",
				type:"post",
				data:$("#fModal2").serialize(),
				beforeSend:function(){
					$("#Modal2").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Tanggal Berhasil Disimpan'
					});
					$("#isi").load('ajaxDaftar_proyek');
					$("#id_prj").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Perubahan Tanggal'
					});
				}
			})
		}
		
	});
	
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/raport_proyek/edit_proyek/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_proyek']);
			$("#nama").val(response['nama']);
			$("#penjelasan").val(response['penjelasan']);
			$("#ke").val(response['ke']);
		}
	);
}


function edit_tgl(id){
  	$.getJSON('<?php echo site_url() ?>/raport_proyek/edit_tgl_proyek/'+id,
		function( response ) {
			$("#Modal2").modal('show');
			$(".modal-title").html('Edit Tanggal');
			$("#id_prj").val(response['id_proyek']);
			$("#tgl_awal").val(response['tgl_awal']);
			$("#tgl_akhir").val(response['tgl_akhir']);
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
					url :"<?php echo site_url()?>/raport_proyek/delete_proyek/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxDaftar_proyek');
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
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Proyek Ke</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
                    <input name="ke" id="ke" value="">
                  </div>
                </div>
				<div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Nama Proyek</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <input name="nama" id="nama" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Penjelasan</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <textarea type="text" class="form-control" id="penjelasan" name="penjelasan" rows="3"/></textarea>
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

<div class="modal fade bs-example-modal-lg" id="Modal2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal2">
			    <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Dari Tanggal</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden"  id="id_prj" name="id_prj" value="" />
                    <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Sampai Tanggal</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
			         <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="">
                  </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save2">Save</button>
            </div>
		</div>
	</div>
</div>