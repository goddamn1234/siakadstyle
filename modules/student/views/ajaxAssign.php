<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> Nomor Induk Siswa </th>
                    <th> Nama Lengkap </th>
					<th> Kelas Terdaftar </th>
					<th> Jalur Pendidikan </th>
					<th> Jenis Pendidikan </th>
					<th> Jenjang Pendidikan </th>
					<th> Aksi</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
					foreach($list->result() as $row){?>
					  <tr>
						<td valign="middle"><?php echo $row->id_number;?></td>
						<td valign="middle"><?php echo $row->full_name;?></td>
						<td valign="middle"><?php echo $row->nama_kelas;?></td>
						<td valign="middle"><?php echo $row->nama_jalur;?></td>
						<td valign="middle"><?php echo $row->nama_jenis;?></td>	
						<td valign="middle"><?php echo $row->nama_jenjang;?></td>
						<td valign="middle">
						<button <?php echo $otoU; ?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_assign;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD; ?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_assign;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
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
