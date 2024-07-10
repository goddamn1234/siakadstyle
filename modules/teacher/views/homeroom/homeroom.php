<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
		<?php foreach($class->result() as $row){ ?>
			<button class="btn btn-round btn-primary" type="button" onClick="raport_list('<?php echo $row->id_kelas;?>')" ><?php echo $row->nama_kelas;?></button>
		<?php }?>
			
			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">

		</div>
	</div>
</div>

		
		<!-- Datatables-->
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
		
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	
});

function raport_list(id){
	$.ajax({
		url :"<?php echo site_url();?>/teacher/raport_list/"+id,
		type:"get",
		success:function(respon){
			$("#isi").html("<div class='bulat'><div id='dalbulat'><span>W</span><span>A</span><span>I</span><span>T</span><span>I</span><span>N</span><span>G</span><span>.</span><span>.</span></div><div class='luarbulat'></div></div>");
			$("#isi").html(respon);
		}
	})
}
function view(id){
	var grade = $("#grade").val();
	$.ajax({
		url :"<?php echo site_url();?>/teacher/raport_view/"+id,
		type:"post",
		data:"id_number="+id+"&grade="+grade,
		success:function(respon){
			$("#isi").html("<div class='bulat'><div id='dalbulat'><span>W</span><span>A</span><span>I</span><span>T</span><span>I</span><span>N</span><span>G</span><span>.</span><span>.</span></div><div class='luarbulat'></div></div>");
			$("#isi").html(respon);
		}
	})
}
</script>