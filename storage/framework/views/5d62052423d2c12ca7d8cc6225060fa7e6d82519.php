
<?php $__env->startSection('title'); ?>
ABP-system | Absen Abp
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
<style>
.ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;height: 100px;
  overflow-y: auto;
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

.active { z-index: 1!important; }
.border{
  border:1px solid #333;
  margin: 2px!important;
}
.label-success{
  color: white!important;
}
.label-success:hover{
  color: black!important;
}
.listPerson .idDel{
  position: absolute!important;
  top: 10px!important;
  right:15px !important;
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
                  <h2>Absen</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

  <div class="row col-lg-12">

<div class="col-lg-12 row">

  <div class="col-lg-6">

    <form action="" method="get" class="form-horizontal col-lg-10 row">
    <div class="form-group">
    <label class="control-label col-lg-3">Nik / Nama</label>
    <div class="col-lg-6">
      <select name="nik" id="nik"  class="form-control" required="required" data-live-search="true">
        <option value="">--Pilih--</option>
        <?php $__currentLoopData = $kar_HGE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $vv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $cek = Illuminate\Support\Facades\DB::table("absensi.ceklog")->where("nik",$vv->nik)->first();
        ?>
          <?php if($vv->flag==0): ?>
          <?php if(isset($_GET['nik'])): ?>
          <?php if($_GET['nik']==$vv->nik): ?>
          <option value="<?php echo e($vv->nik); ?>" selected="selected">(<?php echo e($vv->nik); ?>) <?php echo e($vv->nama); ?></option>  
          <?php else: ?>          
          <?php if(isset($cek->nik) == $vv->nik): ?>
          <option value="<?php echo e($vv->nik); ?>" class="label-success">(<?php echo e($vv->nik); ?>) <?php echo e($vv->nama); ?> </option>
          <?php else: ?>          
          <option value="<?php echo e($vv->nik); ?>">(<?php echo e($vv->nik); ?>) <?php echo e($vv->nama); ?></option> 
          <?php endif; ?>   
          <?php endif; ?>
          <?php else: ?>        
          <?php if(isset($cek->nik) == $vv->nik): ?>
          <option value="<?php echo e($vv->nik); ?>" class="label-success">(<?php echo e($vv->nik); ?>) <?php echo e($vv->nama); ?> </option>
          <?php else: ?>          
          <option value="<?php echo e($vv->nik); ?>">(<?php echo e($vv->nik); ?>) <?php echo e($vv->nama); ?></option> 
          <?php endif; ?> 
          <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>     
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-lg-3">Dari</label>
    <div class="col-lg-3">
      <?php if(isset($_GET['dari'])): ?>
      <input type="text" name="dari" id="dari" class="form-control dateRange" required="required" value="<?php echo e(date('01 F Y',strtotime($_GET['dari']))); ?>"  />
      <?php else: ?>
      <input type="text" name="dari" id="dari" class="form-control dateRange" required="required" value="<?php echo e(date('01 F Y')); ?>"  />
      <?php endif; ?>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-lg-3">Sampai</label>
    <div class="col-lg-3">
      <?php if(isset($_GET['sampai'])): ?>
      <input type="text" name="sampai" id="sampai" class="form-control dateRange" required="required" value="<?php echo e(date('t F Y',strtotime($_GET['sampai']))); ?>" />
      <?php else: ?>
      <input type="text" name="sampai" id="sampai" class="form-control dateRange" required="required" value="<?php echo e(date('t F Y')); ?>" />
      <?php endif; ?>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-lg-3">Dari</label>
    <div class="col-lg-3">
      <select name="status" id="status"  class="form-control" required="required" data-live-search="true">
          <?php if(isset($_GET['status'])): ?>
          <?php if(($_GET['status'])==="masuk"): ?>
          <option value="all">--All--</option>
          <option value="masuk" selected="selected">Masuk</option>
          <option value="pulang" >Pulang</option>  
          <?php elseif(($_GET['status'])==="pulang"): ?>
          <option value="all">--All--</option>
          <option value="masuk">Masuk</option>
          <option value="pulang" selected="selected">Pulang</option>  
          <?php else: ?>          
          <option value="all" selected="selected">--All--</option>
          <option value="masuk">Masuk</option>   
          <option value="pulang">Pulang</option>    
          <?php endif; ?>
          <?php else: ?>
          <option value="all" selected="selected">--All--</option>
          <option value="masuk">Masuk</option>   
          <option value="pulang">Pulang</option>    

          <?php endif; ?>
      </select>  
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-6">
      <button class="btn btn-primary" id="kirim" type="submit">Kirim</button>   
      <a class="btn btn-danger" id="reset" href="<?php echo e(url($_SERVER['REDIRECT_URL'])); ?>">Reset</a>   
    </div>
  </div>
    </form>
  </div>
  
  <div class="col-lg-12">
    <hr>
    <p><b>Jumlah : <?php echo e(count($dataAbsen)); ?></b> </p>
    <hr>
  </div>
  <div class="col-lg-12">
    <?php if(count($dataAbsen)>0): ?>
    <div class="col-lg-12">
      <a href="<?php echo e(url('/absen/user/hge/export?').$_SERVER['QUERY_STRING'].'&dept='.$dept); ?>" class="btn btn-primary">Export</a>
    </div>
      <?php $__currentLoopData = $dataAbsen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-6 listPerson">
      <div class="border row">
      <div class="col-lg-12 row">
        <div class="col-lg-3 row">
          <a href="<?php echo e(url('/face_id').'/'.$v->nik.'/'.$v->gambar); ?>" target="_blank" title="Click to Zoom"><img class="thumbnail" style="margin: 0px!important;" src="<?php echo e(asset(url('/face_id').'/'.$v->nik.'/'.$v->gambar)); ?>"></a></div>
        <div class="col-lg-9" style="margin-left: 10px!important;padding: 10px;">
          <div class="col-lg-12 ">
            <div class="col-lg-4">Tanggal</div>
            <div class="col-lg-8"><?php echo e(date("d F Y",strtotime($v->tanggal))); ?></div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-4">Nik</div>
            <div class="col-lg-8"><?php echo e($v->nik); ?></div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-4">Nama Lengkap</div>
            <div class="col-lg-8"><?php echo e($v->nama); ?></div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-4">Jam Cek log</div>
            <div class="col-lg-8"><?php echo e($v->jam); ?></div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-4">Status</div>
            <div class="col-lg-8">
              <?php if($v->status=="Masuk"): ?>
              <label class="label label-success">
              <?php echo e($v->status); ?>

            </label>
            <?php elseif($v->status=="Pulang"): ?>
            <label class="label label-danger">
              <?php echo e($v->status); ?>

            </label>
            <?php endif; ?>
          </div>
          </div>
        </div>
      </div>
      </div>
      <?php if($v->flag==0): ?>
      <div class="idDel">
              <button name="hapus" nik="<?php echo e($v->nik); ?>" tgl="<?php echo e(strtotime($v->tanggal)); ?>" status="<?php echo e($v->status); ?>" class="btn btn-xs btn-danger" ><i class="fa fa-times"></i></button>
            </div>
            <?php endif; ?>
    </div>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
  <div class="col-lg-12"> No Data!</div>
      <?php endif; ?>
  <hr>
  </div>
</div>
<div class="col-lg-12 text-center">
  <!---PAGINATION-->
  <?php if(isset($_GET['nik'])): ?>
  <?php echo e($dataAbsen->appends([
    "nik"=>$_GET['nik'],
    "dari"=>$_GET['dari'],
    "sampai"=>$_GET['sampai'],
    "status"=>$_GET['status']
    ])->links()); ?>

  <?php else: ?>
  <?php echo e($dataAbsen->links()); ?>

  <?php endif; ?>
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
      $("button[name=hapus]").click(function(){
        eq = $("button[name=hapus]").index(this);
        nik = $("button[name=hapus]").eq(eq).attr("nik");
        tgl = $("button[name=hapus]").eq(eq).attr("tgl");
        status = $("button[name=hapus]").eq(eq).attr("status");
        $.ajax({
          type:"POST",
          url:"<?php echo e(url('/absen/rekap/karyawan/validasi')); ?>",
          data:{_token:"<?php echo e(csrf_token()); ?>",nik:nik,tgl:tgl,status:status},
          success:function(res){
            if(res=="berhasil"){
              window.location.reload();
            }else{
              alert("Gagal Update!");  
            }
          }

        });
      });
      $("select").selectpicker();

    $("input[name=dari]").datepicker({ dateFormat: 'dd MM yy' });
    $("input[name=sampai]").datepicker({ dateFormat: 'dd MM yy' });
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