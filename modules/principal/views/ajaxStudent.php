<div class="col-md-12">
<table id="datatable3" class="table table-striped table-bordered" style="width:100%;white-space:nowrap">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> Id_number</th>
                    <th> Full Name</th>
					<th> Class</th>
					<th> Choose</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
					foreach($student->result() as $row){?>
					  <tr>
						<td valign="middle"><?php echo $row->id_number;?></td>
						<td valign="middle"><?php echo $row->full_name;?></td>
						<td valign="middle"><?php echo $row->nama_kelas;?></td>
						<td valign="middle">
						<button <?php echo $otoU; ?> class="btn btn-info btn-xs" type="button" onclick="choose(<?php echo $row->id_number;?>)" data-toggle="tooltip" data-placement="top" title="lihat"><i class="fa fa-search"></i></button>
					  </tr>
				<?php $no++; };
				  ?>
				
             </tbody>
</table>
<input type="hidden" id="grade" value="<?php echo $grade->tingkat;?>" >
</div>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable3').dataTable();
            
          });
        </script>