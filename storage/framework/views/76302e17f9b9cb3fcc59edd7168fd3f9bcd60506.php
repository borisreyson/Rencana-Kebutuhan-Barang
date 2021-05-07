
<?php $__env->startSection('title'); ?>
ABP-system | FORM BOAT
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
		<!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
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
</style>
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
		<a href="<?php echo e(url('/monitoring/form/boat')); ?>">Form BOAT</a>
		<br>
		<br>
	</div>
	<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Form Monitoring BOAT</h2>                  
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
<div class="row">
	<div class="col-xs-6">
<form class="form-horizontal" method="post" action="">
	<?php echo e(csrf_field()); ?>

	<div class="form-group">
		<label class="control-label col-lg-3">Tanggal</label>
		<div class="col-lg-4">
			<?php if(isset($edit) == 'true'): ?>
			<input type="text" name="tgl" disabled class="form-control" required="required" value="<?php echo e(date('d F Y',strtotime($daily->tgl))); ?>">
			<?php else: ?>
			<input type="text" name="tgl" class="form-control" required="required" value="<?php echo e(date('d F Y')); ?>">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Tug Boat</label>
		<div class="col-lg-5">
			<?php if(isset($edit) == 'true'): ?>
			<input type="text" name="boat" class="form-control" required="required" placeholder="Tug Boat" value="<?php echo e($daily->tugboat); ?>">
			<?php else: ?>
			<input type="text" name="boat" class="form-control" required="required" placeholder="Tug Boat">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Barge</label>
		<div class="col-lg-5">
			<?php if(isset($edit) == 'true'): ?>
			<input type="text" name="barge" class="form-control" required="required" placeholder="Barge" value="<?php echo e($daily->barge); ?>">
			<?php else: ?>
			<input type="text" name="barge" class="form-control" required="required" placeholder="Barge">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Time</label>
		<div class="col-lg-5">
			<?php if(isset($edit) == 'true'): ?>
			<input type="text" name="time_board" class="form-control" required="required" placeholder="Time" value="<?php echo e(($daily->time_board)); ?>">
			<?php else: ?>
			<input type="text" name="time_board" class="form-control" required="required" placeholder="Time">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Tonase</label>
		<div class="col-lg-5">
			<?php if(isset($edit) == "true"): ?>
			<input type="text" name="tonase" class="form-control" required="required" placeholder="Tonase" value="<?php echo e(number_format($daily->tonase,3)); ?>">
			<?php else: ?>
			<input type="text" name="tonase" class="form-control" required="required" placeholder="Tonase">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">Keterangan</label>
		<div class="col-lg-5">
			<?php if(isset($edit) == 'true'): ?>
			<input type="text" name="keterangan" class="form-control" required="required" placeholder="Keterangan" value="<?php echo e($daily->status); ?>">
			<?php else: ?>
			<input type="text" name="keterangan" class="form-control" required="required" placeholder="Keterangan">
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-3 col-lg-6">
			<button class="btn btn-primary" type="submit">Simpan</button>  
			<a href="<?php echo e(url('/monitoring/form/boat')); ?>" class="btn btn-danger">Batal</a>  
		</div>
	</div>
</form>
	</div>
	<div class="col-lg-6">
	  <div class="row text-center">
	    <h5>
	      Import Data From Excel
	      <hr>
	    </h5>
	  </div>
		<form class="form-horizontal" method="post" action="<?php echo e(url('/import/abp/boat')); ?>" enctype="multipart/form-data">
		  <?php echo e(csrf_field()); ?>

		  <div class="form-group">
		    <label class="control-label col-lg-3">Input File Excel</label>
		    <div class="col-lg-5">
		     <input name="fileExcel" class="form-control-static" type="file" required="required"> 
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-lg-offset-3 col-lg-6">
		      <button class="btn btn-primary" type="submit">Proses Data</button>  
		      <a href="<?php echo e(url('/monitoring/form/boat')); ?>" class="btn btn-danger">Batal</a>  
		    </div>
		  </div>
		</form>
	</div>
</div>
</div>
</div>
<div class="x_panel">
							 <div class="x_title">
									<h2>Boat Last Week</h2>                  
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr class="info">
					<th width="150px">Tanggal</th>
					<th>Tug Boat</th>
					<th>Barge</th>
					<th>Time</th>
					<th>Tonase</th>
					<th>Keterangan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
			$daily = Illuminate\Support\Facades\DB::table("monitoring_produksi.barge_boat")->orderBy("tgl","desc")->paginate(7);
        foreach($daily as $k =>$row){
				?>
				<?php if($row->flag=='2'): ?>
				<tr style="background-color: red;color: white;">
					<td><?php echo e(date("d F Y",strtotime($row->tgl))); ?></td>
					<td><?php echo e(($row->tugboat)); ?></td>
					<td><?php echo e(($row->barge)); ?></td>
					<td><?php echo e(($row->time_board)); ?></td>
					<td><?php echo e(number_format($row->tonase,3)); ?></td>
					<td><?php echo e($row->status); ?></td>
					<td>
            <?php if(isset($_GET['page'])): ?>
            <a style="color: white;" href="<?php echo e(url('/monitoring/form/boat/q-'.bin2hex($row->no))); ?>?page=<?php echo e($_GET['page']); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php else: ?>
            <a style="color: white;" href="<?php echo e(url('/monitoring/form/boat/q-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php endif; ?>
            <a style="color: white;" href="<?php echo e(url('/monitoring/form/boat/undo-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-undo"></i></a></td>
				</tr>
				<?php else: ?>
				<tr>
					<td><?php echo e(date("d F Y",strtotime($row->tgl))); ?></td>
					<td><?php echo e(($row->tugboat)); ?></td>
					<td><?php echo e(($row->barge)); ?></td>
					<td><?php echo e(($row->time_board)); ?></td>
					<td><?php echo e(number_format($row->tonase,3)); ?></td>
					<td><?php echo e($row->status); ?></td>
					<td>
            <?php if(isset($_GET['page'])): ?>
            <a href="<?php echo e(url('/monitoring/form/boat/q-'.bin2hex($row->no))); ?>?page=<?php echo e($_GET['page']); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php else: ?>
            <a href="<?php echo e(url('/monitoring/form/boat/q-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php endif; ?>
            <a href="<?php echo e(url('/monitoring/form/boat/delete-'.bin2hex($row->no))); ?>" class="btn btn-xs"><i class="fa fa-trash"></i></a></td>
				</tr>

				<?php endif; ?>
			<?php } ?>
			</tbody>
		</table>
	</div>
  <div class="col-lg-12 text-center"><?php echo e($daily->links()); ?></div>
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

<script>
$("input[name=tgl]").datepicker({ dateFormat: 'dd MM yy' });
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