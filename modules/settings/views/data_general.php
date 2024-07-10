<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data = [];
foreach($general->result() as $key => $val){
    $data[$val->name] = $val->value;
}

?><!DOCTYPE html>
<style type="text/css">@import url("<?php echo base_url() . 'addon/image-upload/bootstrap-imageupload.css'; ?>");</style>
<div class="col-md-12 col-sm-12 col-xs-12">
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
	<fieldset><legend> <span class="pull-right"><small>Form with (*) is required</small></span></legend>
	<div class="col-md-3 col-sm-3">
	<div class="form-group">
        <div class="panel panel-default">
			<div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">Stempel</h3>
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
		<?php echo img(array('id'=>'img-upload','src'=>'image/settings/'.$data['school_stamp']));?>
		</div>
		</div>
    </div>

	
	</div>
	<div class="col-md-9 col-sm-9 col-sm-12">
		<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">School Name <span class="required">*</span></label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="school_name" name="school_name" required="required" class="form-control number" value="<?php echo  $data['school_name'];?>" >
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">School Address</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="school_address" name="school_address" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $data['school_address'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">School Telp</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="school_telp" name="school_telp" class="form-control col-md-7 col-xs-12" value="<?php echo $data['school_telp'];?>" >
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">School Email</label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" id="school_email" name="school_email" class="form-control col-md-7 col-xs-12" value="<?php echo $data['school_email'];?>" >
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
<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/input_mask/jquery.inputmask.js"></script>

  <script type='text/javascript' src="<?php echo base_url(); ?>addon/image-upload/bootstrap-imageupload.js"></script>
  <!-- Auto numeric -->
<script type='text/javascript' src="<?php echo base_url(); ?>addon/autonumeric/autoNumeric.js"></script>
<!-- Datepicker -->
<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datepicker/daterangepicker.js"></script>
<!-- Select 2 -->
<script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/select/select2.full.js"></script>
 <script type="text/javascript">
$(document).ready(function() {
	
	
	$("#save").click(function(){
		var school_name = $("#school_name").val();
		
		if(school_name != ''){
			var formdata = new FormData();      
			var file = $('#userfile')[0].files[0];
            formdata.append('fFile', file);
            $.each($('#demo-form2').serializeArray(), function(a, b){
            formdata.append(b.name, b.value);
            });
			
			$.ajax({
				url :"<?php echo site_url();?>/settings/save",
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