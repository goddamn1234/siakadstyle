<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
        </div>
        <div class="x_content" id="isi">

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
	$("#isi").load('ajaxDaftar_krs/<?php echo $tipe?>/<?php echo $periode?>');
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/aktifitas/proses_masukan",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxDaftar_krs');
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
	$.getJSON('<?php echo site_url() ?>/aktifitas/edit_masukan/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_jalur']);
			$("#nama").val(response['nama_jalur']);
		}
	);
}

function kriteria(id){
    $("#isi3").load('ajaxLihat_kriteria/'+id+'/<?php echo $periode?>');
    $("#Modal2").modal('show');
}

function jadwal(id){
    $("#isi4").load('ajaxLihat_jadwal/'+id+'/<?php echo $periode?>');
    $("#Modal3").modal('show');
}


function del(id){
     Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin membatalkan pendaftaran ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/batal_daftar/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dibatalkan'
					});
						$("#isi").load('ajaxDaftar_krs/<?php echo $tipe?>/<?php echo $periode?>');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Membatalkan pendaftaran'
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Masukkan</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
                        <textarea type="text" class="form-control" id="masukkan" name="masukkan" rows="3"/></textarea>
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
	<div class="modal-dialog modal-lg" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel">Kriteria Penilaian</h4>
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

<div class="modal fade bs-example-modal-lg" id="Modal3" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel">Jadwal Belajar</h4>
            </div>
			<div class="modal-body">
			    <div id="isi4"></div>    
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>