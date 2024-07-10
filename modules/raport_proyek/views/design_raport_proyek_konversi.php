	<style>
	    .tbl-main{
	        background:"#fff";
	        font-family="arial"; 
	        border-collapse: collapse;
	    }
	    .tbl-main th{
	        padding:4px;
	        color:#fff;
	        background:#001F60;
	        border:1px solid #eee;
	    }
	    .tbl-main td{
	        border:1px solid #222;
	        padding:10px 2px;
	    }
	    
	    .tbl-ctt{
	        background:"#fff";
	        border-collapse: collapse;
	    }
	    .tbl-ctt th{
	        padding:4px;
	        color:#fff;
	        background:#ff1111;
	        border:1px solid #ff0000;
	        padding:2px;
	    }
	    .tbl-ctt td{
	        border:1px solid #222;
	        padding:2px;
	    }
	    .back-biru{
	        color:#fff;
	        background:#001F60;
	        border-bottom:1px solid #fff !important;
	        padding:4px;
	    }
	    .back-merah{
	        color:#fff;
	        background:#ff1111;
	        border:1px solid #ff0000; 
	        padding:4px;
	    }
	    .gelap{
	        background:#000;
	    }
	</style>
	<?php foreach($header->result() as $head)?>
	<table width="100%">
		<tr>
			<td align="center">
				<img src="<?php echo 'image/logo.jpg'; ?>" alt="" width="200">
				<div style="font-size:20px;font-weight:bold"><?php echo $head->judul; ?></div>
			</td>
		</tr>
	</table>
	<table width="100%" class="bold">
		<tr>
			<td width="120px">Nama Siswa</td>
			<td width="20px"> : </td>
			<td width="260px"><?php echo $head->full_name; ?></td>
			<td rowspan="4" width="500px" valign="top" align="center"></h4></td>
			<td width="120px">Kelas</td>
			<td width="20px"> : </td>
			<td width="260px">Tahun ke <?php echo $head->tingkat; ?></td>
		</tr>
		<tr>
			<td>No. Induk Siswa</td>
			<td> : </td>
			<td><?php echo $head->murid; ?></td>
			<td>Semester</td>
			<td> : </td>
			<td><?php echo $head->semester; ?></td>
		</tr>
		<tr>
			<td>Tahun Ajaran</td>
			<td> : </td>
			<td><?php echo $head->tahun_akademik; ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
			<tr>
			<td>Angkatan</td>
			<td> : </td>
			<td><?php echo $head->angkatan; ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
     <table border="0" Width="100%" class="tbl-main" cellpadding="0">
         <tr><th colspan="2">LAPORAN PROYEK</th><th colspan="<?php echo $jml_siklus*2?>">SIKLUS BELAJAR</th></tr>
         <tr height="45"><th width="200">Judul Proyek</th><th width="200">Penjelasan Proyek</th>
         <?php foreach($siklus->result() as $siklus_pro) {?>
             <th colspan="2"><?php echo $siklus_pro->nama_siklus?></th>
          <?php } ?>     
             </tr>
         <?php for ($b=1;$b<=$max_item;$b++) {?>    
             <tr>
                 <?php if($b==1){ ?>
                    <td rowspan="<?php echo $max_item ?>"><?php echo $head->nama; ?></td><td rowspan="<?php echo $max_item ?>"><?php echo $head->penjelasan; ?></td>
                 <?php } ?>
                 <?php foreach($siklus->result() as $siklus_pro) {
                    if (!(isset($detail[$siklus_pro->siklus][$b-1]))) $wb="gelap"; else $wb="";
                    ?>
                   <td class="<?php echo $wb?>"><?php if (isset($detail[$siklus_pro->siklus][$b-1])) echo ucfirst($detail[$siklus_pro->siklus][$b-1])?></td>
                   <td class="<?php echo $wb?>"><?php if (isset($nilai[$siklus_pro->siklus][$b-1])) echo $nilai[$siklus_pro->siklus][$b-1]; ?></td>
             <?php } ?>
             </tr>
         <?php } ?>
         <?php if ($head->durasi=='') $wb1='gelap'; else $wb1='';
               if ($head->catatan_siswa=='') $wb2='gelap'; else $wb2='';
               if ($head->catatan_spesial=='') $wb3='gelap'; else $wb3='';
        ?>       
         <tr><td rowspan="3" class="back-merah" align="center"><b>CATATAN</b></td><td class="back-biru">DURASI</td></td><td class="<?php echo $wb1?>" colspan="<?php echo $jml_siklus*2?>"><?php echo $head->durasi; ?></td></tr>
         <tr></td><td class="back-biru">SISWA</td></td><td class="<?php echo $wb2?>" colspan="<?php echo $jml_siklus*2?>"><?php echo ucfirst($head->catatan_siswa); ?></td></tr>
         <tr></td><td class="back-biru">SPESIALIS</td></td><td class="<?php echo $wb3?>" colspan="<?php echo $jml_siklus*2?>"><?php echo ucfirst($head->catatan_spesial); ?></td></tr>
     </table>
	 <br>
      <table class="tbl-ctt" width="100%" cellpadding="2">
         <tr><th align="left">CATATAN</th></tr>
         <?php 
         $ctt="";
         foreach ($catat->result()  as $ct) $ctt=$ct->catatan;
              if ($ctt=='') $wb="gelap"; else $wb=''; ?>
         <tr height="40px"><td class="<?php echo $wb ?>"><?php echo ucfirst($ctt); ?></td></tr>
	 </table>
	 <br>
	 <table cellpadding="5px">
	     <tr><td>Jakarta, <?php echo  date("j F Y", strtotime($head->tgl_raport))?></td></tr>
	     <tr height="110" valign="bottom">
	         <td width="250px">
	             <?php if ($head->ttd_kepsek!=''){?>
	               <div><img src="image/signature/kepsek/<?php echo $head->ttd_kepsek ?>" height="70"></div>
	             <?php } ?>
	             ( <?php echo $head->kepsek?> )<br><b>Kepala Sekolah</b></td>
	         <td width="280px">
	        <?php if ($head->ttd_fasil!=''){?>
	              <div><img src="image/signature/fasil/<?php echo $head->ttd_fasil ?>" height="70"></div>
	        <?php } ?>
	            ( <?php echo $head->fasil?> )<br><b>Fasilitator (Wali Kelas)</b></td>
	         <td width="280px">
	        <?php if ($head->ttd_ortu!=''){?>
	              <div><img src="image/signature/parent/<?php echo $head->ttd_ortu ?>" height="70"></div>
	        <?php } ?>
	             ( <?php echo $head->ortu?> )<br><b>Orang Tua (Wali Murid)</b></td>
	     </tr>
	 </table>