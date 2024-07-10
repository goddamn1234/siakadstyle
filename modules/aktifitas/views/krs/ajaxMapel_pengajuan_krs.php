<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Mata Pelajaran</th>
                    <th> Kelas</th>
                    <th> Guru Pengampu</th>
                    <th> Jml Pengajuan KRS</th>
                    <th> Lihat Pengajuan KRS</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php echo $row->jml?></td>
						<td><a href="pengajuan_krs?pel=<?php echo $row->id_mapel ?>&p=<?php echo $row->periode ?>" class="btn btn-sm btn-primary"> Lihat Pengajuan</a></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>