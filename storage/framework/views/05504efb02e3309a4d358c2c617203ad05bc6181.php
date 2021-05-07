
<?php $__env->startSection('title'); ?>
ABP-system | Karyawan
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
<?php
//dd(date("Y-m-d H:i:s",strtotime("-1 Days")));
$arrRULE = [];
  if(isset($getUser)){
    $arrRULE = explode(',',$getUser->rule);    
  }else{
    ?>
<script>
  window.location="<?php echo e(url('/logout')); ?>";
</script>
    <?php } ?>
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
                  <h2>Data Karyawan</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">
<div class="col-lg-12 row">
<div class="row">
  <div class="col-md-6 col-sm-12 col-xs-12">
  <button class="btn btn-primary" id="newKaryawan" data-toggle="modal" data-target="#myModal">Tambah Data Karyawan</button>
</div>

<div class=" col-lg-3 pull-right">
    <form method="get" action="" class="row col-lg-12 input-group pull-right">
    <span>
    <input type="text" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?>" placeholder="Cari" required class="form-control">
    <?php if(isset($_GET['search'])){ ?>
    <button class="myButtonDiss" type="button">&times;</button>
  <?php } ?>
    </span>
    <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </span>
  </form>
</div>
</div>  
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="col-lg-12">
    <p><b>Jumlah :</b> <?php echo e($jumlah); ?></p>
  </div>
<div class=""> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="table-responsive">
  <table class="table table-bordered text-center">
    <thead>
      <tr class="bg-success">
        <th class="text-center">NIK</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Departemen</th>
        <th class="text-center">Devisi</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($karyawan)>0): ?>
      <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($v->nik); ?></td>
        <td><?php echo e(ucwords($v->nama)); ?></td>
        <td><?php echo e($v->dept); ?></td>
        <td><?php echo e($v->sect); ?></td>
        <td><?php echo e(ucwords($v->jabatan)); ?></td>
        <td class="text-right" width="200px">

          <?php if(in_array('admin sarpras',$arrRULE)): ?>
          <?php
          $cek_user = Illuminate\Support\Facades\DB::table("user_login")->where("nik",$v->nik)->first();
          if(!isset($cek_user->nik)){
          ?>
          <button class="btn btn-xs btn-default" id="createPass" name="createPass" data-id="<?php echo e(bin2hex($v->nik)); ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-key"></i> Create Password</button>
          <?php } ?>
          <?php endif; ?>
          <button class="btn btn-xs btn-warning" id="editKaryawan" name="editKaryawan" data-id="<?php echo e(bin2hex($v->nik)); ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>
          <a href="<?php echo e(url('/sarpras/data/karyawan/delete-')); ?><?php echo e(bin2hex($v->nik)); ?>" class="btn btn-xs btn-danger" id="deleteKaryawan" name="deleteKaryawan"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <tr>
        <td colspan="6" style="background-color: rgba(0,0,0,0.5);color:#fff;" class="text-center">No Have Record!</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
  </div>
  </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p><b>Jumlah :</b> <?php echo e($jumlah); ?></p>
  </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
  <!---PAGINATION-->
  <?php echo e($karyawan->links()); ?>

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
      document.location= "<?php echo e(url('/sarpras/data/karyawan')); ?>";
    });
  $("button[id=newKaryawan]").click(function(){
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/karyawan/form')); ?>",
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
  });
  $("button[id=editKaryawan]").click(function(){
    eq = $("button[id=editKaryawan]").index(this);
    data_id = $("button[id=editKaryawan]").eq(eq).attr('data-id');
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/karyawan/edit')); ?>",
      data:{_token:"<?php echo e(csrf_token()); ?>",data_id:data_id},
      success:function(res){
        $("div[id=konten_modal]").html(res);
      }
    });
  });
  $("button[id=createPass]").click(function(){
    eq = $("button[id=createPass]").index(this);
    data_id = $("button[id=createPass]").eq(eq).attr('data-id');
    $.ajax({
      type:"GET",
      url :"<?php echo e(url('/sarpras/data/karyawan/create/pwd')); ?>",
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