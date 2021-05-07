
<?php $__env->startSection('title'); ?>
ABP-system | TugBoat
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
<style>
.ui-autocomplete 
  { 
    position: absolute; cursor: default;z-index:9999 !important;height: 100px;
    overflow-y: auto;
    overflow-x: hidden;
  }  
.ck-editor__editable 
  {
      min-height: 90px;
  }
 .modal-xl
 {
  width: 90%!important;
  margin-top: 50px;
 }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="right_col" role="main">
  <div class="col-lg-12">
    <br>
    <a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i>
    <a href="<?php echo e(url('/boat')); ?>">TugBoat</a>
    <br>
    <br>
  </div>
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Monitoring TugBoat</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

<?php
  $tgl = [];
  $plan = [];
  $actual = [];
  $Y = [];
  $M = [];
  $F = [];

  function Getangka($nilai)  { return number_format($nilai, 3, ",","."); }
  foreach($dataY as $k => $v)
  {
    $Y[] = date("Y",strtotime($v->tgl));
  }
  foreach($montH as $k => $v)
  {
    $F[] = date("F",strtotime($v->tgl));
    $M[] = date("m",strtotime($v->tgl));
  }
?>
<div class="row">
  <div class="col-xs-12 text-center">
    <?php $__currentLoopData = $Y; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($_GET['year'])): ?>
    <?php if($v==$_GET['year']): ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php else: ?>
    <?php if($v==date("Y")): ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <?php if(!isset($bulanan)): ?>
  <div class="col-xs-12 text-center">
    <?php $__currentLoopData = $F; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($_GET['year'])): ?>
    <?php if(isset($_GET['m'])): ?>
    <?php if($M[$k]==$_GET['m']): ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php else: ?>
    <?php if($k==0): ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php endif; ?>
    <?php else: ?>
    <?php if($M[$k]==date('m')): ?>
    <a href="?year=<?php echo e(date('Y')); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e(date('Y')); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <?php endif; ?>
</div>
<div class="row">
  <table class="table table-striped">
    <thead>
<tr>
  <th colspan ="6">
    Total Rows : <?php echo e(count($data)); ?>

  </th>
</tr>
      <tr class="danger">
        <th>Tanggal</th>
        <th>Tugboat</th>
        <th>Barge</th>
        <th>Time Board</th>
        <th>Tonase</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e(date("d F Y",strtotime($v->tgl))); ?></td>
        <td><?php echo e($v->tugboat); ?></td>
        <td><?php echo e($v->barge); ?></td>
        <td><?php echo e($v->time_board); ?></td>
        <td><?php echo e(Getangka($v->tonase)); ?></td>
        <td><?php echo e($v->status); ?></td>
      </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td colspan ="6">
    Total Rows : <?php echo e(count($data)); ?>

  </td>
</tr>
    </tbody>
  </table>
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

<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="<?php echo e(asset('/vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <script src="<?php echo e(asset('/numeral/min/numeral.min.js')); ?>"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo e(asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/google-code-prettify/src/prettify.js')); ?>"></script>

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