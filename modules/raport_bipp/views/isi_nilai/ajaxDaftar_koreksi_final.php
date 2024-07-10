<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
					<th> NIS</th>
                    <th> Nama Murid</th>
					<th> Nama Kelas</th>
					<th> Periode</th>
					<th> Hasil Penilaian</th>
					<th> Catatan Final</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->id_number;?></td>
						<td><?php echo $row->nmurid;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->periode.' '.$row->tahun_akademik;?></td>
						<td><a href="lihat_nilai?m=<?php echo $row->id_number ?>&f=1&pr=<?php echo $periode?>" class="btn btn-sm btn-primary">Lihat Semua Nilai</a>	</td>
						<td>
					       <input size="20" value="<?php echo $row->catatan?>"><button class="btn btn-info btn-xs" type="button" onclick="edit_catatan(<?php echo $row->id_number;?>,<?php echo $periode;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>   
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