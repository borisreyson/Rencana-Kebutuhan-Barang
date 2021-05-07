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
<?php 
function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
 
}

 ?>


<?php $__env->startSection('title'); ?>
ABP-system | Master
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
                  <h2>Inventory Master Item</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <div class="col-lg-12 row">
<div class="col-xs-6">
    <button class="btn btn-primary" id="new_master" data-toggle="modal" data-target="#myModal">New Master Item</button>
    <a href="<?php echo e(url('/export/master/item')); ?>" class="btn btn-primary" id="export">Export To Excel</a>
</div>
<div class="col-xs-6">
  
<div class=" col-lg-6 pull-right">
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
  </div>
<table class="table table-striped table-bordered">
 
  <thead>
    <tr class="bg-primary">
      <th class="text-center">#</th>
      <th class="text-center">Kode Barang</th>
      <th class="text-center">Part Name</th>
      <th class="text-center">Part Number</th>
      <th class="text-center">Satuan</th>
      <th class="text-center">Label</th>
      <th class="text-center">Kategori</th>
      <th class="text-center">Stok Minimal</th>
      <?php if(in_array('purchasing',$arrRULE)): ?>
      <th>Harga</th>
      <?php endif; ?>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if(count($master)>0): ?>
    <?php $__currentLoopData = $master; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td>
        <?php if($v->statusMaster=='1'): ?>
          <i style="color: green;" class="fa fa-check"></i>
        <?php else: ?>
          <i class="fa fa-times" style="color: red;"></i>
        <?php endif; ?>
      </td>
      <td>
        <?php if($v->statusMaster=='1'): ?>
        <font color="green"><b><?php echo e($v->item); ?></b></font>
        <?php else: ?>
        <font color="red"><b><?php echo e($v->item); ?></b></font>
        <?php endif; ?></td>
      <td><?php echo e($v->item_desc); ?></td>
      <td><?php echo e($v->part_number); ?></td>
      <td><?php echo e($v->satuan); ?></td>
      <td><?php echo e(strtoupper($v->category)); ?> ( <?php echo e(ucwords($v->desc_category)); ?> )</td>
      <td>
        <?php echo e(strtoupper($v->DeskCat)); ?>

      </td>
      <td>
        <?php echo e(strtoupper($v->minimum)); ?>

      </td>
      <?php if(in_array('purchasing',$arrRULE)): ?>
      <td class="text-center">
        <?php if($v->harga==NULL): ?>
        -
        <?php else: ?>
        <?php echo e(rupiah($v->harga)); ?>

        <?php endif; ?>
      </td>
      <?php endif; ?>
      <td align="center">
        <?php if(in_array('purchasing',$arrRULE)): ?>
        <button class="btn btn-xs btn-default" data-id="<?php echo e(bin2hex($v->item)); ?>" id="updateHarga" data-toggle="modal" data-target="#myModal1">Update Harga</button>
        <?php endif; ?>
        <button class="btn btn-xs btn-info" data-id="<?php echo e(($v->item)); ?>" id="qrcode" data-toggle="modal" data-target="#myModal1">QR Code</button>
        <?php if($v->statusMaster=='0'): ?>
        <a href="<?php echo e(url('/inventory/master/status-'.bin2hex($v->item).'-enable')); ?>" class="btn btn-xs btn-success">Enable</a>
        <?php endif; ?>
        <?php if($v->statusMaster=='1'): ?>
        <a href="<?php echo e(url('/inventory/master/status-'.bin2hex($v->item).'-disable')); ?>" class="btn btn-xs btn-danger">Disable</a>
        <?php endif; ?>
      
        <button type="button" class="btn btn-xs btn-warning" data-id="<?php echo e(bin2hex($v->item)); ?>" id="editMaster" data-toggle="modal" data-target="#myModal">Edit</button>
        <a href="<?php echo e(url('/inventory/master/del-'.bin2hex($v->item))); ?>" class="btn btn-xs btn-danger" id="delMaster">Delete</a>
      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr class="info">
      <td colspan="10">
       <b>Total Record : <?php echo e(count($master)); ?></b>
      </td>
    </tr>
    <?php else: ?>
    <tr>
      <td colspan="10" class="text-center">Not Have Record</td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>
<div class="col-lg-12 text-center">
    <?php echo e($master->links()); ?>

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

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
<div id="konten_modal1"></div>
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
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.qrcode.min.js')); ?>"></script>
<script>  
  //NEW LOCATION
  $(document).on("click","button[id=new_master]",function(){
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/master/new')); ?>",
      beforeSend:function(){
        $("div[class=modal-dialog]").removeClass("modal-xs").addClass("modal-lg");
      },
      success:function(result){
        $("div[id=konten_modal]").html(result);
      }
    });
  });

  //EDIT LOCATION
  $(document).on("click","button[id=editMaster]",function(){
    eq = $("button[id=editMaster]").index(this);
    data_id = $("button[id=editMaster]").eq(eq).attr("data-id");
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/master/edit')); ?>",
      data:{data_id:data_id},
      beforeSend:function(){        
        $("div[class=modal-dialog]").removeClass("modal-xs").addClass("modal-lg");
      },
      success:function(result){
        $("div[id=konten_modal]").html(result);
      }
    });
  });
  //BARCODE
  $(document).on("click","button[id=qrcode]",function(){
    eq = $("button[id=qrcode]").index(this);
    data_id = $("button[id=qrcode]").eq(eq).attr("data-id");
    $.ajax({
      type:"POST",
      url:"<?php echo e(url('/inventory/view/QRcode')); ?>",
      data:{data_id:data_id,_token:"<?php echo e(csrf_token()); ?>"},
      beforeSend:function(){        
        $("div[class=modal-dialog]").removeClass("modal-lg").addClass("modal-xs");
      },
      success:function(result){
        $("div[id=konten_modal1]").html(result);
      }
    });
  });
$(".myButtonDiss").click(function(){
      document.location= "<?php echo e(url('inventory/master')); ?>";
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