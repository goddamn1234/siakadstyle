<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">

<div class="x_panel">
	<div class="x_content">
	<div class="col-xs-3">
		<ul class="nav nav-tabs tabs-left">
		<?php foreach($role->result() as $row){?>
			<li><a href="#role<?php echo $row->id_role;?>" data-toggle="tab" onclick="akses(<?php echo $row->id_role;?>)"><?php echo $row->nama_role;?></a></li>
		<?php } ?>
        </ul>
	</div>
    <div class="col-xs-9">
		<!-- Tab panes -->
		<div class="tab-content">
        <?php foreach($role->result() as $tab){?>
			<div class="tab-pane" id="role<?php echo $tab->id_role;?>" ></div>
		<?php } ?>
        </div>
    </div>
	</div>

</div>

</div>
<script>
function akses(id){
	$.ajax({
		url :"<?php echo site_url();?>/admin/treeview/"+id,
		type:"post",
		success:function(hasil){
			$("#role"+id).html(hasil);
		}
	})
	
}
function create(id){
	var nilai = $("#cr"+id).val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/crakses",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai,
		success:function(pesan){
			Lobibox.notify('success',{
				msg : 'Data Berhasil di Update',
				size: 'mini',
				delay:1000
			});
		},
		error:function(){
			Lobibox.notify('error',{
				msg : 'Data Gagal di Update',
				size: 'mini',
				delay:1000
			});
		}
	})
}
function read(id){
	var nilai = $("#re"+id).val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/reakses",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai,
		success:function(pesan){
			Lobibox.notify('success',{
				msg : 'Data Berhasil di Update',
				size: 'mini',
				delay:1000
			});
		},
		error:function(){
			Lobibox.notify('error',{
				msg : 'Data Gagal di Update',
				size: 'mini',
				delay:1000
			});
		}
	})
}
function update(id){
	var nilai = $("#up"+id).val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/upakses",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai,
		success:function(pesan){
			Lobibox.notify('success',{
				msg : 'Data Berhasil di Update',
				size: 'mini',
				delay:1000
			});
		},
		error:function(){
			Lobibox.notify('error',{
				msg : 'Data Gagal di Update',
				size: 'mini',
				delay:1000
			});
		}
	})
}
function delet(id){
	var nilai = $("#de"+id).val();
	$.ajax({
		url :"<?php echo site_url();?>/admin/deakses",
		type:"post",
		data:"id_akses="+id+"&nilai="+nilai,
		success:function(pesan){
			Lobibox.notify('success',{
				msg : 'Data Berhasil di Update',
				size: 'mini',
				delay:1000
			});
		},
		error:function(){
			Lobibox.notify('error',{
				msg : 'Data Gagal di Update',
				size: 'mini',
				delay:1000
			});
		}
	})
}
</script>