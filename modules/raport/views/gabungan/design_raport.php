	<style>
	    .tbl-main{
	        page-break-before:auto;
	        background:"#fff";
	        border-collapse: collapse;
	    }
	    .tbl-main th{
	        page-break-before:auto;
	        padding:4px;
	        color:#fff;
	        background:#001F60;
	        border:1px solid #eee;
	    }
	    .tbl-main td{
	        page-break-before:auto;
	        border:1px solid #222;
	        padding:2px;
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
	<?php foreach($header_pro->result() as $head_pro)?>
	<?php foreach($periode->result() as $per)?>
	<table width="100%">
		<tr>
			<td align="center">
				<img src="image/logo.jpg" alt="" width="200">
				<div style="font-size:20px;font-weight:bold"><?php echo $head->judul; ?></div>
			</td>
		</tr>
		<tr>
		</tr>
	</table>
	<table width="100%" class="bold">
		<tr>
			<td width="120px">Nama Siswa</td>
			<td width="20px"> : </td>
			<td width="260px"><?php echo $head->full_name; ?></td>
			<td rowspan="4" width="500px" valign="top" align="center"></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="120px">Kelas</td>
			<td width="20px"> : </td>
			<td width="260px">Tahun ke <?php echo $head->tingkat; ?></td>
		</tr>
		<tr>
			<td>No. Induk Siswa</td>
			<td> : </td>
			<td><?php echo $head->id_number; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
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
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>Angkatan</td>
			<td> : </td>
			<td><?php echo $head->angkatan; ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<br>
		</br>
	</table>
	 <table border="0" Width="95%" class="tbl-main" cellpadding="0">
         <tr><th colspan="2" width="30%">LAPORAN PROYEK</th><th colspan="<?php echo $jml_siklus*2?>" width="70%">SIKLUS BELAJAR</th></tr>
         <tr height="45"><th>Judul Proyek</th><th>Penjelasan Proyek</th>
         <?php foreach($siklus->result() as $siklus_pro) {?>
             <th colspan="2"><?php echo $siklus_pro->nama_siklus?></th>
          <?php } ?>     
             </tr>
         <?php for ($b=1;$b<=$max_item;$b++) {?>    
             <tr>
                 <?php if($b==1){ ?>
                    <td rowspan="<?php echo $max_item ?>" width="100"><?php echo $head_pro->nama; ?></td>
                    <td rowspan="<?php echo $max_item ?>" width="120" style="height:<?php echo $max_item*125?>px"><?php echo $head_pro->penjelasan; ?></td>
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
               if ($head_pro->dur_dioutput=="Y"){
                   $jml_catatan=$jml_catatan+1;
                   $label_catatan1='DURASI';
                   $catatan1=$head_pro->durasi;
               } 
               if ($head_pro->csis_dioutput =="Y"){
                   $jml_catatan=$jml_catatan+1;
                   if($jml_catatan==2){
                       $label_catatan2='SISWA';
                       $catatan2=$head_pro->catatan_siswa;
                   } else{
                       $label_catatan1='SISWA';
                       $catatan1=$head_pro->catatan_siswa;
                   }
               } 
                if ($head_pro->csp_dioutput =="Y"){
                   $jml_catatan=$jml_catatan+1;
                   if($jml_catatan==1){
                       $label_catatan1='SPESIALIS';
                       $catatan1=$head_pro->catatan_spesial;
                   } else if($jml_catatan==2){
                       $label_catatan2='SPESIALIS';
                       $catatan2=$head_pro->catatan_spesial;
                   } else {
                        $label_catatan3='SPESIALIS';
                        $catatan3=$head_pro->catatan_spesial ;
                   }
               } 
                if ($head_pro->ccp_dioutput =="Y"){
                  $jml_catatan=$jml_catatan+1;
                   if($jml_catatan==1){
                       $label_catatan1='TARGET CAPAIAN SISWA';
                       $catatan1=$head_pro->catatan_target ;
                   } else if($jml_catatan==2){
                       $label_catatan2='TARGET CAPAIAN SISWA';
                       $catatan2=$head_pro->catatan_target ;
                   } else if($jml_catatan==3){
                       $label_catatan3='TARGET CAPAIAN SISWA';
                       $catatan3=$head_pro->catatan_target ;
                   } else {
                       $label_catatan4='TARGET CAPAIAN SISWA';
                       $catatan4=$head_pro->catatan_target ;
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
     
	<table border="0" Width="100%" class="tbl-main" cellpadding="2" style="margin-bottom:20px;">
	    <?php 
	       $tip='Z';$pel='Z';$i=0;$beda=false;
	       $syarat_lulus_sbl='';
	      foreach($raport->result() as $rpt){
	         $i++; 
	         if ($pel!=$rpt->nama_mapel){
	               $pel=$rpt->nama_mapel;
	               $beda=true; 
	               if ($i>1) { 
	               ?>
	               <?php if ($dioutput=='Y'){?>
                	    <tr style=""><td style="background:#BDBDBD;font-size:18px;height:40px"><b>Evaluasi Siswa</b></td><td colspan="5"><?php echo $eval ?></td></tr>
                   <?php	} ?>    
                   <?php if($syarat_dioutput_sbl=="Y"){ ?>
	                    <tr><td colspan="6" style=" color:#fff;background:#001F60;">Syarat Lulus : <?php echo $syarat_lulus ?></td></tr>
	               <?php } ?>     
	            <?php }
	         } else {
	             $syarat_lulus=$rpt->syarat; 
	             $eval=$rpt->evaluasi;
	             $dioutput=$rpt->dioutput;
	             $syarat_dioutput_sbl=$rpt->syarat_dioutput;
	         }
	         
	         if ($tip!=$rpt->nama_tipe){
	            $tip=$rpt->nama_tipe;
	         
	         ?>
	         </table>
	         <br>
	         <table border="0" Width="100%" class="tbl-main" cellpadding="2">
            	<tr>
            	    <th colspan="6" align="center">MATERI PENDUKUNG PROYEK</th>
            	</tr>
            	<tr>
            		<th width=200><?php echo $tip?></th><th width=80>KRITERIA</th><th colspan=2>INDIKATOR PENILAIAN</th><th width=100 style="text-align:center">HASIL</th><th width=410>CATATAN</th>    <!-- edit 26092020-->
            	</tr>
		<?php } ?>
		        <tr>
		            <?php if ($beda==true){ ?>
		               <td rowspan="<?php echo $rpt->jml?>" style="">
		                   <div><?php echo $rpt->nama_mapel ?></div>                                                        <!-- edit 26092020-->
		                   <div style="height:20px;background:#BDBDBD;width:100%;"><?php echo $rpt->nguru?></div>
		               </td>
		            <?php } ?>
		            <td width="80">P<?php echo $rpt->ke ?></td>
		            <td width="220" height="30"><?php echo ucfirst($rpt->isi_kriteria) ?></td>
                    <?php if($rpt->nilai_dioutput=="T") $wb='gelap'; else $wb='' ?>
		            <td width="50" style="text-align:center" class="<?php echo $wb ?>"><?php if ($rpt->nilai=='Y') echo 'YA'; else echo 'TIDAK';  ?></td>     <!-- edit 26092020-->
		            <?php if ($beda==true){ ?> 
		               <?php if($rpt->tercapai_dioutput=="T") $wb='gelap'; else $wb='' ?>
		               <td style="text-align:center" rowspan="<?php echo $rpt->jml ?>" class="<?php echo $wb ?>"><?php if ($rpt->hasil=='Y') echo 'TERCAPAI'; else echo 'BELUM TERCAPAI';  ?></td>    <!-- edit 26092020-->
	                   <?php if ($rpt->catatan=="") $wb="gelap"; else $wb=""; ?>
	                   <td rowspan="<?php echo $rpt->jml?>" class="<?php echo $wb?>"><?php echo ucfirst($rpt->catatan)?></td>
		           <?php }  $beda=false;?>        
		        </tr>
        	<?php } ?>
        	 <?php if ($rpt->dioutput=='Y'){?>
        	    <tr style=""><td style="background:#00FFFF;font-size:18px;height:40px"><b>Evaluasi Siswa</b></td><td colspan="5"><?php echo $rpt->evaluasi ?></td></tr>
        <?php	} ?>
        	<?php if($rpt->syarat_dioutput=="Y"){ ?>
	            <tr><td colspan="6" style=" color:#fff;background:#001F60;">Syarat Lulus : <?php echo $syarat_lulus ?></td></tr>
	        <?php } ?> 
	     </table> 
	       <?php 
	           $catatan='';
	           foreach ($catat->result() as $ct) {
	               $catatan=$ct->catatan;
	               $catatan_siswa=$ct->catatan_siswa;
	               $catatan_dioutput=$ct->catatan_dioutput;
	               $catatan_siswa_dioutput=$ct->catatan_siswa_dioutput;
	           }    
	       ?>    
	     <br>
	     <?php if($catatan_dioutput=="Y"){?>
	     <table class="tbl-ctt" width="100%" cellpadding="2">
	         <tr><th align="left">CATATAN</th></tr>
	         <?php
	             if ($catatan=='') $wb="gelap"; else $wb="";
	             if($catatan_dioutput=="T") $wb="gelap"; 
	                ?>
	                <tr height="40px"><td class="<?php echo $wb?>"><?php  echo ucfirst($catatan)?></td></tr>
	     </table>
	     <br>
	     <?php } ?>
	    <?php
	    if($catatan_siswa_dioutput=="Y"){?>
	     <table class="tbl-ctt" width="100%" cellpadding="2">
	         <tr><th align="left">CATATAN SISWA</th></tr>
	         <?php 
	           $catatan_siswa='';
	           foreach ($catat->result() as $ct) {
	               $catatan=$ct->catatan;
	               $catatan_siswa=$ct->catatan_siswa;
	               $catatan_dioutput=$ct->catatan_dioutput;
	               $catatan_siswa_dioutput=$ct->catatan_siswa_dioutput;
	           }    
	             if ($catatan_siswa=='') $wb="gelap"; else $wb="";
	             if($catatan_siswa_dioutput=="T") $wb="gelap"; 
	                ?>
	                <tr height="40px"><td class="<?php echo $wb?>"><?php  echo ucfirst($catatan_siswa)?></td></tr>
	     </table>
	     	 <br>
	     <?php } ?>	 
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
	     <tr><td>Bogor, <?php echo  $tgl_raport[2] . ' ' . $bulan[ (int)$tgl_raport[1] ] . ' ' . $tgl_raport[0]; ?></td></tr>
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