<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .daterangepicker{z-index:1151;}
	.monthselect, .yearselect{
	color:green;
	}
.switch-field {
  font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
  padding: 0px;
	overflow: hidden;
}

.switch-field input {
  display: none;
}

.switch-field label {
  float: left;
  margin-right:5px;
}

.switch-field label {
  display: inline-block;
  width: 70px;
  color: rgba(0, 0, 0, 0.6);
  font-size: 14px;
  font-weight: normal;
  text-align: center;
  text-shadow: none;
  padding: 6px 5px;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  -webkit-transition: all 0.1s ease-in-out;
  -moz-transition:    all 0.1s ease-in-out;
  -ms-transition:     all 0.1s ease-in-out;
  -o-transition:      all 0.1s ease-in-out;
  transition:         all 0.1s ease-in-out;
}

.switch-field label:hover {
	cursor: pointer;
}

.switch-field input:checked + label {
  background-color: #A5DC86;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.switch-field label:first-of-type {
  border-radius: 4px 0 0 4px;
}

.switch-field label:last-of-type {
  border-radius: 0 4px 4px 0;
}
</style>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2><button <?php echo $otoC;?> class="btn btn-primary add" type="button"><i class="fa fa-plus-square"></i> Tambah Data</button></h2>
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
<!-- Datepicker -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>
		<!-- Select 2 -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/select/select2.full.js"></script>
        <script type="text/javascript">
$(document).ready(function() {
	$("#isi").load('ajaxAssign');
	$(".add").click(function(){
		$("#id_number").select2("val","0");
		$("#kelas").val("0");
		$("#tingkat").val("1");
		$("#Modal").modal('show');
		$(".modal-title").html('Tambah Data');
		
	});
	
	$(".select2_single").select2();
	
	$("#kelas").focus(function(){
		var grade = $("#tingkat").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/cKelas",
			type:"post",
			data:"tingkat="+grade,
			success:function(respon){
				$("#kelas").html(respon);
			}
		})
	})
	$("#nkelas").focus(function(){
		var grade = $("#ntingkat").val();
		$.ajax({
			url :"<?php echo site_url();?>/master/cKelas",
			type:"post",
			data:"tingkat="+grade,
			success:function(respon){
				$("#nkelas").html(respon);
			}
		})
	})
	
	$("#save").click(function(){
		var student = $("#id_number").val();
		var kelas = $("#kelas").val();
		var start = $("#start").val();
		if(student !=0 && kelas !=0 && start != ""){
			$.ajax({
			url :"<?php echo site_url();?>/student/proses_assign",
				type:"post",
				data:$("#fModal").serialize(),
				dataType:"JSON",
				beforeSend:function(){
					$("#Modal").modal('hide');
				},
				success:function(respon){
					if(respon.status =='success'){
						Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
						});
						$("#isi").load('ajaxAssign');
						$("#id").val('kosong');
					}else{
						Lobibox.notify('error', {
						msg: respon.message
						});
					}
					
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		}
		
	});
	
	$("#saveEdit").click(function(){
		var action = $('input:radio[name=action]:checked').val();
		
			$.ajax({
			url :"<?php echo site_url();?>/student/proses_action",
				type:"post",
				data:$("#fEdit").serialize(),
				dataType:"JSON",
				beforeSend:function(){
					$("#editModal").modal('hide');
				},
				success:function(respon){
					if(respon.status =='success'){
						Lobibox.notify('success', {
						msg: 'Data Berhasil Ditambahkan'
						});
						$("#isi").load('ajaxAssign');
						$("#id").val('kosong');
					}else{
						Lobibox.notify('error', {
						msg: respon.message
						});
					}
					
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
			})
		
		
	});
	
	$('#start').daterangepicker({
        singleDatePicker: true,
		showDropdowns: true,
		maxDate:new Date(),
		format:"DD-MM-YYYY",
        calender_style: "picker_3"
    });
	$('#start2').daterangepicker({
        singleDatePicker: true,
		showDropdowns: true,
		maxDate:new Date(),
		format:"DD-MM-YYYY",
        calender_style: "picker_3"
    });
	
});
function action(key){
	var id = $("#oid").val();
	$.getJSON('<?php echo site_url() ?>/student/editAssign/'+id,
		function( response ) {
			if(key == "upgrade"){$("#ntingkat").val(parseInt(response['tingkat'])+1);}else{$("#ntingkat").val(response['tingkat']);}			
		}
	);
}
function edit(id){
	$.getJSON('<?php echo site_url() ?>/student/editAssign/'+id,
		function( response ) {
			$("#nid_number").select2("val",response['id_number']);
			$("#editModal").modal('show');
			$(".modal-title").html('Edit Data');
			$("#oid").val(response['id_assign']);
			$("#nkelas").val(response['id_kelas']);
			$("#ntingkat").val(response['tingkat']);
			$("#oid_number").val(response['id_number']);
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
					url :"<?php echo site_url()?>/teacher/delAssign/"+id,
					type:"post",
					success:function(){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Dihapus'
					});
						$("#isi").load('ajaxAssign');
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

		
<div class="modal fade bs-example-modal-lg" id="Modal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fModal">
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Student</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="hidden" name="id" id="id" value="kosong" />
							<select name="id_number" id="id_number" class="form-control select2_single" tabindex="-1" style="width:100%">
							<option value="0">- Choose Student -</option>
							<?php foreach($student->result() as $list){?>
								<option value="<?php echo $list->id_number;?>"><?php echo $list->id_number." | ".$list->full_name;?></option>
							<?php }	?>
							</select>
						</div>
					</div>
					
					<input type="hidden" name="tingkat" id="tingkat" value="1" />
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="kelas" id="kelas" class="form-control">
							<option value="0">- Choose Grade -</option>
							<?php foreach($kelas->result() as $row){?>
								<option value="<?php echo $row->id_kelas;?>"><?php echo "Year ".$row->tingkat." | ".$row->nama_kelas;?></option>
							<?php }	?>
							
							</select>
						</div>
					</div>
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Start Date</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="text" name="start" id="start" class="form-control" readonly />
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

<div class="modal fade bs-example-modal-lg" id="editModal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width:500px;">
		<div class="modal-content">

			<div class="modal-header" style="background:cyan;">
				<h4 class="modal-title" id="myModalLabel"></h4>
            </div>
			<div class="modal-body">
			<form class="form-horizontal form-label-left" id="fEdit">
					
							<div class="form-group">
								<label class="control-label col-sm-3 col-sm-3 col-xs-12">Action<span style="color:red;">*</span></label>
								<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="switch-field">
								<input type="radio" id="switch_mutasi" class="action col-sm-4" name="action" value="mutasi"/>
								<label for="switch_mutasi" onClick="action('mutasi');">Mutasi</label>
								<input type="radio" id="switch_upgrade" class="action col-sm-4" name="action" value="upgrade"/>
								<label for="switch_upgrade" onClick="action('upgrade');">Upgrade</label>
								<input type="radio" id="switch_pass" class="action col-sm-4" name="action" value="pass"/>
								<label for="switch_pass" onClick="action('pass');">Pass</label>
								<input type="radio" id="switch_out" class="action col-sm-4" name="action" value="out"/>
								<label for="switch_out" onClick="action('out');">Out</label>
								</div>
								</div>
							</div>
							
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Student</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<input type="hidden" name="oid" id="oid" />
							<input type="hidden" name="oid_number" id="oid_number" />
							<select name="nid_number" id="nid_number" class="form-control select2_single" tabindex="-1" style="width:100%" disabled >
							<option value="0">- Choose Student -</option>
							<?php foreach($student->result() as $list){?>
								<option value="<?php echo $list->id_number;?>"><?php echo $list->id_number." | ".$list->full_name;?></option>
							<?php }	?>
							</select>
						</div>
					</div>
					
					<input type="hidden" name="ntingkat" id="ntingkat" />
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="nkelas" id="nkelas" class="form-control">
							<option value="0">- Choose Grade -</option>
							<?php foreach($kelas->result() as $row){?>
								<option value="<?php echo $row->id_kelas;?>"><?php echo "Year ".$row->tingkat." | ".$row->nama_kelas;?></option>
							<?php }	?>
							
							</select>
						</div>
					</div>
					
					<div class="form-group">
                      <label class="control-label col-sm-3 col-sm-3 col-xs-12">Info</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <textarea name="info" id="info" class="form-control"></textarea>
                      </div>
                    </div>
			</form>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveEdit">Simpan</button>
            </div>
		</div>
	</div>
</div>