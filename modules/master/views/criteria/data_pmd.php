<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
        <div class="x_content" id="isi">

		</div>
	</div>
</div>

<!-- Auto numeric -->
<script type='text/javascript' src="<?php echo base_url(); ?>addon/autonumeric/autoNumeric.js"></script>
		
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
	$("#isi").load('ajaxPmd');
	$("#save").click(function(){
		var mapel = $("#mapel").val();
		var category = $("#category").val();
		var criteria = $("#criteria").val();
		var point = $("#point").val();
		if(mapel != "0" || category != '0' || criteria != '' || point != ''){
			$.ajax({
			url :"<?php echo site_url();?>/master/proses_criteria",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxCriteria');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		}else{
			Lobibox.alert('error', {
				msg: 'Periksa kembali inputan anda'
			});
		}
		
	});
	
	
});

function setpmd(id){
	$.ajax({
		url :"<?php echo site_url();?>/master/setPmd/"+id,
		type:"post",
		success:function(respon){
			$("#isi").html(respon);
		},
		error:function(){
			Lobibox.notify('error', {
			msg: 'Gagal Melakukan setting data PMD'
			});
		}
	})
}

</script>