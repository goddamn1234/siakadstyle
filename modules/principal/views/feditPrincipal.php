<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style type="text/css">@import url("<?php echo base_url() . 'image-upload/bootstrap-imageupload.css'; ?>");</style>
<div class="col-md-12 col-sm-12 col-xs-12">
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
	<fieldset><legend>Form Registration <span class="pull-right"><small>Form with (*) is required</small></span></legend>
	<div class="col-md-3 col-sm-3">
	<div class="form-group">
        <div class="panel panel-default">
			<div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">Image</h3>
            </div>
			<div class="panel-body">
			<div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" name="userfile" id="userfile">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
		<?php echo img(array('id'=>'img-upload','src'=>'image/principal/'.$principal->image));?>
		</div>
		</div>
    </div>

		<div class="form-group">
        <div class="panel panel-default">
			<div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">Signature</h3>
            </div>
			<div class="panel-body">
			<div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" name="userfile_sign" id="userfile_sign">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
		<?php echo img(array('id'=>'img-upload2','src'=>'image/principal/'.$principal->signature));?>
		</div>
		</div>
    </div>


	
	</div>
	<div class="col-md-9 col-sm-9 col-sm-12">
		<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">ID Number <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="hidden" id="id_user" name="id_user" value="<?php echo $principal->id_user;?>" >
				<input type="text" id="id_number" name="id_number" required="required" class="form-control number" value="<?php echo $principal->id_number;?>" >
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Full name <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="full_name" name="full_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $principal->full_name;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Spouse name</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="spouse_name" name="spouse_name" class="form-control col-md-7 col-xs-12" value="<?php echo $principal->spouse_name;?>" >
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Birth Place <span class="required">*</span></label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="birth_place" name="birth_place" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $principal->birth_place;?>" >
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Date of Birth <span class="required">*</span></label>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<input type="text" id="birth_date" name="birth_date" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo date('Y-m-d',strtotime($principal->birth_date));?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Home Address <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<textarea name="address" id="address" required="required" class="form-control col-md-7 col-xs-12" placeholder="detail address"><?php echo $principal->address;?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phone <span class="required">*</span></label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="phone1" name="phone1" required="required" class="form-control number" value="<?php echo $principal->phone1;?>" >
			</div>
			<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Phone2</label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="phone2" name="phone2" class="form-control number" value="<?php echo $principal->phone2;?>" >
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nationality <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="nationality" id="nationality" class="select2_single form-control">
				<option value="<?php echo $principal->num_code;?>"><?php echo $principal->reg;?></option>
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
				<option value="<?php echo $principal->id_religion;?>"><?php echo $principal->religion_name;?></option>
				</select>
			</div>
		</div>
	
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Role <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
			<select name="role" id="role" class="form-control">
				<option value="<?php echo $principal->role;?>"><?php echo $principal->nama_role;?></option>
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
		if(id_number != '' || role != '0' || full_name != '' || birth_place != '' || birth_date != '' || address != '' || phone != '' || nationality !='0' || religion != ''){
			var formdata = new FormData();      
			var file = $('#userfile')[0].files[0];
				formdata.append('fFile', file);
				// $.each($('#demo-form2').serializeArray(), function(a, b){
				// formdata.append(b.name, b.value);
				// });
			var file2 = $('#userfile_sign')[0].files[0];
				formdata.append('fFile_sign', file2);
				$.each($('#demo-form2').serializeArray(), function(a, b){
				formdata.append(b.name, b.value);
				});
			$.ajax({
				url :"<?php echo site_url();?>/principal/proses_principal",
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
					$("#isi").load('ajaxprincipal');
					$("#id_user").val('kosong');
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
		}else{
			Lobibox.alert('error', {
				position: 'top left',
				msg: 'Periksa kembali inputan anda',
			});
		}
		
	});

	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		function readURL2(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload2').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#userfile").change(function(){
		    readURL(this);
		});

		$("#userfile_sign").change(function(){
		    readURL2(this);
		});
		
});
	var $imageupload = $('.imageupload');
    $imageupload.imageupload();
  </script>
<style>
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
  width: 120px;
  color: rgba(0, 0, 0, 0.6);
  font-size: 14px;
  font-weight: normal;
  text-align: center;
  text-shadow: none;
  padding: 6px 14px;
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
.monthselect, .yearselect{
	color:green;
}
input[type=text]:focus, textarea:focus {
  -moz-box-shadow: 0 0 9px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload, #img-upload2{
    width: 205px;
	border:1px solid lightblue;
	padding:1px;
}
</style>