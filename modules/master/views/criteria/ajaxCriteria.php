<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Grade </th>
                    <th> Subject</th>
					<th> Category</th>
					<th> P Ke-</th>
					<th> Criteria</th>
					<th> point</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
						<td><?php echo $no;?></td>
						<td>Year <?php echo $row->tingkat_kelas;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->nama_category;?></td>
						<td><?php echo $row->flag;?></td>
						<td><?php echo $row->nama_criteria;?></td>
						<td><?php echo $row->point_criteria;?></td>
						<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_criteria;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_criteria;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>