<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
                    <th> ID Number</th>
                    <th> Full Name</th>
                    <th> Guru Pengampu</th>
                    <th> Nama Mata Pelajaran</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  if ($row->status=='selesai') $st_btn="disabled"; else $st_btn="";
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->id_number;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php echo $guru->full_name;?></td>
						<td><?php echo $mapel->nama_mapel;?></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>