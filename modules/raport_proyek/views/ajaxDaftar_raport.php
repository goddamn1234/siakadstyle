<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> NIS</th>
                    <th> Nama Murid</th>
					<th> Judul Project</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->murid;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php echo $row->nama;?></td>
						<td>
						    <a href="create_raport/<?php echo $row->murid?>/<?php echo $row->id_raport_periode?>" class="btn btn-sm btn-primary">
					           <i class="glyphicon glyphicon-print"></i> Raport Proyek</a>	
					       <a href="create_raport_konversi/<?php echo $row->murid?>/<?php echo $row->id_raport_periode?>" class="btn btn-sm btn-primary">
					           <i class="glyphicon glyphicon-print"></i> Raport Konversi</a>	  	
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