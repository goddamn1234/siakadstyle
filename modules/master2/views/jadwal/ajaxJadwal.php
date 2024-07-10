<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
 				    <th> Nama Pelajaran</th>
 				    <th> Periode</th>
 				    <th> Guru</th>
 				    <th> Kelas</th>
                    <th> Hari</th>
					<th> Jam</th>
					<th></th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->nperiode.' , '.$row->tahun_akademik;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<?php if ($row->hari=='1') $nh='Senin';
						      else if ($row->hari=='2') $nh='Selasa';
						      else if ($row->hari=='3') $nh='Rabu';
						      else if ($row->hari=='4') $nh='Kamis';
						      else if ($row->hari=='5') $nh='Jumat';
						      else if ($row->hari=='6') $nh='Sabtu';
						      else if ($row->hari=='7') $nh='Minggu';
						?>    
						<td><?php echo  $nh?></td>
						<td><?php echo  $row->dari.' - '.$row->sampai?></td>
						<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_jadwal;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_jadwal;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
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