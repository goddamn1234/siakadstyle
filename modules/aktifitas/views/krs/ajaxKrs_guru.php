<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Tipe Mata Pelajaran</th>
                    <th> Periode</th>
                    <!-- <th> Tipe Raport</th> -->
                    <th> Daftar KRS</th>
                    <th> Status Periode</th>
					<th> Jml KRS</th>
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
						<!-- <td>RAPORT MPP</td> -->
						<td><a href="pengajuan_mapel_krs?tipe=<?php echo $row->id_tipe ?>&p=<?php echo $row->id_raport_periode ?>" class="btn btn-sm btn-primary" <?php echo $st_btn?>> Lihat Pengajuan</a></td>
						<td><?php if ($row->status=='selesai') {?>
						        <span class="label label-danger" style="font-size:13px">Selesai</span>
						    <?php }	else { ?>
								<span class="label label-success" style="font-size:13px">Aktif</span>
							<?php } ?>
							</td>
						<td><?php echo $row->jml?></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>