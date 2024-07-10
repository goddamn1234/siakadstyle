<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> NIS</th>
                    <th> Nama Siswa</th>
					<th> Nama Kelas</th>
					<th> Periode</th>
					<th> Hasil Penilaian</th>
					<th colspan="2"> Catatan Final</th>
					<th colspan="2"> Catatan Siswa</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->id_number;?></td>
						<td><?php echo $row->nmurid;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->periode.' '.$row->tahun_akademik;?></td>
						<td><a href="lihat_nilai?m=<?php echo $row->id_number ?>&pr=<?php echo $row->id_raport_periode ?>" class="btn btn-sm btn-primary">Lihat Semua Nilai</a>	</td>
						<td>
					       <input size="10" value="<?php echo $row->catatan?>"><button class="btn btn-info btn-xs" type="button" onclick="edit_catatan(<?php echo $row->id_number;?>,<?php echo $row->id_raport_periode;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>   
						</td>
						<td>
					      Muncul di Output <input style="background:#e3e3e3" value="<?php if($row->catatan_dioutput=="Y") echo "Ya"; else echo "Tidak"; ?>" size="5" disabled> 
						</td>
						<td>
					       <input size="10" value="<?php echo $row->catatan_siswa?>"><button class="btn btn-info btn-xs" type="button" onclick="edit_catatan_siswa(<?php echo $row->id_number;?>,<?php echo $row->id_raport_periode;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>   
						</td>
						<td>
						    Muncul di Output <input style="background:#e3e3e3" value="<?php if($row->catatan_siswa_dioutput=="Y") echo "Ya"; else echo "Tidak"; ?>" size="5" disabled> 
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