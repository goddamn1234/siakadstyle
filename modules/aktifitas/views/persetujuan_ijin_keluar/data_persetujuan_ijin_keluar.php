<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
        <div class="x_content" id="isi">

		</div>
	</div>
</div>

		
		<!-- Datatables-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/moment/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
	$("#isi").load('ajaxPersetujuan_ijin_keluar');

});

function setuju(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda setuju ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/setuju/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Permohonan Berhasil Disetujui'
					});
						$("#isi").load('ajaxPersetujuan_ijin_keluar');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Permohonan gagal disetujui'
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
		 msg: "Anda Menolak ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/aktifitas/tolak/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Permohonan Berhasil Ditolak'
					});
						$("#isi").load('ajaxPersetujuan_ijin_keluar');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Permohonan gagal ditolak'
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Tanggal</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
						<input type="date"  class="form-control" id="tgl" name="tgl" placeholder="tgl" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Jam</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="time" class="form-control" id="jam" name="jam" placeholder="jam" />
                      </div>    
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Keperluan</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="keperluan" />
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