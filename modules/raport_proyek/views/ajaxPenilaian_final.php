<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> NIS</th>
                    <th> Nama Siswa</th>
                    <th> Kelas</th>
                    <th> Jenjang</th>
                    <th> Periode</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->murid;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->nama_periode.' '.$row->tahun_akademik;?></td>
						<td>
							<a href="daftar_proyek_murid?m=<?php echo $row->murid;?>&p=<?php echo $row->periode;?>&f=1" class="btn btn-primary btn-sm">Lihat Proyek</a>
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