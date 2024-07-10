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
	$("#isi").load('ajaxFmp');
	
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	})
	
	$("#save").click(function(){
		var category = $("#category").val();
		var periode = $("#periode").val();
		var pmd = $("#pmd").val();
		var objective = $("#objective").val();
		if(pmd == '0' || category == '0' || periode == '0' || objective == ''){
			Lobibox.alert('error', {
				msg: 'Periksa kembali inputan anda'
			});
			return false;
		}else{
			
			$.ajax({
			url :"<?php echo site_url();?>/master/proses_fmp",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxFmp');
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
	$.getJSON('<?php echo site_url() ?>/master/editFmp/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_fmp']);
			$("#category").val(response['category']);
			$("#pmd").val(response['flag_fmp']);
			$("#periode").val(response['periode']);
			$("#objective").val(response['nama_fmp']);
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
					url :"<?php echo site_url()?>/master/delFmp/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxFmp');
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
				<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Category</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="category" id="category" class="form-control" placeholder="Choose Category" required="required" >
							<?php foreach($category->result() as $cats){?>
								<option value="<?php echo $cats->id_category;?>"><?php echo $cats->nama_category;?></option>
							<?php }?>
						</select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">PMD</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <select name="pmd" id="pmd" class="form-control" required="required" >
					  <option value="0"> - Choose PMD -- </option>
					  <option value="pass"> Pass </option>
					  <option value="merit"> Merit </option>
					  <option value="distinction"> Distinction </option>
					  </select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Periode</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <select name="periode" id="periode" class="form-control" required="required" >
					  <option value="0"> - Choose Periode -- </option>
					  <option value="MID1"> MID Term 1 </option>
					  <option value="END1"> End Term 1 </option>
					  <option value="MID2"> MID Term 2 </option>
					  <option value="END2"> End Term 2 </option>
					  </select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Objective</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="text" class="form-control" name="objective" id="objective" placeholder="objective" required="required" />
                      </div>
                    </div>
			</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save">Simpan</button>
            </div>
		</div>
	</div>
</div>