       <table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Siklus Belajar</th>
                    <th> P-ke</th>
                    <th> Isi Kriteria</th>
					<th> Tercapai<br> Muncul<br> di Output<br> 
				    	    <select name="tercapai_dioutput" style="background:#d9d9d;padding:2px;color:#aaa">
                                  <option value="Y" <?php foreach($nilai as $nil) if ($nil->syarat_dioutput=='Y') echo 'selected'?>>Ya</option>
                                  <option value="T" <?php foreach($nilai as $nil) if ($nil->syarat_dioutput=='T') echo 'selected'?>>Tidak</option>
                             </select>
                    </th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
			    if (count($list->result())>0)
				  foreach($list->result() as $row){
					  ?>
					  <input type="hidden" name="kriteria" value="<?php echo $row->isi_kriteria;?>">
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_siklus;?></td>
						<td><?php echo $row->ke;?></td>
						<td><?php echo $row->isi_kriteria;?></td>
						<td><?php if ($row->nilai=='Y') echo 'Ya';else if ($row->nilai=='T') echo 'Tidak'; ?></td>
						<td>
		                    <?php if (($bisa_edit=='0')||($periode!=$periode_aktif)) $st="visibility:hidden;"; else $st="";?>
		                   	<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_kriteria;?>)" data-toggle="tooltip" data-placement="top" title="ubah" style="<?php echo $st?>"><i class="fa fa-edit"></i></button>
						</td>
					  </tr>	
                 <?php $no++; } ?>
            </tbody>     
        </table>    