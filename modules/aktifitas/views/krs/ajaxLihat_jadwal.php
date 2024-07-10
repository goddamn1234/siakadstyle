<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Hari</th>
                    <th> Mulai</th>
                    <th> Selesai</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  /* if ($row->status=='selesai') $st_btn="disabled"; */
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<?php if ($row->hari=='1') $nh='Senin';
						      else if ($row->hari=='2') $nh='Selasa';
						      else if ($row->hari=='3') $nh='Rabu';
						      else if ($row->hari=='4') $nh='Kamis';
						      else if ($row->hari=='5') $nh='Jumat';
						      else if ($row->hari=='6') $nh='Sabtu';
						      else $nh="";
						?>     
						<td><?php echo $nh ?></td>
						<td><?php echo $row->dari;?></td>
						<td><?php echo $row->sampai;?></td>
                	  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>