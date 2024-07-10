<?php
if($resulted->submit_teacher == 1){
		$is_submited = 'disabled';
	}else{
		$is_submited = '';
	}
?>
<table id="datatable3" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Subject</th>
			<th>Category</th>
			<th>PMD</th>
			<th>Learning Project</th>
			<th>Result</th>
		</tr>
	</thead>
			<tbody>
			<?php 
				  foreach($pmd->result() as $row){?>
					  <tr>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->nama_category;?></td>
						<td><?php echo $row->flag_pmd;?></td>
						<td><?php echo $row->nama_pmd;?></td>
						<td>
							<select name="result_pmd" id="result_pmd<?php echo $row->id_learning; ?>" onChange="result_pmd('<?php echo $row->id_learning;?>')" class="form-control" <?php echo $is_submited; ?> >
							<?php 
							if($row->pmd_result == 'Y'){$sks = "selected";}else{$sks='';}
							if($row->pmd_result == 'N'){$ggl = "selected";}else{$ggl='';}
							?>
							<option value="Y" <?php echo $sks; ?>> Y </option>
							<option value="N" <?php echo $ggl; ?>> N </option>
							</select>
						</td>
					  </tr>
				  <?php  }  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable3').dataTable();
            
          });
        </script>