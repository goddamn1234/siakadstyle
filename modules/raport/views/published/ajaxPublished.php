<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Periode</th>
                    <th> Kelas</th>
					<th> Siswa</th>
					<th> Publikasi Rapor</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->periode;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->full_name;?></td>
						<td valign="middle"><button type="button" onClick="published('<?php echo $row->id_number;?>','<?php echo $row->tingkat;?>','<?php echo $row->published;?>')" class="btn btn-<?php if ($row->published == 'no'){echo 'danger';$tag ='minus-circle';}else{echo 'primary';$tag ='cloud-upload';}?> btn-xs"> <i class="fa fa-<?php echo $tag;?>"> </i> &nbsp;&nbsp;<?php echo $row->published;?> </button></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>