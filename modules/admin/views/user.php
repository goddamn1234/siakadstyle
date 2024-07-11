<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC; ?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Add Data</button> 
			<button class="btn btn-primary cancel" type="button" style="display:none;"><i class="fa fa-minus-square"></i> Cancel</button></h2>
			<?php echo validation_errors(); ?>
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
		<!-- datepicker -->
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>

        <!-- pace -->
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxUser');
	$(".add").click(function(){
		$("#isi").load('fadduser');
		$(".cancel").css('display','block');
		$(".add").css('display','none');
	});
	$(".cancel").click(function(){
		$("#isi").load('ajaxUser');
		$(".cancel").css('display','none');
		$(".add").css('display','block');
	});
			  
			  
	$('#datatable').dataTable();
});

function edit(id){
	$.ajax({
			url :"<?php echo site_url();?>/admin/fedituser",
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
					url :"<?php echo site_url()?>/admin/deluser/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxUser');
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
					url :"<?php echo site_url()?>/admin/actuser/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Perubahan Data berhasil'
					});
						$("#isi").load('ajaxUser');
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
		url :"<?php echo site_url()?>/admin/resetpas/"+id,
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

<style>
.switch-field {
  font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
  padding: 0px;
	overflow: hidden;
}

.switch-field input {
  display: none;
}

.switch-field label {
  float: left;
  margin-right:5px;
}

.switch-field label {
  display: inline-block;
  width: 120px;
  color: rgba(0, 0, 0, 0.6);
  font-size: 14px;
  font-weight: normal;
  text-align: center;
  text-shadow: none;
  padding: 6px 14px;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  -webkit-transition: all 0.1s ease-in-out;
  -moz-transition:    all 0.1s ease-in-out;
  -ms-transition:     all 0.1s ease-in-out;
  -o-transition:      all 0.1s ease-in-out;
  transition:         all 0.1s ease-in-out;
}

.switch-field label:hover {
	cursor: pointer;
}

.switch-field input:checked + label {
  background-color: #A5DC86;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.switch-field label:first-of-type {
  border-radius: 4px 0 0 4px;
}

.switch-field label:last-of-type {
  border-radius: 0 4px 4px 0;
}
</style>
