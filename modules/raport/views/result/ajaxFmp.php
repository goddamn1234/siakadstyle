<?php 
if($result->submit_teacher == 1){
		$is_submit = 'disabled';
	}else{
		$is_submit = '';
	}
if($is_pmd == 0){
		$pasif = "style=display:none";
		$aktif = "style=display:block";
	}else{
		$pasif = "style=display:block";
		$aktif = "style=display:none";
	}
	
?>
<table class="table" style="margin:auto">
	<tr>
		<td>NIS</td>
		<td><?php echo $student->id_number; ?></td>
	</tr>
	<tr>
		<td>Fullname</td>
		<td><?php echo $student->full_name; ?></td>
	</tr>
</table>
<hr>
<div class="panel panel-primary">
	<div class="panel-heading">Project Report</div>
	<div class="panel panel-body">
<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> Subject</th>
					<th> Criteria</th>
					<th> Learning Cycle</th>
					<th> Objective</th>
					<th> Achieved</th>
				</tr>
            </thead>
			<tbody>
			<?php 
				  foreach($list->result() as $row){?>
					  <form class="form-horizontal" id="form<?php echo $row->id_fmp;?>" >
					  <tr>
						<td>Final Major Project</td>
						<td><?php echo $row->flag_fmp;?></td>
						<td><?php echo $row->nama_category;?></td>
						<td><?php echo $row->nama_fmp;?></td>
						<td>
							<select name="result" id="result<?php echo $row->id_raport_fmp; ?>" onChange="result('<?php echo $row->id_raport_fmp;?>')" class="form-control" <?php echo $is_submit; ?> >
							<?php 
							if($row->fmp_result == 'Y'){$sks = "selected";}else{$sks='';}
							if($row->fmp_result == 'N'){$ggl = "selected";}else{$ggl='';}
							?>
							<option value="Y" <?php echo $sks; ?>> Y </option>
							<option value="N" <?php echo $ggl; ?>> N </option>
							</select>
						</td>
					  </tr>
					  </form>
				  <?php  }  ?>
			</tbody>
</table>
	</div>
</div>
<button type="button" class="btn btn-warning btn-xs aktif" <?php echo $aktif." "; if($student->submit_teacher ==1){echo 'disabled';} ?>>Use PMD Report</button>
<button type="button" class="btn btn-warning btn-xs pasif" <?php echo $pasif." "; if($student->submit_teacher ==1){echo 'disabled';} ?>>Dont Use PMD Report</button>
<div class="panel panel-primary">
	<div class="panel-heading">Learning Report</div>
	<div class="panel-body" id="render_pmd">
	
	
	
	</div>
</div>
<div class="col-md-6">
<form id="final" >
<input type="hidden" id="id_raport_result" name="id_raport_result" value="<?php echo $result->id_raport_result;?>" />
<input type="hidden" id="id_assign" name="id_assign" value="<?php echo $id_assign;?>" />

	<div class="form-group">
	<label >Project Result</label>
		<input type="text" class="form-control" name="last_result" id="last_result" value="<?php echo $result->result_fmp;?>" readonly />
	</div>
	<div>
	<label >Learning Result</label>
		<input type="text" class="form-control" name="learning_result" id="learning_result" value="<?php echo $result->result_pmd;?>" readonly />
	</div>

	<div class="form-group">
	<label>Message</label>
		<textarea name="desc" id="desc" class="form-control" <?php echo $is_submit; ?> ><?php if($result->keterangan != NULL){
			echo $result->keterangan;}?></textarea>
	</div>
	
	<div class="form-group">
	<label> </label>
		<button type="button" class="btn btn-primary" id="save" <?php echo $is_submit; ?> ><i class="fa fa-save"></i> Save </button>
	</div>
	
</form>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var result = $("#id_raport_result").val();
	var assign = $("#id_assign").val();
	$.ajax({
			url :"<?php echo site_url();?>/raport/ajaxPmd",
			type:"post",
			data:"id_raport_result="+result+"&id_assign="+assign,
			success:function(respon){
				$("#render_pmd").html(respon);
			}
	});
	
	$(".aktif").click(function(){
		var id_result = $("#id_raport_result").val();
		var id_assign = $("#id_assign").val();
		$.ajax({
			url :"<?php echo site_url();?>/raport/gen_pmd",
			type:"post",
			data:"id_raport_result="+id_result+"&id_assign="+id_assign,
			success:function(respon){
				$(".pasif").css('display','block');
				$(".aktif").css('display','none');
				$("#render_pmd").html(respon);
			}
		});
	});
	$(".pasif").click(function(){
		var id_result = $("#id_raport_result").val();
		var id_assign = $("#id_assign").val();
		$.ajax({
			url :"<?php echo site_url();?>/raport/del_pmd",
			type:"post",
			data:"id_raport_result="+id_result+"&id_assign="+id_assign,
			success:function(respon){
				$(".pasif").css('display','none');
				$(".aktif").css('display','block');
				$("#render_pmd").html(respon);
			}
		});
	});
	
	$("#save").click(function(){
		var id_result = $("#id_raport_result").val();
		var id_assign = $("#id_assign").val();
		var desc = $("#desc").val();
		Lobibox.confirm({
		 title: "Are you sure ?",
		 msg: "If result Submited, You cannot edit this data anymore !",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url();?>/raport/last_result",
					type:"post",
					data:"id_raport_result="+id_result+"&id_assign="+id_assign+"&desc="+desc,
					success:function(respon){
						$("#isi").html(respon);
					}
				})
			}
		}
		})
		
	})
            
});

function result(id){
	var result = $("#result"+id).val();
	var id_raport_result = $("#id_raport_result").val();
	var id_assign = $("#id_assign").val();
	$.ajax({
			url :"<?php echo site_url();?>/raport/save_fmp",
			type:"post",
			data:"id_raport_fmp="+id+"&result="+result+"&id_assign="+id_assign+"&id_raport_result="+id_raport_result,
			dataType:"JSON",
			success:function(respon){
				Lobibox.notify('success',{
					msg : 'Data Berhasil di Update',
					size: 'mini',
					delay:1000
				});
				if(respon.merit == 'yes'){
					
				}
				$("#last_result").val(respon.last_result);
			}
		});
}

function result_pmd(id){
	var result = $("#result_pmd"+id).val();
	var id_raport_result = $("#id_raport_result").val();
	var id_assign = $("#id_assign").val();
	$.ajax({
			url :"<?php echo site_url();?>/raport/save_pmd",
			type:"post",
			data:"id_learning="+id+"&result="+result+"&id_assign="+id_assign+"&id_raport_result="+id_raport_result,
			dataType:"JSON",
			success:function(respon){
				Lobibox.notify('success',{
					msg : 'Data Berhasil di Update',
					size: 'mini',
					delay:1000
				});
				$("#learning_result").val(respon.learning_result);
			}
		});
}
</script>