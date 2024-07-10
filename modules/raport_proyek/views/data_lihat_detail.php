<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	   <div class="x_title">
			<div class="clearfix"></div>
        </div>
        <?php foreach($proyek as $pro); 
            foreach($murid as $mrd);
            ;?>
        <table class="table cellspan:2px">
            <tr><td>Nomer Induk</td><td><?php echo $mrd->id_number;?></td>
                <td align="right"><i class="glyphicon glyphicon-calendar"></i> <?php echo $pro->tgl_awal.' s/d '.$pro->tgl_akhir;?></td></tr>
            <tr><td>Nama Siswa</td><td colspan="2"><?php echo $mrd->full_name;?></td></tr>
            <tr><td>Guru Fasilitator</td><td colspan="2"><?php foreach($fasilitator as $fas){ echo $fas->full_name;}?></td></tr>
            <tr><td>Kelas </td><td colspan="2"><?php  foreach($kelas as $kel) echo $kel->nama_kelas;?></td></tr>
            <tr><td>Proyek ke </td><td colspan="2"><?php echo $pro->ke;?></td></tr>
        </table>
        <h4>
          <table class="table table-bordered">
              <tr><td width="150px" style="background:#ffe4e4">Nama Proyek</td><td><?php echo $pro->nama?></td></tr>
              <tr><td style="background:#ffe4e4">Deskripsi Proyek</td><td><?php echo $pro->penjelasan?></td></tr>
          </table>
        </h4>  
        <div class="x_content" id="isi">

		</div>
		<h2><button <?php echo $otoC;?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Tambah Kriteria</button></h2>
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
    $("#isi").load('ajaxDetail_proyek/<?php echo $id_proyek?>');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
        $("#siklus").val('0');
		$("#ke").val('');
		$("#kriteria").val('');
	});
	
	$("#save").click(function(){
			$.ajax({
			url :"<?php echo site_url();?>/raport_proyek/simpan_proyek_detail",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success ', {
					msg: 'Data Berhasil Disimpan'
					});
					$("#isi").load('ajaxDetail_proyek/<?php echo $id_proyek?>');
					$("#id").val('kosong');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penimpanan data'
					});
				}
			})
		
	});
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/raport_proyek/edit_proyek_detail/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_detail']);
			$("#siklus").val(response['siklus']);
			$("#ke").val(response['ke']);
			$("#kriteria").val(response['kriteria']);
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
					url :"<?php echo site_url()?>/raport_proyek/delete_proyek_detail/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						 $("#isi").load('ajaxDetail_proyek/<?php echo $id_proyek?>');
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
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Siklus</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
					<input type="hidden" id="id" name="id" value="kosong" />
					<input type="hidden" id="id_proyek" name="id_proyek" value="<?php echo $id_proyek?>" />
                    <select class="form-control" id="siklus" name="siklus">
                    	<option value="0">Pilih Siklus</option>
                         <?php foreach($siklus->result() as $sk){?>
							<option value="<?php echo $sk->id_siklus;?>"><?php echo $sk->nama_siklus;?></option>
						<?php }?>
                    </select> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">P-Ke</label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
				    <input type="text" class="form-control" id="ke" name="ke" placeholder="P-Ke" maxlength="5"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3 col-sm-3 col-xs-12">Kriteria</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
				    <textarea class="form-control" id="kriteria" name="kriteria" rows="3"></textarea>
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
</script>