
<?php $__env->startSection('title'); ?>
ABP-system | Request Master Item
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
  position: relative!important;
  left: 0!important;
  right: 0!important;
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
    <a href="<?php echo e(url('/masteritem/request/detail')); ?>">Master Request</a>
    <br>
    <br>
  </div>
  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Request Master Item</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">          
  <div class="row">
    <div class="col-xs-12">
      <?php if(in_array('user inventory',$arrRULE)): ?>
      <a href="<?php echo e(url('/masteritem/request')); ?>" class="btn btn-info" id="StockIn" ><i class="fa fa-plus"></i> New Request Master Item</a>
      <?php endif; ?>
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
  </div>
<table class="table table-striped table-bordered">
  <thead>
    <tr class="bg-primary ">
      <th class="text-center">Part Name</th>
      <th class="text-center">Part Number</th>
      <th class="text-center">Satuan</th>
      <th class="text-center">Minimum</th>
      <th class="text-center">Category</th>
      <?php if(in_array('admin inventory',$arrRULE)): ?>
      <th class="text-center">User Request</th>
      <?php endif; ?>
      <th class="text-center" style="width: 200px;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($data)): ?>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
         $cek = Illuminate\Support\Facades\DB::table("invmaster_item")
         ->join("inv_cat_item","inv_cat_item.CodeCat","invmaster_item.item_cat")
         ->whereRaw("item_desc ='".$v->part_name."' and part_number='".$v->part_number."'")->first();
    ?>
    <tr>
      <td>
        <?php echo e($v->part_name); ?>

         <?php if(in_array('admin inventory',$arrRULE)): ?>
         <?php if(isset($cek)): ?>
         <hr>
         <font color="green"><?php echo e($cek->item_desc); ?></font>
         <?php endif; ?>
         <?php endif; ?>
      </td>
      <td><?php echo e($v->part_number); ?>

      <?php if(in_array('admin inventory',$arrRULE)): ?>
         <?php if(isset($cek)): ?>
         <hr>
         <font color="green"><?php echo e($cek->part_number); ?></font>
         <?php endif; ?>
         <?php endif; ?>
       </td>
      <td><?php echo e($v->satuan); ?>

      <?php if(in_array('admin inventory',$arrRULE)): ?>
         <?php if(isset($cek)): ?>
         <hr>
         <font color="green"><?php echo e($cek->satuan); ?></font>
         <?php endif; ?>
         <?php endif; ?>
       </td>
      <td><?php echo e($v->minimum); ?>

      <?php if(in_array('admin inventory',$arrRULE)): ?>
         <?php if(isset($cek)): ?>
         <hr>
         <font color="green"><?php echo e($cek->minimum); ?></font>
         <?php endif; ?>
         <?php endif; ?>
       </td>
      <td><?php echo e($v->DeskCat); ?>

      <?php if(in_array('admin inventory',$arrRULE)): ?>
         <?php if(isset($cek)): ?>
         <hr>
         <font color="green"><?php echo e($cek->DeskCat); ?></font>
         <?php endif; ?>
         <?php endif; ?>
       </td> 
       <?php if(in_array('admin inventory',$arrRULE)): ?>
      <td class="text-center" style="vertical-align: middle;font-weight: bolder;">
     
        <?php
          $userReq = Illuminate\Support\Facades\DB::table('user_login')->where("username",$v->user_request)->first();
        ?>
         <font color="green"><?php if(isset($userReq)): ?> <?php echo e($userReq ->nama_lengkap); ?> <?php endif; ?></font>
        
       </td> 
       <?php endif; ?>
      <td class="text-center">
        <?php if(in_array('user inventory',$arrRULE)): ?>
        <?php if(!isset($cek)): ?>
        <a href="#" id="editRequest" class="btn btn-warning btn-xs" data-id="<?php echo e(bin2hex($v->id)); ?>"  data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i></a>
        <?php else: ?>
        <label class="btn btn-xs btn-success">Master Item Has Created!</label>
        <?php endif; ?>
        <?php endif; ?>

        <?php if(in_array('admin inventory',$arrRULE)): ?>
        <?php if(!isset($cek)): ?>
          <a href="#" id="register" class="btn btn-primary btn-xs" data-id="<?php echo e(bin2hex($v->id)); ?>"  data-toggle="modal" data-target="#myModal"><i class="fa fa-database"></i> Create To Master Item</a>
        <?php else: ?>
        <hr>

        <font color="green"><i class="fa fa-arrow-left"></i> Permintaan Udah Di register di Master Item</font>
        <?php endif; ?>
        <?php endif; ?>

      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr class="info">
      <td colspan="7">
       <b>Total Record : <?php echo e(count($data)); ?></b>
      </td>
    </tr>
   <?php else: ?>
    <tr>
      <td colspan="7" class="text-center">Not Have Record</td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>
<div class="col-lg-12 text-center">
   <?php echo e($data->links()); ?>

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
  <div class="modal-dialog modal-md">
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
      document.location= "<?php echo e(url('/masteritem/request/detail')); ?>";
    });
    $(document).on("click","a[id=editRequest]",function(){
      eq = $("a[id=editRequest]").index(this);
      data_id = $("a[id=editRequest]").eq(eq).attr("data-id");
      
      $.ajax({
        type:"GET",
        url:"<?php echo e(url('/masteritem/request/item')); ?>",
        data:{data_id:data_id},
        success:function(res){
          $("div[id=konten_modal]").html(res);
          $("select").selectpicker();
        }

      });
    });
        $(document).on("click","a[id=register]",function(){
      eq = $("a[id=register]").index(this);
      data_id = $("a[id=register]").eq(eq).attr("data-id");
      
      $.ajax({
        type:"GET",
        url:"<?php echo e(url('/masteritem/request/create')); ?>",
        data:{data_id:data_id},
        success:function(res){
          $("div[id=konten_modal]").html(res);
          $("select").selectpicker();
        }

      });
    });
  //NEW LOCATION
  $(document).on("click","button[id=StockIn]",function(){
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/stok/masuk')); ?>",
      beforeSend:function(){
        $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse\"");
        $(".modal-dialog").removeClass("modal-md").addClass("modal-xl");
      },
      success:function(result){
        $("div[id=konten_modal]").html(result);
      }
    });
  });
  $(document).on("click","button[id=StockOut]",function(){
    $.ajax({
      type:"GET",
      url:"<?php echo e(url('/inventory/stock/out/new')); ?>",
      beforeSend:function() {
        $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse\"");
        $(".modal-dialog").removeClass("modal-md").addClass("modal-lg");
      },
      success:function(result){
        $("div[id=konten_modal]").html(result);
      }
    });
  });


  $("button[name=detailItemStock]").click(function(){
    eq =  $("button[name=detailItemStock]").index(this);
    idInvSys = $("button[name=detailItemStock]").eq(eq).attr("data-id");
    $.ajax({
      type:"GET",
      url :"/inventory/modal/item/detail",
      data:{idInvSys:idInvSys},
      beforeSend:function(){
        $("div[id=konten_modal]").html("<i class=\"fa fa-spinner fa-pulse\"");
        $(".modal-dialog").removeClass("modal-lg").addClass("modal-md");
      },
      success:function(res){
        $("div[id=konten_modal]").html(res);
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