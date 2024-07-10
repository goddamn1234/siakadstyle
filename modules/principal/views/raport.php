<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxRaport');
});

function view_student(id){
	$.ajax({
			url :"<?php echo site_url();?>/principal/view_student/"+id,
			type:"get",
			success:function(response){
				$("#Modal").modal('show');
				$(".modal-body").html(response);
			}
		})
}

function choose(id_number){
	var grade=$("#grade").val();
	$.ajax({
			url :"<?php echo site_url();?>/principal/raport_view/",
			type:"post",
			data:"grade="+grade+"&id_number="+id_number,
			success:function(response){
				$("#Modal").modal('hide');
				$("#isi").html(response);
			}
		})
}

</script>

<div class="modal fade bs-example-modal-lg" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:800px;">
		<div class="modal-content">

			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel">Data Students</h4>
            </div>
			<div class="modal-body">
			
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
		</div>
	</div>
</div>