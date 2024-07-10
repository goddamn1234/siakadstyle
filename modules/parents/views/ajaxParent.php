<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> Nomor Pengenal</th>
                    <th> Nama Lengkap</th>
					<th> Tempat/Tanggal Lahir</th>
					<th> Nomor Telepon</th>
					<th> Alamat</th>
					<th> TTD</th>
					<th> Status</th>
					<th> Aksi</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
					foreach($list->result() as $row){?>
					  <tr>
						<td valign="middle"><?php echo $row->id_number;?></td>
						<td valign="middle"><?php echo $row->full_name;?></td>
						<td valign="middle"><?php echo $row->birth_place.",".date('d-M-Y',strtotime($row->birth_date));?></td>
						<td valign="middle"><?php echo $row->phone1;?></td>
						<td valign="middle"><?php echo $row->address;?></td>
						<td width="80">
						    <?php if ($row->image_ttd!=''){?>
						    <img src="<?php echo base_url()?>/image/signature/parent/<?php echo $row->image_ttd;?>" height="30">
						    <?php } ?>
						</td>
						<td valign="middle"><a href="#" class="btn btn-<?php if ($row->status == 'aktif'){echo 'primary';}else{echo 'danger';}?> btn-xs" onclick="act(<?php echo $row->id_user;?>)"> <?php echo $row->status;?> </a></td>
						<td valign="middle">
						<button <?php echo $otoU; ?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_user;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD; ?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_user;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
						<button <?php echo $otoU; ?> class="btn btn-primary btn-xs" type="button" onclick="reset(<?php echo $row->id_user;?> )" data-toggle="tooltip" data-placement="top" title="reset password"><i class="fa fa-refresh"></i></button>
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