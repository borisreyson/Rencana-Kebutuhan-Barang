
<?php $__env->startSection('title'); ?>
ABP-system | Master Form Department
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                    <h2>Form<small>Master Section</small></h2>
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
<form id="demo-form2" <?php if(!isset($edit_sect)): ?> action="/sect/form" <?php else: ?> action="/sect/<?php echo e(bin2hex($edit_sect->id_sect)); ?>-<?php echo e(bin2hex($edit_sect->sect)); ?>.edit" <?php endif; ?> data-parsley-validate class="form-horizontal form-label-left" method="post">
                      <?php echo e(csrf_field()); ?>                                            
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department">Department<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <select id="id_department" required="required" name="id_department" class="form-control col-md-7 col-xs-12" value="<?php echo e(isset($edit_sect->id_dept) ? $edit_sect->id_dept : ''); ?>" placeholder="Id Department">
                            <option value="">--PILIH--</option>
                            <?php $__currentLoopData = $dept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($edit_sect)): ?>
                            <?php if($edit_sect->id_dept == $v->id_dept): ?>
                            <option value="<?php echo e($v->id_dept); ?>" selected><?php echo e($v->dept); ?></option>
                            <?php else: ?>
                            <option value="<?php echo e($v->id_dept); ?>"><?php echo e($v->dept); ?></option>  
                            <?php endif; ?>                          
                            <?php else: ?>
                            <option value="<?php echo e($v->id_dept); ?>"><?php echo e($v->dept); ?></option>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_section">Id Section <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" id="id_section" required="required" name="id_section" class="form-control col-md-7 col-xs-12" value="<?php echo e(isset($edit_sect->id_sect) ? $edit_sect->id_sect : ''); ?>" placeholder="Id Section"  <?php if(isset($edit_sect->id_sect)): ?> readonly="readonly" <?php endif; ?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section">Section <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" id="sect" name="sect" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo e(isset($edit_sect->sect) ? $edit_sect->sect : ''); ?>" placeholder="Section">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <?php if(!isset($edit_sect)): ?>
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <?php else: ?>
                          <button type="submit" class="btn btn-success">Update</button>
                          <a href="<?php echo e(url('/form_dept')); ?>" class="btn btn-default">New Entry</a>
                      <?php endif; ?>
                          <a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
                        </div>
                      </div>

                    </form>

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