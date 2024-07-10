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
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
	$("#isi").load('ajaxDaftar_koreksi_final/<?php echo $kelas?>/<?php echo $periode?>');
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_simpan_catatan_final",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(resp){
				    alert(resp);
					Lobibox.notify('success', {
					msg: 'Data Berhasil disimpan'
					});
					$("#isi").load('ajaxDaftar_koreksi_final');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		}
		
	});
	
});

function edit_catatan(id,per){
    $("#id").val(id);
    $("#periode").val(periode);
	$.getJSON('<?php echo site_url() ?>/raport_mpp/edit_catatan_final/'+id+'/'+per,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			if (response!=null)
			   $("#catatan").val(response['catatan']);
			$("#id").val(id);
			$("#periode").val(per);
		}
	);
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Catatan Final</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
						<input type="hidden" class="form-control" id="periode" name="periode" value="kosong" />
                        <textarea type="text" class="form-control" id="catatan" name="catatan" rows="3"/></textarea>
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