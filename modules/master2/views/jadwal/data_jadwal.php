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
	$("#isi").load('ajaxJadwal/<?php echo $pelajaran?>');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/master2/proses_jadwal",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxJadwal/<?php echo $pelajaran?>');
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
	$.getJSON('<?php echo site_url() ?>/master2/edit_jadwal/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_jadwal']);
			$("#hari").val(response['hari']);
			$("#dari").val(response['dari']);
			$("#sampai").val(response['sampai']);
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
					url :"<?php echo site_url()?>/master2/delJadwal/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxJadwal/<?php echo $pelajaran?>');
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Mata Pelajaran</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					   <input type="text" class="form-control"  value="<?php echo $mapel->nama_mapel ?>" readonly/>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Hari</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
						<input type="hidden" class="form-control" id="pelajaran" name="pelajaran" value="<?php echo $mapel->id_mapel?>" />
                        <select class="form-control" id="hari" name="hari"/>
                           <option value="1">Senin</option>
                           <option value="2">Selasa</option>
                           <option value="3">Rabu</option>
                           <option value="4">Kamis</option>
                           <option value="5">Jumat</option>
                           <option value="6">Sabtu</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Mulai Jam</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					   <input type="text" class="form-control" id="dari" name="dari" maxlength="5" placeholder="00:00" />
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Sampai Jam</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					   <input type="text" class="form-control" id="sampai" name="sampai" maxlength="5" placeholder="00:00" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Periode Ajaran</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
				        <select class="form-control" id="periode" name="periode"/>
				           <option value="">- Pilih Periode -</option>
				           <?php foreach($list_periode->result() as $row2){ ?>
                              <option value="<?php echo $row2->id_raport_periode ?>"><?php echo $row2->periode.' , '.$row2->tahun_akademik ?></option>
                           <?php } ?>
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