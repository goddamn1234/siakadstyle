<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style type="text/css">@import url("<?php echo base_url() . 'image-upload/bootstrap-imageupload.css'; ?>");</style>
<div class="col-md-12 col-sm-12 col-xs-12">
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
	<fieldset><legend>Form Registration <span class="pull-right"><small>Form with (*) is required</small></span></legend>
	<div class="col-md-3 col-sm-3">
	<div class="form-group">
        <div class="imageupload panel panel-default"  style="min-height:320px;">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">Image</h3>
                </div>
                <div class="file-tab panel-body">
                    <label class="btn btn-default btn-file">
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="userfile" id="userfile">
                    </label>
					<?php echo img(array('src'=>'image/parent/default.jpg','style'=>'display:block'));?>
                    <button type="button" class="btn btn-default">Remove</button>
					<br>
					
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
                        <input type="file" name="userfile2" id="userfile2">
                    </label>
					<?php echo img(array('src'=>'image/signature/putih.png','style'=>'display:block'));?>
                    <button type="button" class="btn btn-default">Remove</button>
					<br>
					
                </div>
            </div>    
    </div>
	
	</div>
	<div class="col-md-9 col-sm-9 col-sm-12">
		<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">ID Number <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="hidden" id="id_user" name="id_user" value="kosong" >
				<input type="text" id="id_number" name="id_number" required="required" class="form-control number" placeholder="number Induk Kependudukan">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Full name <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="full_name" name="full_name" required="required" class="form-control col-md-7 col-xs-12" placeholder="full name">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Spouse name</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="spouse_name" name="spouse_name" class="form-control col-md-7 col-xs-12" placeholder="spouse name (optional)">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Birth Place <span class="required">*</span></label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="birth_place" name="birth_place" required="required" class="form-control col-md-7 col-xs-12">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Date of Birth <span class="required">*</span></label>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<input type="text" id="birth_date" name="birth_date" required="required" class="form-control col-md-7 col-xs-12" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Home Address <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<textarea name="address" id="address" required="required" class="form-control col-md-7 col-xs-12" placeholder="detail address"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phone <span class="required">*</span></label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="phone1" name="phone1" required="required" class="form-control number">
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Phone2</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="phone2" name="phone2" class="form-control number" placeholder="other phone number (optional)">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Children <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select class="select2_multiple form-control" multiple="multiple" id="children" name="children[]">
						<?php
							foreach($children->result() as $child){
							echo "<option value='".$child->id_number."'>".$child->full_name." | ".$child->id_number."</option>";	
							}
                          ?>
                        </select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Education</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="education" name="education" class="form-control col-md-7 col-xs-12" placeholder="Education">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Occupation</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="occupation" name="occupation" class="form-control col-md-7 col-xs-12" placeholder="Occupation">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Income</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="income" name="income" class="form-control col-md-7 col-xs-12 number" placeholder="Income">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nationality <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="nationality" id="nationality" class="select2_single form-control">
				<option value="0">- Choose Nationality -</option>
				<?php foreach($nationality->result() as $list){?>
					<option value="<?php echo $list->num_code;?>"><?php echo $list->nationality;?></option>
				<?php }	?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Religion <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="religion" id="religion" class="form-control">
				<option value="0">- Choose Religion -</option>
				</select>
			</div>
		</div>
	
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Role <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
			<select name="role" id="role" class="form-control">
				<option value="0">- Choose Role -</option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
				<button type="button" class="btn btn-success" id="save"><i class="fa fa-save"></i> Save</button>
            </div>
		</div>
		
		</div>
	</div>

	</fieldset>
                  </form>
            </div>
<!-- input mask -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/input_mask/jquery.inputmask.js"></script>

  <script type='text/javascript' src="<?php echo base_url(); ?>image-upload/bootstrap-imageupload.js"></script>
  <!-- Auto numeric -->
<script type='text/javascript' src="<?php echo base_url(); ?>autonumeric/autoNumeric.js"></script>
<!-- Datepicker -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>
<!-- Select 2 -->
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/select/select2.full.js"></script>
 <script type="text/javascript">
$(document).ready(function() {
	$("#role").focus(function(){
		$.ajax({
			url :"<?php echo site_url();?>/admin/crole",
			type:"post",
			success:function(role){
				$("#role").html(role);
			}
		})
	})
	$("#religion").focus(function(){
		$.ajax({
			url :"<?php echo site_url();?>/admin/creligion",
			type:"post",
			success:function(role){
				$("#religion").html(role);
			}
		})
	})
	$(".number").autoNumeric({
		aSep:'',
		aPad:false
	});
	
	$(":input").inputmask();
	
	$('#birth_date').daterangepicker({
        singleDatePicker: true,
		showDropdowns: true,
		maxDate:new Date(),
		format:"DD-MM-YYYY",
        calender_style: "picker_3"
    });

	$(".select2_single").select2();
	
	$(".select2_multiple").select2({
		maximumSelectionLength: 5,
        placeholder: "Choose Student",
        allowClear: true
	});
	
	$("#save").click(function(){
		var id_number = $("#id_number").val();
		var role = $("#role").val();
		var full_name = $("#full_name").val();
		var birth_place = $("#birth_place").val();
		var birth_date = $("#birth_date").val();
		var address = $("#address").val();
		var phone = $("#phone1").val();
		var nationality = $("#nationality").val();
		var religion = $("#religion").val();
		var children = $("#children").val();
		if(id_number != '' || role != '0' || full_name != '' || birth_place != '' || birth_date != '' || address != '' || phone != '' || nationality !='0' || religion != '' || children != ''){
			var formdata = new FormData();      
			var file = $('#userfile')[0].files[0];
				formdata.append('fFile', file);
				$.each($('#demo-form2').serializeArray(), function(a, b){
				formdata.append(b.name, b.value);
				});
			$.ajax({
				url :"<?php echo site_url();?>/parents/proses_parent",
				type:"post",
				data:formdata,
				processData: false,
				contentType: false,
				dataType:"JSON",
				success:function(respon){
					if(respon.status){
					Lobibox.notify('success', {
					msg: 'Data Berhasil Ditambahkan'
					});
					$("#isi").load('ajaxParent');
					$("#id").val('kosong');
					$(".cancel").css('display','none');
					$(".add").css('display','block');
					}else{
						Lobibox.notify('error', {
							position: 'top left',
							msg: respon.message,
							delay: false,
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

});
	var $imageupload = $('.imageupload');
    $imageupload.imageupload();
  </script>
<style>
.monthselect, .yearselect{
	color:green;
}
input[type=text]:focus, textarea:focus {
  -moz-box-shadow: 0 0 9px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
</style>