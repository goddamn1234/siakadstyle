<table id="datatable2" class="table table-striped table-bordered">
			<thead>
				<tr style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #35495d; color: white;" role="row">
					<th> No </th>
                    <th> Role</th>
					<th> Description</th>
					<th> Action</th>
				</tr>
            </thead>
			<tbody>
			<?php $no=1;
				  foreach($list->result() as $row){?>
					  <tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->nama_role;?></td>
						<td><?php echo $row->ket;?></td>
						<td>
						<button <?php echo $otoU;?> class="btn btn-info btn-xs" type="button" onclick="edit(<?php echo $row->id_role;?>)" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></button>
						<button <?php echo $otoD;?> class="btn btn-danger btn-xs" type="button" onclick="del(<?php echo $row->id_role;?>)" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></button>
						<button <?php echo $otoU;?> class="btn btn-primary btn-xs" type="button" onclick="generate(<?php echo $row->id_role;?> )" data-toggle="tooltip" data-placement="top" title="generate menu"><i class="fa fa-sitemap"></i></button>
					  </tr>
				  <?php $no++; };  ?>
			</tbody>
</table>
<script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable2-buttons").length && $("#datatabl2e-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable2').dataTable();
            $('#datatable2-keytable').DataTable({
              keys: true
            });
            $('#datatable2-responsive').DataTable();
            $('#datatable2-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable2-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
        </script>