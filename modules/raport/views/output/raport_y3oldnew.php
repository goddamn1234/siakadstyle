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
        .rotate {-webkit-transform: rotate(-90deg);-moz-transform: rotate(-90deg);-ms-transform: rotate(-90deg);-o-transform: rotate(-90deg);filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);transform:rotate(-90deg);transform-origin: 50%;width: 20px;}
		.pmd {color: #fff; background: #172742; border-color: #fff;}
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
			<td width="70px">Year <?php echo $raport_header->tingkat; ?></td>
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
			<td rowspan="3" align="center" style="border-top-color: #000; border-bottom-color: #000; width: 2cm"><div class="rotate"><br><br><br><br>CRITERIA</div></td>
			<td colspan="5" align="center" style="border-top-color: #000;">LEARNING CYCLE / ASSESMENT CIRCULAR</td>
			<td rowspan="3" align="center" style="border-top-color: #000; border-bottom-color: #000; width: 2.1cm">RESULT</td>
			<td rowspan="3" align="center" style="border-top-color: #000; border-bottom-color: #000; border-right-color: #000; width: 1.9cm">NOTES</td>
		</tr>
		<tr class="bold">
			<td align="center" style="width: 3.2cm">DISCOVERY</td>
			<td align="center" style="width: 3.2cm">EXPLORATION</td>
			<td align="center" style="width: 3.2cm">PRESENTATION</td>
			<td align="center" style="width: 3.2cm">PERSONALITY</td>
			<td align="center" style="width: 3.2cm">ACHIEVEMENT</td>
		</tr>
		<tr>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
			<td style="font-size: 8px; border-bottom: #000;">Description:</td>
		</tr>
	</table>

	<?php $batas = 6; $i=1; foreach($pmd as $key => $rl) { ?>
	<table border="1" class="list" <?php if($batas > 30) { echo 'style="page-break-before: always;"'; $batas = 0; } ?>>
		<?php foreach($learning as $ln) { $batas++; ?>
		<tr>
			<?php if($ln == 'pass') { ?>
				<td rowspan="3" align="center" style="font-weight: 700; width: 0.5cm"><?php echo $i; ?></td>
				<td rowspan="3" style="font-weight: 700; width: 2.8cm"><?php echo strtoupper($key); ?></td>
			<?php } ?>
			<td style="color: #fff; background: #172742; font-weight: 700; width: 2cm;"><?php echo strtoupper(substr($ln,0,1)).' ('.ucfirst($ln).')'; ?></td>
			<?php foreach($category as $c) { ?>
				<td valign="top" style="width: 2.4cm">
					<?php echo isset($pmd[$key][$ln][$c]) && $pmd[$key][$ln][$c]->nama_pmd ? $pmd[$key][$ln][$c]->nama_pmd : '&nbsp;'; ?>
				</td>
				<td style="font-weight: 700; width: 0.6cm" align="center"><?php 
					if(isset($pmd[$key][$ln][$c]) && $pmd[$key][$ln][$c]->pmd_result) {
						echo $pmd[$key][$ln][$c]->pmd_result == 'Y' ? 'YES' : 'NO';
					} else echo '&nbsp;'; ?></td>
			<?php } ?>

			<?php if($ln == 'pass') { ?>
				<td rowspan="3" align="center" style="font-weight: 700; width: 2.1cm"><?php echo strtoupper($rl['result_pmd']); ?></td>
				<td rowspan="3" align="center"><?php echo $rl['keterangan'] ? $rl['keterangan'] : '&nbsp;'; ?></td>
			<?php } ?>
		</tr>
		<?php } ?>
	</table>
	<?php $i++; } ?>

	<table border="1" class="list">
	
		<?php $no=1; foreach($raport_fmp as $key => $fm) { ?>
		<tr>
		<?php if($key == 0) {  ?>
        <td rowspan="<?php echo count($raport_fmp); ?>" style="font-weight: 700;width: 0.5cm">  <?php echo $no; ?> </td>
        <td rowspan="<?php echo count($raport_fmp); ?>" style="font-weight: 700;width: 2.8cm">  <?php echo $fm->nama_mapel; ?> </td>
        <?php $no++; } ?>
			
			<?php if($fm->flag_fmp == 'pass' && $key == $flag_span['pass']['start'] ) {
				echo '<td class="pmd" rowspan="'.$flag_span['pass']['rowspan'].'" style="width: 2cm">'.ucfirst( $fm->flag_fmp).'</td>';
			}elseif($fm->flag_fmp == 'merit' && $key == $flag_span['merit']['start']){
				echo '<td class="pmd" rowspan="'.$flag_span['merit']['rowspan'].'" style="width: 2cm">'.ucfirst( $fm->flag_fmp).'</td>';
			}elseif($fm->flag_fmp == 'distinction' && $key == $flag_span['distinction']['start']){
				echo '<td class="pmd" rowspan="'.$flag_span['distinction']['rowspan'].'" style="width: 2cm">'.ucfirst( $fm->flag_fmp).'</td>';
			}  
			 ?>
			 
			<?php if(empty($fm->DISCOVERY)) { ?>
				<td style="width:2.6cm;background:#000;font-size:7;">N</td>
				<td style="width:0.2px;background:#000;font-size:6;">N</td>
			<?php }else { ?>
				<td style="width:2.6cm;font-size:7;"><?php echo ucfirst( $fm->DISCOVERY); ?> </td>
				<td style="width:0.2cm;font-size:6;font-weight:700;"><?php echo $fm->r_self == Y ? 'YES':'NO'; ?></td>
			<?php } ?>
			<?php if(empty($fm->EXPLORATION)) { ?>
				<td style="width:2.6cm;background:#000;font-size:7;">N</td>
				<td style="width:0.2cm;background:#000;font-size:6;">N</td>
			<?php }else { ?>
				<td style="width:2.6cm;font-size:7;"><?php echo ucfirst($fm->EXPLORATION); ?> </td>
				<td style="width:0.2cm;font-size:6;font-weight:700;"> <?php echo $fm->r_expl == Y ? 'YES':'NO'; ?></td>
			<?php } ?>
			<?php if(empty($fm->PRESENTATION)) { ?>
				<td style="width:2.6cm;background:#000;font-size:7;">N</td>
				<td style="width:0.2cm;background:#000;font-size:6;font-weight:700;">N</td>
			<?php }else { ?>
				<td style="width:2.6cm;font-size:7;"><?php echo ucfirst($fm->PRESENTATION); ?></td>
				<td style="width:0.2cm;font-size:6;font-weight:700;"><?php echo $fm->r_pres == Y ? 'YES':'NO'; ?></td>
			<?php } ?>
			<?php if(empty($fm->PERSONALITY)) { ?>
				<td style="width:2.6cm;background:#000;font-size:7;">N</td>
				<td style="width:0.2cm;background:#000;font-size:6;font-weight:700;">N</td>
			<?php }else { ?>
				<td style="width:2.6cm;font-size:7;"><?php echo ucfirst($fm->PERSONALITY); ?> </td>
				<td style="width:0.2cm;font-size:6;font-weight:700;"> <?php echo $fm->r_pers == Y ? 'YES':'NO'; ?></td>
			<?php } ?>
			<?php if(empty($fm->ACHIEVEMENT)) { ?>
				<td style="width:2.6cm;background:#000;font-size:7;">N</td>
				<td style="width:0.2cm;background:#000;font-size:6;font-weight:700;">N</td>
			<?php }else { ?>
				<td style="width:2.6cm;font-size:7;"><?php echo ucfirst($fm->ACHIEVEMENT); ?> </td>
				<td style="width:0.2cm;font-size:6;font-weight:700;"><?php echo $fm->r_achi == Y ? 'YES':'NO'; ?></td>
			<?php } ?>
			<?php if($key == 0) { ?>
			<td rowspan="<?php echo count($raport_fmp); ?>" style="font-weight: 700;width: 2cm">  <?php echo strtoupper($fm->result_fmp); ?> </td>
			<?php } ?>
			<?php if($key == 0) { ?>
			<td rowspan="<?php echo count($raport_fmp); ?>" style="width: 1.9cm;font-size:7;">  <?php echo ucfirst($fm->keterangan); ?> </td>
			<?php } ?>
		</tr>
		<?php } ?>
	</table>

	<table border="1">
		<tr class="bold">
			<td align="center" style="width: 0.5cm; background: #172742; color: #fff; padding: 3px;border-color: #fff; border-left-color: #000;">NO</td>
			<td align="center" style="width: 5.5cm; background: #172742; color: #fff; padding: 3px;border-color: #fff;">SUBJECT</td>
			<td align="center" style="width: 2cm; background: #172742; color: #fff; padding: 3px;border-color: #fff;" align="center">SCORE</td>
			<td align="center" style="width: 3cm; background: #172742; color: #fff; padding: 3px;border-color: #fff;">RESULT</td>
			<td align="center" style="width: 15.3cm; background: #172742; color: #fff; padding: 3px;border-color: #fff; border-right-color: #000;">NOTES</td>
		</tr>
		<?php 
		$jml = 0; 
		foreach($raport_list as $r) {
		if($r->id_mapel != 27) {	
			 ?>
		<tr>
			<td align="center" style="padding: 3px;"><?php echo $no; ?></td>
			<td style="padding: 3px;font-weight:700;"><?php echo $r->nama_mapel; ?></td>
			<td align="center" style="padding: 3px;font-weight:700;"><?php echo $r->score; ?></td>
			<td align="center" style="padding: 3px;font-weight:700;">
				<?php
				//id 27 == FMP
				echo $r->id_mapel == 27 ? strtoupper($r->result_fmp) : strtoupper($r->result); 
				?>
			</td>
			<td style="padding: 3px;"><?php echo $r->keterangan; ?></td>
		</tr>
		<?php $no++; $jml += $r->score; } } ?>
		<tr class="bold">
			<td align="center" style="width: 0.5cm; background: #ddd; padding: 3px;">&nbsp;</td>
			<td align="center" style="width: 5.5cm; background: #ddd; padding: 3px; font-weight: 700;">AVERAGE</td>
			<td align="center" style="width: 2cm; background: #ddd; padding: 3px; font-weight: 700;" align="center"><?php echo count($raport_list)-1 ? number_format($jml /( count($raport_list)-1) ) : '0'; ?></td>
			<td align="center" style="width: 3cm; background: #ddd; padding: 3px; font-weight: 700;"><?php echo isset($raport_list[0]) ? strtoupper($raport_list[0]->result) : '&nbsp;'; ?></td>
			<td align="center" style="width: 15.3cm; background: #ddd; padding: 3px;">&nbsp;</td>
		</tr>
	</table>


	<table border="1">
		<tr>
			<td style="width: 26.2cm; padding: 0.5cm; min-height: 50px;">
				<strong>Notes :</strong>
				<div><?php echo $raport_header->keterangan_by_pr ? $raport_header->keterangan_by_pr : '-'; ?></div>
			</td>
		</tr>
	</table>

	<table id="paraf">
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

