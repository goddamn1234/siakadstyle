<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Tanggal</th>
                    <th> Jam</th>
                    <th> Keperluan</th> 
                    <th> Status</th> 
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo date('d-m-Y', strtotime($row->tgl)); ?></td>
						<td><?php echo date('H:i',strtotime($row->jam));?></td>
						<td><?php echo $row->keperluan;?></td>	
						<td><?php if ($row->status==0) echo 'Diajukan'; else if ($row->status=='1') echo 'Disetujui'; else if ($row->status=='2') echo 'Ditolak';?></td>
						<td>
						<?php
							?>
								<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
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