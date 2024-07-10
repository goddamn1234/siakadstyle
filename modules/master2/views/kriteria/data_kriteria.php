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
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxKriteria');
	$(".add").click(function(){
		$("#Modal").modal('show');
		$(".modal-title").html('Add Data');
		$("#subjek").val();
		$("#id").val('kosong');
		$("#siklus").val(0);
		$("#ke").val('');
		$("#isi_kriteria").val('');
		$("#point").val('');
		$("#syarat").val('');
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
	    $("#isi").load('ajaxKriteria/'+fjenis+'/'+fjalur+'/'+fjenjang+'/'+fkelas+'/'+fstatus);
	})
	
	$("#save").click(function(){
		var nama = $("#nama").val();
		if(nama != ""){
			$.ajax({
			url :"<?php echo site_url();?>/master2/proses_kriteria",
				type:"post",
				data:$("#fModal").serialize(),
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxKriteria');
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
	$.getJSON('<?php echo site_url() ?>/master2/edit_kriteria/'+id,
		function( response ) {
			$("#Modal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#id").val(response['id_kriteria']);
			$("#subjek").val(response['subjek']);
			$("#siklus").val(response['siklus']);
			$("#ke").val(response['ke']);
			$("#isi_kriteria").val(response['isi_kriteria']);
			$("#point").val(response['point']);
			$("#syarat").val(response['syarat']);
			ubah_mapel();
		}
	);
}


function ubah_mapel(){
   var id=$("#subjek").val(); 
   $.getJSON('<?php echo site_url() ?>/master2/cek_metode/'+id,
   function( response ) {
   	   if (response['metode']=='1'){
       	         $("#fix_area").css("display", "none");
                 $("#point_area").css("display", "block");
   		    } else {
   		         $("#fix_area").css("display", "block");
                 $("#point_area").css("display", "none");
        }
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
					url :"<?php echo site_url()?>/master2/delKriteria/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxKriteria');
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
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Subjek</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="hidden" class="form-control" id="id" name="id" value="kosong" />
						<select name="subjek" class="form-control" id="subjek" onchange="ubah_mapel()">
						    <?php foreach($mapel_list->result() as $mapel){?>
								<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel.' ('.$mapel->nama_jenjang.'/'.$mapel->nama_kelas.')';?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                    
				   <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Siklus Belajar</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<select name="siklus" class="form-control" id="siklus">
						    <?php foreach($siklus_list->result() as $siklus){?>
								<option value="<?php echo $siklus->id_siklus;?>"><?php echo $siklus->nama_siklus;?></option>
							<?php }?>
						</select>    
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">P-Ke</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
			            <input type="text" class="form-control" id="ke" name="ke" value="" />
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Isi Kriteria</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
			            <textarea  class="form-control" id="isi_kriteria" name="isi" rows="4"> 
			            </textarea>
                      </div>
                    </div>
                    <div class="form-group" id="point_area" style="display:none">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Point</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
			            <input type="number"  class="form-control" id="point" name="point">
                      </div>
                    </div>
                     <div class="form-group" id="fix_area" style="display:none">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Fix Syarat</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
			             <select class="form-control" id="syarat" name="syarat">
			                 <option value="Y">Ya</option>
			                 <option value="N">Tidak</option>
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