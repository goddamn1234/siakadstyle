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
		<style type="text/css">@import url("<?php echo base_url() . 'assets/js/datatables/jquery.dataTables.min.css'; ?>");</style>
		<style type="text/css">@import url("<?php echo base_url() . 'assets/js/datatables/buttons.bootstrap.min.css'; ?>");</style>
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
	$("#isi").load('ajaxStatus_krs');
});

function daftar_murid(id){
    $("#isi2").load('ajaxMurid_disetujui/'+id+'/<?php echo $periode?>');
    $("#Modal").modal('show');
}

function kriteria(id){
    $("#isi3").load('ajaxLihat_kriteria/'+id+'/<?php echo $periode?>');
    $("#Modal2").modal('show');
}

function jadwal(id){
    $("#isi4").load('ajaxLihat_jadwal/'+id+'/<?php echo $periode?>');
    $("#Modal3").modal('show');
}


</script>

<div class="modal fade bs-example-modal-lg" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:700px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Murid yang telah disetujui</h4>
            </div>
			<div class="modal-body">
			    <div id="isi2"></div>    
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="Modal2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Kriteria Penilaian</h4>
            </div>
			<div class="modal-body">
			    <div id="isi3"></div>    
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="Modal3" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:900px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Jadwal Belajar</h4>
            </div>
			<div class="modal-body">
			    <div id="isi4"></div>    
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>