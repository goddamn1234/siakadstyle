<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC;?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Add Data</button></h2>
			<div class="clearfix"></div>
        </div>
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
	$("#isi").load('ajaxCriteria');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
		$("#mapel").prop('disabled',false);
		$("#kelas").prop('disabled',false);
	});
	$("#mapel").focus(function(){
		var kelas = $("#kelas").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/cMapel",
			type:"post",
			data:"kelas="+kelas,
			success:function(respon){
				$("#mapel").html(respon);
			}
		})
	})
	$("#kelas").change(function(){
		$("#mapel").html("<option value='0'> Pilih Mata Pelajaran </option>");
	})
	
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
	
	$(".persen").autoNumeric({
		aSep:'',
		vMin:0,
		vMax:100,
		aPad:false
	});
	
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/master/editCriteria/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_criteria']);
			$("#kelas").val(response['tingkat_kelas']);
			$("#mapel").val(response['id_mapel']);
			$("#category").val(response['id_category']);
			$("#flag").val(response['flag'].replace("P",""));
			$("#criteria").val(response['nama_criteria']);
			$("#point").val(response['point_criteria']);
			$("#mapel").prop('disabled',true);
			$("#kelas").prop('disabled',true);
		}
	);
}
function del(id){
	 Lobibox.confirm({
		 title: "Konfirmasi",
		 msg: "Anda yakin akan menghapus data ini ?",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url()?>/master/delCriteria/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxCriteria');
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Grade</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="kelas" id="kelas" class="form-control">
						<option value="0"> Choose Grade </option>
						<option value="1"> Year 1</option>
						<option value="2"> Year 2</option>
						<option value="3"> Year 3</option>
						</select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Subject</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
                        <select name="mapel" id="mapel" class="form-control">
						<option value="0"> Choose Subject </option>
						<?php foreach($mapel_list->result() as $buff){
							echo "<option value='".$buff->id_mapel."'>".$buff->nama_mapel."</option>";
						}?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Categori</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="category" id="category" class="form-control">
						<option value="0"> Choose Point Category </option>
						<?php foreach($category_list->result() as $row){
							echo "<option value='".$row->id_category."'>".$row->nama_category."</option>";
						}?>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">P ke-</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="flag" id="flag" class="form-control" placeholder="P ke-">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Criteria</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="criteria" id="criteria" class="form-control" placeholder="Criteria penilaian">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Point</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="point" id="point" class="form-control persen" placeholder="Point penilaian dlm (1-100)">
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