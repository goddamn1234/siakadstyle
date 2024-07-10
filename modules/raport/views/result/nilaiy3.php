<div class="panel panel-primary">
	<div class="panel-heading">Student Value</div>
	<div class="panel panel-body">
<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> NIS</th>
					<th> Nama Siswa </th>
					<th> Subject </th>
					<th> Score </th>
					<th> Result </th>
					<th> Notes </th>
				</tr>
            </thead>
			<tbody>
		<form class="form-horizontal">
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr>
						<td><?php echo $row->id_number;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->score;?></td>
						<td>
							<select name="result" id="result<?php echo $row->id_raport_result; ?>" onChange="result('<?php echo $row->id_raport_result;?>')" class="form-control" <?php echo $is_submit; ?> >
							<?php 
							if($row->result == 'none'){$none = "selected";}else{$none='';}
							if($row->result == 'not accomplished'){$ggl = "selected";}else{$ggl='';}
							if($row->result == 'pass'){$sks = "selected";}else{$sks='';}
							?>
							<option value="none" <?php echo $none; ?>> None </option>
							<option value="pass" <?php echo $sks; ?>> Y </option>
							<option value="not accomplished" <?php echo $ggl; ?>> N </option>
							</select>
						</td>
						<td>
							<input type="text" class="form-control" />
						</td>
					  </tr>
				  <?php $no++; };  ?>
		</form>
			</tbody>
			
</table>
	</div>
</div>
<div class="col-md-6">
<form id="final" >
<input type="hidden" id="id_raport_result" name="id_raport_result" value="<?php echo $result->id_raport_result;?>" />
<input type="hidden" id="id_assign" name="id_assign" value="<?php echo $id_assign;?>" />

	<div class="form-group">
	<label >Last Result</label>
		<input type="text" class="form-control" name="last_result" id="last_result" value="<?php echo $result->result;?>" readonly />
	</div>

	<div class="form-group">
	<label>Message</label>
		<textarea name="desc" id="desc" class="form-control"  ><?php if($result->keterangan != NULL){
			echo $result->keterangan;}?></textarea>
	</div>
	
	<div class="form-group">
	<label> </label>
		<button type="button" class="btn btn-primary" id="save" ><i class="fa fa-save"></i> Save </button>
	</div>
	
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#save").click(function(){
		Lobibox.confirm({
		 title: "Are you sure ?",
		 msg: "If result Submited, You cannot edit this data anymore !",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url();?>/raport/last_result",
					type:"post",
					data:$("#final").serialize(),
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
			url :"<?php echo site_url();?>/raport/save_point",
			type:"post",
			data:"id_raport_detail="+id+"&result="+result+"&id_assign="+id_assign+"&id_raport_result="+id_raport_result,
			dataType:"JSON",
			success:function(respon){
				Lobibox.notify('success',{
					msg : 'Data Berhasil di Update',
					size: 'mini',
					delay:1000
				});
				$("#last_result").val(respon.last_result);
			}
		});
}
</script>