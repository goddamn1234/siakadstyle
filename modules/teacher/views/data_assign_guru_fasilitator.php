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
<style>
    #img-upload{
    width: 205px;
	border:1px solid lightblue;
	padding:1px;
}
</style>
		
		<!-- Datatables-->
		<style type="text/css">@import url("<?php echo base_url() . 'image-upload/bootstrap-imageupload.css'; ?>");</style>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/input_mask/jquery.inputmask.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>image-upload/bootstrap-imageupload.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
        
$(document).ready(function() {
	$("#isi").load('ajaxAssign_guru_fasilitator');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$("#save").click(function(){
	    var id = $("#id").val();
		var guru = $("#guru").val();
	    var file = $('#userfile')[0].files[0];
		let formdata = new FormData();  
			formdata.append('fFile', file);
			formdata.append('id',id)
			formdata.append('guru', guru);
		if(guru != ""){
			$.ajax({
			url :"<?php echo site_url();?>/teacher/proses_assign_guru_fasilitator",
				type:"post",
				data:formdata,
	    		processData: false,
                contentType: false,
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(respon){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan '+respon
					});
					$("#isi").load('ajaxAssign_guru_fasilitator');
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
	$.getJSON('<?php echo site_url() ?>/teacher/edit_assign_guru_fasilitator/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_assign']);
			$("#guru").val(response['guru']);
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
					url :"<?php echo site_url()?>/teacher/delAssign_guru_fasilitator/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxAssign_guru_fasilitator');
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

function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		
$("#userfile").change(function(){
    alert('test');
	    readURL(this);
	});
	
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
                 <div class="imageupload panel panel-default"  style="min-height:320px;">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">Signature</h3>
                </div>
                <div class="file-tab panel-body">
                    <label class="btn btn-default btn-file">
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="userfile" id="userfile" onchange="readURL(this);">
                    </label>
                    <?php echo img(array('id'=>'img-upload','src'=>'image/signature/parent/putih.png'));?>
				    <button type="button" class="btn btn-default">Remove</button>
					<br>
					
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