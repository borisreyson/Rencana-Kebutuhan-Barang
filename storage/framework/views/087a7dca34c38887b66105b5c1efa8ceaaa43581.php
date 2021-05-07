
<?php $__env->startSection('title'); ?>
ABP-system | Driver
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
                  <h2>Data Driver</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">
<div class="col-lg-12 row">
  <button class="btn btn-primary" id="newDriver" data-toggle="modal" data-target="#myModal">Tambah Data Driver</button>
  <div class=" col-lg-3 pull-right">
    <form method="get" action="" class="row col-lg-12 input-group pull-right">
    <span>
    <input type="text" name="cari" value="<?php if(isset($_GET['cari'])){ echo $_GET['cari']; } ?>" placeholder="Cari" required class="form-control">
    <?php if(isset($_GET['cari'])){ ?>
    <button class="myButtonDiss" type="button">&times;</button>
  <?php } ?>
    </span>
    <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </span>
  </form>
</div>
</div>

<div class="col-lg-12 row">
  <div class="col-lg-12">
    <p><b>Jumlah :</b> <?php echo e($j_dr); ?></p>
  </div>
  <table class="table table-bordered text-center">
    <thead>
      <tr class="bg-success">
        <th class="text-center">No Sim</th>
        <th class="text-center">Nik</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Jenis Sim</th>
        <th class="text-center">Masa Berlaku</th>
        <th class="text-center">Asal Sim</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($driver)>0): ?>
      <?php $__currentLoopData = $driver; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($v->no_sim); ?></td>
        <td><?php echo e($v->nik); ?></td>
        <td><?php echo e(ucwords($v->nama)); ?></td>
        <td><?php echo e($v->jenis_sim); ?></td>
        <td><?php echo e(date("d F Y",strtotime($v->berlaku_sim))); ?></td>
        <td><?php echo e(ucwords($v->kota_dikeluarkan)); ?></td>
        <td>
          <button class="btn btn-xs btn-warning" id="editDriver" name="editDriver" data-id="<?php echo e(bin2hex($v->no)); ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>
          <a href="<?php echo e(url('/sarpras/data/driver/delete-')); ?><?php echo e(bin2hex($v->no)); ?>" class="btn btn-xs btn-danger" id="deleteDriver" name="deleteDriver"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <tr>
        <td colspan="7" style="background-color: rgba(0,0,0,0.5);color:#fff;" class="text-center">No Have Record!</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
  <div class="col-lg-12">
    <p><b>Jumlah :</b> <?php echo e($j_dr); ?></p>
  </div>
</div>
<div class="col-lg-12 text-center">
  <!---PAGINATION-->
  <?php echo e($driver->links()); ?>

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