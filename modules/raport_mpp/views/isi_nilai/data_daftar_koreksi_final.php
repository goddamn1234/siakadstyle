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
	$("#isi").load('ajaxDaftar_koreksi_final/<?php echo $kelas?>/<?php echo $periode?>');
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_simpan_catatan_final",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(resp){
				    //alert(resp);
					Lobibox.notify('success', {
					  msg: 'Data Berhasil disimpan'
					});
					$("#isi").load('ajaxDaftar_koreksi_final/<?php echo $kelas?>/<?php echo $periode?>');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		}
		
	});
	
	$("#save2").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/raport_mpp/proses_simpan_catatan_siswa",
				type:"post",
				data:$("#fModal2").serialize(),
				beforeSend:function(){
					$("#Modal2").modal('hide');
				},
				success:function(resp){
				    //alert(resp);
					Lobibox.notify('success', {
					msg: 'Data Berhasil disimpan'
					});
					$("#isi").load('ajaxDaftar_koreksi_final/<?php echo $kelas?>/<?php echo $periode?>');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penyimpanan data'
					});
				}
			})
		}
		
	});
	
});

function edit_catatan(id,per){
    $("#id").val(id);
    $("#periode").val(periode);
	$.getJSON('<?php echo site_url() ?>/raport_mpp/edit_catatan_final/'+id+'/'+per,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			if (response!=null){
			   $("#catatan").val(response['catatan']);
			   $("#catatan_dioutput").val(response['catatan_dioutput']);
			}   
			$("#id").val(id);
			$("#periode").val(per);
		}
	);
}

function edit_catatan_siswa(id,per){
    $("#id2").val(id);
    $("#periode2").val(periode);
	$.getJSON('<?php echo site_url() ?>/raport_mpp/edit_catatan_siswa/'+id+'/'+per,
		function( response ) {
			$("#Modal2").modal('show');
			$(".modal-title").html('Edit Data');
			if (response!=null){
			   $("#catatan_siswa").val(response['catatan_siswa']);
			   $("#catatan_siswa_dioutput").val(response['catatan_siswa_dioutput']);
			}   
			$("#id2").val(id);
			$("#periode2").val(per);
		}
	);
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Catatan Final</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
						<input type="hidden" class="form-control" id="periode" name="periode" value="kosong" />
                        <textarea type="text" class="form-control" id="catatan" name="catatan" rows="3"/></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Muncul di Output</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <select name="catatan_dioutput" name="catatan_dioutput">
                              <option value="Y">Ya</option>
                              <option value="T">Tidak</option>
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

<div class="modal fade bs-example-modal-lg" id="Modal2" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal2">
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Catatan Siswa</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id2" name="id2" value="kosong" />
						<input type="hidden" class="form-control" id="periode2" name="periode2" value="kosong" />
                        <textarea type="text" class="form-control" id="catatan_siswa" name="catatan_siswa" rows="3"/></textarea>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Muncul di Output</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <select id="catatan_siswa_dioutput" name="catatan_siswa_dioutput">
                              <option value="Y">Ya</option>
                              <option value="T">Tidak</option>
                          </select>
                      </div>      
					</div>
				</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save2">Save</button>
            </div>
		</div>
	</div>
</div>