<div style="overflow:scroll; width:100%">
<table id="datatable2" class="table table-striped table-bordered" width="100%">
			<thead>
			    <tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #ff8181; color: white;">
					<th colspan="20"> PERHATIAN : Jika Mengupload File PDF manual maka tidak dapat lagi edit rapot secara system <b>untuk saat ini, Terimakasih </th>
				</tr>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;">
					<th rowspan="2"> No </th>
					<!--<th rowspan="2"> Jenis<br>Pendidikan</th>-->
                    <!--<th rowspan="2"> Jalur<br>Pendidikan</th>-->
					<th rowspan="2"> Jenjang<br>Pendidikan</th>
					<th rowspan="2"> Periode</th>
					<th rowspan="2"> Class</th>
					<th rowspan="2"> Student</th>
					<th colspan="18" class="text-center"> Rapor Yang Siap Untuk di Publish</th>
				</tr>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #337ab7; color: white;">
				     <th colspan="4" class="text-center">View Raport</th>
				    <th colspan="1" class="text-center"> Upload Raport Proyek</th>
				    <th colspan="1" class="text-center"> Status Raport Proyek</th>
				    <th colspan="1" class="text-center"> Upload Raport MPP</th>
				    <th colspan="1" class="text-center"> Status Raport MPP </th>
				    <th colspan="1" class="text-center"> Upload Raport Gabungan</th>
				    <th colspan="1" class="text-center"> Status Upload Gabungan</th>
				    <th colspan="1" class="text-center"> Upload Rapor Konversi</th>
				    <th colspan="1" class="text-center"> Status Upload Konversi</th>
				<!--	<th colspan="2"> Raport Belajar</th>  -->
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<!--<td><?php echo $row->nama_jenis;?></td>-->
						<!--<td><?php echo $row->nama_jalur;?></td>-->
						<td><?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->nperiode.' '.$row->tahun_akademik;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->full_name;?></td>
						<td valign="middle" width="100px">
						    <a href="<?php echo site_url()?>raport_proyek/create_raport/<?php echo  $row->murid?>/<?php echo  $row->id_raport_periode?>" type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
				<!--	        <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>		-->
					        <div style="font-size:10px">View Rapor Proyek</div>
					    </td>
					    <td valign="middle" width="100px">
					  	    <a href="<?php echo site_url()?>raport_mpp/create_raport/<?php echo  $row->murid?>/<?php echo  $row->id_raport_periode?>" type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
				<!--	        <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>		-->
					        <div style="font-size:10px">View Rapor MPP</div>
					    </td>
					    <td valign="middle" width="100px">
						    <a href="<?php echo site_url()?>raport/create_raport/<?php echo  $row->murid?>/<?php echo  $row->id_raport_periode?>" type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
				<!--	        <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>		-->
					        <div style="font-size:10px">View Rapor Proyek + MPP</div>
					    </td>
					   <td valign="middle" width="100px">
					 	    <a href="<?php echo site_url()?>raport_mpp/create_raport_konversi/<?php echo  $row->murid?>/<?php echo $row->id_raport_periode?>" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
				<!--	        <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>		-->
					        <div style="font-size:10px">View Rapor Konversi </div> 
					 	</td>	    
					       <td valign="middle" class="text-center">
				    	       <?php $keyFile = str_replace("/","",'Pro_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);?>
						    <center><button <?php echo $otoU; ?> type="button" class="btn btn-info btn-sm"  onclick="uploadModal('<?php echo $keyFile;?>')"  data-toggle="tooltip" data-placement="top"> <i class="fa fa-upload"> </i> </button></center>
						    <div style="font-size:10px">Upload Manual Rapor Proyek</div>
					    </td>
					    </td>
				    	    <td valign="middle">
				    	   <?php 
							    if(file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){
						            echo '<center><i class="fa fa-check" style="color:green"></i></center>';
                                    echo '<div style="font-size:10px"><center>Ada Upload</center></div>';
						        }
						        else{
						            echo '<center><i class="fa fa-times" style="color:red"></i></center>';
						             echo '<div style="font-size:10px"><center>Tidak ada Upload</center></div>';
						        }           
						        // echo base_url('uploads/raport/raport_'.$row->tingkat.'_'.$row->id_raport_result.'.pdf');
						    ?>
					    </td>
					    <td valign="middle" class="text-center">
				    	       <?php $keyFile = str_replace("/","",'MPP_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);?>
						    <center><button <?php echo $otoU; ?> type="button" class="btn btn-info btn-sm"  onclick="uploadModal('<?php echo $keyFile;?>')"  data-toggle="tooltip" data-placement="top"> <i class="fa fa-upload"> </i> </button></center>
						    <div style="font-size:10px">Upload Manual Rapor MPP</div>
					    </td>
					    </td>
				    	    <td valign="middle" class="text-center">
				    	   <?php 
							    if(file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){
						            echo '<center><i class="fa fa-check" style="color:green"></i></center>';
                                    echo '<div style="font-size:10px"><center>Ada Upload</center></div>';
						        }
						        else{
						            echo '<center><i class="fa fa-times" style="color:red"></i></center>';
						             echo '<div style="font-size:10px"><center>Tidak ada Upload</center></div>';
						        }           
						        // echo base_url('uploads/raport/raport_'.$row->tingkat.'_'.$row->id_raport_result.'.pdf');
						    ?>
					    </td>
				    	<td valign="middle" class="text-center">
				    	       <?php $keyFile = str_replace("/","",'Gab_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);?>
						    <button <?php echo $otoU; ?> type="button" class="btn btn-info btn-sm"  onclick="uploadModal('<?php echo $keyFile;?>')"  data-toggle="tooltip" data-placement="top"> <i class="fa fa-upload"> </i> </button>
						    <div style="font-size:10px">Upload Manual Rapor Proyek + MPP</div>
					    </td>
					    </td>
				    	    <td valign="middle">
				    	   <?php 
							    if(file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){
						            echo '<center><i class="fa fa-check" style="color:green"></i></center>';
                                    echo '<div style="font-size:10px"><center>Ada Upload</center></div>';
						        }
						        else{
						            echo '<center><i class="fa fa-times" style="color:red"></i></center>';
						             echo '<div style="font-size:10px"><center>Tidak ada Upload</center></div>';
						        }           
						        // echo base_url('uploads/raport/raport_'.$row->tingkat.'_'.$row->id_raport_result.'.pdf');
						    ?>
					    </td>					    
					 
					 		<td valign="middle" class="text-center">
					        <?php $keyFile = str_replace("/","",'Konv_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);?>
						   <button <?php echo $otoU; ?> type="button" class="btn btn-info btn-sm" type="button"" onclick="uploadModal('<?php echo $keyFile;?>')"  data-toggle="tooltip" data-placement="top"> <i class="fa fa-upload"> </i> </button>
						    <div style="font-size:10px">Upload Manual Rapor Konversi</div>
					    </td>
					    </td>
				    	    <td valign="middle" >
						      <?php 
							    if(file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){
						            echo '<center><i class="fa fa-check" style="color:green"></i></center>';
						            echo ' <div style="font-size:10px"><center>Ada Upload</center></div>';
						        }
						        else{
						            echo '<center><i class="fa fa-times" style="color:red"></i></center>';
						             echo '<div style="font-size:10px"><center>Tidak ada Upload</center></div>';
						        }
						        // echo base_url('uploads/raport/raport_'.$row->tingkat.'_'.$row->id_raport_result.'.pdf');
						    ?>
					    </td>
				<!--	 	 <td valign="middle">
						    <button type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-upload"> </i> </button>
						    <div style="font-size:10px">Upload Manual Rapor Konversi</div>
					    </td>	-->
				<!--	    <td valign="middle">
					 	    <button type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </button>
				<!--	        <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>
					        <div style="font-size:10px">View Rapor Belajar</div> 
					 	</td>	-->
				<!--	    <td valign="middle">
						    <button type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-upload"> </i> </button>
						    <div style="font-size:10px">Upload Manual Rapor Belajar</div> 
					    </td>	-->
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
</div>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>