<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC; ?> class="btn btn-primary publish" type="button"><i class="fa fa-cloud-upload"></i> Publish All</button>
			<button <?php echo $otoC; ?> class="btn btn-danger unpublish" type="button"><i class="fa fa-history"></i> Retract All</button></h2>
			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">

		</div>
	</div>
</div>

		<!-- input mask -->
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/input_mask/jquery.inputmask.js"></script>
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
	$("#isi").load('ajaxPublished2');
	
	$(".publish").click(function(){
		var tag = 'Y';
		$.ajax({
			url :"<?php echo site_url();?>raport/publish_all2",
			type:"post",
			dataType:"JSON",
			data:"publish="+tag,
			success:function (respon){
			if(respon.status == 'success'){
				Lobibox.notify('success', {
				msg: respon.message
				});
				$("#isi").load('ajaxPublished2');
			}else{
				Lobibox.notify('error', {
				msg: respon.message
				});
				}
			},
			error:function(respon){
			Lobibox.notify('error', {
				msg: "please try again later"
				});
			}
		})
	});
	
	$(".unpublish").click(function(){
		var tag = 'T';
		$.ajax({
			url :"<?php echo site_url();?>raport/publish_all2",
			type:"post",
			dataType:"JSON",
			data:"publish="+tag,
			success:function (respon){
			if(respon.status == 'success'){
				Lobibox.notify('success', {
				msg: respon.message
				});
				$("#isi").load('ajaxPublished2');
			}else{
				Lobibox.notify('error', {
				msg: respon.message
				});
				}
			},
			error:function(respon){
			Lobibox.notify('error', {
				msg: "please try again later"
				});
			}
		})
	});
});

function published(jenis, id, periode, flaging){
	$.ajax({
		url :"<?php echo site_url();?>raport/toggle_published2",
		type:"post",
		dataType:"JSON",
		data:"jenis="+jenis+"&id="+id+"&periode="+periode+"&flaging="+flaging,
		success:function (respon){
			if(respon.status == 'success'){
				Lobibox.notify('success', {
				msg: respon.message
				});
				$("#isi").load('ajaxPublished2');
			}else{
				Lobibox.notify('error', {
				msg: respon.message
						});
					}
		},
		error:function(respon){
			Lobibox.notify('error', {
						msg: "please try again later "+respon.message
						});
		}
	})
}
</script>
