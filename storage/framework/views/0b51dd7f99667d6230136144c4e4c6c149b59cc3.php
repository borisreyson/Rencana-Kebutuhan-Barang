
<?php $__env->startSection('title'); ?>
ABP-system | Vendor
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
                  <h2>Vendor</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
<table class="table table-striped table-bordered">
  <div class="col-lg-12 row">
    <button class="btn btn-primary" id="newSuplier" data-toggle="modal" data-target="#myModal">New Vendor</button>
  </div>
  <thead>
    <tr class="bg-primary">
      <th>Nama Vendor</th>
      <th>Alamat</th>
      <th>Nomor Kontak</th>
      <th>Kategori Vendor</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if(count($suplier)>0): ?>
    <?php $__currentLoopData = $suplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($v->nama_supplier); ?></td>
      <td><?php echo e($v->alamat); ?></td>
      <td><?php echo e($v->nmr_contact); ?></td>
      <td><?php echo e($v->CategoryVendor); ?></td>
      <td>
        <?php if($v->status=='0'): ?>
        <a href="<?php echo e(url('/inventory/suplier/status-'.bin2hex($v->nama_supplier).'-enable')); ?>" class="btn btn-xs btn-success">Enable</a>
        <?php elseif($v->status=='1'): ?>
        <a href="<?php echo e(url('/inventory/suplier/status-'.bin2hex($v->nama_supplier).'-disable')); ?>" class="btn btn-xs btn-danger">Disable</a>
        <?php endif; ?>
      </td>
      <td>
        <button type="button" class="btn btn-xs btn-warning" data-id="<?php echo e(bin2hex($v->nama_supplier)); ?>" id="editSuplier" data-toggle="modal" data-target="#myModal">Edit</button>
        <a href="<?php echo e(url('/inventory/suplier/del-'.bin2hex($v->nama_supplier))); ?>" class="btn btn-xs btn-danger" id="delSuplier">Delete</a>
      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr class="info">
      <td colspan="6">
       <b>Total Record : <?php echo e(count($suplier)); ?></b>
      </td>
    </tr>
    <?php else: ?>
    <tr>
      <td colspan="6" class="text-center">Not Have Record</td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>
<div class="col-lg-12 text-center">
    <?php echo e($suplier->links()); ?>

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
  <div class="modal-dialog modal-lg">
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
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo e(asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/google-code-prettify/src/prettify.js')); ?>"></script>
<script>
  
  //NEW LOCATION
  $(document).on("click","button[id=newSuplier]",function(){
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/suplier/new')); ?>",
      success:function(result){
        $("div[id=konten_modal]").html(result);
      }
    });
  });

  //EDIT LOCATION
  $(document).on("click","button[id=editSuplier]",function(){
    eq = $("button[id=editSuplier]").index(this);
    data_id = $("button[id=editSuplier]").eq(eq).attr("data-id");
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/suplier/edit')); ?>",
      data:{data_id:data_id},
      success:function(result){
        $("div[id=konten_modal]").html(result);
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