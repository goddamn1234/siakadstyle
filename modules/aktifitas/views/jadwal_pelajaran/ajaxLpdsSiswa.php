<table id="datatable2" class="table table-striped table-bordered">
		<thead>
			<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
				<th align="center">TINGKAT KELAS</th>
				<th align="center">NAMA KELAS</th>
				<th align="center">JENJANG PENDIDIKAN</th>
				<th align="center">PERIODE LPDS</th>
				<th align="center">FILE</th>
			</tr>
        </thead>
		<tbody>
	        <?php $no=1;
	        foreach($lpds_siswa->result() as $row){?>
				  <tr>
				   	<td>Year <?php echo $row->tingkat ?></td>
				   	<td><?php echo $row->nama_kelas ?></td>
				   	<td><?php echo $row->nama_jenjang ?></td>
					<td><?php echo $row->periode.' '.$row->tahun_akademik?></td>
					<td><?php if($row->lpds!=''){?>
					        <a href="<?php echo base_url()?>/uploads/lpds/<?php echo $row->lpds;?>" target='_blank' class="btn btn-primary"><i class="fa fa-eye"></i> Lihat File</a>
					     <?php } else {?> 
					         <span style="color:red;font-size:10px">Belum Ada Upload</span>
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