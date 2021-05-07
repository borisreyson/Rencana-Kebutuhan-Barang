
<?php $__env->startSection('title'); ?>
ABP-system | FORM Delay Ob
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
	$z;
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
		<a href="<?php echo e(url('/monitoring/form/boat')); ?>">Form Delay Ob</a>
		<br>
		<br>
	</div>
	<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Form Delay Ob</h2>                  
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
			<input type="text" name="tgl" disabled class="form-control" required="required" value="<?php echo e(date('d F Y',strtotime($HLDelay->tgl))); ?>">
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
				<?php if($HLDelay->shift==1): ?>
	            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="1" checked="checked"> &nbsp; Shift I &nbsp;
	            </label>
	            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
	              <input type="radio" name="shift" value="2"> Shift II
	            </label>
	            <?php elseif($HLDelay->shift==2): ?>
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
		<label class="control-label col-lg-3">Type Delay</label>
		<div class="col-lg-5	" style="margin-bottom:5px; ">
			<?php if(isset($edit) == 'true'): ?>
			<div id="delayType" class="btn-group" data-toggle="buttons">
				<?php $__currentLoopData = $typeDelay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $type_delay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($type_delay->code==$HLDelay->type_delay): ?>
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

	<div class="form-group">
		<label class="control-label col-lg-3"> Delay</label>
		<div class="col-lg-1">
			<?php if(isset($edit) == 'true'): ?>
			<input type="text" name="delay" class="form-control" id="delay" required="required" placeholder=" Delay" value="<?php echo e($HLDelay->delay); ?>">
			<?php else: ?>
			<input type="text" name="delay" class="form-control" id="delay" required="required"  placeholder=" Delay">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Keterangan</label>
		<div class="col-lg-3">
			<?php if(isset($edit) == 'true'): ?>
			<textarea name="keterangan" class="form-control" required="required" placeholder="Keterangan"><?php echo e($HLDelay->keterangan); ?></textarea>
			<?php else: ?>
			<textarea name="keterangan" class="form-control" required="required" placeholder="Keterangan"></textarea>
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-3 col-lg-3">
			<button class="btn btn-primary" type="submit">Simpan</button>  
			<a href="<?php echo e(url('/monitoring/form/delay/ob')); ?>" class="btn btn-danger">Batal</a>  
		</div>
	</div>
</form>
	</div>
</div>
</div>
</div>
<div class="x_panel">
							 <div class="x_title">
									<h2>Delay ob Last Week</h2>                  
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr class="info">
					<th width="150px">Tanggal</th>
					<th>Type Delay</th>
					<th>Shift</th>
					<th>Delay</th>
					<th>Keterangan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$daily =  mysqli_query($konek,"select * from ob_delay_daily order by date(tgl) desc limit 7");
				if($daily){
				if(mysqli_num_rows($daily)>0){
				while($row = mysqli_fetch_object($daily)){
				?>
				
				<?php if($row->flag=='2'): ?>
				<tr style="background-color: red;color: white;">
					<td><?php echo e(date("d F Y",strtotime($row->tgl))); ?></td>
					<td><?php echo e(($row->type_delay)); ?></td>
					<td>
						<?php if($row->shift==1): ?>
							Shift I
						<?php elseif($row->shift==2): ?>
							Shift II
						<?php endif; ?>
					</td>
					<td><?php echo e($row->delay); ?>

					
					<td><?php echo e($row->keterangan); ?></td>
					<td><a style="color: white;" href="<?php echo e(url('/monitoring/form/delay/ob/q-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a><a style="color: white;" href="<?php echo e(url('/monitoring/form/delay/ob/undo-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-undo"></i></a></td>
				</tr>
				<?php else: ?>
				<tr>
					<td><?php echo e(date("d F Y",strtotime($row->tgl))); ?></td>
					<td><?php echo e(($row->type_delay)); ?></td>
					<td>
						<?php if($row->shift==1): ?>
							Shift I
						<?php elseif($row->shift==2): ?>
							Shift II
						<?php endif; ?>
					</td>
					<td><?php echo e(($row->delay)); ?></td>
					<td><?php echo e($row->keterangan); ?></td>
					<td><a href="<?php echo e(url('/monitoring/form/delay/ob/q-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a><a href="<?php echo e(url('/monitoring/form/delay/ob/delete-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-trash"></i></a></td>
				</tr>

				<?php endif; ?>
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