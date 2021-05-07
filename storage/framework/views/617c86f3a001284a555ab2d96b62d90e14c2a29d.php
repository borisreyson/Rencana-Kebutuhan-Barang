
<?php $__env->startSection('title'); ?>
ABP-system | Stock
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
  <div class="col-lg-12">
    <br>
    <a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right"></i>
    <a href="<?php echo e(url('/inventory/stock')); ?>">Stock</a>
    <br>
    <br>
  </div>
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Stock Inventory Out</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
  <div class="col-lg-12 row">
<form action="" method="get" class="col-lg-6">
    <div class="col-lg-10 input-group">
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Start</span>
          <?php if(isset($_GET['startDate'])){?>
          <input style="background-color: white;" type="text" value="<?php echo e($_GET['startDate']); ?>" class="form-control" name="startDate" placeholder="Start Date" aria-describedby="basic-addon1" readonly>
        <?php }else{?>
          <input style="background-color: white;" type="text" value="<?php echo e(date('d F Y',strtotime('-1month'))); ?>" class="form-control" name="startDate" placeholder="Start Date" aria-describedby="basic-addon1" readonly>
        <?php } ?>
          <span class="input-group-addon" id="basic-addon1">End</span>
           <?php if(isset($_GET['endDate'])){?>
          <input style="background-color: white;" type="text" value="<?php echo e($_GET['endDate']); ?>" class="form-control" name="endDate" placeholder="Start Date" aria-describedby="basic-addon1" readonly>
        <?php }else{?>
          <input style="background-color: white;" type="text" value="<?php echo e(date('d F Y')); ?>" class="form-control" name="endDate" placeholder="Start Date" aria-describedby="basic-addon1" readonly>
        <?php } ?>
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </span>
        </div>
    </div>
</form>
    <div class="row col-lg-3  pull-right">
    <form method="get" action="" class="row input-group">
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
  <div class="row">
<div class="col-lg-12 row">
</div>
</div>
<table class="table table-striped">
  <thead>
    <tr class="bg-primary">
      <th width="150px">No</th>
      <th>User Reciever</th>
      <th>From</th>
      <th>Date Stock Out</th>
      <th>List</th>
    </tr>
  </thead>
  <tbody>
    <?php if(count($cek)>0): ?>
    <?php $__currentLoopData = $cek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $user = Illuminate\Support\Facades\DB::table("db_karyawan.data_karyawan")
                ->join("department","department.id_dept","db_karyawan.data_karyawan.departemen")
                ->where("nik",$v->user_reciever)
                ->first();
    ?>
    <tr>
      <td><a href="<?php echo e(url('/check/stock/out-'.bin2hex($v->noid_out))); ?>" target="_blank"> <?php echo e($v->noid_out); ?></a> <a href="<?php echo e(url('/check/stock/out-'.bin2hex($v->noid_out))); ?>" target="_blank" class="btn btn-xs btn-warning pull-right">Print</a>
      </td>
      <td><?php echo e(ucwords($user->nama)); ?> 
        <br>
        <?php echo e(ucwords($user->dept)); ?> - <?php echo e(($v->section)); ?>

        <br>
        (<?php echo e(ucwords($v->jabatan)); ?>)        
         </td>
      <td><?php echo e(ucwords($v->diterima_dari)); ?> (<?php echo e(ucwords($v->jabatan_a)); ?>)</td>
      <td><?php echo e(date("d F Y", strtotime($v->tglOut))); ?>

      </td>
      <td>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Part Name</th>
              <th>Part Number</th>
              <th>Quantity</th>
              <th>Lokasi</th>
              <th>Remark</th>
            </tr>
          </thead>
          <tbody>
<?php $detail = Illuminate\Support\Facades\DB::table("invout_detail")
                ->where("noid_out",$v->noid_out)
                ->join('invmaster_item',"invmaster_item.item","invout_detail.item")
                ->get();
      foreach($detail as $kD => $vD){
            ?>
            <tr>
              <td><?php echo e(ucwords($vD->item)); ?></td>
              <td><?php echo e(ucwords($vD->item_desc)); ?></td>
              <td><?php echo e(ucwords($vD->part_number)); ?></td>
              <td><?php echo e($vD->stock_out); ?> <?php echo e(ucwords($vD->satuan)); ?></td>
              <td><?php echo e($vD->code_loc); ?></td>
              <td><?php echo e($vD->remark); ?></td>
            </tr>
<?php } ?>
          </tbody>
        </table>
      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr class="info">
      <td colspan="8">
       <b>Total Record : <?php echo e(count($cek)); ?></b>
      </td>
    </tr>
    <?php else: ?>
    <tr>
      <td colspan="8" class="text-center">Not Have Record</td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>
<div class="col-lg-12 text-center">
  <?php if(isset($_GET['category'])): ?>
    <?php echo e($cek->appends(['close_rkb' => 'all' ])->links()); ?>

  <?php else: ?>
    <?php echo e($cek->links()); ?>

  <?php endif; ?>

    
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
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo e(asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/google-code-prettify/src/prettify.js')); ?>"></script>
<script>
  
    $("select").selectpicker();
    $("input[name=startDate]").datepicker({ dateFormat: 'dd MM yy' });
    $("input[name=endDate]").datepicker({ dateFormat: 'dd MM yy' });

    $(".myButtonDiss").click(function(){
      document.location= "<?php echo e(url('/check/stock/out')); ?>";
    });
    
  //NEW LOCATION
  $(document).on("click","button[id=StockIn]",function(){
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/stock/new')); ?>",
      success:function(result){
        $("div[id=konten_modal]").html(result);
      }
    });
  });
  $(document).on("click","button[id=StockOut]",function(){
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/stock/out/new')); ?>",
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