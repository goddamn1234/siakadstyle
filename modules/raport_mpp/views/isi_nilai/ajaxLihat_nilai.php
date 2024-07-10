<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Tipe mata pelajaran</th>
                    <th> Mata Pelajaran</th>
					<th> Spesialis Mata Pelajaran</th>
					<th> Hasil Penilaian</th>
					<th> Konversi</th>
					<th width=" <?php if ($final=='1') echo '250'; else echo'100'?>"> Lihat Nilai & Edit</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_tipe;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php if ($row->nilai=='Y'){?>
						           <span class="label label-primary"> TERCAPAI </span>
						    <?php } else if ($row->nilai=='T') {?>
						           <span class="label label-danger"> BELUM TERCAPAI </span>
						    <?php } ?>
						</td>
						<td><?php echo $row->hasil_konversi?></td>
						<td>
						   <?php if ($final=='1'){ 
						      if  ($row->sdh_final=="0") $warna="grey"; else $warna="green";?>
					         <a href="pengisian_nilai?m=<?php echo $row->murid?>&p=<?php echo $row->id_mapel?>&k=2&pr=<?php echo $periode?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i></a>
			                 <button class="btn btn-sm btn-danger" id="btn-hapus" onclick="del(<?php echo $row->murid?>,<?php echo $row->id_mapel?>)"><i class="glyphicon glyphicon-trash"></i></button>
			                 <?php if ($row->sdh_dikoreksi=='0') {?>
			                      <span class="label label-default" style="font-size:12px">Belum Diperiksa Fasil</span> &nbsp;
			                 <?php } else { ?>
			                       <span class="label label-success" style="font-size:12px">Telah Diperiksa Fasil</span> &nbsp;
			                 <?php } ?>
			                 
					          <span class="lbl-circle-<?php echo $warna ?>"><i class="glyphicon glyphicon-ok"></i></span>
						  <?php  } else { 
						     if  ($row->sdh_dikoreksi=="0") $warna="grey"; else $warna="green"; ?> 
					         <a href="pengisian_nilai?m=<?php echo $row->murid?>&p=<?php echo $row->id_mapel?>&k=1&pr=<?php echo $periode?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i></a>
					         &nbsp;&nbsp; <span class="lbl-circle-<?php echo $warna ?>"><i class="glyphicon glyphicon-ok"></i></span>
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