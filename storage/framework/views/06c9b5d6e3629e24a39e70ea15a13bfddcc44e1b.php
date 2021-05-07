
<?php $__env->startSection('title'); ?>
ABP-system | Delay Crushing
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
    <a href="<?php echo e(url('/boat')); ?>">Delay Crushing</a>
    <br>
    <br>
  </div>
  <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Monitoring Delay Crushing</h2>                  
    <div class="clearfix"></div>
  </div>
<div class="x_content">
<?php
  $fl;
  $tgl = [];
  $plan = [];
  $actual = [];
  $Y = [];
  $M = [];
  $F = [];
  $Tdaily=[]; 
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
<div class="row table-responsive">
  <table class="table table-bordered">
    <thead>
<tr>
  <th colspan ="6" style="border-top: 3px solid rgba(0,0,0,0.6);color: #000;font-weight: bolder;background-color: white;">
    Total Rows : <?php echo e(count($data)); ?>

  </th>
</tr>
      <tr style="background-color: rgba(0,0,0,0.6); color: #f8f8f8;margin-top: 3px;">
        <th style="border-left-color: rgba(0,0,0,0.1);border-right-color: rgba(0,0,0,0.1);">Tanggal</th>
        <th colspan="2" style="border-left-color: rgba(0,0,0,0.1);border-right-color: rgba(0,0,0,0.1);"></th>
      </tr>
    </thead>
    <tbody>

<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
  
$sum = Illuminate\Support\Facades\DB::table("monitoring_produksi.cr_delay_daily")
      ->whereRaW("tgL = '".$v->tgl."' and flag ='1'")
      ->groupby("shift")
      ->get();
      
?>  
<?php if(count($sum)>0): ?>
      <tr>
        <td style="text-align: center; vertical-align: middle;font-size: 16px;"><b><?php echo e(date("d F Y",strtotime($v->tgl))); ?></b></td>
        <td colspan="2">
          <table id="myTable"  class="table table-bordered" style="margin: 0px!important;">
      
<?php 
$groupCP = Illuminate\Support\Facades\DB::table("monitoring_produksi.cr_delay_daily")
      ->where('tgl',$v->tgl)
      ->groupby("shift")
      ->get();


 ?>
<?php $__currentLoopData = $groupCP; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $vv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
$groupCPflag = Illuminate\Support\Facades\DB::table("monitoring_produksi.cr_delay_daily")
      ->where([
                ['tgl',$v->tgl],
                ['shift',$vv->shift],
                ['flag',1]
              ])
      ->get();
      
 ?>
<?php if(count($groupCPflag)>0): ?>
      <tr>
        <td style="vertical-align: middle;text-align: center;">
          <?php if($vv->shift==1): ?>
            <span style="font-family: Times New Roman;font-size: 18px;">Shift I</span>
          <?php elseif($vv->shift==2): ?>
            <span style="font-family: Times New Roman;font-size: 18px;">Shift II</span>
          <?php endif; ?>
        </td>
        <td colspan="3">
<?php 
$typeDL = Illuminate\Support\Facades\DB::table("monitoring_produksi.cr_delay_daily")
      ->where([
      ['tgl',$v->tgl],
      ['shift',$vv->shift]
      ])
      ->leftjoin("monitoring_produksi.type_delay","monitoring_produksi.type_delay.code","monitoring_produksi.cr_delay_daily.type_delay")
      ->groupby("type_delay")
      ->get();

 ?>
<?php $__currentLoopData = $typeDL; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kkk => $vvv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
$tCR = Illuminate\Support\Facades\DB::table("monitoring_produksi.cr_delay_daily")
      ->where([
      ['tgl',$v->tgl],
      ['shift',$vv->shift],
      ['type_delay',$vvv->type_delay]
      ])
      ->get();

$tCR_flag = Illuminate\Support\Facades\DB::table("monitoring_produksi.cr_delay_daily")
            ->where([
            ['tgl',$v->tgl],
            ['shift',$vv->shift],
            ['type_delay',$vvv->type_delay],
            ['flag',1]
            ])
          ->get();   
 ?>
<?php if(count($tCR_flag)>0): ?>
<table class="table table-bordered" style="margin:0px!important;">
  <tr align="center">
    <td  style="vertical-align: middle;">
      <?php echo e($vvv->desk); ?>

    </td>
    <td>
<table class="table table-bordered" style="margin:0px!important;">
<?php $__currentLoopData = $tCR; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kkkk => $vvvv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><?php echo e($vvvv->typeCR); ?></td>
    <td><?php echo e(($vvvv->timeCR)); ?> </td>
    <td><?php echo e(($vvvv->remark?$vvvv->remark:"-")); ?> </td>
  </tr>
  <?php
  $v4arr[$k][$kk][$kkk][] = $vvvv->timeCR;
  ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td style="text-align: right;">
    Total : 
  </td>
  <td><?php echo e(array_sum($v4arr[$k][$kk][$kkk])); ?></td>
</tr>
<?php $v3sh[$k][$kk][] = array_sum($v4arr[$k][$kk][$kkk]); ?> 
</table>
    </td>
  </tr>
</table>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
      </tr>
<tr>
  <td>&nbsp;</td>
  <td style="text-align: right;">
    Total Daily Shift : 
  </td>
  <td width="146px">
    <?php 
    $dlSHIFT = number_format(array_sum($v3sh[$k][$kk]),2);
    $Tdaily[$k][] = $dlSHIFT;
    echo $dlSHIFT;
    ?>
    
  </td>
</tr>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
          </td>
      </tr>

<tr>
  <td>&nbsp;</td>
  <td style="text-align: right;">
    Total Daily :
  </td>
  <td width="154px">
    <?php 
    $dailyT = number_format(array_sum($Tdaily[$k]),2);
    $mtd[] = $dailyT;
    echo $dailyT;    
     ?>
  </td>
</tr>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td colspan="3" style="border-top: 3px solid rgba(0,0,0,0.09);color: #000;font-weight: bolder;background-color: white;border-bottom:3px solid rgba(0,0,0,0.6); font-size: 14px;">
    
    Total MTD : <?php if(isset($mtd)): ?> <?php echo e(number_format(array_sum($mtd),2)); ?> <?php else: ?> 0 <?php endif; ?>

  </td>
</tr>
<tr>
  <td colspan ="3" style="border-top: 3px solid rgba(0,0,0,0.6);color: #000;font-weight: bolder;background-color: white;border-bottom:3px solid rgba(0,0,0,0.6);">
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