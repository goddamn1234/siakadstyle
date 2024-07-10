	<style>
	    .tbl-main{
	        background:"#fff";
	        
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
	     .gelap{
	        background:#000;
	    }
	</style>
	<?php foreach($header->result() as $head)?>
	<?php foreach($periode->result() as $per)?>
	<table width="100%">
		<tr>
			<td align="center">
				<img src="image/logo.jpg" alt="" width="200">
				<div style="font-size:20px;font-weight:bold"><?php echo $head->judul; ?></div>
			</td>
		</tr>
	</table>
	<table width="100%" class="bold">
		<tr>
			<td width="120px">Nama Siswa</td>
			<td width="20px"> : </td>
			<td width="260px"><?php echo $head->full_name; ?></td>
			<td rowspan="4" width="500px" valign="top" align="center"></td>
			<td width="120px">Kelas</td>
			<td width="20px"> : </td>
			<td width="260px">Tahun ke <?php echo $head->tingkat; ?></td>
		</tr>
		<tr>
			<td>No. Induk Siswa</td>
			<td> : </td>
			<td><?php echo $head->id_number; ?></td>
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
	<table border="0" Width="100%" class="tbl-main" cellpadding="2">
	    <?php 
	       $tip='Z';$pel='Z';$i=0;$beda=false;
	      foreach($raport->result() as $rpt){
	         $i++; 
	         if ($pel!=$rpt->nama_mapel){
	               $pel=$rpt->nama_mapel;
	               $beda=true; 
	               if ($i>1) { 
	               ?>
	            <tr><td colspan="6" style=" color:#fff;background:#001F60;">Syarat Lulus : <?php echo $rpt->syarat ?></td></tr>
	            <?php }
	         } else $syarat_lulus=$rpt->syarat; 
	         
	         if ($tip!=$rpt->nama_tipe){
	            $tip=$rpt->nama_tipe;
	         
	         ?>
             </table>
	         <table border="0" Width="100%" class="tbl-main" cellpadding="2">
            	<tr>
            	    <th colspan="6" align="center">MATERI PENDUKUNG PROYEK</th>
            	</tr>
            	<tr>
                	<th width=200><?php echo $tip?></th><th width=80>KRITERIA</th><th colspan=2 width=300>INDIKATOR PENILAIAN</th><th width=100>HASIL</th><th width=410>CATATAN</th>
            	</tr>
		<?php } ?>
		        <tr>
		            <?php if ($beda==true){ ?>
		               <td rowspan="<?php echo $rpt->jml?>" style="position:relative"><?php echo $rpt->nama_mapel ?> 
		               <div style="height:20px;background:yellow;width:99%;"><?php echo $rpt->nguru?></div>
		            <?php } ?>
		            <td><?php echo $rpt->ke ?></td>
		            <td><?php echo ucfirst($rpt->isi_kriteria) ?></td>
		            <td width="50"><?php if ($rpt->nilai=='Y') echo 'YA'; else echo 'TIDAK';  ?></td>
		            <?php if ($beda==true){ ?> 
		               <td rowspan="<?php echo $rpt->jml ?>"> <?php echo $rpt->hasil_konversi ?></td>
		               <?php if ($rpt->catatan=="") $wb="gelap"; else $wb=""; ?>
	                   <td rowspan="<?php echo $rpt->jml?>" class="<?php echo $wb?>"><?php echo ucfirst($rpt->catatan); ?></td>
		           <?php }  $beda=false;?>        
		        </tr>
		 <?php 
		        
        	} ?>
        	<?php if ($rpt->dioutput=='Y'){?>
        	    <tr style=""><td style="background:#00FFFF;font-size:18px;height:40px"><b>Evaluasi Siswa</b></td><td colspan="5"><?php echo $rpt->evaluasi ?></td></tr>
        	<?php } ?>
	         <tr><td colspan="6" style=" color:#fff;background:#001F60;">Syarat Lulus : <?php echo ucfirst($rpt->syarat) ?></td></tr>
	     </table>
	     <br>
	     <table class="tbl-ctt" width="100%" cellpadding="2">
	         <tr><th align="left">CATATAN</th></tr>
	         <?php
	            $catatan='';
	            foreach ($catat->result() as $ct) $catatan=$ct->catatan; 
	             if ($catatan=='') $wb="gelap"; else $wb="";
	                ?>
	         <tr height="40px"><td class="<?php echo $wb;?>"><?php echo ucfirst($catatan)?></td></tr>
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