<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Tipe mata pelajaran</th>
                    <th> Mata Pelajaran</th>
					<th> Guru Pengampu</th>
					<th> Hasil Penilaian</th>
					<th> Konversi</th>
					<th> Lihat Nilai & Edit</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_tipe;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td></td>
						<td><?php echo $row->nilai;?></td>
						<td><?php echo $row->konversi?></td>
						<td>
					       <a href="pengisian_nilai?m=<?php echo $row->id_number ?>&p=<?php echo $row->id_mapel?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a>	    
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