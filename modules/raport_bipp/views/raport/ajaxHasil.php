<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
					<th> Nama Kelas</th>
					<th align="center"> Jumlah Raport Siswa</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td align="center"><?php echo $row->jml;?></td>
						<td>
					       <a href="daftar_raport?k=<?php echo $row->id_kelas?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a>	    
						</td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>