<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Mata Pelajaran</th>
					<th> Tingkat</th>
					<th> Required Point</th>
					<th> Set PMD</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td>Grade-<?php echo $row->tingkat_kelas;?></td>
						<td><?php echo $row->achiev_point;?></td>
						<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="setpmd(<?php echo $row->id_mapel;?>)" data-toggle="tooltip" data-placement="top" title="Set PMD"><i class="fa fa-cog"></i></button>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
          });
        </script>