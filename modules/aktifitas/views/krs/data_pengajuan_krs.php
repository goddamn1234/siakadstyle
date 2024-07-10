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
	$("#isi").load('ajaxPengajuan_krs/<?php echo $mapel?>/<?php echo $periode?>');
	
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
					$("#isi").load('ajaxJalur_pedidikan');
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


function terima(id){
 	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin Menerima ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/terima_krs/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Telah diterima'
					});
						$("#isi").load('ajaxPengajuan_krs/<?php echo $mapel?>/<?php echo $periode?>');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Menerima'
					});
					}
				})
			}
    }
     })
				
}

function tolak(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin Menolak ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/tolak_krs/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Telah ditolak'
					});
						$("#isi").load('ajaxPengajuan_krs/<?php echo $mapel?>/<?php echo $periode?>');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Menolak'
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