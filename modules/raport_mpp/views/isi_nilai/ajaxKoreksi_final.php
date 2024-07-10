<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Nama Kelas</th>
					<th> Jenjang Pendidikan</th>
					<th> Jumlah</th>
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
						<td><?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->jml;?></td>
						<td><a href="daftar_koreksi_final?k=<?php echo $row->id_kelas?>&pr=<?php echo $periode?>" class="btn btn-sm btn-primary">Lihat Semua Siswa</a>	</td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>