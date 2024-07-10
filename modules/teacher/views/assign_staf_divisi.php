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
		<style type="text/css">@import url("<?php echo base_url() . 'assets/js/datatables/jquery.dataTables.min.css'; ?>");</style>
		<style type="text/css">@import url("<?php echo base_url() . 'assets/js/datatables/buttons.bootstrap.min.css'; ?>");</style>
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
	$("#isi").load('ajaxAssign_staf_divisi');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/master2/proses_assign_staf_divisi",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxAsign_staf_divisi');
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
	$.getJSON('<?php echo site_url() ?>/teacher/editAssign_staf_divisi/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_assign']);
			$("#guru").val(response['guru']);
			$("#staf").val(response['staf']);
			$("#divisi").val(response['divisi']);
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
					url :"<?php echo site_url()?>/teachher/deledit_assign_staf_divisi/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxAssign_staf_divisi');
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
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Nama Staf</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <select name="staf" class="form-control" id="staf" placeholder="choose Status">
						    <?php foreach($staf->result() as $st){?>
								<option value="<?php echo $st->id_staf;?>"><?php echo $st->nama_staf;?></option>
							<?php }?>
					 </select>   
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Nama Divisi</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <select name="divisi" class="form-control" id="divisi" placeholder="choose Status">
						    <?php foreach($divisi->result() as $div){?>
								<option value="<?php echo $div->id_divisi;?>"><?php echo $div->nama_divisi;?></option>
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