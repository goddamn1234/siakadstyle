<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Subject</th>
					<th> Jadwal Pelajaran</th>
					<th> Jenjang Pendidikan</th>
					<th> Tingkat Kelas</th>
					<th> Nama Kelas</th>
					<th> Tipe Raport</th>
					<th> Tipe Mata Pelajaran</th>
					<th> Metode Penilaian</th>
					<th> Status</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  if($row->status == 'active'){
						  $flag = 'primary';
					  }else{
						  $flag = 'danger';
					  }
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td align="center"><a href="jadwal?p=<?php echo $row->id_mapel ?>"  class="btn btn-info btn-xs" >Lihat</a></td>
						<td><?php echo $row->nama_jenjang;?></td>
						<td>Year <?php echo $row->tingkat;?></td>
						<td><?php echo $row->nama_kelas;?></td>
                        <td><?php echo $row->nama_tipe_raport;?></td>
                        <td><?php echo $row->nama_tipe_pelajaran;?></td>
                        <td><?php if ($row->metode==1) echo 'POIN'; else echo 'FIX SYARAT';?></td>
						<td><button type="button" class="btn btn-<?php echo $flag;?> btn-xs"> <?php echo $row->status;?></button></td>
						<td>
						<?php
							if($row->id_mapel != 27){?>
								<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_mapel;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_mapel;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
						<?php	}
						?>
						
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>