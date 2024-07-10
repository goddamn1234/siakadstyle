<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> P-Ke</th>
                    <th> Siklus</th>
                    <th> Kriteria </th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){ ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->ke;?></td>
						<td><?php echo $row->nama_siklus;?></td>
						<td><?php echo $row->isi_kriteria;?></td>
                	  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>