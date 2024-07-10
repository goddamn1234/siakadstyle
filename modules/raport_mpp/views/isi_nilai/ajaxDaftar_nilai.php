<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> NIS</th>
                    <th> Nama Siswa</th>
					<th> Nama Kelas</th>
					<th> Nama Mata Pelajaran</th>
					<th> Periode</th>
					<th> Hasil Penilaian</th>
					<th> Konversi</th>
					<th> Aksi</th>
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
						<td><?php echo $row->nama_kelas;?> <?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->periode.' '.$row->tahun_akademik;?></td>
						<td><?php if($row->nilai=='Y') {?>
						           <span class="label label-primary"> TERCAPAI </span> <?php } else if($row->nilai=='T') {?> <span class="label label-danger">BELUM TERCAPAI</span>
						    <?php } ?></td>
						<td><?php echo $row->hasil_konversi;?></td>
						<td>
					       <a href="pengisian_nilai?m=<?php echo $row->id_number ?>&p=<?php echo $row->id_mapel?>&pr=<?php echo $row->id_raport_periode?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i></a>	    
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
    