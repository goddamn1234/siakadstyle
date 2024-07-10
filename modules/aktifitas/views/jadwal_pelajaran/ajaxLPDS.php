   <table id="datatable9" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">NIM</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">NAMA SISWA</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">JENJANG</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">KELAS</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">PERIODE</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">FILE</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">AKSI</th>
			</tr>
        </thead>
		<tbody>
	        <?php $no=1;
	        foreach($list_lpds->result() as $row){?>
				  <tr>
				    <td><?php echo $row->id_number ?></td>  
				   	<td><?php echo $row->full_name ?></td>
				   	<td><?php echo $row->nama_jenjang ?></td>
				   	<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php if($row->lpds!=''){?>
					        <a href="<?php echo base_url()?>/uploads/lpds/<?php echo $row->lpds;?>" target='_blank' class="btn btn-primary"><i class="fa fa-eye"></i> Lihat File</a>
					     <?php } else {?> 
					         <span style="color:red;font-size:10px">Belum Ada Upload</span>
					     <?php } ?>
					</td>
					<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="upload_lpds(<?php echo $row->id_raport_periode;?>,<?php echo $row->id_number;?>)" data-toggle="tooltip" data-placement="top" title="Upload"><i class="fa fa-upload"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del_lpds(<?php echo $row->id_raport_periode;?>,<?php echo $row->id_number;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
					</td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>