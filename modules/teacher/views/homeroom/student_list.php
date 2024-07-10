<input type="hidden" id="grade" name="grade" value="<?php echo $grade;?>" >

<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> Id Number </th>
                    <th> Full Name </th>
					<th> Status </th>
					<th> Action </th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
					foreach($student->result() as $row){?>
					  <tr>
						<td valign="middle"><?php echo $row->id_number;?></td>
						<td valign="middle"><?php echo $row->full_name;?></td>
						<td valign="middle"><?php 
							if($row->submit_teacher_co == 0){?>
								<span class="label label-warning">Need Attention</span>
							<?php }else{?>
								<span class="label label-primary">Submited</span>
							<?php } ?>
						</td>
						<td valign="middle">
						<button <?php echo $otoU; ?> class="btn btn-info btn-xs" type="button" onclick="view(<?php echo $row->id_number;?>)" data-toggle="tooltip" data-placement="top" title="lihat" <?php if($row->sembunyikan >= 1){echo 'disabled';}?> ><i class="fa fa-external-link"></i></button>
					  </tr>
				<?php $no++; };
				  ?>
				
             </tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>
