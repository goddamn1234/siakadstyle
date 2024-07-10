<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Mata Pelajaran</th>
                    <th> Guru Pengampu</th>
                    <th> Status </th>
					<th> Kriteria Mata Pelajaran </th>
					<th> Quota </th>
					<th> Jadwal</th>
					<th> Tgl Batas Pendaftaran</th>
					<th> Murid yang telah disetujui</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  if ($row->status=='selesai') $st_btn="disabled";
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php if ($row->status=='0'){ ?> 
						       <label class="label label-primary" style="font-size:12px"> Ditinjau </a>
						    <?php } else if ($row->status=='1'){ ?>
						        <label class="label label-success" style="font-size:12px"> Diterima </a>
						    <?php } else if ($row->status=='2'){ ?>
								<label class="label label-danger" style="font-size:12px"> Ditolak </a>
							<?php } ?>
							
						</td>
						<td><button class="btn btn-sm btn-info"  type="button" onclick="kriteria(<?php echo $row->pelajaran;?>)">  Klik di sini <i class="glyphicon glyphicon-search"></i></a></td>
						<td><?php echo $row->kuota;?></td>
						<td><button class="btn btn-sm btn-info"  type="button" onclick="jadwal(<?php echo $row->pelajaran;?>)">Lihat <i class="glyphicon glyphicon-search"></button></td>
						<td><?php echo $row->tgl_krs;?></td>
						<td><button class="btn btn-sm btn-info"  type="button" onclick="daftar_murid(<?php echo $row->pelajaran;?>)" data-toggle="tooltip" data-placement="top" title="Daftar"> <i class="glyphicon glyphicon-search"> </button></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>