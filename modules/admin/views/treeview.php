<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<table id="datatable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th> Menu </th>
                    <th> Buat </th>
					<th> Lihat </th>
					<th> Ubah </th>
					<th> Hapus</th>
				</tr>
            </thead>
			<tbody>
				<?php treeview($id_role);?>
             </tbody>
              </table>
			  <input type="hidden" id="id_role<?php echo $id_role;?>" value="<?php echo $id_role;?>" />
