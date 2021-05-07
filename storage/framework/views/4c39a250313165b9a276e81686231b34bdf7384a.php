
<?php $__env->startSection('title'); ?>
ABP-system | BARGING PT. MHU
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
    <a href="<?php echo e(url('/barging')); ?>">BARGING PT. MHU</a>
    <br>
    <br>
  </div>
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Monitoring BARGING PT. MHU</h2>                  
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
  $min=0;
  $step=1;

if(!isset($bulanan)){
  foreach ($data as $key => $value) {
    $tgl[] = date("d F Y",strtotime($value->tgl));
    $plan[] = (float) $value->plan_daily;
    $actual[] = (float) $value->actual_daily;
  }
  $min = 2000;
  $step = 2000;
}else{  
  foreach ($data as $key => $value) {
    $tgl[] = date("F",strtotime($value->tgl));
    $plan[] = (float) $value->mtd_plan;
    $actual[] = (float) $value->mtd_actual;
  }
  $min = 5000;
  $step = 5000;
}

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
<?php
$total = count($tgl);
if($total<6){
  $tinggi = 120*($total*2);
}else{
  $tinggi = (120*$total);  
}
?>
<div class="row">
  <div id="mainb" style="height: <?php echo $tinggi;?>px;"></div>
</div>
<?php if(isset($ach)): ?>
<div class="row">
  <div id="mainbar" style="height: <?php echo $tinggi;?>px;"></div>
</div>
<?php endif; ?>
                    

                    
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
   <!--highchart-->
<script src="<?php echo e(asset('highchart/code/highcharts.js')); ?>"></script>
<script src="<?php echo e(asset('highchart/code/modules/exporting.js')); ?>"></script>
<script src="<?php echo e(asset('highchart/code/modules/export-data.js')); ?>"></script>
<script src="<?php echo e(asset('highchart/code/modules/series-label.js')); ?>"></script>

<script>
Highcharts.setOptions({
    lang: {
      decimalPoint: ',',
      thousandsSep: '.'
    }
});
Highcharts.chart('mainb', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Grafik Monitoring Produksi PT. MHU',
        style:{
          //fontSize:'50px'
        }
    },
    xAxis: {
        categories: <?php echo (json_encode($tgl));?>,
        title: {
            text: null,
             
        },
        labels:{
          style: {
                //fontSize: '48px'
            }
        }
    },
    yAxis: {
        min: <?php echo $min;?>,
        labels: {
            overflow: 'justify',
            style: {
                //fontSize: '30px'
            },
            formatter: function () {
                if(this.value>0){
                    return this.value/1000 + 'K MT';
                }else{
                    return this.value/1000 + ' MT';
                }
            }
        },
        tickInterval:<?php echo $step;?>,
        title: {
            text: 'Kumulatif MT',
            style: {
                            //fontSize: '38px'
                        }
        }
        
    },
    tooltip: {
        valueSuffix: ' MT',
        style:{
          //fontSize:'30px'
        }
    },
    plotOptions: {
        bar: {
            borderRadius: 10,
            dataLabels: {
                enabled: true,
                style: {
                          //fontSize: '30px'
                        },
                formatter: function() {
                   return this.y.toFixed(3).toString().replace('.', ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')+" MT";
                }
            },
            enableMouseTracking: false
        }
    },
    legend: {
        //layout: 'vertical',
        //align: 'top',
        verticalAlign: 'top',
      //  x: -90,
       // y: 250,
        floating: false,
        //padding: 45,
        //itemMarginTop: 5,
        //itemMarginBottom: 5,
        //fontSize:'30px',
       // borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
       // shadow: true,
        //width: '8%',
        //height: '10%',
        itemStyle: {
            fontSize:'17px',
            verticalAlign: 'middle',
            lineHeight: '14px'
        }
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'ACTUAL',
        data: <?php echo (json_encode($actual));?>,
        color:'#D93F07'
    }]
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