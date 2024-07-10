<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Periode</th>
                    <th> Mata Pelajaran</th>
                    <th> Jenjang</th>
                    <th> Kelas</th>
                    <th> Guru di Periode Ini</th>
                    <th> Guru Sekarang</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nperiode.'  '.$row->tahun_akademik;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->full_name2;?></td>
						<td><?php echo $row->full_name;?></td>
						<td>
						<?php
							?>
							<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_assign;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_assign;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
						<?php	 
						?>
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