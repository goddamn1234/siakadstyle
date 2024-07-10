<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
			<h2>Please! be carefully to upload bulk data, cek again your data like primary key and unique Identifier.<br>
			Replace all special character with normal character</h2> <br></div>
             <br>
             1. Prepare the XLSX file that contains the <b><i>Student</b></i>, <b><i>Parent</b></i> or <b><i>Teacher</b></i> information you need to import<br>
             (Please take care of spelling errors and that the correct information is entered into the correct columns.)<br>
                                       <ul id="sublist">
                                        <li>a. Download or open the appropriate sample XLSX file: <a href="/index.php?r=importcsv/default/download&amp;id=stdcsv" target="_top"><span><b><i>Student Import</b></i></span></a>&nbsp; &nbsp;and &nbsp;  <a href="/index.php?r=importcsv/default/download&amp;id=empcsv" target="_top"><span><b><i>Teacher Import</b></i></span></a></li>
                                        <li>b. Now capture the information to be imported as indicated in the XLSX file</li>
                                        <li>c. Save the file to your computer as a comma delimited XLSX file - just follow the prompts as given by Excel.</li>
                                     </ul>

            2. Now click on "Browse" XLSX File. Browse to the just saved document (XLSX file) and select it. Click on "Open"<br>
            3. Ensure that the first field - "Fields Delimiter" is set as a ";" and that the correct import mode is selected ("Students Details" or "Teacher Details")<br>
            4. Click on "Next"<br>
            5. Now match the fields on the right (from the csv file) with the fields on the left (from the database). Do not rush. Ensure no mismatches are made!<br>
            6. Select Data Destination Type will you import, after select data -> Click on "Import" Button. <br>          

			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">
		<?php echo form_open_multipart('master/import',array('class'=>'form-horizontal','id'=>'import_form'));?>
			
			<div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-12">
					<select name="table" id="table" class="form-control">
						<option value="kosong"> Choose Data </option>
						<option value="student"> Data Student </option>
						<option value="parent"> Data Parent </option>
						<option value="guru"> Data Teacher </option>
						<option value="principal"> Data principal </option>
					</select>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" readonly placeholder="select file to upload"> 
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" name="userfile" id="userfile" name="input-file-preview"/>
                    </div>
                </span>
            </div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<button type="button" class="btn btn-primary" id="upload" name="upload"><i class="fa fa-upload"></i> Import </button>
				</div>
			</div>
			
			
		<?php echo form_close();?>
		<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Import Result</div>
			</div>
			<div class="panel-body">
				<div id="loading" style="display:none;text-align:center">
				<?php echo img(array('src'=>'image/spinner.gif'));?>
				</div>
				<div id="result">
				</div>
			</div>
		</div>
		</div>
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
		
<style>

.image-preview-input {
    position: relative;
	overflow: hidden;
	margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#upload").click(function(){
		var formdata = new FormData();      
		var file = $('#userfile')[0].files[0];
		formdata.append('fFile', file);
		$.each($('#import_form').serializeArray(), function(a, b){
        formdata.append(b.name, b.value);
		});
		$.ajax({
			url :"<?php echo site_url();?>/master/import",
				type:"post",
				data:formdata,
				processData: false,
				contentType: false,
				beforeSend:function(){
					$("#loading").css('display','block');
					$("#result").html(' ');
				},
				success:function(respon){
					$("#loading").css('display','none');
					$("#result").html(respon);
				},
				error:function(){
					$("#loading").css('display','none');
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan Penambahan data'
					});
				}
		})
	});

$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'tutup',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});

})
</script>
