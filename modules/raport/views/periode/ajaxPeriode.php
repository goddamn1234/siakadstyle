<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Periode</th>
					<th> Tahun Akademik</th>
					<th> Mulai Periode</th>
					<th> Akhir Periode</th>
					<th> Tanggal Rapor</th>
					<th> Nama Kepala Sekolah / TTD</th>
					<th> Status</th>
					<th> Aksi</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->periode;?></td>
						<td><?php echo $row->tahun_akademik;?></td>
						<td><?php echo $row->awal;?></td>
						<td><?php echo $row->akhir;?></td>
						<td><?php echo $row->tgl_raport;?></td>
						<td><table>
						    <?php if($row->kepsek){?>
						    <tr>
						         <td>[SMA] <?php echo $row->kepsek;?></td>
						         <td><?php if ($row->image_ttd!=''){?>
				    	               <img src="<?php echo base_url()?>/image/signature/kepsek/<?php echo $row->image_ttd;?>" height="30">
				    	                <?php } ?>
				    	        </td>
				    	     </tr>
				    	     <?php } ?>
				    	    <?php if($row->kepsek2){?>
						    <tr>
						         <td>[SMK] <?php echo $row->kepsek2;?></td>
						         <td><?php if ($row->image_ttd2!=''){?>
				    	               <img src="<?php echo base_url()?>/image/signature/kepsek/<?php echo $row->image_ttd2;?>" height="30">
				    	                <?php } ?>
				    	        </td>
				    	     </tr>
				    	     <?php } ?>
				    	    <?php if($row->kepsek3){?>
						    <tr>
						         <td>[SMP] <?php echo $row->kepsek3;?></td>
						         <td><?php if ($row->image_ttd3!=''){?>
				    	               <img src="<?php echo base_url()?>/image/signature/kepsek/<?php echo $row->image_ttd3;?>" height="30">
				    	                <?php } ?>
				    	        </td>
				    	     </tr>
				    	     <?php } ?>
				    	     <?php if($row->kepsek4){?>
						    <tr>
						         <td>[SD] <?php echo $row->kepsek4;?></td>
						         <td><?php if ($row->image_ttd4!=''){?>
				    	               <img src="<?php echo base_url()?>/image/signature/kepsek/<?php echo $row->image_ttd4;?>" height="30">
				    	                <?php } ?>
				    	        </td>
				    	     </tr>
				    	     <?php } ?>
				    	     </table>
				    	</td>
						<td valign="middle"><a href="#" class="btn btn-<?php if ($row->status == 'aktif'){echo 'primary';}else{echo 'danger';}?> btn-xs" onclick="act(<?php echo $row->id_raport_periode;?>)"> <?php echo $row->status;?> </a></td>
						<td>
						<button <?php echo $otoU; ?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_raport_periode;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD; ?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_raport_periode;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>