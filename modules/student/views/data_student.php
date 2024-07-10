<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
		<style type="text/css">@import url("<?php echo base_url() . 'assets/js/datatables/buttons.bootstrap.min.css'; ?>");</style>
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxStudent');
	$(".add").click(function(){
		$("#isi").load('faddStudent');
		$(".cancel").css('display','block');
		$(".add").css('display','none');
	});
	$(".cancel").click(function(){
		$("#isi").load('ajaxStudent');
		$(".cancel").css('display','none');
		$(".add").css('display','block');
	});
	
	
	
});

function edit(id){
	$.ajax({
			url :"<?php echo site_url();?>/student/feditStudent",
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
					url :"<?php echo site_url()?>/student/delStudent/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxStudent');
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
					url :"<?php echo site_url()?>/student/actuser/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Perubahan Data berhasil'
					});
						$("#isi").load('ajaxStudent');
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
		url :"<?php echo site_url()?>/student/resetpas/"+id,
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