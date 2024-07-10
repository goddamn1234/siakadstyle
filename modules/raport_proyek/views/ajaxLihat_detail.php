<div class="panel panel-primary">
  <div class="panel-heading" style="background-color:#ff8181;"><b>Penilaian Siswa</div>
  <div class="panel-body">
       <table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Siklus</th>
                    <th> P-ke</th>
                    <th> Kriteria</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){
					  ?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_siklus;?></td>
						<td><?php echo $row->ke;?></td>
						<td><?php echo $row->kriteria;?></td>
						<td>
						<?php
							?>
							<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_detail;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						    <button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_detail;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>								
						<?php	
						?>
						</td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
        </table>
      </div>  
    </div>