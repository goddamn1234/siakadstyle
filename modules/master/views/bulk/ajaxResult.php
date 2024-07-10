<table id="datatable2" class="table table-striped table-bordered">
			<tbody>
			<tr>
				<td>Success</td>
				<td><?php echo $success;?></td>
			</tr>
			<tr>
				<td>Failed</td>
				<td><?php echo $failed['jml'];?></td>
			</tr>
			<tr>
				<td>Failed List</td>
				<td>
					<?php
				  foreach($failed['data'] as $row){
						echo $row.", ";
				  }  ?>
				</td>
			</tr>
			
			</tbody>
</table>