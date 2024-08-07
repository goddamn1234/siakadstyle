<?php
if($result->submit_teacher_co == 1){
		$is_submit = 'enabled';
	}else{
		$is_submit = '';
	}
?>	
<div class="col-md-12">
<div class="panel panel-primary">
	<div class="panel-heading">User Profile</div>
	<div class="panel-body">
	<div class="col-md-6">
	<table class="table">
			<tr>
				<td>Student Name</td>
				<td><?php echo $student->full_name;?></td>
			</tr>
			<tr>
				<td>Student Number</td>
				<td><?php echo $student->id_number;?></td>
			</tr>
			<tr>
				<td>Academic Year</td>
				<td><?php echo $student->tahun_akademik;?></td>
			</tr>
			<tr>
				<td>Batch</td>
				<td><?php if(substr($student->admission_date,0,4) == 0000){echo "-";}else{echo substr($student->admission_date,0,4)- 2013;} ?></td>
			</tr>
	</table>
	</div>
	<div class="col-md-6 pull-right">
		<table class="table">
			<tr>
				<td>Grade</td>
				<td>Year <?php echo $student->tingkat;?></td>
			</tr>
			<tr>
				<td>Semerster</td>
				<td><?php if(substr($student->periode,3) ==1){echo "1 (One)";}else{echo "2 (Two)";};?></td>
			</tr>
			<tr>
				<td>Periode</td>
				<td><?php echo substr($student->periode,0,3) ;?> Term report</td>
			</tr>
	</table>
	</div>
	</div>
</div>
</div>

<div class="col-md-12">
<div class="panel panel-primary">
	<div class="panel-heading">User Project Report </div>
	<div class="panel-body">
	
	<div class="x_panel">
        <div class="x_content">
          <!-- start project list -->
			<table class="table" id="project">
				<thead>
                      <tr>
						<th class="tg-yw4l" rowspan="2">Subject</th>
						<th class="tg-yw4l" rowspan="2">PMD</th>
						<th class="tg-yw4l" colspan="10">Learning Cycle / Assesment Circular</th>
						<th class="tg-yw4l" rowspan="2">Result</th>
						<th class="merging" rowspan="2">Note</th>
					  </tr>
					  <tr>
						<th class="tg-yw4l" style="max-width:250px;">SELF DISCOVERY</th>
						<td>&nbsp;</td>
						<th class="tg-yw4l" style="max-width:250px;">EXPLORATION</th>
						<td>&nbsp;</td>
						<th class="tg-yw4l" style="max-width:250px;">PRESENTATION</th>
						<th>&nbsp;</td>
						<th class="tg-yw4l" style="max-width:250px;">PERSONALITY</th>
						<td>&nbsp;</td>
						<th class="tg-yw4l" style="max-width:250px;">ACHIEVEMENT</th>
						<td>&nbsp;</td>
					  </tr>
                    </thead>
                    <tbody>
					<form class="form-horizontal">
					<div class="form-group">
					<?php $no=1;
					// var_dump($raport->result());
					foreach($raport->result() as $row){ ?>
						<tr>
							<td style="vertical-align:middle;"><?php echo $row->nama_mapel;?></td>
							<td style="vertical-align:middle;"> <b> <?php echo ucfirst( $row->flag_fmp ); ?> </b> </td>
							<td><?php if($row->DISCOVERY != NULL){echo $row->DISCOVERY;}else{echo ' ';}?></td>
							<td>
								<?php if($row->r_self != NULL){ ?>
									<select name="<?php echo $row->id_raport_fmp;?>" id="<?php echo $row->id_raport_fmp;?>" onChange="revisi('<?php echo $row->id_raport_fmp;?>','<?php echo $row->id_raport_result;?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_self =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_self =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
								
							
							</td>
							<td><?php echo $row->EXPLORATION;?></td>
							<td>
							
								<?php if($row->r_expl != NULL){ ?>
									<select name="<?php echo $row->id_raport_fmp;?>" id="<?php echo $row->id_raport_fmp;?>" onChange="revisi('<?php echo $row->id_raport_fmp;?>','<?php echo $row->id_raport_result;?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_expl =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_expl =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td><?php echo $row->PRESENTATION;?></td>
							<td>
							
								<?php if($row->r_pres != NULL){ ?>
									<select name="<?php echo $row->id_raport_fmp;?>" id="<?php echo $row->id_raport_fmp;?>" onChange="revisi('<?php echo $row->id_raport_fmp;?>','<?php echo $row->id_raport_result;?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_pres =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_pres =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td><?php echo $row->PERSONALITY;?></td>
							<td>
							
								<?php if($row->r_pers != NULL){ ?>
									<select name="<?php echo $row->id_raport_fmp;?>" id="<?php echo $row->id_raport_fmp;?>" onChange="revisi('<?php echo $row->id_raport_fmp;?>','<?php echo $row->id_raport_result;?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_pers =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_pers =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td><?php echo $row->ACHIEVEMENT;?></td>
							<td>
							
								<?php if($row->r_achi != NULL){ ?>
									<select name="<?php echo $row->id_raport_fmp;?>" id="<?php echo $row->id_raport_fmp;?>" onChange="revisi('<?php echo $row->id_raport_fmp;?>','<?php echo $row->id_raport_result;?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_achi =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_achi =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td class="resulted" style="vertical-align:middle"><?php echo $row->result_fmp;?></td>
							<?php if($row->keterangan == NULL || $row->keterangan ==''){
								$output = 'no notes for '.$row->nama_mapel;
								}else{
									$output = $row->keterangan;
								}?>
							<td class="merging" style="vertical-align:middle"><textarea onFocus="editableKet('<?php echo $row->id_raport_result;?>')" rows="5" name="ket" id="ket<?php echo $row->id_raport_result;?>" class="form-control" <?php echo $is_submit;?> ><?php echo $output;?></textarea><button type="button" class="btn btn-primary" id="<?php echo $row->id_raport_result;?>" style="display:none;" onClick="setKet('<?php echo $row->id_raport_result;?>')" <?php echo $is_submit;?> ><i class="fa fa-check"></i></button></td>
						</tr>
						
					<?php $no++; }?>
                      
                      </div>
					  </form>
                    </tbody>
                  </table>
                  <!-- end project list -->
                    <hr/>
                  <table class="table" id="score">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Score</th>
                            <th>Result</th>
                            <th>Note</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($raport2 as $key => $raport2) { if($raport2->id_mapel != '27') { ?>
                            <tr>
                                <td><input type="hidden" name="id_mapel" value="<?php echo $raport2->id_mapel; ?>"><input type="hidden" name="id_raport_result" value="<?php echo $raport2->id_raport_result; ?>"><?php echo $raport2->nama_mapel; ?></td>
                                <td><input type="text" name="score" value="<?php echo $raport2->score; ?>"> </td>
                                <td><?php echo $raport2->result; ?></td>
                                <td><textarea name="note" id="" cols="5" rows="1"><?php echo $raport2->keterangan; ?></textarea></td>
                                <td><button class="save_raport_score btn btn-primary">save</button></td>
                            </tr>
                        <?php } } ?>
                    </tbody>
                  </table>

                </div>
              </div>
	
	</div>
</div>
</div>



<div class="col-md-12">
<?php if($pmd->num_rows() == 0){
	$toggle = "style=display:none;";
}else{
	$toggle = '';
}
?>
<div class="panel panel-primary" <?php echo $toggle;?> >
	<div class="panel-heading">User Learning Report</div>
	<div class="panel-body">
	
	<div class="x_panel">
        <div class="x_content">
          <!-- start project list -->
			<table class="table table-striped projects" id="pmd_table">
				<thead>
                      <tr>
						<th class="tg-yw4l" rowspan="2">Subject</th>
						<th class="tg-yw4l" rowspan="2">PMD</th>
						<th class="tg-yw4l" colspan="10">Learning Cycle / Assesment Circular</th>
					  </tr>
					  <tr>
						<td class="tg-yw4l">SELF DISCOVERY</td>
						<td></td>
						<td class="tg-yw4l">EXPLORATION</td>
						<td></td>
						<td class="tg-yw4l">PRESENTATION</td>
						<td></td>
						<td class="tg-yw4l">PERSONALITY</td>
						<td></td>
						<td class="tg-yw4l">ACHIEVEMENT</td>
						<td></td>
					  </tr>
                    </thead>
                    <tbody>
				
					<?php $no=1;
					foreach($pmd->result() as $key => $row){ 
						?>
						<tr>
							<td class='nama_mapel' style="vertical-align:middle;"><?php echo $row->nama_mapel;?></td>
							<td><?php echo $row->flag_pmd;?></td>
							<td><?php echo $row->DISCOVERY;?></td>
							<td>
							
								<?php if($row->r_self){ ?>
									<select name="<?php echo $row->id_learning; ?>" id="<?php echo $row->id_learning; ?>"  onChange="revisi_learning('<?php echo $row->id_learning; ?>','<?php echo $row->id_raport_result; ?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_self =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_self =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td><?php echo $row->EXPLORATION;?></td>
							<td>
							
								<?php if($row->r_expl){ ?>
									<select name="<?php echo $row->id_learning;?>" id="<?php echo $row->id_learning;?>"  onChange="revisi_learning('<?php echo $row->id_learning; ?>','<?php echo $row->id_raport_result; ?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_expl =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_expl =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td><?php echo $row->PRESENTATION;?></td>
							<td>
							
								<?php if($row->r_pres){ ?>
									<select name="<?php echo $row->id_learning;?>" id="<?php echo $row->id_learning;?>"  onChange="revisi_learning('<?php echo $row->id_learning; ?>','<?php echo $row->id_raport_result; ?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_pres =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_pres =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td><?php echo $row->PERSONALITY;?></td>
							<td>
							
								<?php if($row->r_pers){ ?>
									<select name="<?php echo $row->id_learning;?>" id="<?php echo $row->id_learning;?>"  onChange="revisi_learning('<?php echo $row->id_learning; ?>','<?php echo $row->id_raport_result; ?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_pers =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_pers =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
							<td><?php echo $row->ACHIEVEMENT;?></td>
							<td>
							
								<?php if($row->r_achi){ ?>
									<select name="<?php echo $row->id_learning;?>" id="<?php echo $row->id_learning;?>"  onChange="revisi_learning('<?php echo $row->id_learning; ?>','<?php echo $row->id_raport_result; ?>')" <?php echo $is_submit;?> >
									<option value="Y" <?php if($row->r_achi =='Y'){echo "selected";}?> > Y </option>
									<option value="N" <?php if($row->r_achi =='N'){echo "selected";}?> > N </option>
								</select>
								<?php } ?>
							
							</td>
						</tr>
						
					<?php $no++; }?>
                      
                    </tbody>
                  </table>
                  <!-- end project list -->

                </div>
              </div>
	
	</div>
</div>
</div>
<div class="col-md-12">
	<textarea name="principal_note" class="form-control" id="principal_note" placeholder="note" <?php echo $is_submit;?> ><?php echo $result->keterangan_by_hr;?></textarea>
	
		<button type="button" class="btn btn-primary btn-xl submit" <?php echo $is_submit;?> ><i class="fa fa-save"></i> Save</button>
	
</div>
<style>
.projects {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

</style>

<input type="hidden" id="grade" name="grade" value="<?php echo $grade;?>" >
<input type="hidden" id="id_number" value="<?php echo $student->id_number;?>" >
<input type="hidden" id="raport_periode" value="<?php echo $student->id_raport_periode;?>" >

<script>
$(document).ready(function(){
	$(".submit").click(function(){
		var id_number = $("#id_number").val();
		var periode = $("#raport_periode").val();
		var grade = $("#grade").val();
		var note = $("#principal_note").val();
		$.ajax({
			url :"<?php echo site_url();?>principal/submit_principal",
			type:"post",
			data:"id_number="+id_number+"&periode="+periode+"&grade="+grade+"&note="+note,
			success:function(respon){
				location.reload();
			}
		});
	})
	
	$('#project').dataTable({
		scrollY: false,
        scrollX: "100px",
        scrollCollapse: true,
        paging:false,
		ordering:false,
		columnDefs: [
            { width: '20%', targets: 0 }
        ],
        fixedColumns: true
	});
	
	 $('#project').each(function () {
            var Column_number_to_Merge = 1;
 
            // Previous_TD holds the first instance of same td. Initially first TD=null.
            var Previous_TD = null;
            var i = 1;
            $("tbody",this).find('tr').each(function () {
                // find the correct td of the correct column
                // we are considering the table column 1, You can apply on any table column
                var Current_td = $(this).find('td:nth-child(' + Column_number_to_Merge + ')');
                 
                if (Previous_TD == null) {
                    // for first row
                    Previous_TD = Current_td;
                    i = 1;
                } 
                else if (Current_td.text() == Previous_TD.text()) {
                    // the current td is identical to the previous row td
                    // remove the current td
                    Current_td.remove();
                    // increment the rowspan attribute of the first row td instance
                    Previous_TD.attr('rowspan', i + 1);
                    i = i + 1;
                } 
                else {
                    // means new value found in current td. So initialize counter variable i
                    Previous_TD = Current_td;
                    i = 1;
                }
            });
        });
		
		var topMatchTd;
        var previousValue = "";
        var rowSpan = 1;

        $('.merging').each(function(){

            if($(this).text() == previousValue)
            {
              rowSpan++;
              $(topMatchTd).attr('rowspan',rowSpan);
              $(this).remove();
            }
            else
            {
              topMatchTd = $(this);
              rowSpan = 1;
            }

            previousValue = $(this).text();
        });

        $(".save_raport_score").click(function() {
			var $grade = $("#grade").val();
            var $item = $(this).closest("tr");
            var $tds = $item.find("input");
            var $note = $item.find('textarea[name="note"]').val();
            var $id_raport_result,$id_mapel,$score;
            $.each($tds, function() {              
               let input_name = $(this).attr("name");
               if(input_name === 'id_raport_result'){
                $id_raport_result =  $(this).val();
               }
			   if(input_name === 'id_mapel'){
                $id_mapel =  $(this).val();
               }
               if(input_name === 'score'){
                $score =  $(this).val();
               }

            });

			let sent_data = {grade: $grade, id_raport_result : $id_raport_result, id_mapel : $id_mapel, score : $score, note : $note }
			let url = "<?php echo site_url();?>principal/revisi_score_result_by_principal";
			$.post(url , sent_data, (resp) => {
				resp = JSON.parse(resp);
				if(resp.success){
					Lobibox.notify('success',{
					msg : 'Data Berhasil di Update',
					size: 'mini',
					delay:500
				});
				}
			} );
		


        });
		
	
})



function revisi(id_raport_fmp, id_raport_result){
	var result = $("#"+id_raport_fmp).val();
	var grade = $("#grade").val();
		$.ajax({
			url :"<?php echo site_url();?>principal/revisi_by_principal",
			type:"post",
			dataType:'JSON',
			data:"id_raport_result="+id_raport_result+"&id_raport_fmp="+id_raport_fmp+"&result="+result+"&grade="+grade,
			success:function(respon){
				Lobibox.notify('success',{
					msg : 'Data Berhasil di Update',
					size: 'mini',
					delay:1000
				});
				//$(".resulted").html(respon.new_result);
			}
		});
}


function revisi_learning(id_learning, id_raport_result){
	var result = $("#"+id_learning).val();
	var grade = $("#grade").val();
		$.ajax({
			url :"<?php echo site_url();?>principal/revisi_user_learning_by_principal",
			type:"post",
			dataType:'JSON',
			data:"id_learning="+id_learning+"&result="+result+"&grade="+grade+"&id_raport_result="+id_raport_result,
			success:function(respon){
				Lobibox.notify('success',{
					msg : 'Data Berhasil di Update',
					size: 'mini',
					delay:1000
				});
				//$(".resulted").html(respon.new_result);
			}
		});
}

function editableKet(a){
	$("#"+a).css('display','block');
}

function setKet(id){
	var ket = $("#ket"+id).val();
	var grade = $("#grade").val();
	$.ajax({
			url :"<?php echo site_url();?>principal/editKeterangan",
			type:"post",
			dataType:'JSON',
			data:"id_raport_result="+id+"&ket="+ket+"&grade="+grade,
			success:function(respon){
				Lobibox.notify('success',{
					msg : respon.message,
					size: 'mini',
					delay:1000
				});
				$("#"+id).css('display','none');
			}
		});
}

var seen = {};
$('#pmd_table tbody td').each(function() 
{
    var $this = $(this);
	var className = $this.attr('class');
	if(className != null){

		var index = $this.index();
		var txt =  $this.text();
		if (seen[index] === txt) 
		{
			$($this.parent().prev().children()[index]).attr('rowspan', 15);
			$this.hide();
		}
		else 
		{
			seen[index] = txt;
		}
	}
});

</script>