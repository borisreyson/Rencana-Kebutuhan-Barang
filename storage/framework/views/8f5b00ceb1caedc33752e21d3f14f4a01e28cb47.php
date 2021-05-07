
<?php $__env->startSection('title'); ?>
ABP-system | Data Unit
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

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Data Unit</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">


<div class="col-lg-6">
  <div class="col-lg-12">
    <p><b>Jumlah : <?php echo e(count($unit)); ?></b> </p>
  </div>
  <table class="table table-bordered text-center">
    <thead>
      <tr class="bg-success">
        <th class="text-center">No</th>
        <th class="text-center">Unit</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr <?php if($v->flag!=1): ?> style="background-color: red;color: white;" <?php endif; ?>>
        <td class="text-center"><?php echo e($v->id_unit); ?></td>
        <td class="text-center"><?php echo e($v->nama_unit); ?></td>
        <td class="text-center">
          <a class="btn btn-warning btn-xs" href="<?php echo e(url('/mon/unit/rental/form/unit-'.bin2hex($v->id_unit))); ?>" id="edit"><i class="fa fa-pencil"></i></a>
          <?php if($v->flag==1): ?>
          <a class="btn btn-danger btn-xs" href="<?php echo e(url('/mon/unit/rental/unit-del'.bin2hex($v->id_unit))); ?>" id="edit"><i class="fa fa-trash"></i></a>
          <?php else: ?>
          <a class="btn btn-success btn-xs" href="<?php echo e(url('/mon/unit/rental/unit-undo'.bin2hex($v->id_unit))); ?>" id="edit"><i class="fa fa-undo"></i></a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
  <div class="col-lg-12">
    <p><b>Jumlah : <?php echo e(count($unit)); ?></b> </p>
  </div>

<div class="col-lg-12 text-center">
  <!---PAGINATION-->
  <?php echo e($unit->links()); ?>

  <!---PAGINATION-->
</div>
</div>


<div class="col-lg-6">
  <form class="form-horizontal" method="post" action="">
  <?php echo e(csrf_field()); ?>

  <div class="form-group">
    <label class="control-label col-lg-4">Nama Unit</label>
    <div class="col-lg-6">
      <?php if(isset($edit)): ?>
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="unit_old" class="form-control" required="required" value="<?php echo e($edit->nama_unit); ?>">
      <input type="text" name="unit" class="form-control" required="required" value="<?php echo e($edit->nama_unit); ?>">
      <?php else: ?>
      <input type="text" name="unit" class="form-control" required="required" placeholder="Data Unit">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-6 col-lg-4">
      <button class="btn btn-primary" id="Simpan" name="Simpan" type="submit">Simpan</button>  
      <a href="<?php echo e(url('/mon/unit/rental/form/unit')); ?>" class="btn btn-danger">Batal</a>  
    </div>
  </div>
</form>
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
    <?php if(isset($edit)): ?>
      <script>
        $("button[name=Simpan]").addClass("disabled").attr("disabled","disabled");
        $("input[name=unit]").keyup(function(){
          unit_old = $("input[name=unit_old]").val();
          Unit     = $("input[name=unit]").val();
          if(unit_old==Unit){
            $("button[name=Simpan]").addClass("disabled").attr("disabled","disabled");
          }else{
            $("button[name=Simpan]").removeClass("disabled").removeAttr("disabled");
          }
        });
      </script>
    <?php endif; ?>
<script>
  $(".myButtonDiss").click(function(){
      document.location= "<?php echo e(url('/sarpras/data/driver')); ?>";
    });
  $("button[id=newDriver]").click(function(){
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/driver/form')); ?>",
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
  });
  $("button[id=editDriver]").click(function(){
    eq = $("button[id=editDriver]").index(this);
    data_id = $("button[id=editDriver]").eq(eq).attr('data-id');
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/driver/edit')); ?>",
      data:{_token:"<?php echo e(csrf_token()); ?>",data_id:data_id},
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
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