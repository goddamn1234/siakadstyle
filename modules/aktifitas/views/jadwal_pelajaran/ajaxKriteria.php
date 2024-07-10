<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
                    <th> Tipe Mata Pelajaran</th>
                    <th> Periode</th>
                    <th> Tipe Raport</th>
                    <th> Daftar Pelajaran</th>
                    <th> Status Periode</th>
					<th> Status Pendaftaran</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  if ($row->status=='selesai') $st_btn="disabled"; else $st_btn="";
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_tipe;?></td>
						<td><?php echo $row->periode.' '.$row->tahun_akademik;?></td>
						<td>RAPORT MPP</td>
						<td><a href="daftar_krs?tipe=<?php echo $row->id_tipe ?>&p=<?php echo $row->id_raport_periode ?>" class="btn btn-sm btn-primary" <?php echo $st_btn?>> Lihat & Daftar</a></td>
						<td><?php if ($row->status=='selesai') {?>
						        <span class="label label-danger" style="font-size:13px">Selesai</span>
						    <?php }	else { ?>
								<span class="label label-success" style="font-size:13px">Aktif</span>
							<?php } ?>
							</td>
						<td><a href="status_krs?tipe=<?php echo $row->id_tipe ?>&p=<?php echo $row->id_raport_periode ?>" class="btn btn-sm btn-primary" <?php echo $st_btn?>><i class="glyphicon glyphicon-search"></i></a></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>