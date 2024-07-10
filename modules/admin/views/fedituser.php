<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style type="text/css">@import url("<?php echo base_url() . 'image-upload/bootstrap-imageupload.css'; ?>");</style>
<div class="col-md-12 col-sm-12 col-xs-12">
                  <br />
    <form method="post" action="edituser" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
	<fieldset><legend>Edit Form <span class="pull-right"><small>Form with (*) is required</small></span></legend>
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
                    Browse… <input type="file" id="imgInp" name="userfile">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
		<?php echo img(array('id'=>'img-upload','src'=>'image/user/'.$user->image));?>
		</div>
		</div>
		
        
        
    </div>
	</div>
	<div class="col-md-9 col-sm-9 col-sm-12">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">ID Number <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
			<input type="hidden" id="id_user" name="id_user" value="<?php echo $user->id_user;?>">
				<input type="text" id="id_number" name="id_number" required="required" class="form-control number" value="<?php echo $user->id_number;?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Full name <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="full_name" name="full_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $user->full_name;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Spouse name</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="spouse_name" name="spouse_name" class="form-control col-md-7 col-xs-12" value="<?php echo $user->spouse_name;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Birth Place <span class="required">*</span></label>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<input type="text" id="birth_place" name="birth_place" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $user->birth_place;?>">
			</div>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Date of Birth <span class="required">*</span></label>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<input type="text" id="birth_date" name="birth_date" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo date('d-m-Y',strtotime($user->birth_date));?>" readonly>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Home Address <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<textarea name="address" id="address" required="required" class="form-control col-md-7 col-xs-12"><?php echo $user->address;?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phone <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="phone1" name="phone1" required="required" class="form-control col-md-7 col-xs-12 number" value="<?php echo $user->phone1;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phone 2</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="phone2" name="phone2" class="form-control col-md-7 col-xs-12 number" value="<?php echo $user->phone2;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nationality <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="nationality" id="nationality" class="select2_single form-control">
				<option value="<?php echo $user->num_code;?>"> <?php echo $user->reg;?> </option>
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
				<option value="<?php echo $user->id_religion;?>"> <?php echo $user->religion_name;?> </option>
				</select>
			</div>
		</div>
	
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Role <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
			<select name="role" id="role" class="form-control">
				<option value="<?php echo $user->id_role;?>"> <?php echo $user->nama_role;?> </option>
			</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
            </div>
		</div>
	</div>
	
	</fieldset>
	</form>
            </div>
  <!-- input mask -->
  <script type='text/javascript' src="<?php echo base_url(); ?>image-upload/bootstrap-imageupload.js"></script>
    <!-- Auto numeric -->
<script type='text/javascript' src="<?php echo base_url(); ?>autonumeric/autoNumeric.js"></script>
<!-- Datepicker -->
<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datepicker/daterangepicker.js"></script>
<!-- Select 2 -->
<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/select/select2.full.js"></script>
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
	  });
	  
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
	
	$('#birth_date').daterangepicker({
        singleDatePicker: true,
		showDropdowns: true,
		maxDate:new Date(),
		format:"DD-MM-YYYY",
        calender_style: "picker_3"
    });
	$(".select2_single").select2();
	  
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

		$("#imgInp").change(function(){
		    readURL(this);
		}); 

    });
  </script>
<style>
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

#img-upload{
    width: 205px;
	border:1px solid lightblue;
	padding:1px;
}
.monthselect, .yearselect{
	color:green;
}
input[type=text]:focus, textarea:focus {
  -moz-box-shadow: 0 0 9px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
</style>