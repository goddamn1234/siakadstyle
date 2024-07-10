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
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
	$("#isi").load('ajaxAssign_guru_tamu');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/teacher/proses_assign_guru_tamu",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxAssign_guru_tamu');
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
	$.getJSON('<?php echo site_url() ?>/teacher/edit_assign_guru_tamu/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_assign']);
			$("#guru").val(response['guru']);
			$("#tamu").val(response['tamu']);
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
					url :"<?php echo site_url()?>/teacher/delAssign_guru_tamu/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxAssign_guru_tamu');
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

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal">
					<div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Nama Guru</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
                    <select name="guru" class="form-control" id="guru" placeholder="choose Status">
						    <?php foreach($teacher->result() as $guru){?>
								<option value="<?php echo $guru->id_user;?>"><?php echo $guru->id_number.' | '.$guru->full_name;?></option>
							<?php }?>
					 </select>   
                  </div>
                </div>  	
				 <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Guru Tamu</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <select name="specialist" class="form-control" id="specialist" placeholder="choose Status">
						    <?php foreach($tamu->result() as $tm){?>
								<option value="<?php echo $tm->id_guru_tamu;?>"><?php echo $tm->nama_guru_tamu;?></option>
							<?php }?>
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