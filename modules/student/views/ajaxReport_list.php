        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>
        
      <H3>HASIL NILAI > RAPOR SISWA</H3>
        <table id="datatable3" class="table table-striped table-bordered">
				<thead>
				<tr>
					<th rowspan="2"> No </th>
					<th rowspan="2"> Jenjang<br>Pendidikan</th>
					<th rowspan="2"> Periode</th>
					<th rowspan="2"> Class</th>
					<th rowspan="2"> Student</th>
					<th colspan="4" class="text-center"> Daftar Penilaian Rapor </th>
				</tr>
				<tr>
				    <th colspan="4" class="text-center"> Rapor Proyek & Rapor MPP (Materi Pendukung Proyek)</th>
				<!--<th colspan="2" class="text-center"> Raport Konversi</th>
					<th colspan="2"> Raport Belajar</th> -->  
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list2->result() as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->nperiode.' '.$row->tahun_akademik;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->full_name;?></td>
						<!-- <td valign="middle" width="100px"> -->
						    <?php if ($row->pub=="Y"){ ?>
						        <?php $keyFile = str_replace("/","",'Pro_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);?>
						        <?php if (file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){?>
    					<!--	        <a href="<?php echo base_url('uploads/raport/raport_'.$keyFile.'.pdf')?>" type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a> -->
    				    <!--        <div style="font-size:10px">View Rapor Proyek</div> -->
    				            <?php } else { ?>
    				    <!--            <a href="<?php echo site_url()?>raport_proyek/create_raport/<?php echo  $row->murid?>/<?php echo  $row->periode?>" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a> -->
    				    <!--            <div style="font-size:10px">View Rapor Proyek</div> -->
    				    <!--        <?php }?> -->
    					<!--    <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>  		-->
					    <!--    <?php } else {?> -->
    					        <!--<button onClick="" class="btn btn-default btn-sm" disabled> <i class="fa fa-file-pdf-o"> </i> </button>-->
    					<!--    <button type="button" onClick="" class="btn btn-default btn-sm" disabled>XLSX</button>	-->
					        <?php } ?>
					        
					    </td>
					    <td valign="middle" width="100px">
					        <?php if ($row->pub2=="Y"){ ?>
					            <?php $keyFile = str_replace("/","",'MPP_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);?>
    					  	     <?php if (file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){?>
    						        <a href="<?php echo base_url('uploads/raport/raport_'.$keyFile.'.pdf')?>" type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
    				            <?php } else { ?>  
    				                 <a href="<?php echo site_url()?>raport_mpp/create_raport/<?php echo  $row->murid?>/<?php echo  $row->id_raport_periode?>" class="btn btn-info btn-sm" disabled> <i class="fa fa-file-pdf-o"> </i> </a>
    				            <?php }?>
    					<!--    <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>-->
    					<!--     <?php } else {?> -->
    					        <!--<button onClick="" class="btn btn-default btn-sm" disabled> <i class="fa fa-file-pdf-o"> </i> </button>-->
    					<!--    <button type="button" onClick="" class="btn btn-default btn-sm" disabled>XLSX</button>	-->
					    <!--    <?php } ?> -->
					    <!--    <div style="font-size:10px">View Rapor MPP</div> -->
					    </td>
					    <td valign="middle"  width="130px">
					        <?php if (($row->pub=="Y")&&($row->pub2=="Y")){ ?>
    						     <?php $keyFile = str_replace("/","",'Gab_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);?>
    					  	     <?php if (file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){?>
    						        <a href="<?php echo base_url('uploads/raport/raport_'.$keyFile.'.pdf')?>" type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
    				                <div style="font-size:10px">View Rapor Proyek + MPP</div>
    				            <?php } else { ?>  
    				                 <a href="<?php echo site_url()?>raport/create_raport/<?php echo  $row->murid?>/<?php echo  $row->id_raport_periode?>/<?php echo  $row->murid?>" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
     				                <div style="font-size:10px">View Rapor Proyek + MPP</div>
    				            <?php }?>
    					<!--    <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>		-->
    					    <?php } else {?>
    					        <!--<button onClick="" class="btn btn-default btn-sm" disabled> <i class="fa fa-file-pdf-o"> </i> </button>-->
    					<!--    <button type="button" onClick="" class="btn btn-default btn-sm" disabled>XLSX</button>	-->
					        <?php } ?>       
					        
					    </td>
					    <td valign="middle" width="140px">
					        <?php if ($row->pub_konversi=="Y"){ 
					           $keyFile = str_replace("/","",'Konv_'.$row->nperiode.$row->tahun_akademik.'_'.$row->murid); ?> 
					           <?php if(file_exists('./uploads/raport/raport_'.$keyFile.'.pdf')){?>
						          <a href="<?php echo base_url('uploads/raport/raport_'.$keyFile.'.pdf')?>" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
						          <div style="font-size:10px">View Raport Konversi</div>
						         <?php } else {?>
						          <a href="<?php echo site_url()?>raport_mpp/create_raport_konversi/<?php echo  $row->murid?>/<?php echo  $row->id_raport_periode?>/<?php echo  $row->murid?>" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
						          <div style="font-size:10px">View Raport Konversi</div>
						     <?php }  ?>      
						     <?php } else {?>
    					   <!--     <button onClick="" class="btn btn-default btn-sm" disabled> <i class="fa fa-file-pdf-o"> </i> </button>-->
    					<!--    <button type="button" onClick="" class="btn btn-default btn-sm" disabled>XLSX</button>	-->
					        <?php } ?>      
		  				   <!-- <button type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-download"> </i> </button>
						    <div style="font-size:10px">Download Raport Proyek + MPP</div>-->
					    </td>
					    <!--
					 	<td valign="middle">
					 	     <?php if ($row->pub_konversi2=="Y"){ ?>
					 	         $keyFile = str_replace("/","",'Konv_'.$row->tingkat.$row->nperiode.$row->tahun_akademik.'_'.$row->murid);  
    					 	    <a href="./uploads/raport/raport_<?php echo $keyFile?>.pdf" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-file-pdf-o"> </i> </a>
    					        <button type="button" onClick="" class="btn btn-success btn-sm">XLSX</button>
					          <?php } else {?>
    					        <button onClick="" class="btn btn-default btn-sm" disabled> <i class="fa fa-file-pdf-o"> </i> </button>
    					        <button type="button" onClick="" class="btn btn-default btn-sm" disabled>XLSX</button>
					        <?php } ?>      
					        <div style="font-size:10px">View Raport Konversi</div> 
					 	</td>
					 	 <td valign="middle">
						    <button type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-download"> </i> </button>
						    <div style="font-size:10px">Download Raport Konversi</div>
					    </td>
					    <td valign="middle">
					 	   <button onClick="" class="btn btn-default btn-sm" disabled> <i class="fa fa-file-pdf-o"> </i> </button>
    					   <button type="button" onClick="" class="btn btn-default btn-sm" disabled>XLSX</button>
					        <div style="font-size:10px">View Raport Belajar</div> 
					 	</td>
					 	 <td valign="middle">
						    <button type="button" onClick="" class="btn btn-info btn-sm"> <i class="fa fa-download"> </i> </button>
						    <div style="font-size:10px">Download Raport Belajar</div> 
					    </td>
					    -->
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
   </table>

         <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable3').dataTable();
            
          });
        </script>