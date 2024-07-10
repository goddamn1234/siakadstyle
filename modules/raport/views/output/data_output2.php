<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<form class="form-inline" id="formFilter">
			    <div class="form-group">
					<div class="col-md-3">
					<select name="jenis" class="form-control" id="periode">
						<option value="all"> Semua Jenis </option>
						<?php foreach($jenis->result() as $row){ ?>
							<option value="<?php echo $row->id_jenis;?>"> <?php echo $row->nama_jenis ?> </option>
						<?php }?>
					</select>
					</div>
				</div>
				 <div class="form-group">
					<div class="col-md-3">
					<select name="jalur" class="form-control" id="periode">
						<option value="all"> Semua Jalur </option>
						<?php foreach($jalur->result() as $row){ ?>
							<option value="<?php echo $row->id_jalur;?>"> <?php echo $row->nama_jalur ?> </option>
						<?php }?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
					<select name="jenjang" class="form-control" id="periode">
						<option value="all"> Semua Jenjang </option>
						<?php foreach($jenjang->result() as $row){ ?>
							<option value="<?php echo $row->id_jenjang;?>"> <?php echo $row->nama_jenjang ?> </option>
						<?php }?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<select name="grade" class="form-control" id="grade">
					     <option value="all"> All Grade </option>
						<option value="1"> Year 1 </option>
						<option value="2"> Year 2 </option>
						<option value="3"> Year 3 </option>
						<option value="4"> Year 4 </option>
						<option value="5"> Year 5 </option>
						<option value="5"> Year 6 </option>
					</select>
				</div>
				<div class="form-group">
					<div class="col-md-3">
					<select name="class" class="form-control" id="class">
						<option value="all"> All Class </option>
					</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
					<select name="periode" class="form-control" id="periode">
						<option value="all"> All Periode </option>
						<?php foreach($periode->result() as $row){ ?>
							<option value="<?php echo $row->id_raport_periode;?>"> <?php echo $row->periode." ".$row->tahun_akademik;?> </option>
						<?php }?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
					<button type="button" class="btn btn-primary btn-sm" id="filter"><i class="fa fa-filter"></i> Filter</button>
					</div>
				</div>
			</form>
			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">

		</div>
	</div>
</div>

		<!-- input mask -->
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/input_mask/jquery.inputmask.js"></script>
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
	$("#grade").change(function(){
		$("#class").val('all');
	});
	$("#class").focus(function(){
		var grade = $("#grade").val();
		$.ajax({
			url :"<?php echo site_url();?>/raport/getClass",
				type:"post",
				data:"grade="+grade,
				success:function(respon){
					$("#class").html(respon);
				}
			})
	});
	
	$(":input").inputmask();
	
	$("#filter").click(function(){
		$.ajax({
			url :"<?php echo site_url();?>/raport/filter_output2",
				type:"post",
				data:$("#formFilter").serialize(),
				success:function(respon){
					$("#isi").html(respon);
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Filtering data'
					});
				}
			})
		
	});
	
	$("#uploadProses").click(function(){
		var id = $('#fUpload #id').val();
		var tingkat = $('#fUpload #tingkat').val();
		$("#fUpload").submit();
	});
	
	$("#fUpload").on('submit',(function(e) {
	    e.preventDefault();
	    $.ajax({
			url :"<?php echo site_url();?>/raport/proses_upload",
				type:"post",
				data:new FormData(this),
				dataType:"JSON",
				contentType: false,
                     cache: false,
               processData:false,
				beforeSend:function(){
					$("#uploadModal").modal('hide');
				},
				success:function(respon){
					if(respon.status =='success'){
						Lobibox.notify('success', {
						msg: 'Raport Berhasil Ditambahkan'
						});
						$("#filter").trigger('click');
						$("#id").val('');
						$("#fUpload").trigger("reset");
					}else{
						Lobibox.notify('error', {
						msg: respon.message
						});
					}
					
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan Raport'
					});
				}
			})
	}));
	
});
function uploadModal(key){
    
	$("#uploadModal").modal('show');
	$(".modal-title").html('Upload Raport');
	$("#fUpload #key").val(key);
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Year Academic</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="text" name="academic" id="academic" class="form-control" required="required" data-inputmask="'mask' : '9999/9999'" placeholder="yyyy/yyyy" />
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


<div class="modal fade bs-example-modal-lg" id="uploadModal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fUpload" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">File Upload (pdf)</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="hidden" name="key" id="key" />
							<input type="file" name="file_raport" accept=".pdf"/>
						</div>
					</div>
			</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="uploadProses">Upload</button>
            </div>
		</div>
	</div>
</div>