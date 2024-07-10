<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th style="width:5px"> No </th>
					<th> PMD</th>
					<th> Category</th>
					<th> Periode</th>
					<th> Objective</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr>
						<td ><?php echo $no;?></td>
						<td><?php echo strtoupper($row->flag_fmp);?></td>
						<td><?php echo $row->nama_category;?></td>
						<td><?php echo $row->periode;?></td>
						<td><?php echo $row->nama_fmp;?></td>
						<td><button type="button" class="btn btn-primary btn-xs" onClick="edit('<?php echo $row->id_fmp;?>')"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-xs" onClick="del('<?php echo $row->id_fmp;?>')"><i class="fa fa-trash"></i></button></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable2').dataTable();
			
	});
        </script>