<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC;?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Add Data</button></h2>
			<select id="fjenis" style="padding:5px;margin:5px;">
			    <option value="">Pilih Jenis Pendidikan</option>
			    <?php foreach($jenis_list->result() as $jen){?>
					<option value="<?php echo $jen->id_jenis;?>"><?php echo $jen->nama_jenis;?></option>
				<?php }?>
			</select>
			<select id="fjalur" style="padding:5px;margin:5px;">
			    <option value="">Pilih Jalur Pendidikan</option>
			    <?php foreach($jalur_list->result() as $jen){?>
					<option value="<?php echo $jen->id_jalur;?>"><?php echo $jen->nama_jalur;?></option>
				<?php }?>
			</select>
			<select id="fjenjang" style="padding:5px;margin:5px;">
			    <option value="">Pilih Jenjang Pendidikan</option>
			    <?php foreach($jenjang_list->result() as $jen){?>
					<option value="<?php echo $jen->id_jenjang;?>"><?php echo $jen->nama_jenjang;?></option>
				<?php }?> 
			</select>
			<select id="fkelas" style="padding:5px;margin:5px;">
			    <option value="">Pilih Kelas</option>
			    <?php foreach($kelas_list->result() as $kls){?>
					<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
				<?php }?>
			</select>
			<select id="fstatus" style="padding:5px;margin:5px;">
			    <option value="">Pilih Status</option>
			    <option value="active">Active</option>
				<option value="off">Non Active</option>
			</select>
			<button class="btn btn-primary" type="button" id="filter"><i class="fa fa-filter"></i> Filter</button>
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
	$("#isi").load('ajaxMata_pelajaran');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
	});
	
	$("#filter").click(function(){
	    var fjenis=$("#fjenis").val();
	    var fjalur=$("#fjalur").val();
	    var fjenjang=$("#fjenjang").val();
	    var fkelas=$("#fkelas").val();
	    var fstatus=$("#fstatus").val();
	    if (fjenis=='') fjenis='Z';
	    if (fjalur=='') fjalur='Z';
	    if (fjenjang=='') fjenjang='Z';
	    if (fstatus=='') fstatus='Z';
	    $("#isi").load('ajaxMata_pelajaran/'+fjenis+'/'+fjalur+'/'+fjenjang+'/'+fkelas+'/'+fstatus);
	})
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/master2/proses_mata_pelajaran",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxMata_pelajaran');
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
	
	$("#guru_lain").click(function(){
	    var id_pel=$("#id").val();
	    $("#Modal").modal('hide');
	   	$(".modal-title").html('Guru Tambahan');
	    $("#Modal2").modal('show');
	    $("#isi2").load('ajaxGuru_lain/'+id_pel);
	});
	
	$("#tambah_guru_lain").click(function(){
	    $("#Modal2").modal('hide');
		$("#Modal3").modal('show');
		$(".modal-title").html('Add Data');
	});
	
});

function edit(id){
	$.getJSON('<?php echo site_url() ?>/master2/edit_mata_pelajaran/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_mapel']);
			$("#nama").val(response['nama_mapel']);
			$("#tingkat").val(response['tingkat']);
			$("#jenjang").val(response['jenjang']);
			$("#kelas").val(response['kelas']);
			$("#guru").val(response['guru']);
			$("#tipe_pelajaran").val(response['tipe_pelajaran']);
			$("#tipe_raport").val(response['tipe_raport']);
			$("#metode").val(response['metode']);
			$("#point").val(response['point']);
			$("#syarat").val(response['syarat']);
			$("#point").val(response['point']);
			$("#ikut_krs").val(response['ikut_krs']);
			$("#tgl_krs").val(response['tgl_krs']);
			$("#kuota").val(response['kuota']);
			$("#status").val(response['status']);
			$("#kkm").val(response['kkm']);
			$("#kkm_terkecil").val(response['kkm_terkecil']);
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
					url :"<?php echo site_url()?>/master2/delMata_pelajaran/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxMata_pelajaran');
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
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Tipe Raport</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="tipe_raport" class="form-control" id="tipe_raport" placeholder="choose Status">
						    <?php foreach($tp_raport_list->result() as $tp){?>
								<option value="<?php echo $tp->id_tipe;?>"><?php echo $tp->nama_tipe;?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Status</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="status" class="form-control" id="status" placeholder="choose Status">
						<option value="active">Active</option>
						<option value="off">Non Active</option>
						</select>
                      </div>
                    </div>
                    
					<div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Subject</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<input type="hidden" class="form-control" id="id" name="id" value="kosong" />
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Subject name" />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Jenis Pendidikan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="jenis" class="form-control" id="jenis">
						    <?php foreach($jenis_list->result() as $jen){?>
								<option value="<?php echo $jen->id_jenis;?>"><?php echo $jen->nama_jenis;?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Jalur Pendidikan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="jalur" class="form-control" id="jalur">
						    <?php foreach($jalur_list->result() as $jen){?>
								<option value="<?php echo $jen->id_jalur;?>"><?php echo $jen->nama_jalur;?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                    
					<div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Jenjang Pendidikan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="jenjang" class="form-control" id="jenjang" placeholder="choose Status">
						    <?php foreach($jenjang_list->result() as $jen){?>
								<option value="<?php echo $jen->id_jenjang;?>"><?php echo $jen->nama_jenjang;?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                    
					<div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Tingkat Kelas</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
					  <select name="tingkat" class="form-control" id="tingkat" class="form-control">
					  <option value="1"> Year 1</option>
					  <option value="2"> Year 2</option>
					  <option value="3"> Year 3</option>
					  <option value="4"> Year 4</option>
					  <option value="5"> Year 5</option>
					  <option value="6"> Year 6</option>
					  </select>
                      </div>
                    </div>
                    
					<div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Nama Kelas</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="kelas" class="form-control" id="kelas" placeholder="choose Status">
						    <?php foreach($kelas_list->result() as $kls){?>
								<option value="<?php echo $kls->id_kelas;?>"><?php echo $kls->nama_kelas;?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Tipe Pelajaran</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="tipe_pelajaran" class="form-control" id="tipe_pelajaran">
						    <?php foreach($tp_pelajaran_list->result() as $tp){?>
								<option value="<?php echo $tp->id_tipe;?>"><?php echo $tp->nama_tipe;?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Guru Pengampu</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="guru" class="form-control" id="guru">
						    <?php foreach($guru_list->result() as $gr){?>
								<option value="<?php echo $gr->id_user;?>"><?php echo $gr->id_number.' | '.$gr->full_name;?></option>
							<?php }?>
						</select>    
                      </div>
                      
                    </div>
                    <div class="form-group">
                       <label class="control-label col-sm-4 col-sm-4 col-xs-12">Guru Tambahan</label>
                       <div class="col-md-8 col-sm-8 col-xs-12">
                             <button type="button" class="btn btn-primary" id="guru_lain">Lihat</button>
                        </div>     
                    </div>    
                     <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Metode Penilaian</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						  <select name="metode" class="form-control" id="metode" class="form-control">
        					  <option value="1">POINT</option>
        					  <option value="2">FIX SYARAT</option>
    					  </select>   
                      </div>
                    </div>
				    
				    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Point Kelulusan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
				        <input type="number" class="form-control" id="point" name="point" placeholder="" />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Syarat Kelulusan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
				        <input type="text" class="form-control" id="syarat" name="syarat" placeholder="Catatan Syarat Kelulusan" />
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Ikut KRS</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						  <select name="ikut_krs" class="form-control" id="ikut_krs" class="form-control">
        					  <option value="YA">YA</option>
        					  <option value="TIDAK">TIDAK</option>
    					  </select>   
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Tgl KRS </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
				        <input type="date" class="form-control" id="tgl_krs" name="tgl_krs" placeholder="Tgl KRS" />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Kuota </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
				        <input type="number" class="form-control" id="kuota" name="kuota" placeholder="Kuota" />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">KKM </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
				        <input type="number" class="form-control" id="kkm" name="kkm" placeholder="KKM" />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">KKM Terkecil </label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
				        <input type="number" class="form-control" id="kkm_terkecil" name="kkm_terkecil" placeholder="KKM Terkecil" />
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
	<div class="modal-dialog modal-lg" style="width:800px;">
		<div class="modal-content">
			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Guru Lainnya</h4>
            </div>
			<div class="modal-body">
			    <h2><button class="btn btn-primary" type="button" id="tambah_guru_lain"><i class="fa fa-plus-square"></i> Add Data</button></h2>
			    <div id="isi2"></div>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="Modal3" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal">
			        <input type="hidden" class="form-control" id="id_guru_bantu" name="id_guru_bantu" value="kosong" />                    
                    <div class="form-group">
                      <label class="control-label col-sm-4 col-sm-4 col-xs-12">Guru Tambahan</label>
                      <div class="col-md-8 col-sm-8 col-xs-12">
						<select name="guru" class="form-control" id="guru">
						    <?php foreach($guru_list->result() as $gr){?>
								<option value="<?php echo $gr->id_user;?>"><?php echo $gr->id_number.' | '.$gr->full_name;?></option>
							<?php }?>
						</select>    
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