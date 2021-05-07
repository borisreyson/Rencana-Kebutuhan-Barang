
<?php $__env->startSection('title'); ?>
ABP-system | Monitoring SR (Stripping Ratio)
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
<style>
.ui-autocomplete { 
  position: absolute; cursor: default;z-index:9999 !important;height: 100px;
  overflow-y: auto;
  overflow-x: hidden;
}
.ck-editor__editable {
    min-height: 90px;
}
.modal-xl{
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
    <a href="<?php echo e(url('/boat')); ?>">Monitoring SR (Stripping Ratio)</a>
    <br>
    <br>
  </div>
  <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Monitoring SR (Stripping Ratio)</h2>                  
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
  <th colspan ="6" style="border-top: 3px solid #000;color: #000;font-weight: bolder;background-color: white;">
    Total Rows : <?php echo e(count($data)); ?>

  </th>
</tr>
      <tr style="background-color: #333;color: #f8f8f8;margin-top: 3px;">
        <th>Tanggal</th>
        <th>SR (Stripping Ratio)</th>
        <th>SR (Stripping Ratio) Expose</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $rataSR = [];
      $arrOB=[];
      $arrHL=[];
      $Expose=0;
      $arrExpose=[];
      ?>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e(date("d F Y",strtotime($v->tgl))); ?></td>
        <?php
        $ob = Illuminate\Support\Facades\DB::table("monitoring_produksi.ob")->where("tgl",$v->tgl)->first();
        if($v->tgl==$ob->tgl){
        if($v->actual_daily>0){
        $sr = ($ob->actual_daily/$v->actual_daily);
        }else{
          $sr=0;
        }
              array_push($rataSR,$sr);
              array_push($arrOB, $ob->actual_daily);
              array_push($arrHL, $v->actual_daily);
                
        ?>
        <?php if($ob->actual_daily>0): ?>
        <td><?php echo e(number_format($sr,2)); ?></td>
        <?php else: ?>
        <td><?php echo e(number_format(0,2)); ?></td>
        <?php endif; ?>
      <?php }else{ ?>
        <td>-</td>
      <?php } ?>
      <?php
        $stripping_ratio=Illuminate\Support\Facades\DB::table("monitoring_produksi.stripping_ratio")->where("tgl",$v->tgl)->first();
        if(isset($stripping_ratio->tgl)==$v->tgl && $v->tgl==$ob->tgl){
        if($v->actual_daily>0){
        $sr_expose = ($ob->actual_daily/($stripping_ratio->inventory+$v->actual_daily));
        }else{
          $sr_expose=0;
        }
        if($k==0){
              $Expose=$stripping_ratio->inventory;
        }
                
              array_push($arrExpose,$sr_expose);
        ?>
        <?php if(isset($stripping_ratio->inventory)>0): ?>
        <td><?php echo e(number_format($sr_expose,2)); ?></td>
        <?php else: ?>
        <td><?php echo e(number_format(0,2)); ?></td>
        <?php endif; ?>
      <?php }else{ ?>
        <td>-</td>
      <?php } ?>
      </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td colspan ="" style="border-top: 3px solid #000;color: #000;font-weight: bolder;background-color: white;border-bottom:3px solid #000;">
    Total Rows : <?php echo e(count($data)); ?>

    <span style="float: right;">Rata - Rata :</span>
  </td>
  <td style="border-top: 3px solid #000;color: #000;font-weight: bolder;background-color: white;border-bottom:3px solid #000;">
    <?php if(count($data)>0): ?> 
    <?php echo e(number_format(array_sum($rataSR)/count($data),2)); ?>

    <?php endif; ?>
  </td>
  <td style="border-top: 3px solid #000;color: #000;font-weight: bolder;background-color: white;border-bottom:3px solid #000;">
    <?php if(count($data)>0): ?>
    <?php echo e(number_format(array_sum($arrExpose)/count($data),2)); ?>

    <?php endif; ?>
  </td>
</tr>
 <?php if(count($data)>0): ?>
<tr>
  <td align="right">SR Month To Date : </td>
  <td style="font-weight: bolder;color: #000;"><?php  
  if(array_sum($arrHL)>0){
    $nilaiSR = (array_sum($arrOB)/array_sum($arrHL));
  }else{
    $nilaiSR=0;
  }
  echo number_format($nilaiSR,2);
  ?></td>
  <td style="font-weight: bolder;color: #000;"><?php  
  if($Expose>0){
    $nilaiSRExpose = (array_sum($arrOB)/(array_sum($arrHL) +$Expose) );
  }else{
    $nilaiSRExpose=0;
  }
  echo number_format($nilaiSRExpose,2);
  ?></td>
</tr>
<?php endif; ?>
    </tbody>
  </table>
</div>
      </div>
    </div>
  </div>
</div>
</div>
<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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