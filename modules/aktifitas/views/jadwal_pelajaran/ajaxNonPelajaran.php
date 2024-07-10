   <table id="datatable8" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">PERIODE</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">JENJANG</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">TINGKAT</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">KELAS</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">HARI</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">DESKRIPSI</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">JAM</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">AKSI</th>
			</tr>
        </thead>
		<tbody>
		    <?php $no=1;
	        foreach($list_non->result() as $row){?>
				  <tr>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_jenjang ?></td>
					<td>Year <?php echo $row->tingkat?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php if($row->hari==1) echo 'Senin';
					          else if($row->hari==2) echo 'Selasa';
					          else if($row->hari==3) echo 'Rabu';
					          else if($row->hari==4) echo 'Kamis';
					          else if($row->hari==5) echo 'Jumat';
					          else if($row->hari==6) echo 'Sabtu';
					          else if($row->hari==7) echo 'Minggu';
					    ?>
					</td>
					<td><?php echo $row->deskripsi ?></td> 
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
					<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit_non(<?php echo $row->id;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del_non(<?php echo $row->id;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
					</td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>