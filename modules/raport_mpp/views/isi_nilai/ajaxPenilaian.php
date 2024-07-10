<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Nama Pelajaran</th>
					<th> Nama Kelas</th>
					<th> Nama Jenjang</th>
					<th> Spesialis Mata Pelajaran</th>
					<th> Periode</th>
					<th align="center">Jumlah<br>Siswa</th>
					<th> Action</th>
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
						<td><?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php echo $row->periode.' '.$row->tahun_akademik;?></td>
						<td align="center"><?php echo $row->jumlah;?></td>
						<td>
					       <a href="daftar_nilai?p=<?php echo $row->id_mapel ?>&k=<?php echo $row->kelas?>&pr=<?php echo $periode?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a>	    
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