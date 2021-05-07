
<?php $__env->startSection('title'); ?>
ABP-system | Rencana Kebutuhan Barang
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link href="<?php echo e(asset('/vendors/switchery/dist/switchery.min.css')); ?>" rel="stylesheet">
<style>
  thead tr th,tbody tr td{
    text-align: center;
  }    
  .dropdown-menu{
    box-shadow: 1px 1px 5px 5px rgba(0,0,0,0.2);
  }
  .dropdown-menu .print_prev{
    background-color: rgba(242,214,125,0.9);

    color: rgba(0,0,0,0.7);
  }
  .dropdown-menu .details{
    background-color: rgba(245,148,28,0.9);

    color: #fff;
  }
  .dropdown-menu .cancel{
    background-color: rgba(191,17,46,0.9);
    color: #fff;
  }
  .dropdown-menu .po{
    background-color: rgba(56,146,166,0.9);
    color: #fff;
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
 <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tulis Pesan Informasi</h2>
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
                    <br/>


  <div class="row">

<div class="col-md-7">
  <div class="row">
<div class="col-md-12">
  <div class="btn-group">
  <a href="<?php echo e(url('/tulis/pesan')); ?>" class="btn btn-default">Tulis Baru</a>
</div>
</div>
</div>

</div>
<div class="col-md-5">
  <div class="row">
  <form action="" method="post" class="form-horizontal">
    <?php echo e(csrf_field()); ?>

      <div class="form-group">
        <label class="control-label col-md-6"> Cari</label>
        <div class=" col-md-6">
          <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari ..." autocomplete="off" value="<?php echo e(isset($_POST['search']) ? $_POST['search'] : ''); ?>" required="required">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </span>
          </div>
        </div>
      </div>
  </form>
  </div>
</div>
</div>

                    <div class="col-sm-12">
                      <form id="demo-form2" action="<?php echo e(url('/tulis/pesan')); ?>"  data-parsley-validate class="form-horizontal form-label-left" method="post">
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subjek_informasi">Subjek Informasi <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" id="subjek_informasi" name="subjek_informasi" required="required" class="form-control col-md-7 col-xs-12" placeholder="Subjek Informasi">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pesan_informasi">Pesan Informasi <span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <textarea type="text" id="pesan_informasi" name="pesan_informasi" required="required" class="form-control col-md-12 col-xs-12" placeholder="Pesan Informasi"></textarea>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Kirim</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                        </div>
                      </div>

                    </form>
                    </div>
<div class="col-sm-12">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Dikirim</th>
        <th>Judul</th>
        <th>Pesan</th>
        <th>Penulis</th>
        <th>Tanggal Pesan</th>
        <th>Status Pesan</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $dataInformasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($v->id_informasi); ?></td>
        <td><?php echo e($v->nama); ?></td>
        <td><?php echo e($v->subjek); ?></td>
        <td><?php echo e($v->pesan); ?></td>
        <td><?php echo e($v->userIn); ?></td>
        <td><?php echo e(date("d F Y H:i:s",strtotime($v->tglIn))); ?></td>
        <td><?php if($v->flag<1): ?><b style='color:red;'> Belum Terkirim <i class="fa fa-times"></i></b> <?php else: ?> <b style='color:green;'>Terkirim <i class="fa fa-check"></i></b> <?php endif; ?></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>
<div class="col-sm-12">
  <?php echo e($dataInformasi->links()); ?>

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

<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/switchery/dist/switchery.min.js')); ?>"></script>
   <script src="<?php echo e(asset('/clipboard/dist/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/ckeditor/ckeditor.js')); ?>"></script>


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
          type: 'danger',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>
<script>
  // var editor1 = new CKEDITOR.replace( 'pesan_informasi' );
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>