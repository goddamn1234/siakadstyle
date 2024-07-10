<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style type="text/css">@import url("<?php echo base_url() . 'addon/image-upload/bootstrap-imageupload.css'; ?>");</style>
<div class="col-md-12 col-sm-12 col-xs-12">
                  <br />
    <form method="post" action="editprofil" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" autocomplete="off">
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
		<div class="col-md-12">
			<fieldset>
				<legend>Change Password</legend>
				<div class="col-md-12">
				<label class="col-md-4">New Password</label>
				<input type="password" class="form-control col-md-8" name="password" id="password" />
				</div>
				<div class="col-md-12">
				<label class="col-md-4">Confirmation Password</label>
				<input type="password" class="form-control col-md-8" name="password2" id="password2" />
				</div>
			</fieldset>
			<input type="hidden" name="id" value="<?php echo $user->id_user;?>" />
		</div>
	</div>
	
                    
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                    </div>

                  </form>
            </div>
  <!-- input mask -->
  <script type='text/javascript' src="<?php echo base_url(); ?>addon/image-upload/bootstrap-imageupload.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
		
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
</style>