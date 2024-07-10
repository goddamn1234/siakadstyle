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

		
		<!-- Datatables-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/moment/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/pace/pace.min.js"></script>
		<!-- Select 2 -->
<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/select/select2.full.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxAssign');
	$(".add").click(function(){
		$("#id_number").select2("val","0");
		$("#kelas").val("0");
		$("#mapel").val("0");
		$("#tingkat").val("0");
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
		
	});
	
	$(".select2_single").select2();
	
	$("#kelas").focus(function(){
		var grade = $("#tingkat").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/cKelas",
			type:"post",
			data:"tingkat="+grade,
			success:function(respon){
				$("#kelas").html(respon);
			}
		})
	})
	
	$("#mapel").focus(function(){
		var grade = $("#tingkat").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/cMapel",
			type:"post",
			data:"kelas="+grade,
			success:function(respon){
				$("#mapel").html(respon);
			}
		})
	});
	
	$("#save").click(function(){
		var guru = $("#id_number").val();
		var kelas = $("#kelas").val();
		var mapel = $("#mapel").val();
		if(guru !=0 && kelas !=0 && mapel !=0){
			$.ajax({
			url :"<?php echo site_url();?>/teacher/proses_assign",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxAssign');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		}
		
	});
	
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/teacher/editAssign/'+id,
		function( response ) {
			$("#id_number").select2("val",response['id_number']);
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_assign']);
			$("#id_number").val(response['id_number']);
			$("#tingkat").val(response['tingkat']);
			$("#kelas").val(response['id_kelas']);
			$("#mapel").val(response['id_mapel']);
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
					url :"<?php echo site_url()?>/teacher/delAssign/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxAssign');
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

		
<div class="modal fade bs-example-modal-lg" id="Modal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal">
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Teacher</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="hidden" name="id" id="id" value="kosong" />
							<select name="id_number" id="id_number" class="form-control select2_single" tabindex="-1" style="width:100%">
							<option value="0">- Choose Teacher -</option>
							<?php foreach($teacher->result() as $list){?>
								<option value="<?php echo $list->id_number;?>"><?php echo $list->id_number." | ".$list->full_name;?></option>
							<?php }	?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Grade</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <select name="tingkat" id="tingkat" class="form-control" >
					  <option value="0"> - Choose Tingkat -- </option>
					  <option value="1"> Year 1 </option>
					  <option value="2"> Year 2 </option>
					  <option value="3"> Year 3 </option>
					  </select>
                      </div>
                    </div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Class</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="kelas" id="kelas" class="form-control">
							<option value="0">- Choose Class -</option>
							<?php foreach($kelas->result() as $row){?>
								<option value="<?php echo $row->id_kelas;?>"><?php echo "Year ".$row->tingkat." | ".$row->nama_kelas;?></option>
							<?php }	?>
							
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="mapel" id="mapel" class="form-control">
							<option value="0">- Choose Subject -</option>
							<?php foreach($mapel->result() as $buff){?>
								<option value="<?php echo $buff->id_mapel;?>"><?php echo $buff->nama_mapel;?></option>
							<?php }	?>
							</select>
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