
<?php $__env->startSection('title'); ?>
ABP-system | FORM HAULING MHU
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
    <a href="<?php echo e(url('/mhu/form/hauling')); ?>">Form HAULING MHU</a>
    <br>
    <br>
  </div>
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Form Monitoring HAULING MHU</h2>                  
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
      <input type="text" name="tgl" disabled class="form-control" required="required" value="<?php echo e(date('d F Y',strtotime($daily->tgl))); ?>">
      <?php else: ?>
      <input type="text" name="tgl" class="form-control" required="required" value="<?php echo e(date('d F Y')); ?>">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Actual Daily</label>
    <div class="col-lg-3">
      <?php if(isset($edit) == 'true'): ?>
      <input type="text" name="actual_daily" class="form-control" required="required" placeholder="Actual Daily" value="<?php echo e(number_format($daily->actual_daily,3)); ?>">
      <?php else: ?>
      <input type="text" name="actual_daily" class="form-control" required="required" placeholder="Actual Daily">
      <?php endif; ?>
    </div>
  </div>
      <?php if(isset($edit) == "true"): ?>
      <input type="hidden" name="mtd_plan" class="form-control" required="required" placeholder="Mtd Plan" value="<?php echo e(number_format($daily->mtd_plan,3)); ?>">
      <?php else: ?>
      <input type="hidden" name="mtd_plan" class="form-control" required="required" placeholder="Mtd Plan" value="<?php echo e($daily?number_format($daily->mtd_plan,3):'0'); ?>">
      <?php endif; ?>
  <div class="form-group">
    <label class="control-label col-lg-3">Mtd Actual</label>
    <div class="col-lg-3">
      <?php if(isset($edit) == "true"): ?>
      <input type="text" name="mtd_actual" class="form-control" required="required" placeholder="Mtd Actual" value="<?php echo e(number_format($daily->mtd_actual,3)); ?>">
      <?php else: ?>
      <input type="text" name="mtd_actual" class="form-control" required="required" placeholder="Mtd Actual">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Keterangan</label>
    <div class="col-lg-3">
      <?php if(isset($edit) == 'true'): ?>
      <input type="text" name="keterangan" class="form-control" required="required" placeholder="Keterangan" value="<?php echo e($daily->remark); ?>">
      <?php else: ?>
      <input type="text" name="keterangan" class="form-control" required="required" placeholder="Keterangan">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-3">
      <button class="btn btn-primary" type="submit">Simpan</button>  
      <a href="<?php echo e(url('/mhu/form/hauling')); ?>" class="btn btn-danger">Batal</a>  
    </div>
  </div>
</form>
  </div>
</div>
</div>
</div>
<div class="x_panel">
               <div class="x_title">
                  <h2>HAULING MHU Last Week</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
<div class="row">
  <div class="col-lg-12">
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="info">
          <th width="150px">Tanggal</th>
          <th>Actual Daily</th>
          <th>MTD </th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $daily =  Illuminate\Support\Facades\DB::table("monitoring_mhu.hauling")->orderBy("tgl","desc")->paginate(7);
        foreach($daily as $k =>$row){
        ?>
        <?php if($row->flag=='2'): ?>
        <tr style="background-color: red;color: white;">
          <td><?php echo e(date("d F Y",strtotime($row->tgl))); ?></td>
          <td><?php echo e(number_format($row->actual_daily,3)); ?></td>
          <td><?php echo e(number_format($row->mtd_actual,3)); ?></td>
          <td>
            <?php if(isset($_GET['page'])): ?>
            <a style="color: white;" href="<?php echo e(url('/mhu/form/hauling/q-'.bin2hex($row->tgl))); ?>?page=<?php echo e($_GET['page']); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php else: ?>
            <a style="color: white;" href="<?php echo e(url('/mhu/form/hauling/q-'.bin2hex($row->tgl))); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php endif; ?>
            <a style="color: white;" href="<?php echo e(url('/mhu/form/hauling/undo-'.bin2hex($row->tgl))); ?>" class="btn btn-xs"><i class="fa fa-undo"></i></a></td>
        </tr>
        <?php else: ?>
        <tr>
          <td><?php echo e(date("d F Y",strtotime($row->tgl))); ?></td>
          <td><?php echo e(number_format($row->actual_daily,3)); ?></td>
          <td><?php echo e(number_format($row->mtd_actual,3)); ?></td>
          <td>
            <?php if(isset($_GET['page'])): ?>
            <a href="<?php echo e(url('/mhu/form/hauling/q-'.bin2hex($row->tgl))); ?>?page=<?php echo e($_GET['page']); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php else: ?>
            <a href="<?php echo e(url('/mhu/form/hauling/q-'.bin2hex($row->tgl))); ?>" class="btn btn-xs"><i class="fa fa-pencil"></i></a>
            <?php endif; ?>
            <a href="<?php echo e(url('/mhu/form/hauling/delete-'.bin2hex($row->tgl))); ?>" class="btn btn-xs"><i class="fa fa-trash"></i></a></td>
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
const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 2
});
$("input[name=tgl]").datepicker({ dateFormat: 'dd MM yy' });

</script>

<?php if(isset($edit)): ?>
<script>
  $("input[name=actual_daily]").on("keyup",function(){
  actual_daily = $("input[name=actual_daily]").val().replace(/\,/g,'');
  date = $("input[name=tgl]").val();
  $.ajax({
    type:"GET",
    url:"<?php echo e(url('/mhu/monitoring/form/hauling/check')); ?>",
    data:{actual_daily:actual_daily,date:date},
    success:function(res){
      $("input[name=mtd_actual]").val(res);
    }
  });
});
</script>
<?php else: ?>
<script>
  $("input[name=actual_daily]").on("keyup",function(){
  actual_daily = $("input[name=actual_daily]").val().replace(/\,/g,'');
  $.ajax({
    type:"GET",
    url:"<?php echo e(url('/mhu/monitoring/form/hauling/check')); ?>",
    data:{actual_daily:actual_daily},
    success:function(res){
      $("input[name=mtd_actual]").val(res);
    }
  });
});
</script>
<?php endif; ?>

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