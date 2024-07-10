<div class="col-md-12">
	<div class="col-md-6"><h3><i class="fa fa-book"></i> <?php echo $header->nama_mapel;?></h3></div>
	<div class="col-md-3"><article class="media event" style="display:inline;">
                    <a class="pull-left date">
                      <p class="month">Year</p>
                      <p class="day"><?php echo $header->tingkat_kelas;?></p>
                    </a>
                  </article>
				  <article class="media event" style="display:inline;">
                    <a class="pull-left date">
                      <p class="month">Target</p>
                      <p class="day"><?php echo $header->achiev_point;?></p>
                    </a>
                  </article>
				  </div>
	<div class="col-md-3"><a class="btn btn-app back pull-right"><i class="fa fa-reply"></i>Back</a></div>
	<hr>
</div>


<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
					<th> Category</th>
					<th> PMD</th>
					<th> Objective</th>
					<th> Point</th>
					<th> Save</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_category;?></td>
						<td><?php echo $row->flag_pmd;?></td>
						<td width='50%'><input type="text" style="width:100%;" class="form-control" name="pmd<?php echo $row->id_pmd;?>" id="pmd<?php echo $row->id_pmd;?>" value="<?php echo $row->nama_pmd;?>" ></td>
						<td><input type="number" style="width:70px;" class="form-control" name="point<?php echo $row->id_pmd;?>" id="point<?php echo $row->id_pmd;?>" value="<?php echo $row->point_pmd;?>" ></td>
						<td><button type="button" class="btn btn-primary btn-xs" onClick="save('<?php echo $row->id_pmd;?>')"><i class="fa fa-save"></i></button></td>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
			
			$(".back").click(function(){
				$("#isi").load('ajaxPmd');
			});
			
          });
		  
		  function save(id){
			  var objective = $("#pmd"+id).val();
			  var point = $("#point"+id).val();
			 $.ajax({
				url :"<?php echo site_url();?>/master/savePmd/"+id,
				type:"post",
				data:"id_pmd="+id+"&objective="+objective+"&point="+point,
				success:function(respon){
					Lobibox.notify('success', {
					msg: 'Data berhasil dirubah'
					});
				},
				error:function(){
					Lobibox.notify('error', {
					msg: 'Gagal Melakukan setting data PMD'
					});
				}
			})
		  }
        </script>