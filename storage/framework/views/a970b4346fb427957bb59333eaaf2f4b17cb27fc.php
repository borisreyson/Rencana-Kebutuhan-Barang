
<?php $__env->startSection('title'); ?>
ABP-system | Master Department
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <!-- Datatables -->
    <link href="<?php echo e(asset('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')); ?>" rel="stylesheet">

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
                    <h2>Master<small>Section</small></h2>
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
                      <a href="<?php echo e(url('/sect/form')); ?>" class="btn btn-default">Buat Section Baru</a>
                      <a href="<?php echo e(url('/form_dept')); ?>" class="btn btn-default">Buat Departemen Baru</a>
                      <?php if($_SESSION['level']=="administrator"): ?>

                      <a href="<?php echo e(url('/form_user')); ?>" class="btn btn-default">Buat User Baru</a>
                      <?php endif; ?>
                      <br/>
                      <br/>
<div class="row">
<div class="col-md-12 col-xs-12">
                    <div class="table-responsive">
                      <table class="table table-striped ">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No </th>
                            <th class="column-title">Id Section</th>
                            <th class="column-title">Section</th>
                            <th class="column-title">Department</th>
                            <th class="column-title no-link last" align="right"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="5">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
<?php if(count($sect)>0): ?>
<?php $__currentLoopData = $sect; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($k%2): ?>
                          <tr class="even pointer">
                            <td class=" "><?php echo e($k+1); ?></td>
                            <td class=" "><?php echo e(strtoupper($v->id_sect)); ?></td>
                            <td class=" "><?php echo e(ucwords(strtolower($v->sect))); ?></td>
                            <td class=" "><?php echo e($v->dept); ?></td>
                            <td class=" " width="150px">
                              <a href="<?php echo e(url('/sect/'.bin2hex($v->id_dept).'-'.bin2hex($v->id_sect).'.edit')); ?>" class="btn btn-warning btn-xs">Edit</a>
                              <a href="<?php echo e(url('/sect/'.bin2hex($v->id_dept).'-'.bin2hex($v->id_sect).'.del')); ?>" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                          </tr>
<?php else: ?>
                          <tr class="odd pointer">
                            <td class=" "><?php echo e($k+1); ?></td>
                            <td class=" "><?php echo e(strtoupper($v->id_sect)); ?></td>
                            <td class=" "><?php echo e(ucwords(strtolower($v->sect))); ?></td>
                            <td class=" "><?php echo e($v->dept); ?></td>
                            <td class=" " width="150px">
                              <a href="<?php echo e(url('/sect/'.bin2hex($v->id_dept).'-'.bin2hex($v->id_sect).'.edit')); ?>" class="btn btn-warning btn-xs">Edit</a>
                              <a href="<?php echo e(url('/sect/'.bin2hex($v->id_dept).'-'.bin2hex($v->id_sect).'.del')); ?>" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                          </tr>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
                          <tr class="even pointer">
                            <td class=" " colspan="5" align="center">Not have recored yet!</td>
                          </tr>
<?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div id="paging pull-right"><?php echo e($sect->links()); ?></div>
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

<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
  
  $("#datatables").dataTable({
    "order": [[ 1, "asc" ]]
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