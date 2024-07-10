<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> No </th>
                    <th> Grade </th>
					<th> Class </th>
					<th> Year Academic</th>
					<th> Student</th>
					<th> Raport<br>Upload</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<td>Year <?php echo $row->tingkat;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->periode." ".$row->tahun_akademik;?></td>
						<td><?php echo $row->id_number." | ".$row->full_name;?></td>
						<td align="center">
							<?php 
								$keyFile = str_replace("/","",$row->tingkat.$row->periode.$row->tahun_akademik.'_'.$row->id_number.'_'.$row->id_raport_result);
						        if(file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){
						            echo '<i class="fa fa-check" style="color:green"></i>';
						        }
						        else{
						            echo '<i class="fa fa-times" style="color:red"></i>';
						        }
						        // echo base_url('uploads/raport/raport_'.$row->tingkat.'_'.$row->id_raport_result.'.pdf');
						    ?>
						</td>
						<td>
    						<a <?php echo $otoR; ?> class="btn btn-info btn-xs" target="_blank" href="<?php echo base_url().'raport/output_pdf/'.$row->id_raport_result.'/'.$row->tingkat;?>" >
    						    <i class="fa fa-file-pdf-o"></i>
    						</a> 
    						<button <?php echo $otoU; ?> class="btn btn-primary btn-xs" type="button" onclick="uploadModal('<?php echo $keyFile;?>')" data-toggle="tooltip" data-placement="top" title="Upload Raport">
    						    <i class="fa fa-upload"></i>
						    </button>
							<?php 
						        if(file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){?>
									<a <?php echo $otoR; ?> class="btn btn-info btn-xs" target="_blank" href="<?php echo base_url().'uploads/raport/raport_'.$keyFile.'.pdf';?>" data-toggle="tooltip" title="Lihat Raport">
										<i class="fa fa-eye"></i>
									</a>
							<?php } ?>
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