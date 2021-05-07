
<?php $__env->startSection('title'); ?>
ABP-system | Data Karyawan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- bootstrap-progressbar -->
    <link href="<?php echo e(asset('/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php
$arrRULE = [];
  if(isset($getUser)){
    $arrRULE = explode(',',$getUser->rule);    
  }else{
    ?>
<script>
  window.location="<?php echo e(url('/logout')); ?>";
</script>
    <?php } ?>
<!-- page content -->

<div class="right_col" role="main">
 <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data<small> Karyawan</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <button class="btn btn-default" name="tmh_karyawan"  data-toggle="modal" data-target="#myModal">Tambah data Karyawan</button>
  <div class="col-lg-6 pull-right">
  <div class="row">
    <form method="get" class="col-xs-4 pull-right input-group">
    <input type="text" class="cari form-control" name="cari" placeholder="Cari...">
    <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
          </span>
    </form>
    </div>
  </div>
</div>
<div class="col-lg-12 col-sm-12 col-xs-12">
  <?php if(isset($_GET['status'])): ?>
  <?php if($_GET['status']=="aktif"): ?>
  <a href="?status=aktif" class="btn btn-primary active">Karyawan Aktif : <?php echo e($aktiv); ?></a> 
  <?php else: ?>
  <a href="?status=aktif" class="btn btn-primary">Karyawan Aktif : <?php echo e($aktiv); ?></a> 
  <?php endif; ?>
  <?php else: ?>
  <a href="?status=aktif" class="btn btn-primary">Karyawan Aktif : <?php echo e($aktiv); ?></a> 
  <?php endif; ?>
</div>
<div class="col-lg-12 col-sm-12 col-xs-12">

  <?php if(isset($_GET['status'])): ?>
  <?php if($_GET['status']=="tidak_aktif"): ?>
  <a href="?status=tidak_aktif" class="btn btn-danger active">Karyawan Tidak Aktif : <?php echo e($nonaktiv); ?></a> 
  <?php else: ?>
  <a href="?status=tidak_aktif" class="btn btn-danger">Karyawan Tidak Aktif : <?php echo e($nonaktiv); ?></a> 
  <?php endif; ?>
  <?php else: ?>
  <a href="?status=tidak_aktif" class="btn btn-danger">Karyawan Tidak Aktif : <?php echo e($nonaktiv); ?></a> 
  <?php endif; ?>  
</div>
<div class="col-lg-12 col-sm-12 col-xs-12">
  <hr>
  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="text-center bg-info">
                          <td>No</td>
                          <td>Nik</td>
                          <td>Nama</td>
                          <td>Departemen</td>
                          <td>Devisi</td>
                          <td>Jabatan</td>
                          <td>Aksi</td>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php 
                          $sect = Illuminate\Support\Facades\DB::table("section")->where("id_sect",$v->devisi)->first();
                           ?>
                          <?php if($v->flag==1): ?>
                        <tr class="text-center label-danger" style="color: white;">
                          <td style="text-decoration-line: line-through; "><?php echo e($v->no); ?></td>
                          <td style="text-decoration-line: line-through; "><?php echo e($v->nik); ?></td>
                          <td style="text-decoration-line: line-through; "><?php echo e($v->nama); ?></td>
                          <td style="text-decoration-line: line-through; "><?php echo e($v->dept); ?></td>
                          <td style="text-decoration-line: line-through; "><?php echo e($sect?$sect->sect:"-"); ?></td>
                          <td style="text-decoration-line: line-through; "><?php echo e($v->jabatan); ?></td>
                          <td>
                             <?php if(in_array('password karyawan',$arrRULE)): ?>
                            <button class="btn btn-default btn-xs" name="new_password" data-toggle="modal" data-target="#myModal" nik="<?php echo e($v->nik); ?>"><i class="fa fa-key"></i> Create Password </button>
                            <?php endif; ?>
                            <?php if(in_array('edit karyawan',$arrRULE)): ?>
                            <button class="btn btn-warning btn-xs" nik="<?php echo e($v->nik); ?>" name="editKar" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>
                            <?php endif; ?>
                            <a href="<?php echo e(url('/data/karyawan/admin/enable?nik='.$v->nik)); ?>" class="btn btn-default btn-xs"><i class="fa fa-check"></i></a>
                          </td>
                        </tr>
                        <?php else: ?>
                        <tr class="text-center">
                          <td><?php echo e($v->no); ?></td>
                          <td><?php echo e($v->nik); ?></td>
                          <td><?php echo e($v->nama); ?></td>
                          <td><?php echo e($v->dept); ?></td>
                          <td><?php echo e($sect?$sect->sect:"-"); ?></td>
                          <td><?php echo e($v->jabatan); ?></td>
                          <td>
                             <?php if(in_array('password karyawan',$arrRULE)): ?>
                            <button class="btn btn-default btn-xs" name="new_password" data-toggle="modal" data-target="#myModal" nik="<?php echo e($v->nik); ?>"><i class="fa fa-key"></i> Create Password </button>
                            <?php endif; ?>
                            <?php if(in_array('edit karyawan',$arrRULE)): ?>
                            <button class="btn btn-warning btn-xs" nik="<?php echo e($v->nik); ?>" name="editKar" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i></button>
                            <?php endif; ?>
                            <a href="<?php echo e(url('/data/karyawan/admin/disable?nik='.$v->nik)); ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
                          </td>
                        </tr>
                        <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
</div>
<div class="col-lg-12 text-center">

<?php if(isset($_GET['status'])): ?>
  <?php if(isset($_GET['cari'])): ?>
  <?php echo e($karyawan->appends(['status' => $_GET['status'],'cari' => $_GET['cari']])->links()); ?>

  <?php else: ?>
  <?php echo e($karyawan->appends(['status' => $_GET['status']])->links()); ?>

  <?php endif; ?>
  <?php else: ?>
  <?php echo e($karyawan->links()); ?>

  <?php endif; ?>
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
  <div class="modal-dialog modal-md" id="modal_dialog">
<div id="konten_modal"></div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Datatables -->
    <script src="<?php echo e(asset('/vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-buttons/js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/jszip/dist/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/pdfmake/build/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/pdfmake/build/vfs_fonts.js')); ?>"></script>
    <!-- jQuery autocomplete -->
    <script src="<?php echo e(asset('/js-auto/dist/jquery.autocomplete.min.js')); ?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo e(asset('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>"></script>

<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    $("button[name=tmh_karyawan]").click(function(){
      eq = $("button[name=tmh_karyawan]").index(this);
      nik = $("button[name=tmh_karyawan]").eq(eq).attr("nik");
      $.ajax({
        type:"GET",
        url:"<?php echo e(url('/absen/form/karyawan')); ?>",
        // data:{nik:nik},
        success:function(res){
          $("div[id=konten_modal]").html(res);
        }
      });
    });

    $("button[name=editKar]").click(function(){
      eq = $("button[name=editKar]").index(this);
      nik = $("button[name=editKar]").eq(eq).attr("nik");
      $.ajax({
        type:"GET",
        url:"<?php echo e(url('/absen/edit/karyawan')); ?>",
        data:{nik:nik},
        success:function(res){
          $("div[id=konten_modal]").html(res);
        }
      });
    });


    $("button[name=new_password]").click(function(){
      eq = $("button[name=new_password]").index(this);
      nik = $("button[name=new_password]").eq(eq).attr("nik");
      $.ajax({
        type:"GET",
        url:"<?php echo e(url('/karyawan/createpassword')); ?>",
        data:{nik:nik},
        success:function(res){
          $("div[id=konten_modal]").html(res);
        }
      });
    });
    $("select").selectpicker();
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