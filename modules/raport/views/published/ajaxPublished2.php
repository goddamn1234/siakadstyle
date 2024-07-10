<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th rowspan="2"> No </th>
					<th rowspan="2"> Jenis<br>Pendidikan</th>
                    <th rowspan="2"> Jalur<br>Pendidikan</th>
					<th rowspan="2"> Jenjang<br>Pendidikan</th>
					<th rowspan="2"> Periode</th>
					<th rowspan="2"> Kelas</th>
					<th rowspan="2"> Siswa</th>
					<th colspan="3" class="text-center"> Publikasikan Rapor</th>
				</tr>
				<tr>
				    <th width="100"> Raport Proyek & MPP</th>
					<th width="100"> Raport Konversi</th>
					<th> Raport Belajar</th>  
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list1->result() as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_jenis;?></td>
						<td><?php echo $row->nama_jalur;?></td>
						<td><?php echo $row->nama_jenjang;?></td>
						<td><?php echo $row->nperiode.' '.$row->tahun_akademik;?></td>
						<td><?php echo $row->nama_kelas;?></td>
						<td><?php echo $row->full_name;?></td>
						<td valign="middle">
						    <button type="button" onClick="published(1,'<?php echo $row->murid;?>',<?php echo $row->periode;?>,'<?php echo $row->pub;?>')" class="btn btn-<?php if ($row->pub == 'T'){echo 'danger';$tag ='minus-circle';}else{echo 'primary';$tag ='cloud-upload';}?> btn-xs"> <i class="fa fa-<?php echo $tag;?>"> </i> &nbsp;&nbsp;<?php if ($row->pub=="Y") echo "yes"; else echo "no"; ?> </button>
					        <button type="button" onClick="published(2,'<?php echo $row->murid;?>',<?php echo $row->periode;?>,'<?php echo $row->pub2;?>')" class="btn btn-<?php if ($row->pub2 == 'T'){echo 'danger';$tag ='minus-circle';}else{echo 'primary';$tag ='cloud-upload';}?> btn-xs"> <i class="fa fa-<?php echo $tag;?>"> </i> &nbsp;&nbsp;<?php if ($row->pub2=="Y") echo "yes"; else echo "no"; ?>
					    </td>
					 	<td valign="middle">
					 	    <button type="button" onClick="published(3,'<?php echo $row->murid;?>',<?php echo $row->periode;?>,'<?php echo $row->pub_konversi;?>')" class="btn btn-<?php if ($row->pub_konversi == 'T'){echo 'danger';$tag ='minus-circle';}else{echo 'primary';$tag ='cloud-upload';}?> btn-xs"> <i class="fa fa-<?php echo $tag;?>"> </i> &nbsp;&nbsp;<?php if ($row->pub_konversi=="Y") echo "yes"; else echo "no"; ?> </button>
					 	    <button type="button" onClick="published(4,'<?php echo $row->murid;?>',<?php echo $row->periode;?>,'<?php echo $row->pub_konversi2;?>')" class="btn btn-<?php if ($row->pub_konversi2 == 'T'){echo 'danger';$tag ='minus-circle';}else{echo 'primary';$tag ='cloud-upload';}?> btn-xs"> <i class="fa fa-<?php echo $tag;?>"> </i> &nbsp;&nbsp;<?php if ($row->pub_konversi2=="Y") echo "yes"; else echo "no"; ?> </button>
					 	</td>
					    <td></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table> 
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>