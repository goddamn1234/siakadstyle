<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC;?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Add Data</button>
			<button class="btn btn-primary cancel" type="button" style="display:none;"><i class="fa fa-minus-square"></i> Cancel</button></h2>
			<div class="clearfix"></div>
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
	$("#isi").load('ajaxTeachers');
	$(".add").click(function(){
		$("#isi").load('faddTeacher');
		$(".cancel").css('display','block');
		$(".add").css('display','none');
	});
	$(".cancel").click(function(){
		$("#isi").load('ajaxTeachers');
		$(".cancel").css('display','none');
		$(".add").css('display','block');
	});
	
	
	
});

function edit(id){
	$.ajax({
			url :"<?php echo site_url();?>/teacher/feditTeacher",
			type:"post",
			data:"id="+id,
			success:function(response){
				$("#isi").html(response);
				$(".cancel").css('display','block');
				$(".add").css('display','none');
			}
		})
}
function del(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/teacher/delTeacher/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxTeachers');
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
function act(id){
			$.ajax({
					url :"<?php echo site_url()?>/teacher/actuser/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Perubahan Data berhasil'
					});
						$("#isi").load('ajaxTeachers');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Perubahans data'
					});
					}
				})	
}
function reset(id){
	$.ajax({
		url :"<?php echo site_url()?>/teacher/resetpas/"+id,
		type:"post",
		success:function(){
			Lobibox.notify('success', {
			msg: 'Reset Password Berhasil'
			});
		},
		error:function(){
			Lobibox.notify('error', {
			msg: 'Gagal Melakukan Reset Password'
			});
		}
		})	
}

</script>