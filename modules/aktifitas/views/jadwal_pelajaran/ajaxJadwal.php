    <table id="datatable1" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8" style="color:#fff;background:#f75c55;font-weight:bold"> Jadwal Pelajaran Hari Senin </th>
			</tr>
        </thead>
		<tbody>
		<?php $no=1;
			  foreach($list->result() as $row){?>
				  <tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->nama_jenjang?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nama_tipe ?></td>
					<td><?php echo $row->nama_mapel ?></td>
					<td><?php echo $row->full_name ?></td>
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>
        
    <table id="datatablen1" class="table table-striped table-bordered">
        <tbody>
		    <?php 
	        foreach($non->result() as $row){?>
				  <tr>
					<td><?php echo $row->deskripsi ?></td> 
					<td width="110px"><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php };  ?>
		</tbody>
	</table>	
    
    <table id="datatable2" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8" style="color:#fff;background:#f75c55;font-weight:bold"> Jadwal Pelajaran Hari Selasa </th>
			</tr>
        </thead>
		<tbody>
		<?php $no=1;
			  foreach($list2->result() as $row){?>
				  <tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->nama_jenjang?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nama_tipe ?></td>
					<td><?php echo $row->nama_mapel ?></td>
					<td><?php echo $row->full_name ?></td>
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>
    
     <table id="datatablen2" class="table table-striped table-bordered">
        <tbody>
		    <?php 
	        foreach($non2->result() as $row){?>
				  <tr>
					<td><?php echo $row->deskripsi ?></td> 
					<td width="110px"><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php };  ?>
		</tbody>
	</table>	
    
    <table id="datatable3" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8" style="color:#fff;background:#f75c55;font-weight:bold"> Jadwal Pelajaran Hari Rabu </th>
			</tr>
        </thead>
		<tbody>
		<?php $no=1;
			  foreach($list3->result() as $row){?>
				  <tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->nama_jenjang?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nama_tipe ?></td>
					<td><?php echo $row->nama_mapel ?></td>
					<td><?php echo $row->full_name ?></td>
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>
    
     <table id="datatablen3" class="table table-striped table-bordered">
        <tbody>
		    <?php 
	        foreach($non3->result() as $row){?>
				  <tr>
					<td><?php echo $row->deskripsi ?></td> 
					<td width="110px"><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php };  ?>
		</tbody>
	</table>
    
    <table id="datatable4" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8" style="color:#fff;background:#f75c55;font-weight:bold"> Jadwal Pelajaran Hari Kamis </th>
			</tr>
        </thead>
		<tbody>
		<?php $no=1;
			  foreach($list4->result() as $row){?>
				  <tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->nama_jenjang?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nama_tipe ?></td>
					<td><?php echo $row->nama_mapel ?></td>
					<td><?php echo $row->full_name ?></td>
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>
    
    <table id="datatablen4" class="table table-striped table-bordered">
        <tbody>
		    <?php 
	        foreach($non4->result() as $row){?>
				  <tr>
					<td><?php echo $row->deskripsi ?></td> 
					<td width="110px"><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php };  ?>
		</tbody>
	</table>
    
    <table id="datatable5" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8" style="color:#fff;background:#f75c55;font-weight:bold"> Jadwal Pelajaran Hari Jumat </th>
			</tr>
        </thead>
		<tbody>
		<?php $no=1;
			  foreach($list5->result() as $row){?>
				  <tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->nama_jenjang?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nama_tipe ?></td>
					<td><?php echo $row->nama_mapel ?></td>
					<td><?php echo $row->full_name ?></td>
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>
    
    <table id="datatablen5" class="table table-striped table-bordered">
        <tbody>
		    <?php 
	        foreach($non5->result() as $row){?>
				  <tr>
					<td><?php echo $row->deskripsi ?></td> 
					<td width="110px"><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php };  ?>
		</tbody>
	</table>
    
    <table id="datatable6" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8" style="color:#fff;background:#f75c55;font-weight:bold"> Jadwal Pelajaran Hari Sabtu </th>
			</tr>
        </thead>
		<tbody>
		<?php $no=1;
			  foreach($list6->result() as $row){?>
				  <tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->nama_jenjang?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nama_tipe ?></td>
					<td><?php echo $row->nama_mapel ?></td>
					<td><?php echo $row->full_name ?></td>
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>
    
    <table id="datatablen6" class="table table-striped table-bordered">
        <tbody>
		    <?php 
	        foreach($non6->result() as $row){?>
				  <tr>
					<td><?php echo $row->deskripsi ?></td> 
					<td width="110px"><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php };  ?>
		</tbody>
	</table>
    
    <table id="datatable7" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th colspan="8" style="color:#fff;background:#f75c55;font-weight:bold"> Jadwal Pelajaran Hari Minggu </th>
			</tr>
        </thead>
		<tbody>
		<?php $no=1;
			  foreach($list7->result() as $row){?>
				  <tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->nama_jenjang?></td>
					<td><?php echo $row->nperiode.' '.$row->tahun_akademik?></td>
					<td><?php echo $row->nama_kelas ?></td>
					<td><?php echo $row->nama_tipe ?></td>
					<td><?php echo $row->nama_mapel ?></td>
					<td><?php echo $row->full_name ?></td>
					<td><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php $no++; };  ?>
		</tbody>
    </table>
    
    <table id="datatablen7" class="table table-striped table-bordered">
        <tbody>
		    <?php 
	        foreach($non7->result() as $row){?>
				  <tr>
					<td><?php echo $row->deskripsi ?></td> 
					<td width="110px"><?php echo $row->dari.' - '.$row->sampai ?></td>
				  </tr>
			  <?php };  ?>
		</tbody>
	</table>

        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>