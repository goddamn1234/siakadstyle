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
    <table border="0" class="tbl-main" cellpadding="0" width="95%">
         <tr><th colspan="2" width="30%">LAPORAN PROYEK</th><th colspan="<?php echo $jml_siklus*2?>" width="70%">SIKLUS BELAJAR</th></tr>
         <tr height="45"><th>Judul Proyek</th><th>Penjelasan Proyek</th>
         <?php foreach($siklus->result() as $siklus_pro) {?>
             <th colspan="2"><?php echo $siklus_pro->nama_siklus?></th>
          <?php } ?>     
             </tr>
         <?php for ($b=1;$b<=$max_item;$b++) {?>    
             <tr>
                 <?php if($b==1){ ?>
                    <td rowspan="<?php echo $max_item?>" width="100"><?php echo $head->nama; ?></td>
                    <td rowspan="<?php echo $max_item?>" width="120" style="height:<?php echo $max_item*100?>px"><?php echo trim($head->penjelasan); ?></td>
                 <?php } ?>
                 <?php foreach($siklus->result() as $siklus_pro) {
                    if (!(isset($detail[$siklus_pro->siklus][$b-1]))) $wb="gelap"; else $wb="";
                    ?>
                   <td class="<?php echo $wb?>" style="width:150"><?php if (isset($detail[$siklus_pro->siklus][$b-1])) echo ucfirst($detail[$siklus_pro->siklus][$b-1])?></td>
                   <td class="<?php echo $wb?>" style="width:10"><?php if (isset($nilai[$siklus_pro->siklus][$b-1])) if ($nilai[$siklus_pro->siklus][$b-1]=='Y') echo 'YA'; else echo 'TIDAK' ?></td>
             <?php } ?>
             </tr>
         <?php } ?>
         <?php
               $jml_catatan=0;
               $catatan1=''; 
               $label_catatan1='';
               $catatan1='';
               $catatan2='';
               $catatan3='';
               $catatan4='';
               if ($head->dur_dioutput=="Y"){
                   $jml_catatan=$jml_catatan+1;
                   $label_catatan1='DURASI';
                   $catatan1=$head->durasi;
               } 
               if ($head->csis_dioutput =="Y"){
                   $jml_catatan=$jml_catatan+1;
                   if($jml_catatan==2){
                       $label_catatan2='SISWA';
                       $catatan2=$head->catatan_siswa;
                   } else{
                       $label_catatan1='SISWA';
                       $catatan1=$head->catatan_siswa;
                   }
               } 
                if ($head->csp_dioutput =="Y"){
                   $jml_catatan=$jml_catatan+1;
                   if($jml_catatan==1){
                       $label_catatan1='SPESIALIS';
                       $catatan1=$head->catatan_spesial;
                   } else if($jml_catatan==2){
                       $label_catatan2='SPESIALIS';
                       $catatan2=$head->catatan_spesial;
                   } else {
                        $label_catatan3='SPESIALIS';
                        $catatan3=$head->catatan_spesial ;
                   }
               } 
                if ($head->ccp_dioutput =="Y"){
                  $jml_catatan=$jml_catatan+1;
                   if($jml_catatan==1){
                       $label_catatan1='TARGET CAPAIAN SISWA';
                       $catatan1=$head->catatan_target ;
                   } else if($jml_catatan==2){
                       $label_catatan2='TARGET CAPAIAN SISWA';
                       $catatan2=$head->catatan_target ;
                   } else if($jml_catatan==3){
                       $label_catatan3='TARGET CAPAIAN SISWA';
                       $catatan3=$head->catatan_target ;
                   } else {
                       $label_catatan4='TARGET CAPAIAN SISWA';
                       $catatan4=$head->catatan_target ;
                   }      
               } 
               if ($catatan1=='') $wb1='gelap'; else $wb1='';
               if ($catatan2=='') $wb2='gelap'; else $wb2='';
               if ($catatan3=='') $wb3='gelap'; else $wb3='';
               if ($catatan4=='') $wb4='gelap'; else $wb4='';
        ?>
        <?php if( $jml_catatan>0){ ?> 
             <tr><td rowspan="<?php echo $jml_catatan ?>" class="back-merah" align="center"><b>CATATAN </b></td>
                 <td class="back-biru"><?php echo $label_catatan1 ?></td><td class="<?php echo $wb1?>" colspan="<?php echo $jml_siklus*2?>"><?php echo $catatan1; ?></td></tr>
             <?php if($jml_catatan>1){?>
                <tr><td class="back-biru"><?php echo $label_catatan2 ?></td><td class="<?php echo $wb2?>" colspan="<?php echo $jml_siklus*2?>"><?php echo $catatan2; ?></td></tr>
             <?php } ?>
             <?php if($jml_catatan>2){?>
                <tr><td class="back-biru"><?php echo $label_catatan3 ?></td><td class="<?php echo $wb3?>" colspan="<?php echo $jml_siklus*2?>"><?php echo $catatan3; ?></td></tr>
             <?php } ?>
             <?php if($jml_catatan>3){?>
                  <tr><td class="back-biru"><?php echo $label_catatan4 ?></td><td class="<?php echo $wb4?>" colspan="<?php echo $jml_siklus*2?>"><?php echo $catatan4; ?></td></tr>
             <?php } ?>
         <?php } ?>
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
	  <?php
	             $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
                );
                
                $tgl_raport = explode('-', $head->tgl_raport);

	     ?>	 
	 <table cellpadding="5px">
	     <tr><td>Jakarta, <?php echo  $tgl_raport[2] . ' ' . $bulan[ (int)$tgl_raport[1] ] . ' ' . $tgl_raport[0]; ?></td></tr>
	     <tr height="110" valign="bottom">
	         <td width="250px">
	             <?php if($head->jenjang==4){
	                if ($head->ttd_kepsek!=''){?>
	                   <div><img src="image/signature/kepsek/<?php echo $head->ttd_kepsek ?>" height="70"></div>
	                   ( <?php echo $head->kepsek?> )<br><b>Kepala Sekolah</b></td>
	             <?php } 
	                } else if($head->jenjang==3){
	                  if ($head->ttd_kepsek3!=''){?>
	                   <div><img src="image/signature/kepsek/<?php echo $head->ttd_kepsek3 ?>" height="70"></div>
	                   ( <?php echo $head->kepsek3?> )<br><b>Kepala Sekolah</b></td>
	             <?php }
	                }
	              ?>  
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