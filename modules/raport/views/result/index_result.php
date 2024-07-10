<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-md-12 col-sm-12 col-xs-12" style="min-height:460px;">
	<div class="x_panel">
		<div class="x_title">
		<?php
			foreach($kelas->result() as $row ){?>
				<a href="#" onClick="point('<?php echo $row->id_assign;?>')" class="btn btn-circle btn-primary"><?php echo $row->nama_kelas; ?></a>
		<?php	} ?>
		
			<div class="clearfix"></div>
        </div>
        <div class="x_content" id="isi">
		

		</div>
	</div>
</div>



<style>
.btn-circle {
  width: 49px;
  height: 49px;
  text-align: center;
  padding: 5px 0;
  font-size: 20px;
  line-height: 2.00;
  border-radius: 30px;
}
.name {
    position: absolute;
    bottom: 0.5em;
    right: 0.5em;
    color: #ccc;
}
.name a {
    color: #ccc;
    text-decoration: none;
}
.bulat {
    width: 100px;
    height: 100px;
    position: relative;
    margin: 50px auto;
    cursor: pointer;
    border-radius: 110px;
    -webkit-border-radius: 110px;
}
#dalbulat {
    background-color: #222;
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    z-index: 2;
    border-radius: 110px;
    text-align: center;
    font-size:10px;
    color:#ccc;
    line-height: 90px;
}
.luarbulat {
    margin: 0 auto;
    background: #4FFC38;
    background: -webkit-radial-gradient(20% 20%, ellipse cover, #00ff00 0%, #21ca00 24%, transparent 74%, transparent 100%);
    background: radial-gradient(ellipse at 20% 20%, #00FF00 0%, #21CA00 24%, transparent 74%, transparent 100%);
    border-radius: 110px;
    padding: 10px;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    -webkit-animation-name: rotate;
    -webkit-animation-duration: 1s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: rotate;
    -moz-animation-duration: 1s;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    animation-name: rotate;
    animation-duration: 1s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}
#dalbulat span {
    -webkit-animation:color 1.5s linear infinite;
    -moz-animation:color 1.5s linear infinite;
    -ms-animation:color 1.5s linear infinite;
    -o-animation:color 1.5s linear infinite;
    animation:color 1.5s linear infinite;
}
#dalbulat span:nth-child(1) {
    -webkit-animation-delay:0s;
    -moz-animation-delay:0s;
    -ms-animation-delay:0s;
    -o-animation-delay:0s;
    animation-delay:0s;
}
#dalbulat span:nth-child(2) {
    -webkit-animation-delay:.25s;
    -moz-animation-delay:.25s;
    -ms-animation-delay:.25s;
    -o-animation-delay:.25s;
    animation-delay:.25s;
}
#dalbulat span:nth-child(3) {
    -webkit-animation-delay:.45s;
    -moz-animation-delay:.45s;
    -ms-animation-delay:.45s;
    -o-animation-delay:.45s;
    animation-delay:.45s;
}
#dalbulat span:nth-child(4) {
    -webkit-animation-delay:.55s;
    -moz-animation-delay:.55s;
    -ms-animation-delay:.55s;
    -o-animation-delay:.55s;
    animation-delay:.55s;
}
#dalbulat span:nth-child(5) {
    -webkit-animation-delay:.65s;
    -moz-animation-delay:.65s;
    -ms-animation-delay:.65s;
    -o-animation-delay:.65s;
    animation-delay:.65s;
}
#dalbulat span:nth-child(6) {
    -webkit-animation-delay:.75s;
    -moz-animation-delay:.75s;
    -ms-animation-delay:.75s;
    -o-animation-delay:.75s;
    animation-delay:.75s;
}
#dalbulat span:nth-child(7) {
    -webkit-animation-delay:.85s;
    -moz-animation-delay:.85s;
    -ms-animation-delay:.85s;
    -o-animation-delay:.85s;
    animation-delay:.85s;
}
@-webkit-keyframes rotate {
    from {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-moz-keyframes rotate {
    from {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes rotate {
    from {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-webkit-keyframes color {
    0% {
        color:#fff;
    }
    50% {
        color:transparent;
    }
    100% {
        color:#fff;
    }
}
</style>

<!-- Datatables-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/js/datatables/buttons.bootstrap.min.css">
		<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
        <!-- pace -->
        <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
<script>
$(document).ready(function(){
	
})
function nilai(id){
	var id_assign = $("#id_assign").val();
	$.ajax({
		url :"<?php echo site_url();?>/raport/nilai/",
		type:"post",
		data:"id_assign="+id_assign+"&id_raport_result="+id,
		success:function(respon){
			$("#isi").html("<div class='bulat'><div id='dalbulat'><span>W</span><span>A</span><span>I</span><span>T</span><span>I</span><span>N</span><span>G</span><span>.</span><span>.</span></div><div class='luarbulat'></div></div>");
			$("#isi").html(respon);
		}
	});
}
function nilai_y3(id){
	var id_assign = $("#id_assign").val();
	var score = $("#score"+id).val();
	var notes = $("#notes"+id).val();
	
	Lobibox.confirm({
		 title: "Are you sure ?",
		 msg: "If result Submited, You cannot edit this data anymore !",
		 callback: function ($this, type) {
			if (type === 'yes'){
				$.ajax({
					url :"<?php echo site_url();?>/raport/nilai_y3/",
					type:"post",
					data:"id_assign="+id_assign+"&id_raport_result="+id+"&score="+score+"&notes="+notes,
					success:function(respon){
						$("#isi").html("<div class='bulat'><div id='dalbulat'><span>W</span><span>A</span><span>I</span><span>T</span><span>I</span><span>N</span><span>G</span><span>.</span><span>.</span></div><div class='luarbulat'></div></div>");
						$("#isi").html(respon);
					}
				});
			}
		}
	})
}
function point(id){
	$.ajax({
		url :"<?php echo site_url();?>/raport/point/"+id,
		type:"get",
		success:function(respon){
			$("#isi").html("<div class='bulat'><div id='dalbulat'><span>W</span><span>A</span><span>I</span><span>T</span><span>I</span><span>N</span><span>G</span><span>.</span><span>.</span></div><div class='luarbulat'></div></div>");
			$("#isi").html(respon);
		}
	})
}
</script>