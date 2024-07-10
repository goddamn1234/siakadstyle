<!DOCTYPE html>
<html>
<head>
    <title>Save As PDF</title>
    <style>
        *{font-size: 10px;font-family: sans-serif}
        sup{font-size:8px}
        table{border-collapse: collapse; margin-bottom: 10px;}
        table td{border-color: #000}
        table.bold td, tr.bold td{font-weight: 700;}
        table.main td{padding: 3px; color: #fff; background: #172742; border-color: #fff;}
        table.list td{padding: 3px; word-wrap: break-word}
        .rotate {-webkit-transform: rotate(-90deg);-moz-transform: rotate(-90deg);-ms-transform: rotate(-90deg);-o-transform: rotate(-90deg);filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);transform:rotate(-90deg);transform-origin: 50%;width: 20px;margin:0px;margin-right: -27px;}
		
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td align="center">
				<img src="<?php echo 'image/logo-erudio-school-of-art.png'; ?>" alt="" width="200">
				<h4><?php echo substr($raport_header->periode,0,3) == 'MID' ? 'MID TERM REPORT' : 'END TERM REPORT'; ?></h4>
			</td>
		</tr>
	</table>
	<table width="100%" class="bold">
		<tr>
			<td width="100px">Student's Name</td>
			<td width="20px"> : </td>
			<td width="300px"><?php echo $raport_header->full_name; ?></td>
			<td>&nbsp;</td>
			<td width="100px">Grade</td>
			<td width="20px"> : </td>
			<td width="70px">Year - <?php echo $raport_header->tingkat; ?></td>
		</tr>
		<tr>
			<td>Student's Number</td>
			<td> : </td>
			<td><?php echo $raport_header->id_number; ?></td>
			<td>&nbsp;</td>
			<td>Semester</td>
			<td> : </td>
			<td><?php echo substr($raport_header->periode,3);
			if($raport_header->periode == 'MID1'){
				echo ' (one)';}else{echo ' (two)';}  ?></td>
		</tr>
		<tr>
			<td>Academic Year</td>
			<td> : </td>
			<td><?php echo $raport_header->tahun_akademik; ?></td>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td>Batch</td>
			<td> : </td>
			<td><?php echo substr($raport_header->admission_date,0,4)- 2012 <= 0 ? 1 : substr($raport_header->admission_date,0,4)- 2012; ?></td>
			<td colspan="4">&nbsp;</td>
		</tr>
	</table>
	<table border="1" class="main">
		<tr class="bold">
			<td rowspan="3" align="center" style="border-top-color: #000; border-bottom-color: #000; border-left-color: #000; width: 3.5cm">SUBJECT</td>
			<td rowspan="3" align="center" style="border-top-color: #000; border-bottom-color: #000; width: 0.5cm;" ><div class="rotate">CRITERIA</div></td>
			<td colspan="5" align="center" style="border-top-color: #000;">LEARNING CYCLE / ASSESMENT CIRCULAR</td>
			<td rowspan="3" align="center" style="border-top-color: #000; border-bottom-color: #000; width: 2.1cm">RESULT</td>
			<td rowspan="3" align="center" style="border-top-color: #000; border-bottom-color: #000; border-right-color: #000; width: 1.9cm">NOTES</td>
		</tr>
		<tr class="bold">
			<td align="center" style="width: 3.5cm">DISCOVERY</td>
			<td align="center" style="width: 3.5cm">EXPLORATION</td>
			<td align="center" style="width: 3.5cm">PRESENTATION</td>
			<td align="center" style="width: 3.5cm">PERSONALITY</td>
			<td align="center" style="width: 3.5cm">ACHIEVEMENT</td>
		</tr>
		<tr>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
		</tr>
	</table>
	<?php $batas = 6; $i=1; foreach($raport_list as $key => $rl) { 
		
		?>
	<table border="1" class="list" <?php 
		$add_row = isset($rl['pmd']) ? count($rl['detail']) + 5 : count($rl['detail']) + 1;
		if(isset($rl['pmd'])) {
			if($batas + $add_row > 25) { echo 'style="page-break-before: always;"'; $batas = 0; } 
		} else {
			if($batas + $add_row > 30) { echo 'style="page-break-before: always;"'; $batas = 0; }
		}
	?>>
		<?php $batas++; ?>
		<tr>
			<?php if(isset($rl['pmd'])) { ?>
				<td rowspan="<?php echo count($rl['detail']) + 5; ?>" align="center" style="font-weight: 700; width: 0.5cm"><?php echo $i; ?></td>
				<td rowspan="<?php echo count($rl['detail']) + 5; ?>" style="font-weight: 700; width: 2.8cm"><?php echo strtoupper($key); ?></td>
			<?php } else { ?>
				<td rowspan="<?php echo count($rl['detail']) + 1; ?>" align="center" style="font-weight: 700; width: 0.5cm"><?php echo $i; ?></td>
				<td rowspan="<?php echo count($rl['detail']) + 1; ?>" style="font-weight: 700; width: 2.8cm"><?php echo strtoupper($key); ?></td>
			<?php } ?>

			<td colspan="12" style="color: #172742; font-weight: 700" align="center">PROJECT REPORT</td>

			<?php if(isset($rl['pmd'])) { ?>
				<td rowspan="<?php echo count($rl['detail']) + 5; ?>" style="width: 1.9cm" align="center"><?php echo !$rl['keterangan'] ? '&nbsp;' : $rl['keterangan']; ?></td>
			<?php } else { ?>
				<td rowspan="<?php echo count($rl['detail']) + 1; ?>" style="width: 1.9cm" align="center"><?php echo !$rl['keterangan'] ? '&nbsp;' : $rl['keterangan']; ?></td>
			<?php } ?>

		</tr>
		<?php $j=1; foreach($rl['detail'] as $rd) { $batas++; 
				
				if(strlen($rd->DISCOVERY) >= 150){$style_dis = "font-size:8px;";}else{$style_dis = "font-size:10px;";}
				if(strlen($rd->EXPLORATION) >= 150){$style_exp = "font-size:8px;";}else{$style_exp = "font-size:10px;";}
				if(strlen($rd->PRESENTATION) >= 150){$style_pre = "font-size:8px;";}else{$style_pre = "font-size:10px;";}
				if(strlen($rd->PERSONALITY) >= 150){$style_per = "font-size:8px;";}else{$style_per = "font-size:10px;";}
				if(strlen($rd->ACHIEVEMENT) >= 150){$style_ach = "font-size:8px;";}else{$style_ach = "font-size:10px;";}
					
		
		?>
			<tr>
				<td align="center" style="width: 0.5cm"><?php echo $rd->flag; ?></td>
				<?php if($rd->DISCOVERY) { ?>
					
					<td style="width: 2.7cm;<?php echo $style_dis;?>;"><?php echo str_replace('students are able', 'Able', $rd->DISCOVERY);?></td>
					<td style="font-weight: 700; width: 0.6cm;<?php echo $style_dis;?>" align="center"><?php echo $rd->r_self == 'success' ? 'YES' : 'NO';?></td>
				<?php } else { ?>
					<td style="background: #000; width: 2.7cm;<?php echo $style_dis;?>">&nbsp;</td>
					<td style="background: #000; width: 0.6cm;<?php echo $style_dis;?>">&nbsp;</td>
				<?php } ?>

				<?php if($rd->EXPLORATION) { ?>
					<td style="width: 2.7cm;<?php echo $style_exp;?>;"><?php echo str_replace('students are able', 'Able', $rd->EXPLORATION);?></td>
					<td style="font-weight: 700; width: 0.6cm;<?php echo $style_exp;?>" align="center"><?php echo $rd->r_expl == 'success' ? 'YES' : 'NO';?></td>
				<?php } else { ?>
					<td style="background: #000; width: 2.7cm;<?php echo $style_exp;?>">&nbsp;</td>
					<td style="background: #000; width: 0.6cm;<?php echo $style_exp;?>">&nbsp;</td>
				<?php } ?>

				<?php if($rd->PRESENTATION) { ?>
					<td style="width: 2.7cm;<?php echo $style_pre;?>;"><?php echo str_replace('students are able', 'Able', $rd->PRESENTATION);?></td>
					<td style="font-weight: 700; width: 0.6cm;<?php echo $style_pre;?>" align="center"><?php echo $rd->r_pres == 'success' ? 'YES' : 'NO';?></td>
				<?php } else { ?>
					<td style="background: #000; width: 2.7cm;<?php echo $style_pre;?>">&nbsp;</td>
					<td style="background: #000; width: 0.6cm;<?php echo $style_pre;?>">&nbsp;</td>
				<?php } ?>

				<?php if($rd->PERSONALITY) { ?>
					<td style="width: 2.7cm;<?php echo $style_per;?>;"><?php echo str_replace('students are able', 'Able', $rd->PERSONALITY);?></td>
					<td style="font-weight: 700; width: 0.6cm;<?php echo $style_per;?>" align="center"><?php echo $rd->r_pers == 'success' ? 'YES' : 'NO';?></td>
				<?php } else { ?>
					<td style="background: #000; width: 2.7cm;<?php echo $style_per;?>">&nbsp;</td>
					<td style="background: #000; width: 0.6cm;<?php echo $style_per;?>">&nbsp;</td>
				<?php } ?>

				<?php if($rd->ACHIEVEMENT) { ?>
					<td style="width: 2.7cm;<?php echo $style_ach;?>;"><?php echo str_replace('students are able', 'Able', $rd->ACHIEVEMENT);?></td>
					<td style="font-weight: 700; width: 0.6cm;<?php echo $style_ach;?>" align="center"><?php echo $rd->r_achi == 'success' ? 'YES' : 'NO';?></td>
				<?php } else { ?>
					<td style="background: #000; width: 2.7cm;<?php echo $style_ach;?>">&nbsp;</td>
					<td style="background: #000; width: 0.6cm;<?php echo $style_ach;?>">&nbsp;</td>
				<?php } ?>	

				<?php if($j == 1) { ?>
				<td rowspan="<?php echo count($rl['detail']); ?>" align="center" style="font-weight: 700;"><?php echo strtoupper($rl['result']); ?></td>
				<?php } ?>		
			</tr>
		<?php $j++; } ?>





		<?php if(isset($rl['pmd'])) { $batas += 4; ?>
			<tr>
				<td colspan="12" style="color: #172742; font-weight: 700" align="center">LEARNING REPORT</td>
			</tr>
			<?php foreach($learning as $ln) { ?>
				<tr>
					<td style="color: #fff; background: #172742; font-weight: 700"><?php echo strtoupper(substr($ln,0,1)).' ('.ucfirst($ln).')'; ?></td>

					<?php foreach($category as $c) { ?>
						<td valign="top" style="width: 2.4cm">
							<?php echo isset($raport_list[$key]['pmd'][$ln][$c]) && $raport_list[$key]['pmd'][$ln][$c]->nama_pmd ? $raport_list[$key]['pmd'][$ln][$c]->nama_pmd : '&nbsp;'; ?>
						</td>
						<td style="font-weight: 700; width: 0.6cm" align="center"><?php 
							if(isset($raport_list[$key]['pmd'][$ln][$c]) && $raport_list[$key]['pmd'][$ln][$c]->pmd_result) {
								echo $raport_list[$key]['pmd'][$ln][$c]->pmd_result == 'Y' ? 'YES' : 'NO';
							} else echo '&nbsp;'; ?></td>
					<?php } ?>

					<?php if($ln == 'pass') { ?>
						<td rowspan="3" align="center" style="font-weight: 700;"><?php echo strtoupper($rl['result_pmd']); ?></td>
					<?php } ?>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<?php $i++; } ?>

	<table border="1">
		<tr>
			<td style="width: 26.2cm; padding: 0.5cm; min-height: 50px;">
				<strong>Notes :</strong>
				<div>
				<?php echo $raport_header->keterangan_by_pr ? $raport_header->keterangan_by_pr : '-'; ?>
				</div>
			</td>
		</tr>
	</table>

	<table>
		<tr>
			<td>Jakarta, <?php echo date('F jS Y'); ?>
			
			<div style="width: 200px; height: 120px; position: relative;">
			<img id="image1" style="position: relative;" src="<?php echo $school_stamp; ?>" width="120px"  />
			<img id="image2" style="position: absolute; top: 10px; left: 10px;" src="<?php echo $principal_signature; ?>" width="120px" />
			<br/>
			(<?php echo $principal_name; ?>)<br/><strong>PRINCIPAL</strong>
			</div>
			
			</td>
		</tr>
	</table>
</body>
</html>