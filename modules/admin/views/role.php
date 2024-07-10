<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button class="btn btn-primary add" type="button" <?php echo $otoC;?> ><i class="fa fa-plus-square"></i> Add Data</button></h2>
			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">
		<table id="datatable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
                    <th> Role</th>
					<th> Description</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_role;?></td>
						<td><?php echo $row->ket;?></td>
						<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_role;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_role;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
						<button <?php echo $otoU;?> class="btn btn-primary btn-xs" type="button" onclick="generate(<?php echo $row->id_role;?> )" data-toggle="tooltip" data-placement="top" title="generate menu"><i class="fa fa-sitemap"></i></button>
					  </tr>
				  <?php $no++; };  ?>
                
             </tbody>
              </table>
		</div>
	</div>
</div>
<!-- Datatables-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/moment/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/dataTables.bootstrap.js"></script>


        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$(".add").click(function(){
		$("#addModal").modal('show');
	});
	$("#save").click(function(){
		var role = $("#role").val();
		var ket = $("#ket").val();
		$.ajax({
			url :"<?php echo site_url();?>/admin/addrole",
				type:"post",
				data:"role="+role+"&ket="+ket,
				beforeSend:function(){
					$("#addModal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxRole');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
		})
	});
	$("#saveedit").click(function(){
		var role = $("#nrole").val();
		var ket = $("#nket").val();
		var id = $("#oid").val();
		$.ajax({
			url :"<?php echo site_url();?>/admin/newrole",
				type:"post",
				data:"role="+role+"&ket="+ket+"&id="+id,
				beforeSend:function(){
					$("#editModal").modal('hide');
				},
				success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dirubah'
					});
					$("#isi").load('ajaxRole');
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Perubahan data'
					});
				}
		})
	});

			  
			  
			  
			  
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
function edit(id){
	$.getJSON('<?php echo site_url() ?>/admin/editrole/'+id,
		function( response ) {
			$("#editModal").modal('show');
			$("#nrole").val(response['nama_role']);
			$("#nket").val(response['ket']);
			$("#oid").val(response['id_role']);
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
					url :"<?php echo site_url()?>/admin/delrole/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxRole');
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
function generate(id){
	$.ajax({
		url :"<?php echo site_url()?>/admin/generate/"+id,
		type:"post",
		success:function(){
			Lobibox.notify('success', {
			msg: 'Menu Berhasil Digenerate'
			});
			$("#isi").load('ajaxRole');
			},
		error:function(){
			Lobibox.notify('error', {
			msg: 'Gagal Melakukan Generate menu'
			});
			}
	})
}
</script>
<div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Add Data</h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left">
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Role Name</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" id="role" placeholder="Nama role" />
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Description</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" id="ket" placeholder="Deskripsi" ></textarea>
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
<div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:#35495d;">
				<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Edit Data</h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left">
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Role Name</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" id="nrole"/>
						<input type="hidden" class="form-control" id="oid"/>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Description</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" id="nket"></textarea>
                      </div>
                    </div>
					
			</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveedit">Simpan</button>
            </div>
		</div>
	</div>
</div>