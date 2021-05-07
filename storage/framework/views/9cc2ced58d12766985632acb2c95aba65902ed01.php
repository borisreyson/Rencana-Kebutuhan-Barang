
<?php $__env->startSection('title'); ?>
ABP-system | FORM Delay Crushing
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
		<!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('/css/timepicker.min.css')); ?>" rel="stylesheet">
<style>
.ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;height: 100px;

						overflow-y: auto;
						/* prevent horizontal scrollbar */
						overflow-x: hidden;
						}  

.ck-editor__editable {
		min-height: 90px;
}
 .modal-xl{
	width: 90%!important;
	margin-top: 50px;
 }
 table thead tr th, table tbody tr td {
	text-align: center;
 }
 input[type=time]{
 	height: 100%!important;margin: 0px!important;padding-top: 0px!important;padding-bottom: 0px!important;
 }

.active { z-index: 1!important; } 
</style>
<?php 
	$z=0;
	$d_Decode=0;
	if(isset($edit)){
		$d_Decode = ( json_decode($HLDelay));
	}
	//die();
 ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- page content -->

<div class="right_col" role="main">
	<div class="col-lg-12">
		<br>
		<a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i>
		<a href="<?php echo e(url('/monitoring/form/boat')); ?>">Form Delay Crushing</a>
		<br>
		<br>
	</div>
	<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Form Delay Crushing</h2>                  
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
<div class="row">
	<div class="col-xs-12">
<form class="form-horizontal" method="post" action="">
	<?php echo e(csrf_field()); ?>

	
	<div class="form-group">
		<label class="control-label col-lg-3">Tanggal</label>
		<div class="col-lg-2">
			<?php if(isset($edit) == 'true'): ?>
			<input type="text" name="tgl" disabled class="form-control" required="required" value="<?php echo e(date('d F Y',strtotime($d_Decode->tgl))); ?>">
			<?php else: ?>
			<input type="text" name="tgl" class="form-control" required="required" value="<?php echo e(date('d F Y')); ?>">
			<?php endif; ?>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-lg-3">Shift</label>
		<div class="col-lg-3">
			<?php if(isset($edit) == 'true'): ?>
			<div id="shift" class="btn-group" style="margin-bottom: 5px;" data-toggle="buttons">
				<?php if($d_Decode->shift==1): ?>
	            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="1" checked="checked"> &nbsp; Shift I &nbsp;
	            </label>
	            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="2"> Shift II
	            </label>
	            <?php elseif($d_Decode->shift==2): ?>
	            <label class="btn btn-default " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="1"> &nbsp; Shift I &nbsp;
	            </label>
	            <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="2" checked=""> Shift II
	            </label>
	            <?php endif; ?>
	          </div>
			<?php else: ?>
			<div id="shift" class="btn-group" style="margin-bottom: 5px;" data-toggle="buttons">
	            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="1" checked="checked"> &nbsp; Shift I &nbsp;
	            </label>
	            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="2"> Shift II
	            </label>
	          </div>
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-4 col-lg-offset-3" style="margin-bottom:5px; ">
			<?php if(isset($edit) == 'true'): ?>
			<div id="delayType" class="btn-group" data-toggle="buttons">
				<?php $__currentLoopData = $typeDelay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $type_delay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($type_delay->code==$d_Decode->type_delay): ?>
                    <label class="btn btn-default active" id="type_delay" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="type_delay" value="<?php echo e($type_delay->code); ?>" checked="checked"> &nbsp; <?php echo e($type_delay->desk); ?>	&nbsp;
                    </label>
                    <?php  
                    $z=$k;
                     ?>
                <?php else: ?>
                    <label class="btn btn-default" id="type_delay" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="type_delay" value="<?php echo e($type_delay->code); ?>"> &nbsp; <?php echo e($type_delay->desk); ?> &nbsp;
                    </label>
                <?php endif; ?>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
			<?php else: ?>

			<div id="delayType" class="btn-group" data-toggle="buttons">
				<?php $__currentLoopData = $typeDelay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($k==0): ?>
                    <label class="btn btn-default active" id="type_delay" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="type_delay" value="<?php echo e($v->code); ?>" checked="checked"> &nbsp; <?php echo e($v->desk); ?> &nbsp;
                    </label>
                    <?php else: ?>
                    <label class="btn btn-default" id="type_delay" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="type_delay" value="<?php echo e($v->code); ?>"> &nbsp; <?php echo e($v->desk); ?> &nbsp;
                    </label>
                    <?php endif; ?>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
			<?php endif; ?>
		</div>
	</div>
<?php if(!is_object($d_Decode)): ?>
	<div class="form-group">
		<label class="control-label col-lg-3">Work Hour</label>
		<div class="col-lg-2">
			<input type="text" name="w_h" class="form-control" placeholder="Work Hour">
		</div>
		<div class="col-lg-2">
			<input type="text" name="w_h_r" class="form-control" placeholder="Remark">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Standby</label>
		<div class="col-lg-2">
			<input type="text" name="stb" class="form-control" placeholder="Standby">
		</div>
		<div class="col-lg-2">
			<input type="text" name="stb_r" class="form-control" placeholder="Remark">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Breakdown</label>
		<div class="col-lg-2">
			<input type="text" name="b_d" class="form-control" placeholder="Breakdown">
		</div>
		<div class="col-lg-2">
			<input type="text" name="b_d_r" class="form-control" placeholder="Remark">
		</div>
	</div>
<?php else: ?>
	<?php $__currentLoopData = $d_Decode->DL; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kR => $vR): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo e($kR); ?></label>
		<div class="col-lg-2">
			<input type="text" name="<?php echo e($kR); ?>" class="form-control" placeholder="Work Hour" value="<?php echo e($vR); ?>">
		</div>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

	<div class="form-group">
		<div class="col-lg-offset-3 col-lg-3">
			<button class="btn btn-primary" type="submit">Simpan</button>  
			<a href="<?php echo e(url('/monitoring/form/delay/crushing')); ?>" class="btn btn-danger">Batal</a>  
		</div>
	</div>
</form>
	</div>
</div>
</div>
</div>
<div class="x_panel">
							 <div class="x_title">
									<h2>Delay Crushing Last Week</h2>                  
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-bordered table-striped">
				<?php
				$daily =  mysqli_query($konek,"select * from cr_delay_daily group by (tgl) order by date(tgl) desc limit 7");
				if($daily){
				if(mysqli_num_rows($daily)>0){
while($row = mysqli_fetch_object($daily)){
				?>
				<tr>
					<td style="vertical-align: middle;"><?php echo e(date("d F Y",strtotime($row->tgl))); ?></td>
					<td>
						<table class="table table-bordered" style="margin: 0px!important;padding: 0px!important;">
<?php
	$shift =  mysqli_query($konek,"select * from cr_delay_daily where tgl='".$row->tgl."' group by (shift) order by date(tgl) desc limit 7");
				while($row1 = mysqli_fetch_object($shift)){
?>
							<tr>
								<td style="text-align: center;vertical-align: middle;">
									<?php
									if($row1->shift==1){
										echo "Shift I";
									}else if($row1->shift==2 ){
										echo "Shift II";
									}
									?>
								</td>
								<td>
<table class="table table-bordered" style="margin: 0px!important;padding: 0px!important;">

<?php

	$cp =  mysqli_query($konek,"select * from cr_delay_daily left join type_delay on cr_delay_daily.type_delay = type_delay.code where tgl='".$row1->tgl."' and shift='".$row1->shift."' group by (type_delay) order by date(tgl) desc limit 7");
				while($row2 = mysqli_fetch_object($cp)){

?>
	<tr>
		<td style="vertical-align: middle;">
			<?php echo e($row2->desk); ?> 
		</td>
		<td>
			<table class="table table-bordered" style="margin: 0px!important;padding: 0px!important;">
<?php
$zx=0;
	$crTYPE =  mysqli_query($konek,"select * from cr_delay_daily  where tgl='".$row2->tgl."' and shift='".$row2->shift."' and type_delay='".$row2->type_delay."' order by date(tgl) desc limit 7");
				while($row3 = mysqli_fetch_object($crTYPE)){
?>
				<tr>
					<td style="text-align: left!important;">- <?php echo e($row3->typeCR); ?></td>
					<td > :  <?php echo e($row3->timeCR); ?> </td>
					<td > :  <?php echo e($row3->remark?$row3->remark:"-"); ?> </td>
					<?php if($zx==0): ?>
					<td rowspan="4" style="vertical-align: middle;text-align: center;">

<a href="<?php echo e(url('/monitoring/form/delay/crushing/q-'.bin2hex($row3->tgl).'?t='.bin2hex($row3->type_delay).'&sh='.bin2hex($row3->shift))); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
<?php if($row3->flag==0): ?>
<a href="<?php echo e(url('/monitoring/form/delay/crushing/undo-'.bin2hex($row3->tgl).'?t='.bin2hex($row3->type_delay).'&sh='.bin2hex($row3->shift))); ?>" class="btn btn-xs"><i class="fa fa-undo"></i></a>
<?php else: ?> 
<a href="<?php echo e(url('/monitoring/form/delay/crushing/delete-'.bin2hex($row3->tgl).'?t='.bin2hex($row3->type_delay).'&sh='.bin2hex($row3->shift))); ?>" class="btn btn-xs"><i class="fa fa-trash"></i></a>
<?php endif; ?>

					</td>	
					<?php endif; ?>	
				</tr>


<?php 
$arrTime[$z][] = $row3->timeCR;
$zx++;
} ?>

				<tr>
					<td  style="text-align: right;">
						Total :
					</td>
					<td><?php echo e(number_format(array_sum($arrTime[$z]),2)); ?></td>
				</tr>

			</table>
		</td>

	</tr>
<?php 
$z++;
} ?>

</table>
								</td>
							</tr>
				<?php } ?>
						</table> 
					</td>

				<?php } 
			}else{ ?>
					<tr>
						<td colspan="7" style="text-align: center;">No Record Data</td>
					</tr>
			<?php }
			} ?>
			</tbody>
		</table>
	</div>
</div>
								</div>
							</div>
						</div>
</div>
</div>



<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


		<!-- compose -->
		
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-xl">
<div id="konten_modal"></div>
	</div>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Datatables -->
		<!-- FastClick -->


<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<script src="<?php echo e(asset('/vendors/fastclick/lib/fastclick.js')); ?>"></script>
		<script src="<?php echo e(asset('/numeral/min/numeral.min.js')); ?>"></script>
		<!-- bootstrap-wysiwyg -->
		<script src="<?php echo e(asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
		<script src="<?php echo e(asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
		<script src="<?php echo e(asset('/vendors/google-code-prettify/src/prettify.js')); ?>"></script>
		<script src="<?php echo e(asset('/js/timepicker.min.js')); ?>"></script>



<script>
$("input[name=tgl]").datepicker({ dateFormat: 'dd MM yy' });
var pikerID = ['dl_daily','dl_mtd'];
var timepicker = new TimePicker(pikerID, {
  lang: 'en',
  theme: 'blue-grey'
});
timepicker.on('change', function(evt) {
  
  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;
  /* if (evt.element.id === 'dl_daily') {
    evt.element.value = value;
  } else {
    evt.element.value = value;
  }
  */
});
$("label[id=type_delay]").click(function(){
	eq = $("label[id=type_delay]").index(this);
	type_delay = $("input[name=type_delay]").eq(eq).val();
	if(eq == 0){
		$(".myLabel").fadeOut();
		$("div[id=dynamicForm]").fadeOut();
		$("input[name=dynamicField]").val(" ");
	}else if(eq == 1){
		$("div[id=dynamicForm]").hide();
		$("div[id=dynamicForm]").fadeIn();
		$(".myLabel").hide();
		$(".myLabel").eq(eq-1).fadeIn();
	}else if(eq == 2){
		$("div[id=dynamicForm]").hide();
		$("div[id=dynamicForm]").fadeIn();
		$(".myLabel").hide();
		$(".myLabel").eq(eq-1).fadeIn();

	}
});

</script>



<?php if(session('success')): ?>
	<script>
		setTimeout(function(){
new PNotify({
					title: 'Success',
					text: "<?php echo e(session('success')); ?>",
					type: 'success',
					hide: true,
					styling: 'bootstrap3'
			});
		},500);
	</script>
<?php endif; ?>
<?php if(session('failed')): ?>
	<script>
		setTimeout(function(){
new PNotify({
					title: 'Failed',
					text: "<?php echo e(session('failed')); ?>",
					type: 'error',
					hide: true,
					styling: 'bootstrap3'
			});
		},500);
	</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>