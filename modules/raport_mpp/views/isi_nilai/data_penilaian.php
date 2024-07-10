<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
		     Periode
	    	<select id="fperiode" style="padding:5px;margin:5px;">
			    <?php foreach($periode->result() as $period){ ?>
					<option value="<?php echo $period->id_raport_periode;?>"><?php echo $period->periode.' '.$period->tahun_akademik;?></option>
				<?php } ?>
			</select>
			<button class="btn btn-primary" type="button" id="filter"><i class="fa fa-filter"></i> Filter</button>
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
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
   	$("#isi").load('ajaxPenilaian');
   	
   	 $("#filter").click(function(){
	    var fperiode=$("#fperiode").val();
	    if (fperiode=='') fperiode='Z';
	    $("#isi").load('ajaxPenilaian/'+fperiode);
  	 })
});
</script>
