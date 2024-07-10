<input type="hidden" id="id_assign" value="<?php echo $id_assign;?>" />
<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
                    <th> Student</th>
					<th> Grade</th>
					<th> Subject</th>
					<th> Periode</th>
					<th> Academic</th>
					<th> Result</th>
					<th> Informasi</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($raport->result() as $row){
					  if ($row->id_mapel == 27){
						  $result = $row->result_fmp;
					  }else{
						  $result = $row->result;
					  }
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->id_number." | ".$row->full_name;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->periode;?></td>
						<td><?php echo $row->tahun_akademik;?></td>
						<td valign="middle"><a href="#" class="btn btn-<?php if ($result == 'none'){echo 'info';}else if($result == 'pass'){echo 'primary';}else{echo 'danger';}?> btn-xs"> <?php echo $result;?> </a></td>
						<td><?php echo $row->keterangan;?></td>						
						<td>
						<button <?php echo $otoU; ?> class="btn btn-primary btn-xs" type="button" onclick="nilai(<?php echo $row->id_raport_result;?>)" data-toggle="tooltip" data-placement="top" title="cek"><i class="fa fa-external-link-square"></i></button>
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