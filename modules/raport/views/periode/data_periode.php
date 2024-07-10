<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC; ?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Add Data</button></h2>
			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">

		</div>
	</div>
</div>
		<style type="text/css">@import url("<?php echo base_url() . 'image-upload/bootstrap-imageupload.css'; ?>");</style>
		<!-- input mask -->
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/input_mask/jquery.inputmask.js"></script>
		<!-- Datatables-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
         <script type='text/javascript' src="<?php echo base_url(); ?>image-upload/bootstrap-imageupload.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxPeriode');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$(":input").inputmask();
	
	$("#save").click(function(){
		var periode = $("#periode").val();
		var academic = $("#academic").val();
		var file = $('#userfile')[0].files[0];
		let formdata = new FormData();  
			formdata.append('fFile', file);
			$.each($('#fModal').serializeArray(), function(a, b){
				formdata.append(b.name, b.value);
			});
		if(periode != "0" && academic !=""){
			$.ajax({
			url :"<?php echo site_url();?>/raport/proses_periode",
			    data:formdata,
	    		processData: false,
                contentType: false,
				type:"post",
				dataType:'JSON',
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(respon){
					if(respon.status == 'success'){
						Lobibox.notify('success', {
						msg: respon.message
						});
					}else{
						Lobibox.notify('error', {
						msg: respon.message
						});
					}
					
					$("#isi").load('ajaxPeriode');
					$("#id").val('kosong');
				},
				error:function(respon){
				    Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		}
		
	});
	
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/raport/editPeriode/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_raport_periode']);
			$("#periode").val(response['periode']);
			$("#academic").val(response['tahun_akademik']);
			$("#awal").val(response['awal']);
			$("#status").val(response['status']);
			$("#akhir").val(response['akhir']);
			$("#tgl_raport").val(response['tgl_raport']);
			$("#kepsek").val(response['kepsek']);
			$("#kepsek2").val(response['kepsek2']);
			$("#kepsek3").val(response['kepsek3']);	
			$("#kepsek4").val(response['kepsek4']);
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
					url :"<?php echo site_url()?>/raport/delPeriode/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxPeriode');
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

function upload_ttd(id){
    $("#kepsek_ke").val(id);
    $("#Modal").modal('hide');		
    $("#Modal2").modal('show');		
}


function act(id){
			$.ajax({
					url :"<?php echo site_url()?>/raport/actPeriode/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Perubahan Data berhasil'
					});
						$("#isi").load('ajaxPeriode');
					},
					error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Perubahan data'
					});
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Periode</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
                        <select name="periode" id="periode" class="form-control" required="required" >
							<option value="0"> choose Periode </option>
							<option value="MID1"> MID Term Periode 1 </option>
							<option value="END1"> END Term Periode 1</option>
							<option value="MID2"> MID Term Periode 2 </option>
							<option value="END2"> END Term Periode 2</option>
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Tahun Ajaran</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="text" name="academic" id="academic" class="form-control"  data-inputmask="'mask' : '9999/9999'" placeholder="yyyy/yyyy" />
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Mulai Periode</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="date" name="awal" id="awal" class="form-control"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Akhir Periode</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="date" name="akhir" id="akhir" class="form-control" data-inputmask="'mask' : '9999/9999'"  placeholder="dd-mm-yyyy" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Tgl Raport</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="date" name="tgl_raport" id="tgl_raport" class="form-control" placeholder="dd-mm-yyyy" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Status Periode</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <select name="status" id="status" class="form-control"/>
					     <option>aktif</option>
					     <option>selesai</option>
					  </select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Kepala SMA</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					     <input type="text" name="kepsek" id="kepsek" class="form-control" placeholder="" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					      <button type="button" class="btn btn-primary" onclick="upload_ttd(1)">Upload Tanda Tangan</buton>
                      </div>
                    </div>
                    	<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Kepala SMK</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					      <input type="text" name="kepsek3" id="kepsek2" class="form-control" placeholder="" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					    <button type="button" class="btn btn-primary" onclick="upload_ttd(2)">Upload Tanda Tangan</buton>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Kepala SMP</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					     <input type="text" name="kepsek3" id="kepsek3" class="form-control" placeholder="" />
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					    <button type="button" class="btn btn-primary" onclick="upload_ttd(3)">Upload Tanda Tangan</buton>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Kepala SD</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					     <input type="text" name="kepsek4" id="kepsek4" class="form-control" placeholder="" />
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					     <button type="button" class="btn btn-primary" onclick="upload_ttd(4)">Upload Tanda Tangan</buton>
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

<div class="modal fade bs-example-modal-lg" id="Modal2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Upload Tanda Tangan</h4>
            </div>
			<div class="modal-body">
			    <form class="form-horizontal form-label-left" id="fModal2">
			      <div class="form-group">   
			          <label class="control-label col-sm-3 col-sm-3 col-xs-12">Gambar Tanda Tangan</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <input type="hidden" name="kepsek_ke" id="kepsek_ke" value="">  
    				     <input type="file" name="ttd" id="ttd" class="form-control" placeholder="" />
                      </div>
                  </div>      
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save2">Upload</button>
            </div>
		</div>
	</div>
</div>	