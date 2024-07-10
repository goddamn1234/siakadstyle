   <table id="datatable10" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">PERIODE</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">JENJANG</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">FILE</th>
				<th style="background:#2b66aa;color:#fff;font-weight:bold" align="center">AKSI</th>
			</tr>
        </thead>
		<tbody>
	     <?php $no=1;
	        foreach($list_kalender->result() as $row){?>
				  <tr>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
				   	<td><?php echo $row->nama_jenjang ?></td>
				    <td><?php if($row->kalender!=''){?>
					        <a href="<?php echo base_url()?>/uploads/kalender/<?php echo $row->kalender;?>" target='_blank' class="btn btn-primary"><i class="fa fa-eye"></i> Lihat File</a>
					     <?php } else {?> 
					         <span style="color:red;font-size:10px">Belum Ada Upload</span>
					     <?php } ?>
					</td>
					<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="upload_kalender(<?php echo $row->id_raport_periode;?>,<?php echo $row->id_jenjang;?>)" data-toggle="tooltip" data-placement="top" title="Upload"><i class="fa fa-upload"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del_kalender(<?php echo $row->id_raport_periode;?>,<?php echo $row->id_jenjang;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
					</td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>