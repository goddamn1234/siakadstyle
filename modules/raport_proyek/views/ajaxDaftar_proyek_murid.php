<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Nama Proyek</th>
                    <th> Penjelasan</th>
					<th> Proyek ke</th>
					<th width="<?php if ($final=='1') echo '250'; else echo '140' ?>"> Nilai dan Lihat Proyek</th>
					<th> Tanggal Terakhir Edit</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama;?></td>
						<td><?php echo $row->penjelasan;?></td>
						<td><?php echo $no ?></td>
						<td><a href="pengisian_nilai?m=<?php echo $row->murid ?>&p=<?php echo $row->id_proyek ?><?php if ($final==1) echo "&f=1";?>" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i></a>
						    <button class="btn btn-sm btn-default" onclick="edit_tgl(<?php echo $row->id_proyek ?>)"><i class="glyphicon glyphicon-calendar"></i></button> 
						    <?php if ($final=='1'){ ?>
						       <?php if ($row->sdh_dikoreksi=='0') { ?>
						           <span class="label label-primary" style="font-size:12px">Belum dikoreksi fasil</span> &nbsp;
						       <?php } else { ?>
						           <span class="label label-danger" style="font-size:12px">Sudah dikoreksi fasil</span> &nbsp;
						       <?php } ?>
						            <?php if ($row->sdh_final=='0') $warna="grey"; else $warna="green"?>
						            <span class="lbl-circle-<?php echo $warna ?>"><i class="glyphicon glyphicon-ok"></i></span>
						    <?php } else { ?>
						       <?php if ($row->sdh_dikoreksi=='0') $warna="grey"; else $warna="green"?>
						       <span class="lbl-circle-<?php echo $warna ?>"><i class="glyphicon glyphicon-ok"></i></span>
						    <?php } ?>
						</td>
						<td>
						  <?php echo $row->tgl_modif?>  
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