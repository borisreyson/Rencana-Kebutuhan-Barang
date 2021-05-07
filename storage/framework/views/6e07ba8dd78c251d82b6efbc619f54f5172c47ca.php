
<?php $__env->startSection('title'); ?>
ABP-system | Monitoring Unit Rental <?php if(isset($shift)): ?> Shift <?php echo e($shift); ?> <?php endif; ?>
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
.myButtonDiss{
  background-color: transparent;
  border: 0px;
  position: absolute;
  z-index: 999;
  font-size: 25px;
  right: 50px;
 }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
  $hm_awal=[];
  $hm_akhir=[];
  $abp1=[];
  $mtk1=[];
  $stb1=[];
  $bd1=[];
  $abp2=[];
  $mtk2=[];
  $stb2=[];
  $bd2=[];
  $total_hm1=[];
  $total_hm2=[];
  $tot_stb1=[];
  $tot_stb2=[];
  $tot_hm=[];
  $tot_bd=[];
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Monitoring Unit Rental <?php if(isset($shift)): ?> Shift <?php echo e($shift); ?> <?php endif; ?></h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">
<div class="col-lg-12 row">
  <div class="col-lg-12">  
<div class="row">
  <div class="col-xs-12 text-center">
    <?php $__currentLoopData = $Y; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($_GET['year'])): ?>
    <?php if($v==$_GET['year']): ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($v); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php else: ?>    
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($v); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php endif; ?>
    <?php else: ?>
    <?php if($v==date("Y")): ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($v); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php else: ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($v); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($v); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php endif; ?>
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
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php else: ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php endif; ?>
    <?php else: ?>
    <?php if($k==0): ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php else: ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e($_GET['year']); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php else: ?>
    <?php if($M[$k]==date('m')): ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e(date('Y')); ?>&m=<?php echo e($M[$k]); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e(date('Y')); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-default active"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php else: ?>
    <?php if(isset($_GET['unit'])): ?>
    <a href="?year=<?php echo e(date('Y')); ?>&m=<?php echo e($M[$k]); ?>&unit=<?php echo e($_GET['unit']); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php else: ?>
    <a href="?year=<?php echo e(date('Y')); ?>&m=<?php echo e($M[$k]); ?>" class="btn btn-xs btn-primary"><?php echo e($v); ?></a>
    <?php endif; ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <?php endif; ?>
</div>
  </div>
</div>
<div class="col-lg-12">
  <hr>
</div>
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="row">
<?php if(isset($unit)): ?>
<form class="form-horizontal" method="get" action="">

  <div class="form-group">
    <label class="control-label col-lg-1 col-md-3 col-xs-12">Unit</label>
    <div class="col-lg-2 col-md-6 col-xs-12">
      <select name="unit" class="form-control" data-live-search="true">
      <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k =>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(isset($_GET['unit'])): ?>
      <?php if($_GET['unit']==$v->id_unit): ?>
      <option value="<?php echo e($v->id_unit); ?>" selected="selected"><?php echo e($v->nama_unit); ?></option>
      <?php else: ?>
      <option value="<?php echo e($v->id_unit); ?>"><?php echo e($v->nama_unit); ?></option>
      <?php endif; ?>
      <?php else: ?>
      <option value="<?php echo e($v->id_unit); ?>"><?php echo e($v->nama_unit); ?></option>
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    </div>
    <div class="col-lg-2 col-md-3 col-xs-12">
      <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
  </div>
</form>
<?php endif; ?>
</div>
</div>
<div class="col-lg-12">
  <hr>
</div>
<div class="container-fluid">
<div class="col-lg-12 col-xs-12 col-sm-12">
  <div class="row">
  <div class="table-responsive">
  <table class="table table-bordered text-center ">
    <thead>
      <tr class="bg-success">
        <th class="text-center">Date</th>
        <th class="text-center">Shift</th>
        <th class="text-center">Unit</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Hm Awal</th>
        <th class="text-center">Hm Akhir</th>
        <th class="text-center">Total HM</th>
        <th class="text-center">ABP</th>
        <th class="text-center">MTK</th>
        <th class="text-center">Standby</th>
        <th class="text-center">Breakdown</th>
        <th class="text-center">Total</th>
        <th class="text-center">PA</th>
        <th class="text-center">UA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="14" class="bg-danger">&nbsp;</td>
      </tr>
      <?php if(count($data)>0): ?>
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kd => $vd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php 
        $rental = Illuminate\Support\Facades\DB::table("monitoring_unit.data_hm_unit")
                ->join("monitoring_unit.unit","monitoring_unit.unit.id_unit","monitoring_unit.data_hm_unit.unit")
                ->whereRaw("tgl='".$vd->tgl."' and unit='".$vd->unit."'")
                ->get();
       ?>
      <?php $__currentLoopData = $rental; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <?php if($k==0): ?>
        <td rowspan="2" style="vertical-align: middle;"><?php echo e(date("d F Y",strtotime($v->tgl))); ?></td>
        <?php endif; ?>
        <td>
        <?php if($v->shift==1): ?>
        <?php 
        $hm_awal[$kd]   = $v->hm_awal;
        $abp1[$kd]      = $v->abp;
        $mtk1[$kd]      = $v->mtk;
        $stb1[$kd]      = $v->stb;
        $bd1[$kd]       = $v->bd;
        $total_hm1[]    = ($v->hm_akhir-$v->hm_awal);
        $tot_stb1[]     = $v->stb;
         ?>
              Shift I
            <?php elseif($v->shift==2): ?>
        <?php 
        $hm_akhir[$kd] = $v->hm_akhir;
        $abp2[$kd]     = $v->abp;
        $mtk2[$kd]     = $v->mtk;
        $stb2[$kd]     = $v->stb;
        $bd2[$kd]      = $v->bd;
        $total_hm2[]    =($v->hm_akhir-$v->hm_awal);
        $tot_stb2[]     = $v->stb;
         ?>
              Shift II
            <?php endif; ?>
        </td>
        <?php if($k==0): ?>
        <td rowspan="2" style="vertical-align: middle;"><?php echo e(($v->nama_unit)); ?></td>
        <?php endif; ?>
        <td><?php echo e($v->nama); ?></td>
        <td><?php echo e(number_format($v->hm_awal,1)); ?></td>
        <td><?php echo e(number_format($v->hm_akhir,1)); ?></td>
        <td><?php echo e(number_format(($v->hm_akhir-$v->hm_awal),1)); ?></td>
        <td><?php echo e(number_format($v->abp,1)); ?></td>
        <td><?php echo e(number_format($v->mtk,1)); ?></td>
        <td><?php echo e(number_format($v->stb,1)); ?></td>
        <td><?php echo e(number_format($v->bd,1)); ?></td>
        <td><?php echo e(number_format((($v->hm_akhir-$v->hm_awal)+$v->stb+$v->bd),1)); ?></td>

        <?php  
        $tot_hm[]=(($v->hm_akhir-$v->hm_awal)+$v->stb+$v->bd);
        $tot_bd[]=$v->bd;
          ?>
        <td>
          <?php if(($v->hm_akhir-$v->hm_awal)>0): ?>
          <?php echo e(((($v->hm_akhir-$v->hm_awal)+$v->stb)/(($v->hm_akhir-$v->hm_awal)+$v->stb+$v->bd))*100); ?>%
        <?php  $tot_pa[]=((($v->hm_akhir-$v->hm_awal)+$v->stb)/(($v->hm_akhir-$v->hm_awal)+$v->stb+$v->bd))*100;  ?>
          <?php else: ?>
          0
          <?php endif; ?>
        </td>
        <td><?php if(($v->hm_akhir-$v->hm_awal)>0): ?>
          <?php echo e(number_format((($v->hm_akhir-$v->hm_awal)/(($v->hm_akhir-$v->hm_awal)+$v->stb))*100,2)); ?> %
        <?php else: ?>
      0
    <?php endif; ?></td>
      </tr>
       <?php if(count($rental)==1): ?>
       <tr>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        </tr>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td class="bg-primary">Total</td>
        <td class="bg-primary" colspan="3"></td>
        <td class="bg-primary"><?php if(isset($hm_awal[$kd])): ?>
                                <?php echo e(number_format($hm_awal[$kd],1)); ?>

                              <?php else: ?> 
                                <?php echo e(number_format(0,1)); ?>

                              <?php endif; ?></td>
        <td class="bg-primary"><?php if(isset($hm_akhir[$kd])): ?>
                                  <?php echo e(number_format($hm_akhir[$kd],1)); ?>

                                <?php else: ?>
                              <?php echo e(number_format(0,1)); ?>

                              <?php endif; ?></td>
        <td class="bg-primary"><?php if(isset($hm_akhir[$kd] ) && isset($hm_awal[$kd])): ?>
                              <?php echo e(number_format(($hm_akhir[$kd]-$hm_awal[$kd]),1)); ?>

                            <?php else: ?>
                            <?php echo e(number_format(0,1)); ?>

                          <?php endif; ?></td>
        <td class="bg-primary"><?php if(isset($abp1[$kd]) && isset($abp2[$kd])): ?>
                                <?php echo e(number_format(($abp1[$kd]+$abp2[$kd]),1)); ?>

                              <?php else: ?>
                                <?php echo e(number_format(0,1)); ?>

                            <?php endif; ?></td>
        <td class="bg-primary"><?php if(isset($mtk1[$kd]) && isset($mtk2[$kd])): ?>
                                <?php echo e(number_format(($mtk1[$kd]+$mtk2[$kd]),1)); ?>

                              <?php else: ?>
                              <?php echo e(number_format(0,1)); ?>

                            <?php endif; ?></td>
        <td class="bg-primary">
                          <?php if(isset($stb1[$kd]) && isset($stb2[$kd])): ?>
                              <?php echo e(number_format(($stb1[$kd]+$stb2[$kd]),1)); ?>

                            <?php else: ?>
                            <?php echo e(number_format(0,1)); ?>

                          <?php endif; ?>
                        </td>
        <td class="bg-primary">
        <?php if(isset($bd1[$kd]) && isset($bd2[$kd])): ?>
        <?php echo e(number_format(($bd1[$kd]+$bd2[$kd]),1)); ?>

      <?php else: ?>
      <?php echo e(number_format(0,1)); ?>

    <?php endif; ?></td>
        <td class="bg-primary">
          <?php if(isset($hm_akhir[$kd]) && isset($hm_awal[$kd]) && isset($stb1[$kd]) && isset($stb2[$kd]) && isset($bd2[$kd])): ?>
          <?php echo e(number_format((($hm_akhir[$kd]-$hm_awal[$kd])+($stb1[$kd]+$stb2[$kd])+($bd2[$kd]+$bd2[$kd])),1)); ?>

          <?php else: ?>
          <?php echo e(number_format(0,1)); ?>

        <?php endif; ?></td>
        <td class="bg-primary">
          <?php if(isset($hm_akhir[$kd]) && isset($hm_awal[$kd]) && isset($stb1[$kd]) && isset($stb2[$kd]) && isset($bd2[$kd])): ?>
          <?php echo e(((($hm_akhir[$kd]-$hm_awal[$kd])+($stb1[$kd]+$stb2[$kd]))/(($hm_akhir[$kd]-$hm_awal[$kd])+($stb1[$kd]+$stb2[$kd])+($bd2[$kd]+$bd2[$kd])))*100); ?>%
          <?php else: ?>
          <?php echo e(number_format(0,1)); ?>

        <?php endif; ?></td>
        <td class="bg-primary">
        <?php if(isset($hm_akhir[$kd]) && isset($hm_awal[$kd]) && isset($stb1[$kd]) && isset($stb2[$kd]) && isset($bd2[$kd])): ?>
        <?php echo e(number_format((($hm_akhir[$kd]-$hm_awal[$kd])/(($hm_akhir[$kd]-$hm_awal[$kd])+($stb1[$kd]+$stb2[$kd])))*100,2)); ?> %
        <?php else: ?>
        <?php echo e(number_format(0,1)); ?>

        <?php endif; ?>
        </td>
      </tr>
      <tr>
        <td colspan="14" class="bg-danger">&nbsp;</td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <tr>
        <td colspan="14" style="background-color: rgba(0,0,0,0.5);color:#fff;" class="text-center">No Have Record!</td>
      </tr>
      <?php endif; ?>
      <?php if(count($data)>0): ?>
      <tr>
        <td style="background-color: black;color: white;">Total MTD</td>
        <td colspan="5" style="background-color: black;color: white;"></td>
        <td style="background-color: black;color: white;"><?php echo e(number_format(array_sum($total_hm1)+array_sum($total_hm2),1)); ?></td>
        <td colspan="2" style="background-color: black;color: white;"></td>
        <td style="background-color: black;color: white;"><?php echo e(number_format(array_sum($tot_stb1)+array_sum($tot_stb2),1)); ?></td>
        <td style="background-color: black;color: white;"></td>
        <td style="background-color: black;color: white;"><?php echo e(array_sum($tot_hm)); ?></td>
        <td style="background-color: black;color: white;">
<?php
if(array_sum($total_hm1)+array_sum($total_hm2)!=0){
$totPA = ((array_sum($total_hm1)+array_sum($total_hm2)+array_sum($tot_stb1)+array_sum($tot_stb2))/(array_sum($total_hm1)+array_sum($total_hm2)+array_sum($tot_stb1)+array_sum($tot_stb2)+array_sum($tot_bd)))*100;
echo number_format($totPA,2)." %";
}
?>
        </td>
        <td style="background-color: black;color: white;">
<?php
if(array_sum($total_hm1)+array_sum($total_hm2)!=0){
$totUA = ((array_sum($total_hm1)+array_sum($total_hm2))/(array_sum($total_hm1)+array_sum($total_hm2)+array_sum($tot_stb1)+array_sum($tot_stb2)))*100;
echo number_format($totUA,2)." %";
}
?>
        </td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
  </div>
  </div>
  </div>
</div>
<div class="col-lg-12 text-center">
  <!---PAGINATION-->
  <!---PAGINATION-->
</div>
</div>

                </div>
              </div>
            </div>

</div>
</div>


<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    

</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
<div id="konten_modal"></div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Datatables -->
    <!-- FastClick -->


<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="<?php echo e(asset('/vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo e(asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/google-code-prettify/src/prettify.js')); ?>"></script>
    <?php if(!isset($_GET['unit'])): ?>
<script>
  $(window).ready(function(){
    document.location.href="?unit="+$("select").val();
  });
</script>
    <?php endif; ?>
<script>
  $("select[name=unit]").on("change",function(){
    unit = $("select[name=unit]").val();
    if(unit!=""){
      window.location.href="?unit="+unit;
    }
  });
  $("select").selectpicker();
  $(".myButtonDiss").click(function(){
      document.location= "<?php echo e(url('/mon/unit/rental')); ?>";
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