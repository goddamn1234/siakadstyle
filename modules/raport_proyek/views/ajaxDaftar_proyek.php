<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Nama Proyek</th>
                    <th> Penjelasan</th>
					<th> Proyek ke</th>
					<th> Nilai dan Lihat Proyek</th>
					<th> Action</th>
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
						<td><a href="detail_proyek?m=<?php echo $row->murid ?>&p=<?php echo $row->id_proyek ?>" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i></a>
						     <button class="btn btn-sm btn-default" onclick="edit_tgl(<?php echo $row->id_proyek ?>)"><i class="glyphicon glyphicon-calendar"></i></button> 
						     <?php if ($row->status=='0') $warna="grey"; else $warna="green"?>
						     <span class="lbl-circle-<?php echo $warna ?>"><i class="glyphicon glyphicon-ok"></i></span>
						</td>
						<td>
						   <button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_proyek;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
					       <button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_proyek;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>	
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