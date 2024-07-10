<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Jalur Pendidikan</th>
					<th> Jenis Pendidikan</th>
					<th> Jenjang Pendidikan</th>
					<th> Tingkat</th>
                    <th> Nama Kelas</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_jalur;?></td>
						<td><?php echo $row->nama_jenis;?></td>
						<td><?php echo $row->nama_jenjang;?></td>
						<td>Year <?php echo $row->tingkat;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_kelas;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_kelas;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>