<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Mata Pelajaran</th>
                    <th> Guru Pengampu</th>
                    <th> Daftar </th>
					<th> Kriteria Mata Pelajaran </th>
					<th> Quota </th>
					<th> Jadwal</th>
					<th> Tgl Batas Pendaftaran</th>
					<th> Berikan Masukan</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  if ($row->status=='selesai') $st_btn="disabled";
					    if($row->tgl_krs<date('Y-m-d')) $btn_dis='disabled'; else $btn_dis='';
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_mapel;?></td>
						<td><?php echo $row->full_name;?></td>
						<td><?php if ($row->id_krs==''){ 
						          if ($btn_dis=='disabled'){
						       ?> 
						       <!-- <a href="JavaScript:Void(0);" class="btn btn-sm btn-primary" <?php echo $btn_dis?>> Mendaftar </a> -->
						       <?php } else { ?> 
						       <a href="proses_daftar_krs/<?php echo $row->id_mapel ?>" class="btn btn-sm btn-primary" <?php echo $btn_dis?>> Mendaftar </a>
						    <?php } } else { ?>
						       <table><tr><td>
						       <span  style="font-size:12px;padding:6px 12px;color:#fff;background:#777;margin-right:3px;"> Terdaftar</span> 
						       </td><td>
						       <button class="btn btn-xs btn-danger" onclick="del(<?php echo $row->id_krs ?>)"><i class="glyphicon glyphicon-remove" <?php echo $btn_dis; ?>></i></button>  
						       </td></tr></table>
						    <?php } ?>
						</td>
						<td><button class="btn btn-sm btn-info"  type="button" onclick="kriteria(<?php echo $row->id_mapel;?>)">  Klik di sini <i class="glyphicon glyphicon-search"></i></button></td>
						<td><?php echo $row->kuota;?></td>
						<td><button class="btn btn-sm btn-info"  type="button" onclick="jadwal(<?php echo $row->id_mapel;?>)">Lihat <i class="glyphicon glyphicon-search"></td>
						<td><?php echo $row->tgl_krs;?></td>
						<td><button class="btn btn-sm btn-primary"  type="button" onclick="edit(<?php echo $row->id_krs;?>)" data-toggle="tooltip" data-placement="top" title="masukkan"> <i class="glyphicon glyphicon-edit"> </button></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            
          });
        </script>