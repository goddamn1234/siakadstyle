<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> ID Number</th>
                    <th> Full Name</th>
                   	<th> Nama<br>Kelas </th>
					<th> Guru Pengampu </th>
					<th> Nama Mata Pelajaran</th>
					<th> Fasilitator/<br>Wali kelas</th>
					<th> Tanggal<br>Daftar</th>
					<th> Status</th>
					<th> Keputusan</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  if ($row->status=='selesai') $st_btn="disabled";
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->id_number;?></td>
						<td><?php echo $row->nmurid;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->nguru;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->nwali;?></td>
						<td><?php echo date('d-M-Y h:i',strtotime($row->tgl_daftar));?></td>
						<td><?php if ($row->status=='0'){ ?> 
						       <label class="label label-primary"> Ditinjau </a>
						    <?php } else if ($row->status=='1'){ ?>
						        <label class="label label-success"> Diterima </a>
						    <?php } else if ($row->status=='2'){ ?>
								<label class="label label-danger"> Ditolak </a>
							<?php }?>
						</td>
						<td>
							<button title="Diterima" class="btn btn-sm btn-success" onclick="terima(<?php echo $row->id_krs;?>)"><i class="glyphicon glyphicon-ok"></i></button>
						    &nbsp;<button title="Ditolak" class="btn btn-sm btn-danger" onclick="tolak(<?php echo $row->id_krs;?>)"><i class="glyphicon glyphicon-remove"></i></button>
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