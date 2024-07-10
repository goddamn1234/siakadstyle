<style>
.job{
	margin:-20px 0 0 0;
	font-style:italyc;
	font-size:12px;
}
.ava{
	border:1px solid green;
	border-radius:5px;
	padding:1px;
}
td{
	vertical-align:middle;
}
</style>
<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th width=80px> Image </th>
					<th> Nomor Pengenal</th>
                    <th> Nama Lengkap</th>
					<th> Tempat/Tanggal Lahir</th>
					<th> Nomor Telepon</th>
					<th> Status</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
					foreach($list->result() as $row){?>
					  <tr>
						<td><?php echo img(array('src'=>'image/user/'.$row->image,'class'=>'ava','width'=>'90','height'=>'100'));?></td>
						<td valign="middle"><?php echo $row->id_number;?></td>
						<td valign="middle"><h2><?php echo $row->full_name;?><h2><br><p class="job"><?php echo $row->nama_role;?></p></td>
						<td valign="middle"><?php echo $row->birth_place.",<br>".date('d-M-y',strtotime($row->birth_date));?></td>
						<td valign="middle"><?php echo $row->phone1;?></td>
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
